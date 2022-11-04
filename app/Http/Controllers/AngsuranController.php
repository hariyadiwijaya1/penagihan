<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use App\Exports\AngsuranExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AngsuranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

       $detail_angsuran = Angsuran::where('pinjaman_id', $id)->get();
        return view('angsuran.index',[
            'title' => 'Angsuran',
            'detail_angsuran' => $detail_angsuran
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
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function show(Angsuran $angsuran)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function edit(Angsuran $angsuran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function update(Angsuran $angsuran)
    {
        $angsuran->update(
            ['status'=>request('status')]
        );

        if ($angsuran->status ==  1) {
            Pinjaman::where('id', $angsuran->pinjaman_id)->update([
                'saldo_pinjaman' => DB::raw("saldo_pinjaman - $angsuran->total")
            ]);
        } else {
            Pinjaman::where('id', $angsuran->pinjaman_id)->update([
                'saldo_pinjaman' => DB::raw("saldo_pinjaman + $angsuran->total")
            ]);
        }
        return redirect()->route('detail.angsuran', $angsuran->pinjaman_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Angsuran  $angsuran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Angsuran $angsuran)
    {
        //
    }

    public function export(Pinjaman  $pinjaman)
    {
        return Excel::download(new AngsuranExport($pinjaman->id), 'angsuran.xlsx');
    }
}
