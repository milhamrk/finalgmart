<?php

namespace App\Exports;

use App\produk_koperasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProdukKoperasiExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $produkKoperasi = produk_koperasi::all();
        $alphabet = array( 'A', 'B', 'C', 'D', 'E',
                       'F', 'G', 'H', 'I', 'J',
                       'K', 'L', 'M', 'N', 'O',
                       'P', 'Q', 'R', 'S', 'T',
                       'U', 'V', 'W', 'X', 'Y',
                       'Z'
                       );
        $payload = [];
        foreach ($produkKoperasi as $key => $value) {
            $payload[] = array('id' => $key+1,
                                'idKategori' => $alphabet[$value['id_kategori']-1],
                                'namaProduk' => $value['nama_produk'],
                                'kodeProduk' => $value['kode_produk'],
                                'merk' => $value['merk'],
                                'hargaKoperasi' => $value['harga_koperasi'],
                            );
        }
        $collect = collect($payload)->map(function ($coll) {
            return (object) $coll;
        });
        return $collect;
    }
     public function headings(): array
    {
        return ['#','Kategori Produk','Jenis Produk','Kode Produk','Merk Produk','Harga Jual'];
    }
}
