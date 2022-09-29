<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
// use CarbonPeriod;
use App\Models\Visitor;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Models\LogTransaction;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use CreatePersonalAccessTokensTable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Mail\Transport\LogTransport;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Statistika Pertahun Grafik-chart
        $month = range(1, 12);
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
        $getyear = $request->year ? $request->year : Carbon::now()->year;

        $month_period = CarbonPeriod::create(Carbon::now()->subMonths(11), Carbon::now());
        // dd($monthPeriod);
        foreach($month_period as $key => $value) {
            $month_new[$value->format('m')] = [$value->format('n'), $value->format('Y')];
        }
        // dd(array_values($month_new));
        foreach (array_values($month_new) as $key => $value) {
            $data['visitor'][$key]['period'] = $months[$value[0]];
            $data['visitor'][$key]['vvip'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereHas(
                'visitor',
                function (Builder $query) {
                    $query->where('tipe_member', 'VVIP');
                }
            )->whereMonth(
                'created_at',
                strlen($value[0]) == 1 ? '0' . $value[0] : $value[0]
            )->whereYear(
                'created_at', 
                $value[1]
            )
            ->count();

            $data['visitor'][$key]['vip'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereHas(
                'visitor',
                function (Builder $query) {
                    $query->where('tipe_member', 'VIP');
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
        $start_date = Carbon::now()
            ->startOfWeek()
            ->translatedFormat('Y-m-d');
        $end_date = Carbon::now()
            ->endOfWeek()
            ->translatedFormat('Y-m-d');
        $date_period = CarbonPeriod::create($start_date, $end_date)->toArray();
        $now = Carbon::now()->translatedFormat('Y-m-d');
        $last7Days = Carbon::now()->subDays(6)
            ->translatedFormat('Y-m-d');
        $day_period = CarbonPeriod::create($last7Days, $now)->toArray();

        foreach ($day_period as $key => $value) {
            $data['visitor_daily'][$key]['y'] = Carbon::create(
                $day_period[$key]
            )->translatedFormat('d/m/y');

            $data['visitor_daily'][$key]['a'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereHas(
                'visitor',
                function (Builder $query) {
                    $query->where('tipe_member', 'VVIP');
                }
            )->whereDate('created_at', $day_period[$key])
            ->count();
            $data['visitor_daily'][$key]['b'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereHas(
                'visitor',
                function (Builder $query) {
                    $query->where('tipe_member', 'VIP');
                }
            )->whereDate('created_at', $day_period[$key])
            ->count();
            }


        // statistika mingguan & tanggal
        $data['now'] = Carbon::now()->translatedFormat('Y-m-d');
        $data['visitor_week'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereBetween('created_at', 
        [
            Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()
            // $day_period
        ])->count();

        $data['visitor_today'] = LogTransaction::distinct('visitor_id')->whereDate('created_at', now()->format('Y-m-d'))
            ->where('payment_status', 'paid')
            ->count();
        // 

        $data['visitor_month'] = Visitor::whereMonth(
            'created_at',
            now()->month
        )->count(); 
        
        $data['visitor_year'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereYear(
            'created_at',
            $request->year ? $request->year : date('Y')
        )->count();

        $data['visitor_vip'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereHas('visitor', function (
            Builder $query
        ) {
            $query->where('tipe_member', 'VIP');
        })->count();

        $data['visitor_vvip'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereHas('visitor', function (
            Builder $query
        ) {
            $query->where('tipe_member', 'VVIP');
        })->count();

        // total female male VVIP & VIP
        $data['visitor_vvip_female'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereHas(
            'visitor',
            function (Builder $query) {
                $query
                    ->where('tipe_member', 'VVIP')
                    ->where('gender', 'perempuan');
            }
        )->count();
        $data['visitor_vvip_male'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereHas(
            'visitor',
            function (Builder $query) {
                $query
                    ->where('tipe_member', 'VVIP')
                    ->where('gender', 'laki-laki');
            }
        )->count();
        $data['visitor_vip_female'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereHas(
            'visitor',
            function (Builder $query) {
                $query
                    ->where('tipe_member', 'VIP')
                    ->where('gender', 'perempuan');
            }
        )->count();
        $data['visitor_vip_male'] = LogTransaction::distinct('visitor_id')->where('payment_status', 'paid')->whereHas(
            'visitor',
            function (Builder $query) {
                $query
                    ->where('tipe_member', 'VIP')
                    ->where('gender', 'laki-laki');
            }
        )->count();
        
        // data-table analisis tamu
        $visitor = Visitor::select([
            'id',
            'name',
            'created_at',
            'tipe_member',
            'updated_at',
        ])
            ->orderBy('updated_at', 'desc')
            ->get();
        if ($request->ajax()) {
            return datatables()
                ->of($visitor)
                ->editColumn('updated_at', function ($data) {
                    return empty($data->transaction($data->id))
                        ? '-' : $data->transaction($data->id)->created_at->translatedFormat('d F Y');
                })
                ->addColumn('times', function ($data) {
                    return empty($data->transaction($data->id))
                        ? '-' : $data->transaction($data->id)->created_at->translatedFormat('h:i a');
                })
                ->editColumn('tipe_member', function ($data) {
                    return $data->tipe_member;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        // dd($visitor);
        return view('/Analisis-tamu', $data);
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
