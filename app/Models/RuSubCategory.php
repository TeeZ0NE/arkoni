<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RuSubCategory extends Model
{
    public $timestamps = false;
    public $primaryKey = 'sub_cat_id';
    protected $fillable = array(
        'sub_cat_id', 'ru_name', 'title', 'desc', 'h1', 'h2', 'seo_text',
    );

    public function setRuNameAttribute($value)
    {
        return $this->attributes['ru_name'] = mb_strtolower($value);
    }

    public function getSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_cat_id');
    }


    public function getCategory(){
        return DB::table('ru_sub_categories as scr')->
            select('scr.ru_name','scr.sub_cat_id', 'rc.ru_name as cat_name')->
            join('sub_categories as sc','scr.sub_cat_id','=','sc.id')->
            join('ru_categories as rc','sc.cat_id','=','rc.cat_id')->
            get();
    }
}
