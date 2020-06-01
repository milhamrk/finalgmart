<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    protected $table = 'konsumen';
    protected $primaryKey = 'id_konsumen';
    protected $fillable = ['nama','email','no_hp','alamat','password'];
}
