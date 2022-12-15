<?php

namespace App\Http\Controllers;

use App\Models\LogTransaction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function analytic_week_revenue()
    {
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
            $data['revenue_daily'][$key]['d'] = LogTransaction::whereDate('created_at', $day_period[$key])->where('payment_status', 'paid')->sum('jml_rental');
            $data['revenue_daily'][$key]['e'] = LogTransaction::whereDate('created_at', $day_period[$key])->where('payment_status', 'paid')->sum('jml_service');
            $data['revenue_daily'][$key]['f'] = $data['revenue_daily'][$key]['a'] + $data['revenue_daily'][$key]['b'] + $data['revenue_daily'][$key]['c'];
        }
        $data = json_encode($data['revenue_daily']);

        return response()->json($data);
    }

    public function analytic_month_revenue()
    {
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
            $data['revenue'][$key]['g'] = LogTransaction::whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1])->sum('jml_default');
            $data['revenue'][$key]['h'] = LogTransaction::whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1])->sum('jml_additional');
            $data['revenue'][$key]['i'] = LogTransaction::whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1])->sum('jml_other');
            $data['revenue'][$key]['j'] = LogTransaction::whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1])->sum('jml_rental');
            $data['revenue'][$key]['k'] = LogTransaction::whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1])->sum('jml_service');
            $data['revenue'][$key]['f'] = $data['revenue'][$key]['g'] + $data['revenue'][$key]['h'] + $data['revenue'][$key]['i'] + $data['revenue'][$key]['j'] + $data['revenue'][$key]['k'];
        }

        $data = json_encode($data['revenue']);

        return response()->json($data);
    }

    public function index()
    {
        $data['revenue_today'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('total_gross');
        $data['revenue_game'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_default');
        $data['revenue_proshop'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_additional');
        $data['revenue_store'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_other');
        $data['revenue_rental'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_rental');
        $data['revenue_service'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->where('payment_status', 'paid')->sum('jml_service');
        return view('dashboard.revenue', $data);
    }
}
