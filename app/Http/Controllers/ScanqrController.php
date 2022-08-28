<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\View\View;
use Illuminate\Http\Request;
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

    // fungsi generate QRcode Daftar-tamu
    public function generate ($id)
    {
        $visitor = Visitor::findOrFail($id);
        $qrcode = QrCode::size(400)->generate($visitor->id);
        return view('qrcode',compact('qrcode'));
    }

    // Scantamu-berhasil
    public function scantamuberhasil(){
            return view('/scan-tamu-berhasil');
    }
    
    public function proses (){
            return view('proses');
    }


    public function kartutamu(){
        
            return view('tamu.kartu-tamu');
    }

}
