<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Visitor;
use App\Models\LogAdmin;
use App\Models\LogLimit;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ReportDeposit;
use Illuminate\Support\Carbon;
use App\Jobs\SendMailJobDeposit;
use illuminate\support\facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ScanqrController extends Controller
{
    private $status;
    private $message;
    private $data;
    private $user;

    public function __construct()
    {
        $this->status = "INVALID";
        $this->message = "Ada sesuatu yang salah!";
        $this->data = [];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $visitors = Visitor::all();
        // return View::make('Scan-tamu')
        // ->with('visitors', $visitors);

        return view('Scan-tamu');
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
        // $visitor = Visitor::findOrFail($id);
        // $qrcode = QrCode::size(400)->generate($visitor->id);
        // return view('qrcode',compact('qrcode'));
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
    // Scantamu-berhasil
    public function scantamuberhasil(){
            return view('/scan-tamu-berhasil');
    }
    
    public function proses (){
            return view('proses');
    }

    public function kartutamu($id){

        $visitor = Visitor::findOrFail($id);
        $qrcode = QrCode::size(180)->generate($visitor->unique_qr);
        $data['visitor'] =  Visitor::find($id);
        return view('tamu.kartu-tamu',compact('qrcode'),$data);
        
    }

    //penghubung route dengan view
    public function detailscan(){
        return view('detail_scan');
    }
    
    //penghubung method dengan view yang akan ditampilkan
    public function show_detail($id = null){
        $visitor = Visitor::find($id);
        $deposit = Deposit::where('visitor_id', $id)->first();
        $log_limit = LogLimit::where('visitor_id', $id)->first();
        $data['visitor'] = $visitor;
        $data['deposit'] = $deposit;
        $data['log_limit'] = $log_limit;
        return view('detail_scan', $data);
    }

    public function checkQRCode(Request $request, $id = null)
    {
        $url_qr = explode("/", parse_url($request->get('qrCode'), PHP_URL_PATH));
        $get_visitor = Visitor::where("id", $url_qr[2])->first();
        if($get_visitor == null) {
            $this->setResponse('INVALID', "Data tidak ditemukan!");
            return response()->json($this->getResponse());
        } else {
            try {
                $this->setResponse('VALID', "Valid QR code", [
                    'name' => $get_visitor->name,
                ]);
                return response()->json($this->getResponse());
            } catch (\Throwable $th) {
                return response()->json($this->getResponse());
            }
        }
    }

    private function setResponse($status = "INVALID", $message = "Ada sesuatu yang salah!", $data = [])
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
            'data' => $this->data ? $this->data : null
        ];
    }

    public function update_deposit(Request $request, $id)
    {
        try {
            $get_uri = explode("/", parse_url($request->getRequestUri(), PHP_URL_PATH));
            $visitor = Deposit::join('visitors', 'deposits.visitor_id', '=', 'visitors.id')->where('deposits.visitor_id', $get_uri[3])->first();
            $deposit = Deposit::where('visitor_id', $get_uri[3])->first();
            $deposit->balance = $request->balance + $deposit->balance;
            
            $report_deposit = ReportDeposit::where('visitor_id', $get_uri[3])->first();
            $report_deposit->report_balance = $request->balance + $report_deposit->report_balance;
            $deposit->save();
            $report_deposit->save();

            LogAdmin::create([
                'user_id' => Auth::id(),
                'type' => 'CREATE',
                'activities' => 'Berhasil menambah deposit <b>'.$request->balance.'</b> atas nama <b>'.$visitor->name.'</b>',
            ]);
            return redirect()->back()->with('success','Berhasil menambah deposit');
        } catch (\Throwable $th) {
            return response()->json($this->getResponse());
        }
    }
}
