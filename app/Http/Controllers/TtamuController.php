<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class TamuController extends Controller
{
    // fungsi Paginasi
    // public function daftartamu(){

    //     // $data['visitor'] = DB::table('visitors')->orderBy('created_at', 'desc')->whereNull('deleted_at')->paginate(20);

    //     // return view('tamu.Daftar-tamu', $data);
    //     // return response()->json($data);
    // }

    
    // public function tambahtamu(){
        
    //     return view('tamu.Tambah-tamu');

    // }

    public function edittamu(){
        
        return view('tamu.edit-tamu');
    }

    public function updatetamu(){
        
        return view('tamu.Daftar-tamu');
    }
    public function tambahdeposit(){
        
        return view('tamu.tambah-deposit');
    }
    public function kartutamu(){
        
        return view('tamu.kartu-tamu');
    }


    // Fungsi Menambahkan-tamu
    // public function inserttamu(Request $request){
    //     // dd($request->all());
    //     // $data[Visitor]::create($request->all()); 
    //     // return redirect()->route('Daftar-tamu');

    //     $this->validate($request, [
    //         'name'     => 'required',
    //         'address'     => 'required',
    //         'gender'   => 'required',
    //         'email'   => 'required|email',
    //         'phone'   => 'required',
    //         'company'   => 'required',
    //         'position'   => 'required',
    //         'tipe_member'   => 'required',
    //     ]);
        
    //     $visitors = Visitor::create([
            
    //         'name'      => $request->name,
    //         'address'   => $request->address,
    //         'gender'    => $request->gender,
    //         'email'    => $request->email,
    //         'phone'    => $request->phone,
    //         'company'    => $request->company,                
    //         'position'    => $request->position,
    //         'tipe_member'    => $request->tipe_member,
    //         'created_at'    => Carbon::now()
    //     ]);
    //         // $visitors->address = $request->alamat;
    //         $visitors->save();
    //         return redirect('/daftar-tamu')
    //         ->with('sukses','Company has been created successfully.');
    // }

    // Fungsi edittamu (belum)
    // public function edit($id)
    // {
    //     // get the shark
    //     $visitors = Visitor::find($id);

    //     // show the edit form and pass the shark
    //     return View::make('/daftar-tamu')
    //         ->with('visitor', $visitors);
    // }


    // hapustamu
    // fungsi Hapus-tamu
    // public function hapus($id)
    // {
    //     $visitor = Visitor::find($id);
    //     $visitor->delete();
    //     return back();
    // }

}
