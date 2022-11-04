<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;
    //untuk memberikan penjelasan bawah tabel ini bernama pinjaman gak ada s nya
    protected $table = 'pinjaman';

    //kebalikan dari fillable, jadi hanya kolom yang disebutkan di array tidak boleh masuk
    protected $guarded = [];

    //membuat relasi
    public function angsuran()
    {
        return $this -> hasMany(Angsuran::class);
    }

    public function user()
    {
        return $this -> belongsTo(User::class);
    }
}
