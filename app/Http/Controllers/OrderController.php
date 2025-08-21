<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionSales;
use App\Models\TransactionSalesDetail;
use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $user = Auth::guard('master_users')->user();
        $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
        
        $cartItems = Cart::getCartItems($sessionId);
        $subtotal = Cart::getTotalAmount($sessionId);
        $shippingCost = 25000; // Fixed shipping cost
        $tax = $subtotal * 0.11; // 11% PPN
        $total = $subtotal + $shippingCost + $tax;
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }
        
        return view('orders.checkout', compact('cartItems', 'subtotal', 'shippingCost', 'tax', 'total', 'user'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:500'
        ]);
        
        $user = Auth::guard('master_users')->user();
        $sessionId = $user ? 'user_' . $user->user_id : session()->getId();
        $cartItems = Cart::getCartItems($sessionId);
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong');
        }
        
        $subtotal = Cart::getTotalAmount($sessionId);
        $shippingCost = 25000;
        $tax = $subtotal * 0.11;
        $total = $subtotal + $shippingCost + $tax;
        
        DB::beginTransaction();
        
        try {
            // Create transaction
            $transaction = TransactionSales::create([
                'transaction_number' => 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
                'user_id' => $user->user_id,
                'customer_name' => $user->fullname,
                'customer_email' => $user->email,
                'customer_phone' => $request->phone,
                'shipping_address' => $request->shipping_address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'notes' => $request->notes,
                'subtotal_amount' => $subtotal,
                'shipping_cost' => $shippingCost,
                'tax_amount' => $tax,
                'total_amount' => $total,
                'paid_amount' => 0, // Belum bayar
                'payment_status' => 'pending',
                'order_status' => 'pending',
                'transaction_date' => now()
            ]);
            
            // Create transaction details
            foreach ($cartItems as $cartItem) {
                TransactionSalesDetail::create([
                    'transaction_id' => $transaction->transaction_id,
                    'item_id' => $cartItem->item_id,
                    'item_name' => $cartItem->item_name,
                    'item_price' => $cartItem->item_price,
                    'quantity' => $cartItem->quantity,
                    'subtotal' => $cartItem->subtotal
                ]);
            }
            
            // Clear cart
            Cart::where('session_id', $sessionId)->delete();
            
            DB::commit();
            
            return redirect()->route('orders.success', $transaction->transaction_id)
                            ->with('success', 'Pesanan berhasil dibuat');
                            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage());
        }
    }
    
    public function success($transactionId)
    {
        $user = Auth::guard('master_users')->user();
        $transaction = TransactionSales::with('details')
                                     ->where('transaction_id', $transactionId)
                                     ->where('user_id', $user->user_id)
                                     ->firstOrFail();
        
        return view('orders.success', compact('transaction'));
    }
    
    public function track($transactionNumber)
    {
        $transaction = TransactionSales::with('details')
                                     ->where('transaction_number', $transactionNumber)
                                     ->firstOrFail();
        
        return view('orders.track', compact('transaction'));
    }
    
    public function cancelRequest(Request $request, $transactionId)
    {
        $user = Auth::guard('master_users')->user();
        $transaction = TransactionSales::where('transaction_id', $transactionId)
                                     ->where('user_id', $user->user_id)
                                     ->firstOrFail();
        
        if (!$transaction->canBeCancelled()) {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan karena sudah dikirim atau selesai');
        }
        
        $request->validate([
            'cancellation_reason' => 'required|string|max:500'
        ]);
        
        $transaction->update([
            'cancellation_reason' => $request->cancellation_reason,
            'cancellation_requested_at' => now(),
            'order_status' => 'cancellation_requested'
        ]);
        
        return redirect()->route('history.show', $transaction->transaction_id)
                        ->with('success', 'Permintaan pembatalan telah dikirim ke admin untuk ditinjau');
    }
}
