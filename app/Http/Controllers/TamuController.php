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
use FontLib\Table\Type\post;
use Illuminate\Http\Request;
use App\Models\ReportDeposit;
use App\Models\DepositHistory;
use App\Models\LogTransaction;
use App\Jobs\SendMailJobDeposit;
use PhpParser\Node\Stmt\Return_;
use App\Exports\DaftarTamuExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Jobs\SendMailJobKuponTambah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
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
    public function index(Request $request)
    {
        $visitor = Visitor::select([
            'id',
            'name',
            'email',
            'phone',
            'tipe_member',
        ])->where('tipe_member','!=','REGULER')->orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            return datatables()->of($visitor)->addColumn('action', function ($visitor) {
                if (auth()->user()->role_id == '2') {
                    $button = '<class="d-flex align-items-center"><a data-toggle="tooltip" data-placement="top" title="Detail Tamu" href="' . url('kartu-tamu/' . Crypt::encryptString($visitor->id)) . '"><img src="' . url('dist/img/Card-Tamu.svg') . '"></a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a data-toggle="tooltip" data-placement="top" title="Edit" href="' . url('edit-tamu/' . Crypt::encryptString($visitor->id)) . '">
                                    <svg width="21" height="21";viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 3.26645L17.5333 0.799784C17.3213 0.597635 17.0396 0.484863 16.7467 0.484863C16.4537 0.484863 16.172 0.597635 15.96 0.799784L13.7667 2.99978H1.99999C1.64637 2.99978 1.30723 3.14026 1.05718 3.39031C0.807132 3.64036 0.666656 3.9795 0.666656 4.33312V18.9998C0.666656 19.3534 0.807132 19.6925 1.05718 19.9426C1.30723 20.1926 1.64637 20.3331 1.99999 20.3331H16.6667C17.0203 20.3331 17.3594 20.1926 17.6095 19.9426C17.8595 19.6925 18 19.3534 18 18.9998V6.83978L20 4.83978C20.2084 4.63104 20.3255 4.34811 20.3255 4.05312C20.3255 3.75813 20.2084 3.47519 20 3.26645ZM10.5533 12.4198L7.75999 13.0398L8.42666 10.2731L14.7933 3.89312L16.9467 6.04645L10.5533 12.4198ZM17.6667 5.28645L15.5133 3.13312L16.7467 1.89978L18.9 4.05312L17.6667 5.28645Z" fill="#787878"/>
                                    </svg>
                                </a>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a href="javascript:void(0)" name="delete" data-toggle="tooltip" data-placement="top" title="Hapus" id="' . $visitor->id . '" class="delete-confirm"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.25 3.50004V1.24854C7.25 1.04962 7.32902 0.858857 7.46967 0.718205C7.61032 0.577553 7.80109 0.498535 8 0.498535H14C14.1989 0.498535 14.3897 0.577553 14.5303 0.718205C14.671 0.858857 14.75 1.04962 14.75 1.24854V3.50004H20.75C20.9489 3.50004 21.1397 3.57905 21.2803 3.71971C21.421 3.86036 21.5 4.05112 21.5 4.25004C21.5 4.44895 21.421 4.63971 21.2803 4.78036C21.1397 4.92102 20.9489 5.00004 20.75 5.00004H1.25C1.05109 5.00004 0.860322 4.92102 0.71967 4.78036C0.579018 4.63971 0.5 4.44895 0.5 4.25004C0.5 4.05112 0.579018 3.86036 0.71967 3.71971C0.860322 3.57905 1.05109 3.50004 1.25 3.50004H7.25ZM8.75 3.50004H13.25V2.00004H8.75V3.50004ZM3.5 21.5C3.30109 21.5 3.11032 21.421 2.96967 21.2804C2.82902 21.1397 2.75 20.9489 2.75 20.75V5.00004H19.25V20.75C19.25 20.9489 19.171 21.1397 19.0303 21.2804C18.8897 21.421 18.6989 21.5 18.5 21.5H3.5ZM8.75 17C8.94891 17 9.13968 16.921 9.28033 16.7804C9.42098 16.6397 9.5 16.4489 9.5 16.25V8.75004C9.5 8.55112 9.42098 8.36036 9.28033 8.21971C9.13968 8.07905 8.94891 8.00004 8.75 8.00004C8.55109 8.00004 8.36032 8.07905 8.21967 8.21971C8.07902 8.36036 8 8.55112 8 8.75004V16.25C8 16.4489 8.07902 16.6397 8.21967 16.7804C8.36032 16.921 8.55109 17 8.75 17ZM13.25 17C13.4489 17 13.6397 16.921 13.7803 16.7804C13.921 16.6397 14 16.4489 14 16.25V8.75004C14 8.55112 13.921 8.36036 13.7803 8.21971C13.6397 8.07905 13.4489 8.00004 13.25 8.00004C13.0511 8.00004 12.8603 8.07905 12.7197 8.21971C12.579 8.36036 12.5 8.55112 12.5 8.75004V16.25C12.5 16.4489 12.579 16.6397 12.7197 16.7804C12.8603 16.921 13.0511 17 13.25 17Z" fill="#787878"/>
                    </svg>
                    </a>';
                    
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<a data-toggle="modal" data-placement="top" title="Tambah Kupon" data-target="#myModal" href="javascript:void(0)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#787878" d="M9,10a1,1,0,0,0-1,1v2a1,1,0,0,0,2,0V11A1,1,0,0,0,9,10Zm12,1a1,1,0,0,0,1-1V6a1,1,0,0,0-1-1H3A1,1,0,0,0,2,6v4a1,1,0,0,0,1,1,1,1,0,0,1,0,2,1,1,0,0,0-1,1v4a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V14a1,1,0,0,0-1-1,1,1,0,0,1,0-2ZM20,9.18a3,3,0,0,0,0,5.64V17H10a1,1,0,0,0-2,0H4V14.82A3,3,0,0,0,4,9.18V7H8a1,1,0,0,0,2,0H20Z"/></svg></a></div>
                    <div id="myModal" class="modal fade" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">×</button>
                                <h5 class="modal-title" id="myModalLabel">
                                Tambah Kupon</h5>
                            </div>
                            <div class="modal-body">
                                <form action="'. url('update/kupon/' . $visitor->id) . '" method="POST">
                                    <input type="hidden" name="_token" value=" '.csrf_token().' ">
                                    <div class="form-group">
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"><img src="dist/img/ticket.svg"
                                                    alt=""></div>
                                            <input type="text" min="0"
                                                onkeypress="return event.charCode >= 48 && event.charCode <=57"
                                                class="form-control" name="quota_kupon" data-id=""
                                                placeholder="Masukan jumlah Kupon" required>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-anim">
                                        <i class="icon-rocket"></i>
                                        <span class="btn-text">submit</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>';
                    return $button;
                } else {
                    $button = '<div class="d-flex align-items-center"><a data-toggle="tooltip" data-placement="top" title="Detail Tamu" href="' . url('kartu-tamu/' . Crypt::encryptString($visitor->id)) . '"><img src="' . url('dist/img/Card-Tamu.svg') . '"></a>';
                    return $button;
                }
            })->editColumn('tipe_member', function ($data) {
                return $data->tipe_member;
            })->editColumn('qrcode', function ($data) {
                return '<a href="' . url('kartu-tamu/' . $data->id) . '">' . $data->name . '</a>';
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
        $this->validate(
            $request,
            [
                'name' => 'required|unique:visitors,name',
                'address' => 'required',
                'gender' => 'required',
                'email' => 'required|email|unique:visitors,email',
                'phone' => 'required|min:12|unique:visitors,phone',
                'company' => 'required',
                'position' => 'required',
                'tipe_member' => 'required',
                'category' => 'required',
            ],
            [
                'name.required' => 'Nama Lengkap masih kosong.',
                'name.unique' => 'Nama Lengkap sudah ada',
                'address.required' => 'Alamat masih kosong.',
                'address.unique' => 'Alamat sudah ada',
                'gender.required' => 'Jenis Kelamin masih kosong.',
                'gender.unique' => 'Jenis Kelamin sudah ada',
                'email.required' => 'Email masih kosong.',
                'email.unique' => 'Email sudah ada',
                'phone.required' => 'Nomer Hp masih kosong.',
                'phone.unique' => 'Nomer Hp sudah ada',
                'company.required' => 'Perusahaan masih kosong.',
                'company.unique' => 'Perusahaan sudah ada',
                'position.required' => 'Jabatan masih kosong.',
                'position.unique' => 'Jabatan sudah ada',
                'category.required' => 'Kategori masih kosong',
            ]
        );
        $random = Str::random(15);
        $random_unique = Carbon::now()->format('Y-m');
        $token = $random_unique . '-' . $random;
        $visitors = Visitor::create([
            'name' => $request->name,
            'address' => $request->address,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'position' => $request->position,
            'tipe_member' => $request->tipe_member,
            'category' => $request->category,
            'created_at' => Carbon::now(),
        ]);
        $get_visitor = Visitor::where('id', $visitors->id)->latest()->first();
        $link_qr = URL::signedRoute('detail-scan', ['qr' => $token, 'e' => $visitors->id]);
        $get_visitor->unique_qr = $link_qr;
        $get_visitor->save();

        if ($request->tipe_member == 'VIP') {
            $report_quota = ReportLimit::create([
                'visitor_id' => $visitors->id,
                'user_id' =>    Auth::user()->id,
                'report_quota' => 4,
                'report_quota_kupon' => 0,
                'status' => 'Bertambah',
                'created_at' => Carbon::now(),
            ]);
        } else {
            $report_quota = ReportLimit::create([
                'visitor_id' => $visitors->id,
                'user_id' =>    Auth::user()->id,
                'report_quota' => 10,
                'report_quota_kupon' => 0,
                'status' => 'Bertambah',
                'created_at' => Carbon::now(),
            ]);
        }
        $report_quota->save();

        $quota = LogLimit::create([
            'visitor_id' => $visitors->id,
            'report_limit_id' => $report_quota->id,
            'quota' => $request->tipe_member == 'VIP' ? '4' : '10',
            'quota_kupon' => 0,
            'created_at' => Carbon::now(),
        ]);
        $quota->save();

        $report_deposit = ReportDeposit::create([
            'payment_type' => 'cash',
            'visitor_id' => $visitors->id,
            'user_id' => Auth::user()->id,
            'report_balance' => 0,
            'status' => 'Bertambah',
        ]);
        $report_deposit->save();

        $deposit = Deposit::create([
            'visitor_id' => $visitors->id,
            'user_id' =>    Auth::user()->id,
            'report_deposit_id' => $report_deposit->id,
        ]);
        $deposit->save();

        $data = $request->all();
        dispatch(new SendMailJob($data));
        // dispatch(new SendMailJobDeposit($data));
        LogAdmin::create([
            'user_id' => Auth::id(),
            'type' => 'CREATE',
            'activities' => 'Menambah member <b>' . $visitors->name . '</b>',
        ]);

        $encrypt = Crypt::encrypt($visitors->id);
        return redirect('/tambah-deposit/' . $encrypt)->with('success', 'Berhasil menambah tamu');
    }
    /* end insert tamu */

    /* function tambahan deposit */
    public function tambahdeposit(Request $request, $id)
    {
        $data['id'] = Crypt::decrypt($id);
        return view('tamu.tambah-deposit', $data);
    }
    /* END function tambahan deposit */

    /* insert deposit && BERTAMBAH(create) deposit */
    public function insertdeposit(Request $request)
    {
        $this->validate($request, [
            'visitor_id' => 'required',
            'balance' => 'required',
            'payment_type' => 'required',
        ]);
        $visitor = Visitor::find($request->visitor_id);
        if (!is_null($request->payment_type)) {
            $report_deposit = ReportDeposit::create([
                'payment_type' => $request->payment_type,
                'visitor_id' => $request->visitor_id,
                'user_id' => Auth::user()->id,
                'fund' => $request->balance,
                'report_balance' => $request->balance,
                'status' => 'Bertambah',
            ]);
        } else {
            $report_deposit = ReportDeposit::create([
                'payment_type' => 0,
                'visitor_id' => $request->visitor_id,
                'user_id' => Auth::user()->id,
                'fund' => $request->balance,
                'report_balance' => $request->balance,
                'status' => 'Bertambah',
            ]);
        }

        $report_deposit->save();

        $deposit = Deposit::where('visitor_id', $request->visitor_id)->first();
        $deposit->balance = $request->balance + $deposit->balance;
        $deposit->save();
        $data_deposit = array(
            "visitor_id" => $request->visitor_id,
            "balance" => $request->balance,
            "name" => $visitor->name,
            "address" => $visitor->address,
            "gender" => $visitor->gender,
            "email" => $visitor->email,
            "phone" => $visitor->phone,
            "company" => $visitor->company,
            "position" => $visitor->position,
            "tipe_member" => $visitor->tipe_member
        );
        dispatch(new SendMailJobDeposit($data_deposit));
        LogAdmin::create([
            'user_id' => Auth::id(),
            'type' => 'CREATE',
            'activities' => 'Berhasil menambah deposit ',
        ]);
        return redirect('/daftar-tamu')->with('success', 'Berhasil menambah deposit');
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
            $limit = LogLimit::where('visitor_id', $decrypt_id)->first();
            $deposit = Deposit::where('visitor_id', $decrypt_id)->first();
            $visitor = Visitor::findOrFail($decrypt_id);
            $data['qrcode'] = QrCode::size(180)->generate($visitor->id);
            $data['quota'] = $limit->quota;
            $data['quota_kupon'] = $limit->quota_kupon;
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
        $decrypt_id = Crypt::decryptString($id);
        $aktifitas_deposit = ReportDeposit::select('id', 'report_balance', 'payment_type', 'status', 'visitor_id', 'user_id', 'fund', 'created_at')
        ->where('visitor_id', $decrypt_id)->where('fund','!=',0)->orderBy('created_at', 'desc')->get();
        if ($request->ajax()) {
            return datatables()->of($aktifitas_deposit)->editColumn('report_balance', function ($data) {
                return 'Rp. ' . number_format($data->fund, 0, ',', '.');
            })->addColumn(
                'transaction',
                function ($data) {
                    return 'Rp. ' . number_format($data->report_balance, 0, ',', '.');
                }
            )->addColumn('payment_type', function ($data) {
                if ($data->payment_type == 'cash') {
                    return '<p class="label label-success">' . $data->payment_type . '</p>';
                } else if ($data->payment_type == 'transfer') {
                    return '<p class="label label-warning">' . $data->payment_type . '</p>';
                } else {
                    return '<p class="label label-danger">' . $data->payment_type . '</p>';
                }
            })->addColumn('status', function ($data) {
                if ($data->status == 'Bertambah') {
                    return '<p class="label label-success">' . $data->status . '</p>';
                } elseif ($data->status == 'Berkurang') {
                    return '<p class="label label-danger">' . $data->status . '</p>';
                }
            })->editColumn('created_at', function ($data) {
                return $data->created_at->format('d-m-Y H:i');
            })->rawColumns(['report_balance', 'transaction', 'status', 'payment_type', 'created_at'])->make(true);
        }
    }
    /* end data aktifitas tamu Deposit */

    /* data aktifitas tamu limit */
    public function reportlimit(Request $request, $id)
    {
        $decrypt_id = Crypt::decryptString($id);
        $aktifitas_limit =
            ReportLimit::select('id', 'report_quota', 'status', 'visitor_id',  'user_id', 'created_at')
            ->where('report_quota','!=' ,0)->where('visitor_id', $decrypt_id)->orderBy('created_at', 'desc')->get();

        if ($request->ajax()) {
            return datatables()->of($aktifitas_limit)
                ->addColumn('limit', function ($data) {
                    return $data->report_quota;
                })->addColumn('Informasi', function ($data) {
                    if($data->status == 'Bertambah'){
                        return ' Limit anda bertambah!';
                } elseif($data->status == 'Berkurang'){
                    return ' Limit anda berkurang! ';
                } else {
                    return 'Limit Bulanan melakukan Reset ';
                }})
                ->addColumn('status', function ($data) {
                    if ($data->status == 'Bertambah') {
                        return '<p class="label label-success">' . $data->status . '<div>';
                    } elseif ($data->status == 'Berkurang') {
                        return '<p class="label label-danger">' . $data->status . '<div>';
                    } else {
                        return '<p class="label label-warning">' . $data->status . '<div>';
                    }
                })->editColumn('created_at', function ($data) {
                    return date_format($data->created_at, 'd-m-Y H:i');
                })->rawColumns(['limit', 'informasi', 'status', 'created_at'])->make(true);
    }
    }
    /* end data aktifitas tamu limit */

    /* data aktifitas tamu kupon */
    public function reportkupon(Request $request, $id)
    {
        $decrypt_id = Crypt::decryptString($id);
        $aktifitas_limit =
            ReportLimit::select('id', 'report_quota_kupon', 'status', 'visitor_id',  'user_id', 'created_at')->where('visitor_id', $decrypt_id)->where('report_quota_kupon','!=',0)->orderBy('created_at', 'desc')->get();

        if ($request->ajax()) {
            return datatables()->of($aktifitas_limit)
                ->addColumn('kupon', function ($data) {
                    if ($data->report_quota_kupon > 0){
                        return $data->report_quota_kupon;
                    } else {
                        return ;
                    }
                })->addColumn('Informasi', function ($data) {
                    if($data->status == 'Bertambah'){
                        return ' Limit Anda Bertambah!';
                } elseif($data->status == 'Berkurang'){
                    return ' Limit Anda Berkurang! ';
                } else {
                    
                }})
                ->addColumn('status', function ($data) {
                    if ($data->status == 'Bertambah') {
                        return '<p class="label label-success">' . $data->status . '<div>';
                    } elseif ($data->status == 'Berkurang') {
                        return '<p class="label label-danger">' . $data->status . '<div>';
                    } else {
                        
                    }
                })->editColumn('created_at', function ($data) {
                    if ($data->report_quota_kupon > 0){
                    return date_format($data->created_at, 'd-m-Y H:i');
                    }else{
                    return '<input type="hidden">';
                    }
                })->rawColumns(['kupon', 'Informasi', 'status', 'created_at'])->make(true);
        }
    }
    /* end data aktifitas tamu kupon */

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
            'balance' => $request->balance,
            // 'activities' => 'Deposit <b>' . $visitor->name . ' berkurang sebesar <b>' . $request->balance . '</b>',
        ]);
        $visitor->save();
        return redirect()->route('/aktifitas-kartu-tamu/' . $visitor->id)->with('status', 'Data Tamu Berhasil Diupdate');
    }
    /* END UPDATE BERKURANG deposit */

    /* limit tamu*/
    public function limittamu($id)
    {
        $limit = LogLimit::find($id);
        $data = [
            [
                'id' => $limit->visitor_id,
                'report_limit_id' => $limit->report_limit_id,
                'quota' => $limit->quota,
            ]
        ];
        DB::table('log_limits', 'quota')->get();
    }
    /* end limit tamu*/

    /* CREATE BERHASIL RESET limit VIP */
    public function createlimitvip(Request $request, $id)
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
            // 'activities' => 'Limit <b>' . $visitor->name . ' sebesar <b>' . $request->quota . '</b>',
        ]);

        $visitor->save();
        return redirect('/aktifitas-kartu-tamu/' . $visitor->id)->with('status', ' berhasil tambah deposit');
    }
    /* END CREATE BERHASIL RESET limit VIP */

    /* CREATE BERHASIL RESET limit VVIP */
    public function createlimitvvip(Request $request, $id)
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
            'activities' => 'Limit <b>' . $visitor->name . ' reset <b>' . $request->quota . '</b>',
        ]);
        $visitor->save();
        return redirect('/aktifitas-kartu-tamu/' . $visitor->id)->with('toast_success', ' berhasil reset limit');
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
            'activities' => 'Limit <b>' . $visitor->name . ' berkurang menjadi <b>' . $request->quota . '</b>',
        ]);
        return redirect('/aktifitas-kartu-tamu/' . $visitor->id)->with('toast_success', 'Paket berhasil diupdate');
    }
    /* END UPDATE BERKURANG LIMIT tamu*/

    /* data aktifitas tamu transaksi*/
    public function reporttransaksi(Request $request, $id)
    {
        $decrypt_id = Crypt::decryptString($id);
        $reporttransaksi = LogTransaction::join('visitors', 'log_transactions.visitor_id', '=', 'visitors.id')->where('log_transactions.visitor_id', $decrypt_id)->orderBy('log_transactions.created_at', 'desc')->get(['log_transactions.*', 'visitors.name as name']);
        if ($request->ajax()) {
            return datatables()->of($reporttransaksi)->editColumn('order_number', function ($data) {
                return $data->order_number;
            })
                ->addColumn('information', function ($data) {
                    // if($data->payment_type == 'limit'){
                    //     return '<p>Transaksi berhasil ! <b>'. $data->name.'</b> telah melakukan pembayaran menggunakan <b>limit</b></p>';
                    // } else if ($data->payment_type == 'kupon') {
                    //     return '<p>Transaksi berhasil ! <b>'. $data->name.'</b> telah melakukan pembayaran menggunakan <b>kupon</b></p>';
                    // } else if ($data->payment_type == 'cash/transfer') {
                    //     return '<p>Transaksi berhasil ! <b>'. $data->name.'</b> telah melakukan pembayaran <b>cash/transfer</b> sebesar <b>Rp. '.\formatrupiah($data->total).'</b></p>';
                    // } else{
                    // return '<p>Transaksi berhasil ! <b>'. $data->name.'</b> telah melakukan pembayaran menggunakan <b>saldo deposit</b> sebesar <b>Rp. '.\formatrupiah($data->total).'</b></p>';
                    return '<p>Transaksi berhasil ! <b>' . $data->name . '</b> telah melakukan pembayaran </p>';
                    // }
                })
                ->addColumn('status', function ($data) {
                    if ($data->payment_status == 'paid') {
                        return '<p class="label label-success">Berhasil<div>';
                    } else {
                        return '<p class="label label-warning">Gagal<div>';
                    }
                })
                ->editColumn('created_at', function ($data) {
                    return date_format($data->created_at, 'd-m-Y H:i');
                })->editColumn('total', function($data) {
                    return 'Rp. ' . number_format($data->total, 0, ',', '.');
                })->rawColumns(['order_number', 'total', 'information', 'status', 'created_at'])->make(true);
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
            'activities' => 'Transaksi Berhasil! <b>' . $visitors->name . ' telah melakukan pembayaran sebesar <b>' . $request->balance . '</b>',
        ]);

        return redirect('/aktifitas-kartu-tamu/' . $visitors->id)->with('toast_success', 'Transaksi Berhasil!');
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
            'activities' => 'Transaksi berhasil! <b>' . $visitors->name . ' telah melakkan pembayaran menggunakan <b>' . $request->quota . '</b>',
            // cTransaksi berhasil ! Arya GP telah melakukan pembayaran menggunakan Limit Gratis.
        ]);

        return redirect('/aktifitas-kartu-tamu/' . $visitors->id)
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
        $limit = LogLimit::where('visitor_id', $decrypt_id)->first();
        return view('tamu.edit-tamu', compact('visitor', 'limit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Loglimit $limit)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'email' => 'required|email',
                'phone' => 'required|min:12',
                'company' => 'required',
                'position' => 'required',
                'tipe_member' => 'required',
                'category' => 'required',
            ],
            [
                'name.required' => 'Nama Tamu masih kosong.',
                'address.required' => 'Alamat Tamu masih kosong.',
                'email.required' => 'Email Tamu masih kosong.',
                'phone.required' => 'Nomer Hp Tamu masih kosong.',
                'company.required' => 'Nama perusahaan masih kosong.',
                'position.required' => 'Posisi masih kosong.',
                'category.required' => 'Kategori masih kosong.',
            ]
        );
        $visitor = Visitor::find($id);
        $visitor->fill($request->post())->save();
        $limit = LogLimit::find($id);
        $limit->fill($request->post())->save();
        LogAdmin::create([
            'user_id' => Auth::id(),
            'quota' => $request->quota,
            'type' => 'UPDATE',
            'activities' => 'Mengubah member <b>' . $visitor->name . '</b>',
        ]);

        $visitor_limit = LogLimit::find($visitor->id);
        $visitor_report_limit = ReportLimit::find($visitor->id);
        if ($visitor->wasChanged('tipe_member')) {
            $visitor_limit->update([
                'quota' => $request->tipe_member == 'VIP' ? '4' : '10',
                'created_at' => Carbon::now(),
            ]);

            if ($visitor->tipe_member == 'VVIP') {
                $visitor_report_limit->update([
                    'report_quota' => $request->tipe_member == 'VIP' ? '4' : '10',
                    'created_at' => Carbon::now(),
                    'status' => 'Reset',
                    'activities' => 'Limit <b>' . $visitor->name . '</b> telah diubah menjadi <b>' . $request->tipe_member . '</b> dengan limit <b>10x Perbulan </b>',
                ]);
            } else {
                $visitor_report_limit->update([
                    'report_quota' => $request->tipe_member == 'VIP' ? '4' : '10',
                    'created_at' => Carbon::now(),
                    'status' => 'Reset',
                    'activities' => 'Limit <b>' . $visitor->name . '</b> telah diubah menjadi <b>' . $request->tipe_member . '</b> dengan limit <b>4x</b> Perbulan ',
                ]);
            }
        }
        return redirect()->route('daftar-tamu')->with('success', 'Berhasil edit tamu');
    }
    
    public function tambahtamu()
    {
        return view('tamu.tambah-tamu');
    }

    /* export exel analisi*/

    public function export_excel_tamu() {
        return Excel::download(new DaftarTamuExport, 'daftar_tamu.xlsx');
    }

    /* end export exel analisi*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $visitor = Visitor::find($id);
        $visitor->name = $visitor->name;

        LogAdmin::create([
            'user_id' => Auth::id(),
            'type' => 'DELETE',
            'activities' => 'Menghapus member <b>' . $visitor->name . '</b>',
        ]);
        Visitor::destroy($id);
        return redirect()->route('daftar-tamu');
    }

    public function update_kupon(Request $request, $id, Loglimit $log_limit)
    {
        try {
            $visitor = Visitor::find($id);
            $visitor = LogLimit::join('visitors', 'log_limits.visitor_id', '=', 'visitors.id')->where('log_limits.visitor_id', $id)->first();
            $log_limit = LogLimit::where('visitor_id', $id)->first();
            $log_limit->quota_kupon = $request->quota_kupon + $log_limit->quota_kupon;
            // dd($log_limit);
            // $log_limit->save();
            // dd($log_limit);

            //notifikasi email
            $log_limit = LogLimit::where('visitor_id', $id)->first();
            $data = $request->all();
            $datav = Visitor::find($id);
            $data['name'] = $datav->name;
            $data['tambahkupon'] = $request->quota_kupon;
            $data['sebelumkupon'] = $log_limit->quota_kupon - $request->quota_kupon;
            $data['setelahkupon'] = $log_limit->quota_kupon;
            $data['quota'] = $log_limit->quota;
            $data['quota_kupon'] = $log_limit->quota_kupon;
            $data['email'] = $visitor->email;
            dispatch(new SendMailJobKuponTambah($data));

            LogAdmin::create([
                'user_id' => Auth::id(),
                'type' => 'CREATE',
                'activities' => 'Berhasil menambah kupon <b>' . $request->quota_kupon . '</b> atas nama <b>' . $visitor->name . '</b>',
            ]);

            ReportLimit::create([
                'report_quota_kupon' => $log_limit->quota_kupon,
                'report_quota' => $log_limit->quota,
                'visitor_id' => $id,
                'user_id' => Auth::id(),
                'status' => 'Bertambah',
            ]);

            return redirect()->back()->with('success', 'Berhasil menambah kupon');
        } catch (\Throwable $th) {
            return response()->json($this->getResponse());
        }
    }
}