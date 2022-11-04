<?php

namespace App\Exports;

use App\Models\Angsuran;
use Maatwebsite\Excel\Concerns\FromCollection;

class AngsuranExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $id;
    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        return Angsuran::where('pinjaman_id', $this->id)->get();
    }
}
