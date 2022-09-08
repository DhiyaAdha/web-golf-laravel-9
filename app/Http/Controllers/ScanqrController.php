<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Visitor;
use App\Models\LogLimit;
use Illuminate\View\View;
use Illuminate\Http\Request;
use illuminate\support\facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ScanqrController extends Controller
{
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
        $qrcode = QrCode::size(180)->generate($visitor->id);
        $data['visitor'] =  Visitor::find($id);
        // $data['email'] =$visitor->email;
        // $data['phone'] =$visitor->phone;
        // $data['gender'] =$visitor->gender;
        // dd($data);
        return view('tamu.kartu-tamu',compact('qrcode'),$data);
        
    }

    //penghubung route dengan view
    public function detailscan(){
        return view('detail_scan');
    }
    
    //penghubung method dengan view yang akan ditampilkan
    public function detail_datapengunjung($id){
        $visitor = Visitor::find($id);
        $deposit = Deposit::find($id);
        $log_limit = LogLimit::find($id);
        $data['visitor'] = $visitor;
        $data['deposit'] = $deposit;
        $data['log_limit'] = $log_limit;

        return view('detail_scan', $data);

        // $data_visitor = Visitor::all();
        // return view('detail_scan', compact('data_visitor'));
    }

    //private
    private function checkUser($id)
    {
        $this->user = Visitor::find($id);
        if (!$this->user) {
            $this->setResponse('INVALID', "Invalid QR code");
            throw new \Throwable();
        }
    }

    private function checkEmail($email)
    {
        if (!hash_equals((string) $email, sha1($this->user->email))) {
            $this->setResponse('INVALID', "Invalid QR code");
            throw new \Throwable();
        }
    }

    public function checkQRCode(Request $request)
    {
        $qrCode = [];
        if (trim($request->get('qrCode'))) {
            $qrCode = explode('/', trim($request->get('qrCode')));
        } else {
            $this->setResponse('VALID', 'Invalid QR code');
            return response()->json($this->getResponse());
        }

        try {
            $this->checkUser($qrCode[1]);
            $this->checkEmail($qrCode[2]);
            // $this->checkExpire($qrCode[3]);
            $this->setResponse('VALID', "Valid QR code", [
                'name' => $this->user->name,
                'email' => $this->user->email,
            ]);
            return response()->json($this->getResponse());
        } catch (\Throwable $th) {
            return response()->json($this->getResponse());
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
