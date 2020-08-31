<?php

namespace App\Imports;

use App\produk_koperasi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProdukKoperasiImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        
        return new produk_koperasi([
            'id_kategori' => produk_koperasi::toNum($row[1]), 
            'nama_produk' => $row[2],
            'kode_produk' => $row[3],
            'merk' => $row[4], 
            'harga_koperasi' => $row[5], 
            'gambar' => "default.jpg", 
        ]);
    }
}
