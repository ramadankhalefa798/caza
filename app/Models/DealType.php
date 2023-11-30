<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class DealType extends Model
{
    use Translatable;

    protected $table = 'deals_types';
    protected $guarded = [];

    protected $translatedAttributes = ['name'];
    protected $with = ['translations'];
    protected $hidden = ['translations'];
}
