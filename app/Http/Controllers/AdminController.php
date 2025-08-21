<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionSales;
use App\Models\MasterItem;
use App\Models\MasterCategory;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders = TransactionSales::count();
        $pendingOrders = TransactionSales::where('status', 'pending')->count();
        $shippedOrders = TransactionSales::where('status', 'shipped')->count();
        $totalRevenue = TransactionSales::where('status', '!=', 'cancelled')->sum('total_amount');
        
        $recentOrders = TransactionSales::with('details')
                            ->orderBy('created_at', 'desc')
                            ->limit(10)
                            ->get();
        
        return view('admin.dashboard', compact(
            'totalOrders', 'pendingOrders', 'shippedOrders', 
            'totalRevenue', 'recentOrders'
        ));
    }
}
