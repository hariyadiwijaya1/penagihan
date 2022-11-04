<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Bunga;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PinjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total_pinjaman = 1000000;
        $tenor = 5;
        $bunga = Bunga::find(1)->suku_bunga;

        $a = $total_pinjaman;
        $b = $tenor*(($total_pinjaman / $tenor) + ($total_pinjaman * ($bunga/100)));
        $c = ($total_pinjaman * ($bunga/100));
        $d = ($total_pinjaman / $tenor);
        $e = (($total_pinjaman / $tenor) + ($total_pinjaman * ($bunga/100)));


        $pinjam = Pinjaman::create([
            'user_id' => 1,
            'total_pinjaman' => ceil($a),
            'saldo_pinjaman' => ceil($b),
            'tanggal_pinjam' => date('Y-m-d'),
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
    }
}
