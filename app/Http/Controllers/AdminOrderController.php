<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    /**
     * Display admin dashboard with orders
     */
    public function dashboard()
    {
        $orders = Order::with(['orderItems.masterItem', 'masterCustomer'])
                      ->orderBy('created_at', 'desc')
                      ->paginate(20);

        return view('admin.dashboard', compact('orders'));
    }

    /**
     * Display all orders for admin
     */
    public function orders()
    {
        $orders = Order::with(['orderItems.masterItem', 'masterCustomer'])
                      ->orderBy('created_at', 'desc')
                      ->paginate(20);

        return view('admin.orders', compact('orders'));
    }

    /**
     * Display order detail for admin
     */
    public function orderDetail($orderId)
    {
        $order = Order::with(['orderItems.masterItem', 'masterCustomer'])
                     ->findOrFail($orderId);

        return view('admin.order-detail', compact('order'));
    }

    /**
     * Update order status (admin privilege)
     */
    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($orderId);
        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', "Status order berhasil diubah dari '$oldStatus' ke '{$request->status}'");
    }

    /**
     * Approve cancellation request (admin privilege)
     */
    public function approveCancellation($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        // Only allow cancellation if not shipped yet
        if (in_array($order->status, ['shipped', 'delivered'])) {
            return redirect()->back()->with('error', 'Order yang sudah dikirim tidak dapat dibatalkan.');
        }

        $order->status = 'cancelled';
        $order->save();

        return redirect()->back()->with('success', 'Pembatalan order telah disetujui.');
    }

    /**
     * Reject cancellation request (admin privilege)
     */
    public function rejectCancellation($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        // Reset cancellation request (you might want to add a separate field for this)
        return redirect()->back()->with('success', 'Pembatalan order telah ditolak.');
    }
}
