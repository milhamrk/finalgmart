<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class produk_koperasi extends Model
{
    protected $table = 'produk_koperasi';
    protected $primaryKey = 'id_produkkoperasi';
    protected $fillable = ['id_produkkoperasi','nama_produk','merk','gambar','harga_koperasi','id_kategori'];
}
