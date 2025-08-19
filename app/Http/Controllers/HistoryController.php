<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionSales;
use App\Models\TransactionSalesDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('master_users')->user();
        
        // Query dasar untuk transaction user yang sedang login
        $query = TransactionSales::with(['details.product'])
            ->forUser($user->id)
            ->orderBy('date', 'desc');

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status != '') {
            $query->byStatus($request->status);
        }

        // Filter berdasarkan tanggal jika ada
        if ($request->has('date_from') && $request->date_from != '') {
            $query->whereDate('date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to != '') {
            $query->whereDate('date', '<=', $request->date_to);
        }

        // Pagination
        $transactions = $query->paginate(10);

        return view('history', compact('transactions'));
    }

    public function show($id)
    {
        $user = Auth::guard('master_users')->user();
        
        // Ambil detail transaksi dengan semua relasi
        $transaction = TransactionSales::with(['details.product', 'user'])
            ->where('transaction_sales_id', $id)
            ->where('user_id', $user->id) // Pastikan user hanya bisa lihat transaksinya sendiri
            ->firstOrFail();

        return view('history-detail', compact('transaction'));
    }

    public function cancel($id)
    {
        $user = Auth::guard('master_users')->user();
        
        $transaction = TransactionSales::where('transaction_sales_id', $id)
            ->where('user_id', $user->id)
            ->where('paid_amount', '<', DB::raw('total_amount')) // Status pending
            ->firstOrFail();

        // Set paid_amount to 0 to indicate cancelled
        $transaction->update(['paid_amount' => 0, 'notes' => ($transaction->notes ?? '') . ' [DIBATALKAN]']);

        return redirect()->route('history.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}
