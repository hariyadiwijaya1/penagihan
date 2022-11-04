<?php

namespace App\Http\Controllers;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use App\Exports\PinjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //untuk mengambil data menggunakan data tables (server side)
        if (request()->ajax())
        {
            $pinjaman = Pinjaman::with('angsuran')->latest()->get();
            return DataTables::of ($pinjaman)
                ->addIndexColumn()
                ->editColumn('user_id', function (Pinjaman $pinjaman){
                    return $pinjaman->user->name;
                })

                ->addColumn('status', function ($row){
                    $acc ='<button class="btn btn-primary" disabled><i class="fa fa-check"></i></button>';

                    $tolak =
                    '<form method="post" action="'.route('pinjaman.status', $row->id).'">
                    '.csrf_field().'
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                    </form>';

                    return $row->status == 1 ? $acc : $tolak;
                })
                ->addColumn('action', function ($row){
                    $btn =
                    '
                    <form method="post" action="'.route('pinjaman.destroy', $row->id).'">
                    '.csrf_field().'
                    '.method_field('DELETE').'
                    <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fas fa-trash"></i>
                    </button>
                    </form>
                    ';

                    return $btn;
                })
                ->addColumn('details', function ($row) {
                    $btn =
                    '<a href="'.route('detail.angsuran', $row->id).'" class="btn btn-primary">Details</a>';
                    return $btn;
                })

                ->rawColumns(['action','status', 'details'])
                ->make(true);
        }


        return view('pinjaman.index', [
            'title' => 'Halaman Pinjaman'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $pinjaman=Pinjaman::with('angsuran', 'user')->find($id);

        return response()->json($pinjaman);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pinjaman $pinjaman)
    {
        $pinjaman->delete();
        return back();
    }

    public function status(Pinjaman $pinjaman)
    {
        $pinjaman->update([
            'status'            => 1,
            'tanggal_pinjam'    => date('Y-m-d'),
        ]);
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new PinjamanExport, 'pinjaman.xlsx');
    }
}
