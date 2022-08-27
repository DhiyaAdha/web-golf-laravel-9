<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Paginasi
        $visitor = DB::table('visitors')->orderBy('created_at', 'desc')->whereNull('deleted_at')->paginate(20);

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
            // return redirect('/daftar-tamu')
            return redirect('tamu.tambah-tamu')
            ->with('sukses','Company has been created successfully.');
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

    public function tambahtamu(){
        
        // $visitors = Visitor::all();

        // return view('tamu.tambah-tamu');
        return view('tamu.tambah-tamu');

    }
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visitor = Visitor::find($id);
        return view('tamu.edit-tamu',compact('visitor'));
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
            'name'     => 'required',
            'address'    => 'required',
            'gender'   => 'required',
            'email'   => 'required|email',
            'phone'   => 'required',
            'company'   => 'required',
            'position'   => 'required',
        
        ]);
        $visitor = Visitor::find($id);
        $visitor->fill($request->post())->save();
    
        return redirect()->route('daftar-tamu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $visitor = Visitor::find($id);
        $visitor->delete();
        // return redirect ('daftar-tamu.index');
        return redirect()->route('daftar-tamu');
    
    }
}
