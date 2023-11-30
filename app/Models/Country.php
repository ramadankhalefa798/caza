<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use Translatable;

    protected $table = 'countries';
    protected $guarded = [];

    protected $translatedAttributes = ['name'];
    protected $with = ['translations'];
    protected $hidden = ['translations'];
}
