<?php

namespace App\Http\Controllers;

use App\Models\TransactionHistory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Monitoring
    public function dashboardSummary() {
        $stockin = TransactionHistory::where('status', 'in')->count();
        $stockout = TransactionHistory::where('status', 'out')->count();
        $stockreturn = TransactionHistory::where('status', 'return')->count();
        $total_transaction = TransactionHistory::get()->count();
        return view('pages.monitoring.dashboard', compact('stockin', 'stockout', 'stockreturn', 'total_transaction'));
    }

    public function dashboardHistory() {
        $histories = TransactionHistory::OrderBy('updated_at', 'desc')->paginate(10);
        return view('pages.monitoring.history', compact('histories'));
    }

}
