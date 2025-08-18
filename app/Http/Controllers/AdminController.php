<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\MasterItem;
use App\Models\MasterCategory;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total');
        
        $recentOrders = Order::with('orderItems')
                            ->orderBy('created_at', 'desc')
                            ->limit(10)
                            ->get();
        
        return view('admin.dashboard', compact(
            'totalOrders', 'pendingOrders', 'shippedOrders', 
            'totalRevenue', 'recentOrders'
        ));
    }
    
    public function orders(Request $request)
    {
        $query = Order::with('orderItems');
        
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('order_number', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_email', 'like', '%' . $request->search . '%');
            });
        }
        
        $orders = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.orders.index', compact('orders'));
    }
    
    public function orderDetail($orderId)
    {
        $order = Order::with('orderItems.masterItem')->findOrFail($orderId);
        return view('admin.orders.detail', compact('order'));
    }
    
    public function updateOrderStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
            'admin_notes' => 'nullable|string|max:500'
        ]);
        
        $order = Order::findOrFail($orderId);
        
        $order->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);
        
        return back()->with('success', 'Status pesanan berhasil diupdate');
    }
    
    public function approveCancellation($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        if ($order->status == 'shipped' || $order->status == 'delivered') {
            return back()->with('error', 'Pesanan yang sudah dikirim tidak dapat dibatalkan');
        }
        
        $order->update([
            'status' => 'cancelled',
            'cancelled_at' => now()
        ]);
        
        return back()->with('success', 'Pembatalan pesanan telah disetujui');
    }
    
    public function rejectCancellation(Request $request, $orderId)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500'
        ]);
        
        $order = Order::findOrFail($orderId);
        
        $order->update([
            'admin_notes' => $request->admin_notes,
            'cancellation_reason' => null // Clear cancellation request
        ]);
        
        return back()->with('success', 'Permintaan pembatalan telah ditolak');
    }
}
