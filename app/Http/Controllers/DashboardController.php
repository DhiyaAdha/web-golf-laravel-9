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
use Illuminate\Mail\Transport\LogTransport;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Statistika Pertahun      
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
        // dd($getyear);
        
        foreach ($month as $key => $value) {
            $data['visitor'][$key]['period'] = $months[$value];
            $data['visitor'][$key]['vvip'] = LogTransaction::whereHas(
                'visitor',
                function (Builder $query) {
                    $query->where('tipe_member', 'VVIP');
                }
            )
                ->whereMonth(
                    'created_at',
                    strlen($value) == 1 ? '0' . $value : $value
                )
                ->whereYear('created_at', $getyear)
                // ->where('tipe_member', 'VVIP')
                ->count();

            $data['visitor'][$key]['vip'] = LogTransaction::whereHas(
                'visitor',
                function (Builder $query) {
                    $query->where('tipe_member', 'VIP');
                }
            )
                ->whereMonth(
                    'created_at',
                    strlen($value) == 1 ? '0' . $value : $value
                )
                ->whereYear('created_at', $getyear)
                // ->where('tipe_member', 'VIP')
                ->count();
        }
        // Statistika-mingguan
        // $day = range(1, 7);
        // $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        // $week = range(
        //     [Carbon::now()->startOfWeek()],
        //     Carbon::now()->endOfWeek()->week
        // );
        // echo '<pre>';
        // dd($week);
        // echo '</pre>';
        // exit();

        // function mingguan
        $start_date = Carbon::now()
            ->startOfWeek()
            ->translatedFormat('Y-m-d');
        $end_date = Carbon::now()
            ->endOfWeek()
            ->translatedFormat('Y-m-d');
        $date_period = CarbonPeriod::create($start_date, $end_date)->toArray();
        // $getweek = $request->week ? $request->week : Carbon::now()->week;
        $now = Carbon::now()->translatedFormat('Y-m-d');
        $last7Days = Carbon::now()
            ->subDays(6)
            ->translatedFormat('Y-m-d');
        $day_period = CarbonPeriod::create($last7Days, $now)->toArray();
        foreach ($day_period as $key => $value) {
            $data['visitor_daily'][$key]['y'] = Carbon::create(
                $day_period[$key]
            )->translatedFormat('D');

            $data['visitor_daily'][$key]['a'] = LogTransaction::whereHas(
                'visitor',
                function (Builder $query) {
                    $query->where('tipe_member', 'VVIP');
                }
            )

                ->whereDate('created_at', $day_period[$key])
                // ->where('tipe_member', 'VVIP')
                ->count();
            $data['visitor_daily'][$key]['b'] = LogTransaction::whereHas(
                'visitor',
                function (Builder $query) {
                    $query->where('tipe_member', 'VIP');
                }
            )
                ->whereDate('created_at', $day_period[$key])
                // ->where('tipe_member', 'VIP')
                ->count();
        }
        // dd($data['visitor_daily']);


        // foreach ($day as $key => $value) {
        //     $data['visitor_daily'][$key]['y'] = $days[$key];
        //     $data['visitor_daily'][$key]['a'] = LogTransaction::whereHas(
        //         'visitor',
        //         function (Builder $query) {
        //             $query->where('tipe_member', 'VVIP');
        //         }
        //     )
        //         ->whereDate('created_at', $date_period[$key])
        //         // ->where('tipe_member', 'VVIP')
        //         ->count();
        //     $data['visitor_daily'][$key]['b'] = LogTransaction::whereHas(
        //         'visitor',
        //         function (Builder $query) {
        //             $query->where('tipe_member', 'VIP');
        //         }
        //     )
        //         ->whereDate('created_at', $date_period[$key])
        //         // ->where('tipe_member', 'VIP')
        //         ->count();
        // }

        
        $data['visitor_week'] = Visitor::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek(Carbon::SATURDAY),
        ])
            ->get()
            ->count();

        // total hari ini
        $data['visitor_today'] = LogTransaction::whereDate(
            'created_at',
            now()->translatedFormat('Y-m-d')
        )->count();
        // minggu ini
        $data['visitor_month'] = Visitor::whereMonth(
            'created_at',
            now()->month
        )->count(); //bulan ini
        $data['visitor_year'] = LogTransaction::whereYear(
            'created_at',
            $request->year ? $request->year : date('Y')
        )->count();

        
        // total VIP VVIP 
        $data['visitor_vip'] = LogTransaction::whereHas(
            'visitor',
            function (Builder $query) {
                $query->where('tipe_member', 'VIP');
            }
        )->count();
        // $data['visitor_vip'] = Visitor::where('tipe_member', 'VIP')->count();
        $data['visitor_vvip'] = LogTransaction::whereHas(
            'visitor',
            function (Builder $query) {
                $query->where('tipe_member', 'VVIP');
            }
        )->count();

        // total gender
          // per gender
        // $data['visitor_vvip_male'] = Visitor::where([
        //     ['tipe_member', 'VVIP'],
        //     ['gender', 'laki-laki'],
        // ])->count();

        // total female male VVIP & VIP
        $data['visitor_vvip_female'] = LogTransaction::whereHas(
            'visitor',
            function (Builder $query) {
                $query->where('tipe_member', 'VVIP')
                ->where('gender','perempuan');
            }
        )->count();
        $data['visitor_vvip_male'] = LogTransaction::whereHas(
            'visitor',
            function (Builder $query) {
                $query->where('tipe_member', 'VVIP')
                ->where('gender','laki-laki');
            }
        )->count();
        $data['visitor_vip_female'] = LogTransaction::whereHas(
            'visitor',
            function (Builder $query) {
                $query->where('tipe_member', 'VIP')
                ->where('gender','perempuan');
            }
        )->count();
        $data['visitor_vip_male'] = LogTransaction::whereHas(
            'visitor',
            function (Builder $query) {
                $query->where('tipe_member', 'VIP')
                ->where('gender','laki-laki');
            }
        )->count();
        // dd($data['visitor_vip_male']);


        // join function
        // $visitor = Visitor::select(
        //     'visitors.name as name',
        //     'visitors.tipe_member as tipe_member',
        //     'log_transactions.created_at'
        // )
        //     ->join(
        //         'log_transactions',
        //         'visitors.id',
        //         '=',
        //         'log_transactions.visitor_id'
        //     )
        //     ->get();
        // dd($visitor);

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
                        ? '-'
                        : $data
                        ->transaction($data->id)
                        ->created_at->translatedFormat('d F Y');
                })
                ->addColumn('times', function ($data) {
                    return empty($data->transaction($data->id))
                        ? '-'
                        : $data
                        ->transaction($data->id)
                        ->created_at->translatedFormat('h:i a');
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
