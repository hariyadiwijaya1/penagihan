<?php

namespace Database\Seeders;

use App\Models\Bunga;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BungaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bunga::create([
            'suku_bunga' => 2
        ]);
    }
}
