<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;



class Company extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name', 'phone', 'photo', 'adjective_id', 'verified_at'
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function  getPhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/companies/' . $val) : "";
    }
}
