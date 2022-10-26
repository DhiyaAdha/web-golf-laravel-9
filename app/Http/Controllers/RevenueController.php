<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\LogTransaction;
use Illuminate\Database\Eloquent\Builder;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Total revenue today START
        $data['pendapatan_revenue_today'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->sum('total');

        $data['pendapatan_revenue_default'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->sum('jml_default');
        $data['pendapatan_revenue_additional'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->sum('jml_additional');
        $data['pendapatan_revenue_other'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->sum('jml_other');
        //Total revenue today END

        //trendline permainan START

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
            $data['log_transaction'][$key]['period'] = $months[$value[0]];
            $data['log_transaction'][$key]['total_permainan'] = LogTransaction::where('payment_status', 'paid',
                function (Builder $query) {
                    $query->where('jml_default');
                }
            )->whereMonth(
                'created_at',
                strlen($value[0]) == 1 ? '0' . $value[0] : $value[0]
            )->whereYear(
                'created_at',
                $value[1]
            )
                ->count();
        }

        //statistika mingguan bar-chart 
        $now = Carbon::now()->translatedFormat('Y-m-d');
        $last7Days = Carbon::now()->subDays(6)
            ->translatedFormat('Y-m-d');
        $day_period = CarbonPeriod::create($last7Days, $now)->toArray();

        foreach ($day_period as $key => $value) {
            $data['permainan_daily'][$key]['y'] = Carbon::create(
                $day_period[$key]
            )->translatedFormat('d/m/y');

            $data['permainan_daily'][$key]['a'] = LogTransaction::where('payment_status', 'paid',
                function (Builder $query) {
                    $query->where('jml_default');
                }
            )->whereDate('created_at', $day_period[$key])
                ->count();
        }





        $data['pendapatan_rev_permainan_year'] = LogTransaction::where('payment_status', 'paid')->whereYear(
            'created_at',
            now()->format('Y')
        )->sum('jml_default');


        //trendline permainan END


        return view('dashboard.revenue', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
