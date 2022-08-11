<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dtVisitor = Visitor::all();
        return view ('Analisis-tamu', compact('dtVisitor'));
        
          
        
        // return view('Analisis-tamu')->with('visitor', $dtVisitor);
            // $post   = Post::all();
            // return view('index')->with('post', $post);
        
        
        
        // return $dtVisitor;
        // return view ('Analisis-tamu', ['dtVisitor'=>$dtVisitor]);
        // public function lihat_acara()
        // {
        // $data['acara'] = events::all();
        // return view('admin.home', ['acara' => $data['acara'] ]);
        // }
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
        
        Visitor::create([
            'id' => $request->id,
            'nama' => $request->name,
            'gener' => $request->gener,
            'tipe_member' => $request->tipe_member,
        ]);

        return redirect('analisis_tamu');

        
        // Pegawai::create([
        //     'nama' => $request->nama,
        //     'alamat' => $request->alamat,
        //     'tgllhr' => $request->tgllhr,
        // ]);

        // return redirect('datapegawai');
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
}
