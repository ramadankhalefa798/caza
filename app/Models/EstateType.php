<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class EstateType extends Model
{
    use Translatable;

    protected $table = 'estates_types';
    protected $guarded = [];

    protected $translatedAttributes = ['name'];
    protected $with = ['translations'];
    protected $hidden = ['translations'];
}
