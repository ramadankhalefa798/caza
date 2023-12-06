<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use Translatable;

    protected $table = 'professions';
    protected $guarded = [];

    protected $translatedAttributes = ['name'];
    protected $with = ['translations'];
    protected $hidden = ['translations'];


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
