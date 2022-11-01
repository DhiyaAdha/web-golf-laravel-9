<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Package;
use App\Models\Visitor;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\LogTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\Console\Input\Input;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $req) {
        $data['revenue_today'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('total_gross');
        $data['revenue_game'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_default');
        $data['revenue_proshop'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_additional');
        $data['revenue_store'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_other');

        //statistic dynamic of week
        $now = Carbon::now()->translatedFormat('Y-m-d');
        $last7Days = Carbon::now()->subDays(6)->translatedFormat('Y-m-d');
        $day_period = CarbonPeriod::create($last7Days, $now)->toArray();
        foreach ($day_period as $key => $value) {
            $data['revenue_daily'][$key]['y'] = Carbon::create(
                $day_period[$key]
            )->translatedFormat('l');

            $data['revenue_daily'][$key]['a'] = LogTransaction::whereDate('created_at', $day_period[$key])->where('payment_status', 'paid')->sum('jml_default');
            $data['revenue_daily'][$key]['b'] = LogTransaction::whereDate('created_at', $day_period[$key])->where('payment_status', 'paid')->sum('jml_additional');
            $data['revenue_daily'][$key]['c'] = LogTransaction::whereDate('created_at', $day_period[$key])->where('payment_status', 'paid')->sum('jml_other');
            $data['revenue_daily'][$key]['d'] = $data['revenue_daily'][$key]['a'] + $data['revenue_daily'][$key]['b'] + $data['revenue_daily'][$key]['c'];
        }
        foreach ($day_period as $key => $value) {
            $data['revenue_daily2'][$key]['q'] = Carbon::create(
                $day_period[$key]
            )->translatedFormat('l');

            $data['revenue_daily2'][$key]['w'] = LogTransaction::whereDate('created_at', $day_period[$key])->where('payment_status', 'paid')->sum('jml_default');
        }

        return view('dashboard.revenue', $data);
    }
}
