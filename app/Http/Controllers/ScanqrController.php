<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Visitor;
use App\Models\LogAdmin;
use App\Models\LogLimit;
use App\Models\LogCoupon;
use App\Models\ReportLimit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ReportDeposit;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use App\Jobs\SendMailJobKuponTambah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Jobs\SendMailJobDepositTambah;

class ScanqrController extends Controller
{
    private $status;

    private $message;

    private $data;

    public function __construct()
    {
        $this->status = 'INVALID';
        $this->message = 'Ada sesuatu yang salah!';
        $this->data = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('membership.scan-tamu');
    }

    public function proses()
    {
        return view('proses');
    }

    public function detailscan()
    {
        return view('membership.detail_scan');
    }

    public function show_detail(Request $request, $code = null)
    {
        try {
            if (! $request->hasValidSignature()) {
                abort(401);
            }
            $visitor = Visitor::where('code_member', $code)->first();
            $deposit = Deposit::where('visitor_id', $visitor->id)->first();
            $log_limit = LogLimit::where('visitor_id', $visitor->id)->first();
            $data['log_coupon'] = LogCoupon::where('visitor_id', $visitor->id)->first();
            $data['visitor'] = $visitor;
            $data['deposit'] = $deposit;
            $data['log_limit'] = $log_limit;

            return view('membership.detail_scan', $data);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    public function checkQRCode(Request $request)
    {
        $get_visitor = Visitor::where('code_member', $request->get('qrCode'))->first();
        Cache::put('random', Str::random(5));
        try {
            if ($get_visitor == null) {
                $this->setResponse('INVALID', 'Qr Code tidak ditemukan!');
                return response()->json($this->getResponse());
            } else {
                if($get_visitor->expired_date <= Carbon::now()) {
                    $this->setResponse('INVALID', 'Masa berlaku member habis');
                    return response()->json($this->getResponse());
                } elseif($get_visitor->status == 'inactive') {
                    $this->setResponse('INVALID', 'Member tidak aktif');
                    return response()->json($this->getResponse());
                } else {
                    try {
                        LogAdmin::create([
                            'user_id' => Auth::id(),
                            'type' => 'CREATE',
                            'activities' => 'Verifikasi Qr Code member <b>'.$get_visitor->name.'</b>',
                        ]);
                        $this->setResponse('VALID', 'Valid QR Code', [
                            'name' => $get_visitor->name,
                            'detail_scan' => URL::temporarySignedRoute('detail-scan', now()->addMinutes(45), ['rdm' => Cache::get('random'), 'code' => $get_visitor->code_member]),
                        ]);
                        return response()->json($this->getResponse(), 200);
                    } catch (\Throwable $th) {
                        return response()->json($this->getResponse());
                    }
                }
            }
        } catch (\Throwable $th) {
            return response()->json($this->getResponse());
        }
    }


    public function checkNIK(Request $request)
    {
        $get_visitor = Visitor::where('nik', $request->get('nik'))->where('phone', $request->get('phone'))->first();
        Cache::put('random', Str::random(5));
        try {
            if(is_null($get_visitor)) {
                $this->setResponse('INVALID', 'NIK tidak ditemukan!');
                return response()->json($this->getResponse());
            } else {
                if($get_visitor->expired_date <= Carbon::now()) {
                    $this->setResponse('INVALID', 'Masa berlaku member habis');
                    return response()->json($this->getResponse());
                } elseif($get_visitor->status == 'inactive') {
                    $this->setResponse('INVALID', 'Member tidak aktif');
                    return response()->json($this->getResponse());
                } else {
                    try {
                        $this->setResponse('VALID', 'Verifikasi Valid', [
                            'name' => $get_visitor->name,
                            'detail_scan' => URL::temporarySignedRoute('detail-scan', now()->addMinutes(45), ['rdm' => Cache::get('random'), 'code' => $get_visitor->code_member]),
                        ]);
                        return response()->json($this->getResponse(), 200);
                    } catch (\Throwable $th) {
                        return response()->json($this->getResponse());
                    }
                }
            }
        } catch (\Throwable $th) {
            return response()->json($this->getResponse());
        }
    }

    public function checkNoHp(Request $request)
    {
        $phone_visitor = Visitor::where('phone', $request->get('phone'))->first();
        Cache::put('random', Str::random(5));
        try {
            if (is_null($phone_visitor)) {
                $this->setResponse('INVALID', 'Nomor Hp Tidak Ditemukan!');
                return response()->json($this->getResponse());
            } else {
                if($phone_visitor->expired_date <= Carbon::now()) {
                    $this->setResponse('INVALID', 'Masa berlaku member habis');
                    return response()->json($this->getResponse());
                } elseif($phone_visitor->status == 'inactive') {
                    $this->setResponse('INVALID', 'Member tidak aktif');
                    return response()->json($this->getResponse());
                } else {
                    try {
                        LogAdmin::create([
                            'user_id' => Auth::id(),
                            'type' => 'CREATE',
                            'activities' => 'Verifikasi No Hp member <b>'.$phone_visitor->name.'</b>',
                        ]);

                        $this->setResponse('VALID', 'Valid Nomor Hp', [
                            'name' => $phone_visitor->name,
                            'status_nik' => $phone_visitor->status_nik,
                            'detail_scan' => URL::temporarySignedRoute('detail-scan', now()->addMinutes(45), ['rdm' => Cache::get('random'), 'code' => $phone_visitor->code_member]),
                        ]);
                        return response()->json($this->getResponse(), 200);
                    } catch (\Throwable $th) {
                        return response()->json($this->getResponse());
                    }
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    private function setResponse($status = 'INVALID', $message = 'Ada sesuatu yang salah!', $data = [])
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    private function getResponse()
    {
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data ? $this->data : null,
        ];
    }

    public function update_deposit(Request $request, $id)
    {
        try {
            $get_uri = explode('/', parse_url($request->getRequestUri(), PHP_URL_PATH));
            $visitor = Deposit::join('visitors', 'deposits.visitor_id', '=', 'visitors.id')->where('deposits.visitor_id', $get_uri[3])->first();
            $deposit = Deposit::where('visitor_id', $get_uri[3])->first();
            $deposit->balance = str_replace('.','',$request->balance) + $deposit->balance;
            $deposit->save();

            //notifikasi email
            $log_limit = LogLimit::where('visitor_id', $id)->first();
            $data = $request->all();
            $datav = Visitor::find($id);
            $data['name'] = $datav->name;
            $data['tambahdeposit'] = $request->balance;
            $data['sebelumdeposit'] = $deposit->balance - str_replace('.','',$request->balance);
            $data['setelahdeposit'] = $deposit->balance;
            $data['quota'] = $log_limit->quota;
            $data['quota_kupon'] = $log_limit->quota_kupon;
            $data['email'] = $visitor->email;
            dispatch(new SendMailJobDepositTambah($data));

            LogAdmin::create([
                'user_id' => Auth::id(),
                'type' => 'CREATE',
                'activities' => 'Berhasil menambah deposit <b>'.$request->balance.'</b> atas nama <b>'.$visitor->name.'</b>',
            ]);

            ReportDeposit::create([
                'payment_type' => $request->payment_type,
                'visitor_id' => $get_uri[3],
                'user_id' => Auth::id(),
                'fund' => $deposit->balance,
                'status' => 'Bertambah',
                'report_balance' => str_replace('.','',$request->balance),
            ]);

            return redirect()->back()->with('success', 'Berhasil menambah deposit');
        } catch (\Throwable $th) {
            return response()->json($this->getResponse());
        }
    }

    public function update_kupon(Request $request, $id)
    {
        try {
            $get_uri = explode('/', parse_url($request->getRequestUri(), PHP_URL_PATH));
            $visitor = LogLimit::join('visitors', 'log_limits.visitor_id', '=', 'visitors.id')->where('log_limits.visitor_id', $get_uri[3])->first();
            $log_limit = LogLimit::where('visitor_id', $get_uri[3])->first();
            $log_limit->quota_kupon = $request->quota_kupon + $log_limit->quota_kupon;
            $log_limit->save();

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
                'activities' => 'Berhasil menambah kupon <b>'.$request->quota_kupon.'</b> atas nama <b>'.$visitor->name.'</b>',
            ]);

            ReportLimit::create([
                'report_quota_kupon' => $log_limit->quota_kupon,
                'visitor_id' => $get_uri[3],
                'user_id' => Auth::id(),
                'status' => 'Bertambah',
            ]);

            return redirect()->back()->with('success', 'Berhasil menambah kupon');
        } catch (\Throwable $th) {
            return response()->json($this->getResponse());
        }
    }
}
