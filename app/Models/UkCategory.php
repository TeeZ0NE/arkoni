<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UkCategory extends Model
{
    public $timestamps = false;
    public $primaryKey = 'cat_id';
    protected $fillable = array(
        'cat_id', 'uk_name','title', 'desc', 'h1', 'h2', 'seo_text', 'seo_text_2'
    );

    public function setUkNameAttribute($value){
        return $this->attributes['uk_name'] = mb_strtolower($value);
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function getSubCategories()
    {
        return $this->hasManyThrough(RuSubCategory::class, SubCategory::class, 'cat_id', 'sub_cat_id', 'cat_id', 'id');
    }
}
