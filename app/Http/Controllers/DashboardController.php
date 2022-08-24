<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function dashboard(){
        // memanggil data visitor

        $data['visitor'] = DB::table('Visitors')->orderBy('created_at', 'desc')->paginate(10);
        $data['visitor_today'] = Visitor::whereDate('created_at', now()->format('Y-m-d'))->count();
        $data['visitor_week'] = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get()->count();
        $data['visitor_month'] = Visitor::whereMonth('created_at', now()->month)->count(); //bulan ini  
        $data['visitor_year'] = Visitor::whereYear('created_at', now()->format('Y'))->count();
        $data['visitor_years'] = Visitor::whereYear('created_at', '2023')->count();

        $data['visitor_vip'] = Visitor::where('tipe_member', 'VIP')->count();
        $data['visitor_vvip'] = Visitor::where('tipe_member', 'VVIP')->count();
        $data['visitor_vvip_female'] = Visitor::where([
                                            ['tipe_member', 'VVIP'],
                                            ['gender', 'perempuan'],
                                        ])->count();
        $data['visitor_vvip_male'] = Visitor::where([
                                            ['tipe_member', 'VVIP'],
                                            ['gender', 'laki-laki'],
                                        ])->count();
        
        //VIP 
        $data['visitor_vip_female'] = Visitor::where([
                                            ['tipe_member', 'VIP'],
                                            ['gender', 'perempuan'],
                                        ])->count();
        $data['visitor_vip_male'] = Visitor::where([
                                            ['tipe_member', 'VIP'],
                                            ['gender', 'laki-laki'],
                                        ])->count();

        $data['Jan_vvip'] = Visitor::whereMonth('created_at', '01')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Jan_vip'] = Visitor::whereMonth('created_at', '01')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        $data['Feb_vvip'] = Visitor::whereMonth('created_at', '02')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Feb_vip'] = Visitor::whereMonth('created_at', '02')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        $data['Mar_vvip'] = Visitor::whereMonth('created_at', '03')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Mar_vip'] = Visitor::whereMonth('created_at', '03')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        $data['Apr_vvip'] = Visitor::whereMonth('created_at', '04')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Apr_vip'] = Visitor::whereMonth('created_at', '04')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        $data['Mei_vvip'] = Visitor::whereMonth('created_at', '05')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Mei_vip'] = Visitor::whereMonth('created_at', '05')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        $data['Jun_vvip'] = Visitor::whereMonth('created_at', '06')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Jun_vip'] = Visitor::whereMonth('created_at', '06')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        $data['Jul_vvip'] = Visitor::whereMonth('created_at', '07')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Jul_vip'] = Visitor::whereMonth('created_at', '07')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        $data['Aug_vvip'] = Visitor::whereMonth('created_at', '08')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Aug_vip'] = Visitor::whereMonth('created_at', '08')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        $data['Sep_vvip'] = Visitor::whereMonth('created_at', '09')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Sep_vip'] = Visitor::whereMonth('created_at', '09')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        $data['Oct_vvip'] = Visitor::whereMonth('created_at', '10')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Oct_vip'] = Visitor::whereMonth('created_at', '10')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        $data['Nov_vvip'] = Visitor::whereMonth('created_at', '11')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Nov_vip'] = Visitor::whereMonth('created_at', '11')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        $data['Dec_vvip'] = Visitor::whereMonth('created_at', '12')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
        $data['Dec_vip'] = Visitor::whereMonth('created_at', '12')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
        
        // REKAP HARIAN
        // $data['vvip_sen'] = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::MONDAY)->addDays(1), Carbon::now()->endOfWeek(Carbon::SUNDAY)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
        
        $data['vvip_sen'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
        $data['vip_sen'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
        $data['vvip_sel'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(1)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
        $data['vip_sel'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(1)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
        $data['vvip_rab'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(2)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
        $data['vip_rab'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(2)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
        $data['vvip_kam'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(3)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
        $data['vip_kam'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(3)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
        $data['vvip_jum'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(4)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
        $data['vip_jum'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(4)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
        $data['vvip_sa'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(5)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
        $data['vip_sa'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(5)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
        $data['vvip_min'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(6)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
        $data['vip_min'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek()->addDays(6)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();


        return view('/Analisis-tamu', $data);

    }
}
