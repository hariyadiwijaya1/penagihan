<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Bunga;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->role==1)
        {
            return redirect()->route('pinjaman.index');
        }
        return view('home');
    }

    public function pengajuan()
    {
        return view('pengajuan');
    }

    public function daftar()
    {
        $total_pinjaman = request('total_pinjaman');
        $tenor = request('tenor');
        $bunga = Bunga::find(1)->suku_bunga ;

        $a = $total_pinjaman;
        $b = $tenor*(($total_pinjaman / $tenor) + ($total_pinjaman * ($bunga/100)));
        $c = ($total_pinjaman * ($bunga/100));
        $d = ($total_pinjaman / $tenor);
        $e = (($total_pinjaman / $tenor) + ($total_pinjaman * ($bunga/100)));

        $pinjam = Pinjaman::create([
            'user_id' => auth()->user()->id,
            'total_pinjaman' => ceil($a),
            'saldo_pinjaman' => ceil($b),
            'tenor' => $tenor,
            'angsuran_bunga' => ceil($c),
            'angsuran_pokok' => ceil($d),
            'total_angsuran' => ceil($e),
        ]);

        for ($i = 0; $i < $tenor; $i++){
            Angsuran::create([
                'pinjaman_id' => $pinjam->id,
                'angsuran_keberapa' => $i+1,
                'pokok' => $pinjam -> angsuran_pokok,
                'bunga' => $pinjam -> angsuran_bunga,
                'total' => $pinjam -> total_angsuran,
                'jatuh_tempo' => Carbon::parse($pinjam->tanggal_pinjam)->addMonth($i+1)->format('Y-m-d'),
            ]);
        }

        return redirect()->route('profil', auth()->user()->id);
    }

    public function profil($id)
    {
        $user = User::find($id);
        if ($user && auth()->user()->id == $user->id)
        {
        return view('profil', [
            'title' => 'Profil',
            'pinjaman' => Pinjaman::with('angsuran')->where('user_id', $user->id)->get(),
            'angsuran' => Angsuran::whereHas('pinjaman', function ($q) use ($user) {
                $q->where('status', 1);
                $q->where('user_id', $user->id);
            })
            ->get()
        ]);
        }else { abort(404);}
    }

    public function upload($id)
    {
        $angsuran = Angsuran::find($id);
        if (request('bukti_transaksi')) {
            if ($angsuran->bukti_transaksi) {
                Storage::delete($angsuran->bukti_transaksi);
            }
            $image = request()->file('bukti_transaksi')->store('img/bukti_transaksi');
        } else {
            $image = null;
        }
        $angsuran->update([
            'bukti_transaksi' => $image,
        ]);
        return redirect()->route('profil', auth()->user()->id);
    }
}
