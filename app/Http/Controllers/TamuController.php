<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TamuController extends Controller
{
    // fungsi Paginasi
    public function daftartamu(){
        $data['visitor'] = DB::table('Visitors')->orderBy('created_at', 'desc')->whereNull('deleted_at')->paginate(20);
        return view('tamu.Daftar-tamu', $data);

        // return response()->json($data);
    }

    
    public function tambahtamu(){
        
        return view('/Tambah-tamu');
    }

    // Fungsi Menambahkan-tamu
    public function inserttamu(Request $request){
        // dd($request->all());
        // $data[Visitor]::create($request->all()); 
        // return redirect()->route('Daftar-tamu');

        $this->validate($request, [
            'name'     => 'required',
            'address'     => 'required',
            'gender'   => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'company'   => 'required',
            'position'   => 'required',
            'tipe_member'   => 'required',
        ]);
        
        $visitors = Visitor::create([
            
            'name'      => $request->name,
            'address'   => $request->address,
            'gender'    => $request->gender,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'company'    => $request->company,                
            'position'    => $request->position,
            'tipe_member'    => $request->tipe_member,
            'created_at'    => Carbon::now()
        ]);
            // $visitors->address = $request->alamat;
            $visitors->save();
            return redirect('/daftar-tamu')
            ->with('sukses','Company has been created successfully.');
    }

    // fungsi Hapus-tamu
    public function hapus($id)
    {
        $visitor = Visitor::find($id);
        $visitor->delete();
        return back();
    }

}
