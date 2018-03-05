<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
    public $timestamps = false;
    protected $fillable = array(
        'cat_url_slug',
    );

    public function RuCategory(){
        return $this->hasOne(RuCategory::class,'cat_id');
    }

    public function UkCategory(){
        return $this->hasOne(UkCategory::class,'cat_id');
    }

    public function getNameAndId(){
        return    DB::table('categories')
            ->select('uk_categories.name as uk_name','ru_categories.name as ru_name','id')
            ->join('uk_categories','uk_categories.cat_id','=','categories.id')
            ->join('ru_categories','ru_categories.cat_id','=','categories.id')
            ->get();
    }
}
