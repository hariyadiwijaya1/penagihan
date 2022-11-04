<?php

namespace App\Http\Controllers;

use App\Models\Bunga;
use Illuminate\Http\Request;

class BungaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bunga=Bunga::find(1);
        return view('bunga.index',$bunga,[
            'title' => 'bunga',
            'bunga' => $bunga
        ]);
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
     * @param  \App\Models\Bunga  $bunga
     * @return \Illuminate\Http\Response
     */
    public function show(Bunga $bunga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bunga  $bunga
     * @return \Illuminate\Http\Response
     */
    public function edit(Bunga $bunga)
    {
        return view('bunga.edit',compact('bunga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bunga  $bunga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bunga $bunga)
    {
        $bunga->update(['suku_bunga'=>$request->suku_bunga]);
        // return redirect('bunga.index');
        return redirect()->route('bunga.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bunga  $bunga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bunga $bunga)
    {
        //
    }
}
