<?php

namespace App\Http\Controllers;

use App\Models\LogTransaction;
// use CarbonPeriod;
use App\Models\Visitor;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AnalisisTamu;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function analytic_week()
    {
        $now = Carbon::now()->translatedFormat('Y-m-d');
        $last7Days = Carbon::now()->subDays(6)->translatedFormat('Y-m-d');
        $day_period = CarbonPeriod::create($last7Days, $now)->toArray();

        foreach ($day_period as $key => $value) {
            $data['visitor_daily'][$key]['y'] = Carbon::create(
                $day_period[$key]
            )->translatedFormat('l');

            $data['visitor_daily'][$key]['a'] = Visitor::where('tipe_member', 'VVIP')->whereHas('log_transaction', function (Builder $query) use ($day_period, $key) {
                $query->whereDate('created_at', $day_period[$key]);
            })->count();
            $data['visitor_daily'][$key]['b'] = Visitor::where('tipe_member', 'VIP')->whereHas('log_transaction', function (Builder $query) use ($day_period, $key) {
                $query->whereDate('created_at', $day_period[$key]);
            })->count();
            $data['visitor_daily'][$key]['c'] = LogTransaction::where('payment_status', 'paid')->whereHas(
                'visitor',
                function (Builder $query) {
                    $query->where('tipe_member', 'REGULER');
                }
            )->whereDate('created_at', $day_period[$key])->count();
        }
        $data = json_encode($data['visitor_daily']);

        return response()->json($data);
    }

    public function analytic_month()
    {
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
            $data['visitor'][$key]['period'] = $months[$value[0]];
            $data['visitor'][$key]['pertamina'] = Visitor::where('category', 'pertamina')->whereHas('log_transaction', function (Builder $query) use ($value) {
                $query->whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1]);
            })->count();
            $data['visitor'][$key]['pensiunan'] = Visitor::where('category', 'pensiunan')->whereHas('log_transaction', function (Builder $query) use ($value) {
                $query->whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1]);
            })->count();
            $data['visitor'][$key]['forkopimda'] = Visitor::where('category', 'forkopimda')->whereHas('log_transaction', function (Builder $query) use ($value) {
                $query->whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1]);
            })->count();
            $data['visitor'][$key]['perpesi'] = Visitor::where('category', 'perpesi')->whereHas('log_transaction', function (Builder $query) use ($value) {
                $query->whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1]);
            })->count();
            $data['visitor'][$key]['umum'] = Visitor::where('category', 'umum')->whereHas('log_transaction', function (Builder $query) use ($value) {
                $query->whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1]);
            })->count();

            $data['visitor'][$key]['VIP'] = Visitor::where('tipe_member', 'VVIP')->whereHas('log_transaction', function (Builder $query) use ($value) {
                $query->whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1]);
            })->count();

            $data['visitor'][$key]['Member'] = Visitor::where('tipe_member', 'VIP')->whereHas('log_transaction', function (Builder $query) use ($value) {
                $query->whereMonth('created_at', strlen($value[0]) == 1 ? '0'.$value[0] : $value[0])->whereYear('created_at', $value[1]);
            })->count();

            $data['visitor'][$key]['Umum'] = LogTransaction::where('payment_status', 'paid')->whereHas(
                'visitor',
                function (Builder $query) {
                    $query->where('tipe_member', 'REGULER');
                }
            )->whereMonth(
                'created_at',
                strlen($value[0]) == 1 ? '0'.$value[0] : $value[0]
            )->whereYear(
                'created_at',
                $value[1]
            )->count();
        }

        $data = json_encode($data['visitor']);

        return response()->json($data);
    }

    public function index(Request $request)
    {
        // statistika mingguan & tanggal
        $data['now'] = Carbon::now()->translatedFormat('Y-m-d');
        $data['visitor_week'] = LogTransaction::where('payment_status', 'paid')->whereBetween(
            'created_at',
            [
                Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay(),
            ]
        )->count();
        // dd($data);

        $data['visitor_today'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))
            ->where('payment_status', 'paid')
            ->count();

        $data['visitor_month'] = Visitor::whereMonth(
            'created_at',
            now()->month
        )->count();

        $data['visitor_year'] = LogTransaction::where('payment_status', 'paid')->whereYear(
            'created_at',
            now()->format('Y')
        )->count();

        $data['visitor_vip'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))
        ->where('payment_status', 'paid')->whereHas('visitor', function (
            Builder $query
        ) {
            $query->where('tipe_member', 'VIP')->whereDate('created_at', now()->format('Y-m-d'));
        })->count();

        $data['visitor_vvip'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))
        ->where('payment_status', 'paid')->whereHas('visitor', function (
            Builder $query
        ) {
            $query->where('tipe_member', 'VVIP')->whereDate('created_at', now()->format('Y-m-d'));
        })->count();

        $data['visitor_reguler'] = LogTransaction::whereDate('created_at', now()->format('Y-m-d'))
        ->where('payment_status', 'paid')->whereHas('visitor', function (
            Builder $query
        ) {
            $query->where('tipe_member', 'REGULER')->whereDate('created_at', now()->format('Y-m-d'));
        })->count();

        // VVIP
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

        // Transaction VVIP
        $data['visitor_transaction_vvip_male'] = LogTransaction::where('payment_status', 'paid')->whereHas(
            'visitor',
            function (Builder $query) {
                $query
                    ->where('tipe_member', 'VVIP')
                    ->where('gender', 'laki-laki');
            }
        )->count();
        $data['visitor_transaction_vvip_female'] = LogTransaction::where('payment_status', 'paid')->whereHas(
            'visitor',
            function (Builder $query) {
                $query
                    ->where('tipe_member', 'VVIP')
                    ->where('gender', 'perempuan');
            }
        )->count();
        // Transaction VIP
        $data['visitor_transaction_vip_male'] = LogTransaction::where('payment_status', 'paid')->whereHas(
            'visitor',
            function (Builder $query) {
                $query
                    ->where('tipe_member', 'VIP')
                    ->where('gender', 'laki-laki');
            }
        )->count();
        $data['visitor_transaction_vip_female'] = LogTransaction::where('payment_status', 'paid')->whereHas(
            'visitor',
            function (Builder $query) {
                $query
                    ->where('tipe_member', 'VIP')
                    ->where('gender', 'perempuan');
            }
        )->count();

        $visitor = Visitor::select([
            'id',
            'name',
            'created_at',
            'tipe_member',
            'category',
        ])
            ->where('tipe_member', '!=', 'REGULER')
            ->get();
        if ($request->ajax()) {
            return datatables()->of($visitor)->editColumn('category', function ($data) {
                    return $data->category;
            })
            ->addColumn('times', function ($data) {
                return empty($data->transaction($data->id)) ? '-' : $data->transaction($data->id)->created_at->translatedFormat('d F Y').', '.$data->transaction($data->id)->created_at->translatedFormat('H:i a');
            })
            ->editColumn('tipe_member', function ($data) {
                return $data->tipe_member;
            })
            ->rawColumns(['name', 'action'])->make(true);
        }

        $data['category'] = collect(Package::pluck('category'))->unique();
        // dd($data['category']);
        return view('dashboard.analisis-tamu', $data);
    }

    public function download(Request $request)
    {
        $dates = explode(' - ', $request->daterange);
        $category = $request->category;
        $data = LogTransaction::whereDate('created_at', '>=', $dates[0])->whereDate('created_at', '<=', $dates[1])->get();
        $newItem = array();
        foreach ($data as $key => $value) {
            if ($category == 'all') {
                $products = unserialize($value->cart)->toArray();
            } else {
                $arr = unserialize($value->cart)->toArray();
                $products = Arr::where($arr, function ($value, $key) use ($category) {
                    return $value['category'] == $category;
                });
            }
            foreach ($products as $i => $val) {
                $item['id'] = $i;
                $item['inv'] = $value->order_number;
                $item['category'] = $val['category'];
                $item['product'] = $val['name'];
                $item['username'] = $value->visitor->name;
                $item['qty'] = $val['qty'];
                $item['pricesingle'] = $val['pricesingle'];
                $item['price'] = $val['price'];
                $item['date'] = $value->created_at;
                array_push($newItem, $item);
            }
        }

        $sheets = collect(Arr::pluck($newItem, 'category'))->unique();
        return Excel::download(new AnalisisTamu($newItem, $sheets), 'analisis-tamu-'.date('YmdHis').'.xlsx');
    }
}
