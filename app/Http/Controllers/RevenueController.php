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
        // foreach ($month_period as $key => $value) {
        //     $month_new[$value->format('m')] = [$value->format('n'), $value->format('Y')];
        // }
        // foreach (array_values($month_new) as $key => $value) {
        //     $data['permainan'][$key]['period'] = $months[$value[0]];
        //     $data['permainan'][$key]['PERMAINAN'] = LogTransaction::select('jml_default')->whereMonth(
        //         'created_at',
        //         strlen($value[0]) == 1 ? '0' . $value[0] : $value[0]
        //     )->whereYear(
        //         'created_at',
        //         $value[1]
        //     )
        //         ->get();
        // }


        $data = LogTransaction::select('jml_default')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });

        $months=[];
        $monthCount=[];
        foreach($data as $month => $values){
            $months[]=$month;
            $monthCount[]=count($values);
        }























        // //statistika mingguan bar-chart 
        // $now = Carbon::now()->translatedFormat('Y-m-d');
        // $last7Days = Carbon::now()->subDays(6)
        //     ->translatedFormat('Y-m-d');
        // $day_period = CarbonPeriod::create($last7Days, $now)->toArray();

        // foreach ($day_period as $key => $value) {
        //     $data['permainan_daily'][$key]['y'] = Carbon::create(
        //         $day_period[$key]
        //     )->translatedFormat('d/m/y');

        //     $data['permainan_daily'][$key]['a'] = LogTransaction::select('jml_default')->whereDate('created_at', $day_period[$key])->get();
        // }




        // statistika pertahun
        $data['pendapatan_rev_permainan_year'] = LogTransaction::where('payment_status', 'paid')->whereYear(
            'created_at',
            now()->format('Y')
        )->sum('jml_default');
        // statistika mingguan & tanggal
        $data['now'] = Carbon::now()->translatedFormat('Y-m-d');
        $data['pendapatan_rev_permainan_week'] = LogTransaction::where('payment_status', 'paid')->whereBetween(
            'created_at',
            [
                Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()
            ]
        )->sum('jml_default');


        //trendline permainan END
        $data['pendapatan_revenue_today'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->sum('total');
       
        $data['pendapatan_revenue'] = LogTransaction::sum('total');
        $data['pendapatan_revenue_permainan'] = LogTransaction::sum('jml_default');
        $data['pendapatan_revenue_fasilitas'] = LogTransaction::sum('jml_additional');
        $data['pendapatan_revenue_other_all'] = LogTransaction::sum('jml_other');

        $data['pendapatan_revenue_default'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->sum('jml_default');
        $data['pendapatan_revenue_additional'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->sum('jml_additional');
        $data['pendapatan_revenue_other'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))->sum('jml_other');
        //Total revenue today END

        //trendline permainan START

        


        return view('dashboard.revenue', $data, ['data'=>$data, 'months'=>$months, 'monthCount'=>$monthCount]);
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
