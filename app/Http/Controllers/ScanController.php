<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ScanController extends Controller
{
    
    // Scantamu - sidebar
    public function scantamu(){
        return view('/scan-tamu');
    }
    public function scantamuberhasil(){
        return view('/scan-tamu-berhasil');
    }

    public function proses (){
        return view('proses');
    }

    // fungsi generate QRcode Daftar-tamu
    public function generate ($id)
    {
        $visitor = Visitor::findOrFail($id);
        $qrcode = QrCode::size(400)->generate($visitor->id);
        return view('qrcode',compact('qrcode'));
    }
}
