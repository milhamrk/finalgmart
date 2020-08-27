<?php

namespace App\Imports;

use App\produk_koperasi;
use Maatwebsite\Excel\Concerns\ToModel;

class ProdukKoperasiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new produk_koperasi([
            'nama' => $row[1],
            'nis' => $row[2], 
            'alamat' => $row[3], 
        ]);
    }
}
