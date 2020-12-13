<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;

class DashboardController extends Controller
{
    public function index() {

        $sql = "SELECT MONTHNAME(trx_date) month, count(*) total FROM transactions ".
        "GROUP BY MONTHNAME(trx_date) ".
        "ORDER BY MONTH(trx_date)";

        $transactions = \DB::select($sql);

        $months = [];
        $totals = [];

        foreach ($transactions as $key => $value) {
            $months[] = $value->month;
            $totals[] = $value->total;
        }

        $charts = [
            'months' => $months,
            'totals' => $totals,
        ];

        $data = [
            'chart' => $charts
        ];

        $trx_data = Transactions::orderBy('created_at', 'DESC')->limit(10)->get();

        return view('admin.dashboard', compact('trx_data'))->with($data);
    }
}
