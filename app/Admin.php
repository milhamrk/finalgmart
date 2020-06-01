<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
	use Notifiable;
	protected $guard = 'adminz';

    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $fillable = ['name','email','password','role','province_id'];
    protected $hidden = [
            'password', 'remember_token',
        ];
}
