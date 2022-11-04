<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angsuran', function (Blueprint $table) {
            $table->id();
            $table->string('angsuran_keberapa');
            $table->float('pokok', 15,2);
            $table->float('bunga', 15,2);
            $table->float('total', 15,2);
            $table->date('jatuh_tempo');
            $table->string('bukti_transaksi')->nullable();
            $table->enum('status', ['1','0'])->coment('0=belum bayar 1=sudah bayar')->default('0');
            $table->timestamps();

            // $table->foreignId('user_id')->constrained();
            $table->foreignId('pinjaman_id')->constrained('pinjaman')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angsuran');
    }
};
