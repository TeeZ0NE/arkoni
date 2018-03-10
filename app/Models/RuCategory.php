<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuCategory extends Model
{
    public $timestamps = false;
    public $primaryKey = 'cat_id';
    protected $fillable = array(
      'cat_id', 'ru_name','title', 'desc', 'h1', 'h2', 'seo_text',
    );

    public function setRuNameAttribute($value){
        return $this->attributes['ru_name'] = mb_strtolower($value);
    }

    public function getCategory(){
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function getSubCategories(){
        return $this->hasManyThrough(RuSubCategory::class, SubCategory::class,'cat_id','sub_cat_id','cat_id','id');
    }
}
