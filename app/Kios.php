<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kios extends Authenticatable
{
	use Notifiable;
	protected $guard = 'kiosz';

    protected $table = 'kios';
    protected $primaryKey = 'id_kios';
    protected $fillable = ['nama_pemilik', 'nama_kios', 'email', 'no_hp', 'alamat', 'status_buka', 'longitude', 'latitude', 'id_city'];

    protected $hidden = [
            'password', 'remember_token',
        ];
}
