<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Visitor;
use App\Models\LogAdmin;
use App\Models\LogLimit;
use App\Jobs\SendMailJob;
use App\Models\ReportLimit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ReportDeposit;
use App\Models\DepositHistory;
use App\Models\LogTransaction;
use App\Jobs\SendMailJobDeposit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Cache\RateLimiting\Limit;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fgf(){
        return view('emails.sample2');
    }
    public function index(Request $request)
    {
        $visitor = Visitor::select([
            'id',
            'name',
            'email',
            'phone',
            'tipe_member',
        ])->orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            return datatables()->of($visitor)->addColumn('action', function ($visitor) {
                    $button = '<div class="d-flex align-items-center"><a data-toggle="tooltip" data-placement="top" title="Detail Tamu" href="' .url('kartu-tamu/' . Crypt::encryptString($visitor->id)) .'"><img src="'.url('dist/img/Card-Tamu.svg').'"></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a data-toggle="tooltip" data-placement="top" title="Edit" href="'.url('edit-tamu/' . Crypt::encryptString($visitor->id)) .'">
                                    <svg width="21" height="21";viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 3.26645L17.5333 0.799784C17.3213 0.597635 17.0396 0.484863 16.7467 0.484863C16.4537 0.484863 16.172 0.597635 15.96 0.799784L13.7667 2.99978H1.99999C1.64637 2.99978 1.30723 3.14026 1.05718 3.39031C0.807132 3.64036 0.666656 3.9795 0.666656 4.33312V18.9998C0.666656 19.3534 0.807132 19.6925 1.05718 19.9426C1.30723 20.1926 1.64637 20.3331 1.99999 20.3331H16.6667C17.0203 20.3331 17.3594 20.1926 17.6095 19.9426C17.8595 19.6925 18 19.3534 18 18.9998V6.83978L20 4.83978C20.2084 4.63104 20.3255 4.34811 20.3255 4.05312C20.3255 3.75813 20.2084 3.47519 20 3.26645ZM10.5533 12.4198L7.75999 13.0398L8.42666 10.2731L14.7933 3.89312L16.9467 6.04645L10.5533 12.4198ZM17.6667 5.28645L15.5133 3.13312L16.7467 1.89978L18.9 4.05312L17.6667 5.28645Z" fill="#787878"/>
                                    </svg>
                                </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .='<a href="javascript:void(0)" name="delete" data-toggle="tooltip" data-placement="top" title="Hapus" id="' .$visitor->id . '" class="delete-confirm"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.25 3.50004V1.24854C7.25 1.04962 7.32902 0.858857 7.46967 0.718205C7.61032 0.577553 7.80109 0.498535 8 0.498535H14C14.1989 0.498535 14.3897 0.577553 14.5303 0.718205C14.671 0.858857 14.75 1.04962 14.75 1.24854V3.50004H20.75C20.9489 3.50004 21.1397 3.57905 21.2803 3.71971C21.421 3.86036 21.5 4.05112 21.5 4.25004C21.5 4.44895 21.421 4.63971 21.2803 4.78036C21.1397 4.92102 20.9489 5.00004 20.75 5.00004H1.25C1.05109 5.00004 0.860322 4.92102 0.71967 4.78036C0.579018 4.63971 0.5 4.44895 0.5 4.25004C0.5 4.05112 0.579018 3.86036 0.71967 3.71971C0.860322 3.57905 1.05109 3.50004 1.25 3.50004H7.25ZM8.75 3.50004H13.25V2.00004H8.75V3.50004ZM3.5 21.5C3.30109 21.5 3.11032 21.421 2.96967 21.2804C2.82902 21.1397 2.75 20.9489 2.75 20.75V5.00004H19.25V20.75C19.25 20.9489 19.171 21.1397 19.0303 21.2804C18.8897 21.421 18.6989 21.5 18.5 21.5H3.5ZM8.75 17C8.94891 17 9.13968 16.921 9.28033 16.7804C9.42098 16.6397 9.5 16.4489 9.5 16.25V8.75004C9.5 8.55112 9.42098 8.36036 9.28033 8.21971C9.13968 8.07905 8.94891 8.00004 8.75 8.00004C8.55109 8.00004 8.36032 8.07905 8.21967 8.21971C8.07902 8.36036 8 8.55112 8 8.75004V16.25C8 16.4489 8.07902 16.6397 8.21967 16.7804C8.36032 16.921 8.55109 17 8.75 17ZM13.25 17C13.4489 17 13.6397 16.921 13.7803 16.7804C13.921 16.6397 14 16.4489 14 16.25V8.75004C14 8.55112 13.921 8.36036 13.7803 8.21971C13.6397 8.07905 13.4489 8.00004 13.25 8.00004C13.0511 8.00004 12.8603 8.07905 12.7197 8.21971C12.579 8.36036 12.5 8.55112 12.5 8.75004V16.25C12.5 16.4489 12.579 16.6397 12.7197 16.7804C12.8603 16.921 13.0511 17 13.25 17Z" fill="#787878"/></svg></a></div>';
                    return $button;
                })->editColumn('tipe_member', function ($data) {
                    return $data->tipe_member;
                })->editColumn('qrcode', function ($data) {
                    return '<a href="' .url('kartu-tamu/' . $data->id) .'">' .$data->name .'</a>';
                })->rawColumns(['qrcode', 'action'])->make(true);
        }
        return view('tamu.daftar-tamu', compact('visitor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
    
    /* insert tamu(store) */
    public function inserttamu(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company' => 'required',
            'position' => 'required',
            'tipe_member' => 'required',
        ]);
        $random = Str::random(15);
        $random_unique = Carbon::now()->format('Y-m');
        $token = $random_unique.'-'.$random;
        $visitors = Visitor::create([
            'name' => $request->name,
            'address' => $request->address,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'position' => $request->position,
            'tipe_member' => $request->tipe_member,
            'created_at' => Carbon::now(),
        ]);
        $get_visitor = Visitor::where('id', $visitors->id)->latest()->first();
        $link_qr = URL::signedRoute('detail-scan',['qr'=>$token, 'e'=> $visitors->id]);
        $get_visitor->unique_qr = $link_qr;
        $get_visitor->save();
        
        $report_quota = ReportLimit :: create([
            'visitor_id' => $visitors->id,
            'user_id' =>    Auth::user()->id,
            'report_quota' => $request->tipe_member == 'VIP' ? '4' : '10',
            'created_at' => Carbon::now(),
        ]);
        $report_quota->save();
        $quota = LogLimit::create([
            'visitor_id' => $visitors->id,
            'report_limit_id' => $report_quota->id,
            'quota' => $request->tipe_member == 'VIP' ? '4' : '10',
            'created_at' => Carbon::now(),
        ]);
        $quota->save();

        $data = $request->all();
        dispatch(new SendMailJob($data));
        dispatch(new SendMailJobDeposit($data));
        LogAdmin::create([
            'user_id' => Auth::id(),
            'type' => 'CREATE',
            'activities' => 'Menambah member <b>'.$visitors->name.'</b>',
        ]);
        return redirect('/tambah-deposit/'.$visitors->id)->with('success','Berhasil menambah tamu');
    }
    /* end insert tamu */

    /* function tambahan deposit */
    public function tambahdeposit(Request $request, $id)
    {
        $data['id'] = $id;
        return view('tamu.tambah-deposit', $data);
    }
    /* END function tambahan deposit */

    /* insert deposit && BERTAMBAH(create) deposit */
    public function insertdeposit(Request $request)
    {
        $visitors = Visitor::where('id', $request->id)->first();
        $report_deposit = ReportDeposit::create([
            'visitor_id' => $request->visitor_id,
            'user_id' => Auth::user()->id,
            'report_balance' => $request->balance,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(), 
        ]);
        $report_deposit->save();    
        $deposit = Deposit::create([
            'visitor_id' => $request->visitor_id,
            'user_id' =>    Auth::user()->id,
            'report_deposit_id' => $report_deposit->id,
            'type' => 'CREATE',
            'balance' => $request->balance,
            'activities' => 'Deposit <b>'.$request->name.' bertambah menjadi <b>'.$request->balance.'</b>',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $deposit->save();
        $data = $request->all();
        dispatch(new SendMailJobDeposit($data));
        LogAdmin::create([
            'user_id' => Auth::id(),
            'type' => 'CREATE',
            'activities' => 'Berhasil menambah deposit ',
        ]);
        return redirect('/daftar-tamu')->with('success','Berhasil menambah deposit');
    }
    /* insert deposit && BERTAMBAH(create) deposit */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            $decrypt_id = Crypt::decryptString($id);
            $data['visitor'] = Visitor::find($decrypt_id);
            $limit = LogLimit::where('visitor_id',$decrypt_id)->first();
            $deposit = Deposit::where('visitor_id',$decrypt_id)->first();
            $visitor = Visitor::findOrFail($decrypt_id);
            $data['qrcode'] = QrCode::size(180)->generate($visitor->id);
            $data['quota'] = $limit->quota;
            $data['balance'] = $deposit->balance;
            $data['deposit'] = Deposit::where('visitor_id', $decrypt_id)->orderBy('created_at', 'desc')->get();
            $data['limit'] = LogLimit::where('visitor_id', $decrypt_id)->orderBy('created_at', 'desc')->get();
            return view('tamu.kartu-tamu', $data);
        } catch (\Throwable $th) {
            return redirect()->route('daftar-tamu');
        }
    }

    /* data aktifitas tamu Deposit */
    public function reportdeposit(Request $request, $id)
    {
        $aktifitas_deposit = ReportDeposit::select('id', 'report_balance', 'payment_type', 'visitor_id', 'user_id', 'created_at')->where('visitor_id', $id)->orderBy('created_at', 'desc') ->get();
        if ($request->ajax()) {
            return datatables()->of($aktifitas_deposit)->editColumn('report_balance', function ($data) {
                    return number_format($data->report_balance, 0, ',', '.');
                })->addColumn('information', function ($data) {
                    return $data->visitor->name.' melakukan deposit sebesar '.number_format($data->report_balance, 0, ',', '.');
                })->make(true);
        }
    }
    /* end data aktifitas tamu Deposit */

        /* data aktifitas tamu limit */
    public function reportlimit(Request $request, $id)
    {
        $aktifitas_limit = ReportLimit::select('id', 'report_quota', 'status', 'visitor_id', 'user_id', 'created_at')->where('visitor_id', $id)->orderBy('created_at', 'desc') ->get();
        if ($request->ajax()) {
            return datatables()->of($aktifitas_limit)->addColumn('information', function ($data) {
                return 'Limit '.$data->visitor->name.' bertambah menjadi '.$data->report_quota;
            })->addColumn('status', function ($data) {
                return $data->status;
            })->make(true);
        }
    }
        /* end data aktifitas tamu limit */

    /*UPDATE BERKURANG deposit */
    public function updatedeposit(Request $request, $id)
    {
        $this->validate($request, [
            'visitor_id' => 'required',
        ]);

        $visitor = Visitor::find($id);   
        $visitor->name = $request->name;
        $visitor->email = $request->email;
        $visitor->address = $request->address;
        $visitor->phone = $request->phone;
        $visitor->company = $request->company;
        $visitor->position = $request->position;
        $visitor->tipe_member = $request->tipe_member;
        $visitor->updated_at = Carbon::now();
        $visitors = Visitor::create([
            'name' => $request->name,
            'address' => $request->address,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'position' => $request->position,
            'tipe_member' => $request->tipe_member,
            'created_at' => Carbon::now(),
        ]);
        Deposit::create([
            'visitor_id' => $request->visitor_id,
            'status' => 'UPDATE',
            'balance' => $request->balance,
            'activities' => 'Deposit <b>'.$visitor->name.' berkurang sebesar <b>'.$request->balance.'</b>',
        ]);
        $visitor->save();
        return redirect()->route('/aktifitas-kartu-tamu/'.$visitor->id)->with('status', 'Data Tamu Berhasil Diupdate');
    }
    /* END UPDATE BERKURANG deposit */

    /* limit tamu*/
    public function limittamu($id)
    {
        $limit = LogLimit::find($id);
        $data = [[
                'id' => $limit->visitor_id,
                'report_limit_id' => $limit->report_limit_id,
                'quota' => $limit->quota,
            ]
        ];
        DB::table('log_limits', 'quota')->get();
    }
    /* end limit tamu*/

    /* CREATE BERHASIL RESET limit VIP */
    public function createlimitvip (Request $request, $id)
    {
        $this->validate($request, [
            'visitor_id' => 'required',
        ]);
        $visitor = Visitor::find($id);   
        $visitor->name = $request->name;
        $visitor->email = $request->email;
        $visitor->address = $request->address;
        $visitor->phone = $request->phone;
        $visitor->company = $request->company;
        $visitor->position = $request->position;
        $visitor->tipe_member = $request->tipe_member;
        $visitor->updated_at = Carbon::now();
        LogLimit::create([
            'visitor_id' => $request->visitor_id,
            'status' => 'CREATE',
            'quota' => $request->quota,
            'activities' => 'Limit <b>'.$visitor->name.' sebesar <b>'.$request->quota.'</b>',
        ]);

        $visitor->save();
        return redirect('/aktifitas-kartu-tamu/'.$visitor->id)->with('status', ' berhasil tambah deposit');
    }
    /* END CREATE BERHASIL RESET limit VIP */

    /* CREATE BERHASIL RESET limit VVIP */
    public function createlimitvvip (Request $request, $id)
    {
        $this->validate($request, [
            'visitor_id' => 'required',
        ]);
        $visitor = Visitor::find($id);   
        $visitor->name = $request->name;
        $visitor->email = $request->email;
        $visitor->address = $request->address;
        $visitor->phone = $request->phone;
        $visitor->company = $request->company;
        $visitor->position = $request->position;
        $visitor->tipe_member = $request->tipe_member;
        $visitor->updated_at = Carbon::now();
        LogLimit::create([
            'visitor_id' => $request->visitor_id,
            'status' => 'CREATE',
            'quota' => $request->quota,
            'activities' => 'Limit <b>'.$visitor->name.' reset <b>'.$request->quota.'</b>',
        ]);
        $visitor->save();
        return redirect('/aktifitas-kartu-tamu/'.$visitor->id)->with('toast_success', ' berhasil reset limit');
    }
    /* END CREATE BERHASIL RESET limit VVIP */

    /* UPDATE BERKURANG LIMIT tamu*/
    public function updatelimit(Request $request, $id)
    {
        $visitor = Visitor::find($id);   
        $visitor->name = $request->name;
        $visitor->email = $request->email;
        $visitor->address = $request->address;
        $visitor->phone = $request->phone;
        $visitor->company = $request->company;
        $visitor->position = $request->position;
        $visitor->tipe_member = $request->tipe_member;
        $visitor->updated_at = Carbon::now();
        LogLimit::create([
            'visitor_id' => $request->visitor_id,
            'user_id' => Auth::id(),
            'type' => 'UPDATE',
            'activities' => 'Limit <b>'.$visitor->name.' berkurang menjadi <b>'.$request->quota.'</b>',
        ]);
        return redirect('/aktifitas-kartu-tamu/'.$visitor->id)->with('toast_success', 'Paket berhasil diupdate');
    }
    /* END UPDATE BERKURANG LIMIT tamu*/

    /* data aktifitas tamu transaksi*/
    public function reporttransaksi(Request $request, $id)
    {
        $reporttransaksi = LogTransaction::select('id', 'payment_type', 'payment_status', 'total', 'visitor_id', 'user_id', 'created_at')->where('visitor_id', $id)->orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            return datatables()->of($reporttransaksi)->addColumn('order_id', function ($data) {
                return $data->id;
            })->editColumn('information', function ($data) {
                return 'Transaksi berhasil! '.$data->visitor->name.' telah melakukan pembayaran Rp.'.number_format($data->total, 0, ',', '.');
            })->addColumn('status', function ($data) {
                return $data->payment_status;
            })->addColumn('created_at', function ($data) {
                return $data->created_at;
            })->make(true);
        }
    }
    /* END data aktifitas tamu transaksi*/

    /* SUCCEED TRANSAKSI deposit */
    public function transaksideposit(Request $request)
    {
        $visitors = Visitor::create([
            'name' => $request->name,
            'address' => $request->address,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'position' => $request->position,
            'tipe_member' => $request->tipe_member,
            'created_at' => Carbon::now(),
        ]);
        Deposit::create([
            'visitor_id' => $request->visitor_id,
            'status' => 'SUCCEED',
            'balance' => $request->balance,
            'activities' => 'Transaksi Berhasil! <b>'.$visitors->name.' telah melakukan pembayaran sebesar <b>'.$request->balance.'</b>',
        ]);

        return redirect('/aktifitas-kartu-tamu/'.$visitors->id)->with('toast_success', 'Transaksi Berhasil!');
    }
    /* END SUCCEED TRANSAKSI deposit */

    /* SUCCEED TRANSAKSI limit */
    public function transaksilimit(Request $request)
    {
        $visitors = Visitor::create([
            'name' => $request->name,
            'address' => $request->address,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'position' => $request->position,
            'tipe_member' => $request->tipe_member,
            'created_at' => Carbon::now(),
        ]);

        LogLimit::create([
            'visitor_id' => $request->visitor_id,
            'user_id' => Auth::id(),
            'type' => 'SUCCEED',
            'activities' => 'Transaksi berhasil! <b>'.$visitors->name.' telah melakkan pembayaran menggunakan <b>'.$request->quota.'</b>',
                // cTransaksi berhasil ! Arya GP telah melakukan pembayaran menggunakan Limit Gratis.
        ]);

        return redirect('/aktifitas-kartu-tamu/'.$visitors->id)
            ->with('toast_success', 'Transaksi Berhasil!');
    }
    /* END SUCCEED TRANSAKSI limit */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decrypt_id = Crypt::decryptString($id);
        $visitor = Visitor::find($decrypt_id);
        return view('tamu.edit-tamu', compact('visitor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company' => 'required',
            'position' => 'required',
            'tipe_member' => 'required',
        ]);
        $visitor = Visitor::find($id);
        $visitor->fill($request->post())->save();
        LogAdmin::create([
            'user_id' => Auth::id(),
            'type' => 'UPDATE',
            'activities' => 'Mengubah member <b>'.$visitor->name.'</b>',
        ]);
        return redirect()->route('daftar-tamu')->with('success', 'Berhasil edit tamu');
    }
    public function tambahtamu()
    {
        return view('tamu.tambah-tamu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $visitor = Visitor::find($id);
        LogAdmin::create([
            'user_id' => Auth::id(),
            'type' => 'DELETE',
            'activities' => 'Menghapus member <b>'.$visitor->name.'</b>',
        ]);
        $visitor->delete();
        return redirect()->route('daftar-tamu');
    }
}