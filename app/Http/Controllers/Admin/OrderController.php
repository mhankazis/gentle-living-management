<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransactionSales;
use App\Models\TransactionSalesDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index(Request $request)
    {
        $query = TransactionSales::with(['user', 'details'])
            ->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Search by transaction number or customer name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('whatsapp', 'like', "%{$search}%");
            });
        }

        $orders = $query->paginate(20);

        // Get status counts for dashboard
        $statusCounts = [
            'pending' => TransactionSales::where('status', 'pending')->count(),
            'confirmed' => TransactionSales::where('status', 'confirmed')->count(),
            'processing' => TransactionSales::where('status', 'processing')->count(),
            'shipped' => TransactionSales::where('status', 'shipped')->count(),
            'delivered' => TransactionSales::where('status', 'delivered')->count(),
            'cancelled' => TransactionSales::where('status', 'cancelled')->count(),
            'cancellation_requested' => TransactionSales::whereNotNull('cancellation_requested_at')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = TransactionSales::with(['user', 'details'])->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
            'admin_notes' => 'nullable|string|max:500'
        ]);

        $order = TransactionSales::findOrFail($id);
        $admin = Auth::guard('master_users')->user();

        DB::beginTransaction();
        
        try {
            $oldStatus = $order->status;
            
            $order->update([
                'status' => $request->status,
                'admin_notes' => $request->admin_notes,
                'updated_by' => $admin->user_id,
                'status_updated_at' => now()
            ]);

            // Log status change
            DB::table('order_status_logs')->insert([
                'transaction_sales_id' => $order->transaction_sales_id,
                'old_status' => $oldStatus,
                'new_status' => $request->status,
                'changed_by' => $admin->user_id,
                'notes' => $request->admin_notes,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::commit();

            return redirect()->route('admin.orders.show', $id)
                           ->with('success', 'Status pesanan berhasil diperbarui');
                           
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update payment status.
     */
    public function updatePaymentStatus(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:unpaid,paid,failed,refunded',
            'paid_amount' => 'nullable|numeric|min:0',
            'payment_notes' => 'nullable|string|max:500'
        ]);

        $order = TransactionSales::findOrFail($id);
        $admin = Auth::guard('master_users')->user();

        $order->update([
            'payment_status' => $request->payment_status,
            'paid_amount' => $request->paid_amount ?? $order->paid_amount,
            'payment_notes' => $request->payment_notes,
            'payment_updated_by' => $admin->user_id,
            'payment_updated_at' => now()
        ]);

        return redirect()->route('admin.orders.show', $id)
                       ->with('success', 'Status pembayaran berhasil diperbarui');
    }

    /**
     * Approve cancellation request.
     */
    public function approveCancellation(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:500'
        ]);

        $order = TransactionSales::findOrFail($id);
        $admin = Auth::guard('master_users')->user();

        if (!$order->cancellation_requested_at) {
            return back()->with('error', 'Pesanan ini tidak memiliki permintaan pembatalan');
        }

        $order->update([
            'status' => 'cancelled',
            'admin_notes' => $request->admin_notes,
            'updated_by' => $admin->user_id,
            'status_updated_at' => now()
        ]);

        return redirect()->route('admin.orders.show', $id)
                       ->with('success', 'Pembatalan pesanan telah disetujui');
    }

    /**
     * Reject cancellation request.
     */
    public function rejectCancellation(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500'
        ]);

        $order = TransactionSales::findOrFail($id);

        if (!$order->cancellation_requested_at) {
            return back()->with('error', 'Pesanan ini tidak memiliki permintaan pembatalan');
        }

        $order->update([
            'status' => 'confirmed', // Return to confirmed status
            'admin_notes' => $request->admin_notes,
            'cancellation_requested_at' => null
        ]);

        return redirect()->route('admin.orders.show', $id)
                       ->with('success', 'Permintaan pembatalan telah ditolak');
    }

    /**
     * Export orders to Excel/CSV.
     */
    public function export(Request $request)
    {
        // Implementation for export functionality
        // Could use Laravel Excel package
        
        return response()->json(['message' => 'Export functionality to be implemented']);
    }

    /**
     * Get order statistics for dashboard.
     */
    public function statistics()
    {
        $stats = [
            'total_orders' => TransactionSales::count(),
            'pending_orders' => TransactionSales::where('order_status', 'pending')->count(),
            'total_revenue' => TransactionSales::where('payment_status', 'paid')->sum('total_amount'),
            'orders_today' => TransactionSales::whereDate('created_at', today())->count(),
            'orders_this_month' => TransactionSales::whereMonth('created_at', now()->month)->count(),
        ];

        return response()->json($stats);
    }
}
