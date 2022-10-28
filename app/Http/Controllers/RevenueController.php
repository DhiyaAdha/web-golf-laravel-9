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
        $data['revenue_today'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('total_gross');
        $data['revenue_game'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_default');
        $data['revenue_proshop'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_additional');
        $data['revenue_store'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_other');
        return view('dashboard.revenue', $data);
    }
}
