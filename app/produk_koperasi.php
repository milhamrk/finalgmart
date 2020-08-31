<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produk_koperasi extends Model
{
    protected $table = 'produk_koperasi';
    protected $primaryKey = 'id_produkkoperasi';
    protected $fillable = ['id_produkkoperasi','nama_produk','kode_produk','merk','gambar','harga_koperasi','id_kategori'];

    public static function toNum($data) {
        $alphabet = range('A', 'Z');
        $return_value = array_search('D', $alphabet)-1;
        return $return_value;
    }
    public static function one($data) {
        return $data+1;
    }
}
