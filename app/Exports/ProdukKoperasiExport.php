<?php

namespace App\Exports;

use App\produk_koperasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProdukKoperasiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return produk_koperasi::all();
    }
     public function headings(): array
    {
        return ['id_produkkoperasi','nama_produk','merk','gambar','harga_koperasi','id_kategori'];
    }
}
