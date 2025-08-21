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
        $request->validate([
            'item_id' => 'required|exists:master_items,item_id',
            'quantity' => 'required|integer|min:1'
        ]);
        
        $item = MasterItem::findOrFail($request->item_id);
        $user = Auth::guard('master_users')->user();
        $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
        
        // Check if item already in cart
        $cartItem = Cart::where('session_id', $sessionId)
                       ->where('item_id', $request->item_id)
                       ->first();
        
        if ($cartItem) {
            // Update quantity
            $cartItem->quantity += $request->quantity;
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
        
        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_count' => Cart::getTotalItems($sessionId)
        ]);
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
