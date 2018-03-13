<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Attribute extends Model
{
    protected $fillable = array(
        'ru_name',
        'uk_name'
    );
    public $timestamps = false;

    public function setRuNameAttribute($value)
    {
        return $this->attributes['ru_name'] = mb_strtolower($value);
    }

    public function setUkNameAttribute($value)
    {
        return $this->attributes['uk_name'] = mb_strtolower($value);
    }

    /**
     * search query and then sort
     * @param String $q what we're looking 4
     * @param string $sort sort method ASC or DESC
     * @return array of results
     */
    public function searchAndSort($q = Null, $sort = 'asc')
    {
        return DB::table('attributes')->
        select('*')->
        where('ru_name', 'LIKE', '%' . $q . '%')->
        orWhere('uk_name', 'LIKE', '%' . $q . '%')->
        orderBy('ru_name', $sort)->
        orderBy('uk_name', $sort);
    }
}
