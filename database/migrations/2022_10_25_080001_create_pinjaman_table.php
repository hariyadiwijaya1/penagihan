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
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');
            $table->float('total_pinjaman', 15, 2);
            $table->float('saldo_pinjaman', 15, 2);
            $table->date('tanggal_pinjam')->nullable();
            $table->boolean('status', [1, 0])->comment('1=acc 0=belum acc')->default(0);
            $table->integer('tenor');

            $table->float('tunggakan', 15, 2)->nullable();
            $table->float('angsuran_bunga', 15, 2);
            $table->float('angsuran_pokok', 15, 2);

            $table->float('total_angsuran', 15, 2);
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->foreignId('user_id')->constrained('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjaman');
    }
};
