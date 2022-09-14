<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Visitor;
use App\Models\LogLimit;
use Illuminate\View\View;
use Illuminate\Http\Request;
use illuminate\support\facades\DB;
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
    public function show_detail($email = null){
        $visitor = Visitor::find($email);
        // $deposit = Deposit::where('visitor_id', $id)->first();
        // $log_limit = LogLimit::where('visitor_id', $id)->first();
        $data['visitor'] = $visitor;
        // $data['deposit'] = $deposit;
        // $data['log_limit'] = $log_limit;
        return view('detail_scan', $data);
    }

    public function checkQRCode(Request $request, $email = null)
    {
        // return redirect('/detail/'.$email)->with(
        //     'success',
        //     'Verifikasi berhasil'
        // );
        $qrCode = trim($email);
        $get_visitor = Visitor::where("email", $qrCode)->first();
        if($get_visitor == null) {
            $this->setResponse('INVALID', "Invalid QR code");
            return response()->json($this->getResponse());
        } else {
            try {
                $this->setResponse('VALID', "Valid QR code", [
                    'id' => $get_visitor->id,
                    'name' => $get_visitor->name,
                    'email' => $get_visitor->email,
                    'phone' => $get_visitor->phone,
                    'address' => $get_visitor->address,
                    'position' => $get_visitor->position,
                    'company' => $get_visitor->company,
                    'gender' => $get_visitor->gender,
                    'tipe_member' => $get_visitor->tipe_member,
                ]);
                return response()->json($this->getResponse());
            } catch (\Throwable $th) {
                $this->setResponse('INVALID', "Invalid QR code");
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
}
