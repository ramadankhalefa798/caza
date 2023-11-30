<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Adjective extends Model
{
    use Translatable;

    protected $table = 'adjectives';
    protected $guarded = [];

    protected $translatedAttributes = ['name'];
    protected $with = ['translations'];
    protected $hidden = ['translations'];
}
