<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{

    protected $table = 'auctions';
    protected $guarded = [];


    public function  getCoverAttribute($val)
    {
        return ($val !== null) ? asset('assets/images/auctions/' . $val) : "";
    }



    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function estateType()
    {
        return $this->belongsTo(EstateType::class, 'estate_type_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
