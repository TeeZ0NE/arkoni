<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = array(
        'name_ru',
        'name_uk'
    );
    public $timestamps = false;

    public function setNameRuAttribute($value)
    {
        return $this->attributes['name_ru'] = mb_strtolower($value);
    }

    public function setNameUkAttribute($value)
    {
        return $this->attributes['name_uk'] = mb_strtolower($value);
    }
}
