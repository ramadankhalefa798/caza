<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{

    protected $table = 'deals';
    protected $guarded = [];




    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function estateType()
    {
        return $this->belongsTo(EstateType::class, 'estate_type_id', 'id');
    }

    public function dealType()
    {
        return $this->belongsTo(DealType::class, 'deal_type_id', 'id');
    }
}
