<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Package;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\LogTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data['revenue_today'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_other');
        $log_transaction = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->get(['cart', 'payment_type']);
        $cart = [];
        $default = array();
        foreach($log_transaction as $log) {
            $cart += [
                'payment_type'=> unserialize($log['cart']),
            ];
        }
        // $package_default = Package::whereIn('id', $default)->where('category', 'default')->get();
        return view('dashboard.revenue', $data);
    }
}
