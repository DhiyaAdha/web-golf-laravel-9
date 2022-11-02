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

    public function index() {
        $data['revenue_today'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('total_gross');
        $data['revenue_game'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_default');
        $data['revenue_proshop'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_additional');
        $data['revenue_store'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_other');

        //statistic dynamic of weeks
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

        // Statistika Pertahun Grafik-chart
        $months = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec',
        ];
        $data['years'] = range(Carbon::now()->year - 3, Carbon::now()->year);

        $month_period = CarbonPeriod::create(Carbon::now()->subMonths(11), Carbon::now());
        foreach ($month_period as $key => $value) {
            $month_new[$value->format('m')] = [$value->format('n'), $value->format('Y')];
        }
        foreach (array_values($month_new) as $key => $value) {
           $data['revenue'][$key]['e'] = $months[$value[0]];
           $data['revenue'][$key]['f'] =  LogTransaction::whereMonth('created_at', strlen($value[0]) == 1 ? '0' . $value[0] : $value[0])->whereYear('created_at',$value[1])->sum('total');
           $data['revenue'][$key]['g'] = LogTransaction::whereMonth('created_at', strlen($value[0]) == 1 ? '0' . $value[0] : $value[0])->whereYear('created_at',$value[1])->sum('jml_default');
           $data['revenue'][$key]['h'] =LogTransaction::whereMonth('created_at', strlen($value[0]) == 1 ? '0' . $value[0] : $value[0])->whereYear('created_at',$value[1])->sum('jml_additional');
           $data['revenue'][$key]['i'] = LogTransaction::whereMonth('created_at', strlen($value[0]) == 1 ? '0' . $value[0] : $value[0])->whereYear('created_at',$value[1])->sum('jml_other');
           
        }


        return view('dashboard.revenue', $data);
    }
}
