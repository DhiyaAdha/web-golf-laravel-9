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
        $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
        $year = range(2020, Carbon::now()->year);
        $getyear = ($request->year) ? $request->year : Carbon::now()->year;
        foreach ($month as $key => $value) {
            $data['visitor'][$key]['period'] = $months[$value];
            $data['visitor'][$key]['vvip'] = Visitor::whereMonth('created_at', (strlen($value) == 1) ? '0' . $value : $value)
                ->whereYear('created_at', $getyear)->where('tipe_member', 'VVIP')->count();
            $data['visitor'][$key]['vip'] = Visitor::whereMonth('created_at', (strlen($value) == 1) ? '0' . $value : $value)
                ->whereYear('created_at', $getyear)->where('tipe_member', 'VIP')->count();
        }

        // Statistika-mingguan
        $day = range(1, 7);
        $days = array('Senin.', 'Selasa.', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu');
        $week = range([Carbon::now()->startOfWeek()], Carbon::now()->endOfWeek()->week);
        $start_date = Carbon::now()->startOfWeek()->format('Y-m-d');
        $end_date = Carbon::now()->endOfWeek()->format('Y-m-d');
        $date_period = CarbonPeriod::create($start_date, $end_date)->toArray();
        $getweek = ($request->week) ? $request->week : Carbon::now()->week;
        foreach ($day as $key => $value) {
            $data['visitor_daily'][$key]['y'] = $days[$key];
            $data['visitor_daily'][$key]['a'] = Visitor::whereDate('created_at', $date_period[$key])->where('tipe_member', 'VVIP')->count();
            $data['visitor_daily'][$key]['b'] = Visitor::whereDate('created_at', $date_period[$key])->where('tipe_member', 'VIP')->count();
        }
        $data['visitor_week'] = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get()->count();
        $data['visitor_today'] = Visitor::whereDate('created_at', now()->format('Y-m-d'))->count();
        $data['visitor_month'] = Visitor::whereMonth('created_at', now()->month)->count(); //bulan ini  
        $data['visitor_year'] = Visitor::whereYear('created_at', now()->format('Y'))->count();
        $data['visitor_years'] = Visitor::whereYear('created_at', '2023')->count();
        
        $data['visitor_vip'] = Visitor::where('tipe_member', 'VIP')->count();
        $data['visitor_vvip'] = Visitor::where('tipe_member', 'VVIP')->count();
        $data['visitor_vvip_female'] = Visitor::where(
            [
                ['tipe_member', 'VVIP'],
                ['gender', 'perempuan'],
            ]
        )->count();
        $data['visitor_vvip_male'] = Visitor::where(
            [
                ['tipe_member', 'VVIP'],
                ['gender', 'laki-laki'],
            ]
        )->count();
        //VIP 
        $data['visitor_vip_female'] = Visitor::where([
            ['tipe_member', 'VIP'],
            ['gender', 'perempuan'],
        ])->count();
        $data['visitor_vip_male'] = Visitor::where([
            ['tipe_member', 'VIP'],
            ['gender', 'laki-laki'],
        ])->count();


        // data-table analisis tamu
        $visitor = Visitor::select(['name', 'created_at', 'tipe_member', 'updated_at'])->get();
        if ($request->ajax()) {
            return datatables()->of($visitor)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at->format('d F Y');
                })
                ->editColumn('tipe_member', function ($data) {
                    return $data->tipe_member;
                    // if ($data->tipe_member == 'VIP') {
                    //     return `<span class="label label-vip">$data->tipe_member</span>`;
                    // } else {
                    //     return `<span class="label label-vvip">$data->tipe_member</span>`;
                    // }
                })
                ->editColumn('updated_at', function ($data) {
                    return $data->created_at->format('H:i');
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
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
