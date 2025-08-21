<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\MasterItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::guard('master_users')->user();
        $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
        
        $cartItems = Cart::getCartItems($sessionId);
        $total = Cart::getTotalAmount($sessionId);
        $itemCount = Cart::getTotalItems($sessionId);
        
        return view('cart.index', compact('cartItems', 'total', 'itemCount'));
    }
    
    public function add(Request $request)
    {
        try {
            // Debug: Log authentication status
            $user = Auth::guard('master_users')->user();
            Log::info('Cart add - Auth status:', [
                'is_authenticated' => Auth::guard('master_users')->check(),
                'user_id' => $user ? $user->user_id : null,
                'session_id' => session()->getId(),
                'request_data' => $request->all()
            ]);
            
            $request->validate([
                'item_id' => 'required|exists:master_item,item_id',
                'quantity' => 'required|integer|min:1'
            ]);
            
            $item = MasterItem::findOrFail($request->item_id);
            $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
            
            Log::info('Cart add - Session info:', [
                'final_session_id' => $sessionId,
                'item_id' => $request->item_id,
                'quantity' => $request->quantity
            ]);
            
        } catch (\Exception $e) {
            Log::error('Cart add error:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ], 400);
            } else {
                return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
            }
        }
        
        // Check current quantity in cart
        $cartItem = Cart::where('session_id', $sessionId)
                       ->where('item_id', $request->item_id)
                       ->first();
        
        $currentCartQuantity = $cartItem ? $cartItem->quantity : 0;
        $newTotalQuantity = $currentCartQuantity + $request->quantity;
        
        // Check if new total quantity exceeds stock
        if ($newTotalQuantity > $item->stock) {
            $availableQuantity = $item->stock - $currentCartQuantity;
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $availableQuantity > 0 
                        ? "Stok tidak cukup. Anda hanya dapat menambahkan {$availableQuantity} item lagi."
                        : "Produk sudah mencapai batas maksimum di keranjang Anda.",
                    'available_quantity' => $availableQuantity,
                    'current_stock' => $item->stock
                ], 400);
            } else {
                return redirect()->back()->with('error', 
                    $availableQuantity > 0 
                        ? "Stok tidak cukup. Anda hanya dapat menambahkan {$availableQuantity} item lagi."
                        : "Produk sudah mencapai batas maksimum di keranjang Anda."
                );
            }
        }
        
        if ($cartItem) {
            // Update quantity
            $cartItem->quantity = $newTotalQuantity;
            $cartItem->subtotal = $cartItem->quantity * $cartItem->item_price;
            $cartItem->save();
        } else {
            // Add new item
            Cart::create([
                'session_id' => $sessionId,
                'item_id' => $item->item_id,
                'item_name' => $item->name_item,
                'item_price' => $item->sell_price,
                'quantity' => $request->quantity,
                'subtotal' => $item->sell_price * $request->quantity
            ]);
        }
        
        $totalItems = Cart::getTotalItems($sessionId);
        
        // Handle both JSON and form requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang',
                'cart_count' => $totalItems
            ]);
        } else {
            return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
        }
    }
    
    public function getQuantity($itemId)
    {
        try {
            $user = Auth::guard('master_users')->user();
            $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
            
            $cartItem = Cart::where('session_id', $sessionId)
                           ->where('item_id', $itemId)
                           ->first();
            
            return response()->json([
                'quantity' => $cartItem ? $cartItem->quantity : 0,
                'session_id' => $sessionId,
                'debug' => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'quantity' => 0,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        $user = Auth::guard('master_users')->user();
        $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
        
        $cartItem = Cart::where('cart_id', $cartId)
                       ->where('session_id', $sessionId)
                       ->firstOrFail();
        
        $cartItem->quantity = $request->quantity;
        $cartItem->subtotal = $cartItem->quantity * $cartItem->item_price;
        $cartItem->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Kuantitas berhasil diupdate',
            'subtotal' => number_format($cartItem->subtotal, 0, ',', '.'),
            'total' => number_format(Cart::getTotalAmount($sessionId), 0, ',', '.')
        ]);
    }
    
    public function remove($cartId)
    {
        $user = Auth::guard('master_users')->user();
        $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
        
        $cartItem = Cart::where('cart_id', $cartId)
                       ->where('session_id', $sessionId)
                       ->firstOrFail();
        
        $cartItem->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus dari keranjang'
        ]);
    }
    
    public function clear()
    {
        $user = Auth::guard('master_users')->user();
        $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
        
        Cart::where('session_id', $sessionId)->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan'
        ]);
    }
    
    public function count()
    {
        $user = Auth::guard('master_users')->user();
        $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
        
        return response()->json([
            'count' => Cart::getTotalItems($sessionId)
        ]);
    }
}
