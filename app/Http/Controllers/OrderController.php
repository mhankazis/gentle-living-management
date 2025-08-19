<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout()
    {
        $sessionId = session()->getId();
        $cartItems = Cart::getCartItems($sessionId);
        $subtotal = Cart::getTotalAmount($sessionId);
        $shippingCost = 10000; // Fixed shipping cost
        $total = $subtotal + $shippingCost;
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }
        
        return view('orders.checkout', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10'
        ]);
        
        $sessionId = session()->getId();
        $cartItems = Cart::getCartItems($sessionId);
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }
        
        $subtotal = Cart::getTotalAmount($sessionId);
        $shippingCost = 10000;
        $total = $subtotal + $shippingCost;
        
        // Create order
        $order = Order::create([
            'order_number' => 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'shipping_address' => $request->shipping_address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            'status' => 'pending'
        ]);
        
        // Create order items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'item_id' => $cartItem->item_id,
                'item_name' => $cartItem->item_name,
                'item_price' => $cartItem->item_price,
                'quantity' => $cartItem->quantity,
                'subtotal' => $cartItem->subtotal
            ]);
        }
        
        // Clear cart
        Cart::where('session_id', $sessionId)->delete();
        
        return redirect()->route('orders.success', $order->order_id)
                        ->with('success', 'Pesanan berhasil dibuat');
    }
    
    public function success($orderId)
    {
        $order = Order::with('orderItems')->findOrFail($orderId);
        return view('orders.success', compact('order'));
    }
    
    public function track($orderNumber)
    {
        $order = Order::with('orderItems')->where('order_number', $orderNumber)->firstOrFail();
        return view('orders.track', compact('order'));
    }
    
    public function cancelRequest(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        
        if (!$order->canBeCancelled()) {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah dikirim atau diterima');
        }
        
        $request->validate([
            'cancellation_reason' => 'required|string|max:500'
        ]);
        
        // User hanya mengajukan request, bukan langsung cancel
        $order->update([
            'cancellation_reason' => $request->cancellation_reason,
            'cancellation_requested_at' => now()
        ]);
        
        return redirect()->route('orders.track', $order->order_number)
                        ->with('success', 'Permintaan pembatalan telah dikirim ke admin untuk ditinjau');
    }
}
