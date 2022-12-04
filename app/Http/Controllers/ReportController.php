<?php

namespace App\Http\Controllers;

use Carbon\CarbonPeriod;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\LogTransaction;
use App\Models\SettingLimit;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ReportController extends Controller
{
    public function index() 
    {
        return view('report.transaction');
    }

    public function all(Request $request) 
    {
        $transaction = LogTransaction::select('*')->where('payment_status', 'paid')->when($request->filter, function ($query, $filter) {
            if ($filter == 'today') {
                $query->whereDate('created_at', now()->format('Y-m-d'));
            } else if($filter == 'week') {
                $query->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
            } else if ($filter == 'month') {
                $query->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
            } else {
                $query->whereBetween('created_at', [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()]);
            }
        });

        $cart = [];
        foreach($transaction->orderBy('created_at', 'desc')->get() as $item) {
            $cart[] = unserialize($item->cart)->toArray();
        }
        
        $merge_cart = Arr::collapse($cart);
        if ($request->ajax()) {
            return datatables()->of($merge_cart)->editColumn('name', function ($data) {
                return $data['name'];
            })->editColumn('pricesingle', function ($data) {
                return formatrupiah($data['pricesingle']);
            })->editColumn('qty', function ($data) {
                return $data['qty'];
            })->editColumn('price', function ($data) {
                return formatrupiah($data['price']);
            })->editColumn('created_at', function ($data) {
                return $data['created_at'];
            })->addIndexColumn()->make(true);
        }
    }

    public function games(Request $request) 
    {
        $transaction = LogTransaction::select('*')->where('payment_status', 'paid')->when($request->filter, function ($query, $filter) {
            if ($filter == 'today') {
                $query->whereDate('created_at', now()->format('Y-m-d'));
            } else if($filter == 'week') {
                $query->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
            } else if ($filter == 'month') {
                $query->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
            } else {
                $query->whereBetween('created_at', [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()]);
            }
        });

        $cart = [];
        foreach($transaction->orderBy('created_at', 'desc')->get() as $item) {
            $cart[] = unserialize($item->cart)->toArray();
        }
        
        $merge_cart = Arr::collapse($cart);
        $transaction_default = Arr::where($merge_cart, function ($value, $key) {
            return $value['category'] == 'default';
        });
        
        if ($request->ajax()) {
            return datatables()->of($transaction_default)->editColumn('name', function ($data) {
                return $data['name'];
            })->editColumn('pricesingle', function ($data) {
                return formatrupiah($data['pricesingle']);
            })->editColumn('qty', function ($data) {
                return $data['qty'];
            })->editColumn('price', function ($data) {
                return formatrupiah($data['price']);
            })->editColumn('created_at', function ($data) {
                return $data['created_at'];
            })->addIndexColumn()->make(true);
        }
    }

    public function proshop(Request $request) 
    {
        $transaction = LogTransaction::select('*')->where('payment_status', 'paid')->when($request->filter, function ($query, $filter) {
            if ($filter == 'today') {
                $query->whereDate('created_at', now()->format('Y-m-d'));
            } else if($filter == 'week') {
                $query->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
            } else if ($filter == 'month') {
                $query->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
            } else {
                $query->whereBetween('created_at', [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()]);
            }
        });

        $cart = [];
        foreach($transaction->orderBy('created_at', 'desc')->get() as $item) {
            $cart[] = unserialize($item->cart)->toArray();
        }
        
        $merge_cart = Arr::collapse($cart);
        $transaction_default = Arr::where($merge_cart, function ($value, $key) {
            return $value['category'] == 'additional';
        });
        
        if ($request->ajax()) {
            return datatables()->of($transaction_default)->editColumn('name', function ($data) {
                return $data['name'];
            })->editColumn('pricesingle', function ($data) {
                return formatrupiah($data['pricesingle']);
            })->editColumn('qty', function ($data) {
                return $data['qty'];
            })->editColumn('price', function ($data) {
                return formatrupiah($data['price']);
            })->editColumn('created_at', function ($data) {
                return $data['created_at'];
            })->addIndexColumn()->make(true);
        }
    }

    public function canteen(Request $request) 
    {
        $transaction = LogTransaction::select('*')->where('payment_status', 'paid')->when($request->filter, function ($query, $filter) {
            if ($filter == 'today') {
                $query->whereDate('created_at', now()->format('Y-m-d'));
            } else if($filter == 'week') {
                $query->whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
            } else if ($filter == 'month') {
                $query->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
            } else {
                $query->whereBetween('created_at', [Carbon::now()->subYear()->startOfYear(), Carbon::now()->subYear()->endOfYear()]);
            }
        });

        $cart = [];
        foreach($transaction->orderBy('created_at', 'desc')->get() as $item) {
            $cart[] = unserialize($item->cart)->toArray();
        }
        
        $merge_cart = Arr::collapse($cart);
        $transaction_default = Arr::where($merge_cart, function ($value, $key) {
            return $value['category'] == 'others';
        });
        
        if ($request->ajax()) {
            return datatables()->of($transaction_default)->editColumn('name', function ($data) {
                return $data['name'];
            })->editColumn('pricesingle', function ($data) {
                return formatrupiah($data['pricesingle']);
            })->editColumn('qty', function ($data) {
                return $data['qty'];
            })->editColumn('price', function ($data) {
                return formatrupiah($data['price']);
            })->editColumn('created_at', function ($data) {
                return $data['created_at'];
            })->addIndexColumn()->make(true);
        }
    }

    public function setting_limit()
    {
        return view('setting.update-limit');
    }

    public function select_member(Request $request)
    {
        $limit = SettingLimit::where('tipe_member', $request->get('type_member'))->first();
        return response()->json(['limit' => $limit->limit]);
    }

    public function update_limit(Request $request)
    {
        $this->validate($request, [
            'tipe_member' => 'required',
            'limit' => 'required',
        ]);

        $limit = SettingLimit::where('tipe_member', $request->tipe_member)->first();
        $limit->limit = $request->limit;
        $limit->save();
        return redirect()->back()->with('success', 'Berhasil edit limit');
    }
}
