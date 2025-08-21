<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\MasterItem;
use Illuminate\Support\Facades\Auth;

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
            $request->validate([
                'item_id' => 'required|exists:master_items,item_id',
                'quantity' => 'required|integer|min:1'
            ]);
            
            $item = MasterItem::findOrFail($request->item_id);
            $user = Auth::guard('master_users')->user();
            $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
            
            // Check stock availability
            $currentCartQuantity = Cart::where('session_id', $sessionId)
                ->where('item_id', $request->item_id)
                ->sum('quantity');
            
            $totalRequestedQuantity = $currentCartQuantity + $request->quantity;
            
            if ($totalRequestedQuantity > $item->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $item->stock . ', sudah di keranjang: ' . $currentCartQuantity
                ], 400);
            }
            
            // Add or update cart item
            $cartItem = Cart::where('session_id', $sessionId)
                ->where('item_id', $request->item_id)
                ->first();
            
            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'session_id' => $sessionId,
                    'item_id' => $request->item_id,
                    'quantity' => $request->quantity,
                    'price' => $item->sell_price
                ]);
            }
            
            $itemCount = Cart::getTotalItems($sessionId);
            
            return response()->json([
                'success' => true,
                'message' => 'Item berhasil ditambahkan ke keranjang!',
                'cart_count' => $itemCount
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan item ke keranjang: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1'
            ]);
            
            $user = Auth::guard('master_users')->user();
            $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
            
            $cartItem = Cart::where('id', $id)
                ->where('session_id', $sessionId)
                ->firstOrFail();
            
            $item = MasterItem::findOrFail($cartItem->item_id);
            
            if ($request->quantity > $item->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok tidak mencukupi. Stok tersedia: ' . $item->stock
                ], 400);
            }
            
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
            
            $itemCount = Cart::getTotalItems($sessionId);
            $total = Cart::getTotalAmount($sessionId);
            
            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil diperbarui!',
                'cart_count' => $itemCount,
                'total' => $total
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui keranjang: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function remove($id)
    {
        try {
            $user = Auth::guard('master_users')->user();
            $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
            
            $cartItem = Cart::where('id', $id)
                ->where('session_id', $sessionId)
                ->firstOrFail();
            
            $cartItem->delete();
            
            $itemCount = Cart::getTotalItems($sessionId);
            $total = Cart::getTotalAmount($sessionId);
            
            return response()->json([
                'success' => true,
                'message' => 'Item berhasil dihapus dari keranjang!',
                'cart_count' => $itemCount,
                'total' => $total
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus item dari keranjang: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function clear()
    {
        try {
            $user = Auth::guard('master_users')->user();
            $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
            
            Cart::where('session_id', $sessionId)->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Keranjang berhasil dikosongkan!',
                'cart_count' => 0,
                'total' => 0
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengosongkan keranjang: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function count()
    {
        try {
            $user = Auth::guard('master_users')->user();
            $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
            
            $itemCount = Cart::getTotalItems($sessionId);
            
            return response()->json([
                'success' => true,
                'cart_count' => $itemCount
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan jumlah item: ' . $e->getMessage()
            ], 500);
        }
    }
}
