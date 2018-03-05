<?php

namespace App\Models;

use App\RuSubCategory;
use Illuminate\Database\Eloquent\Model;

class RuCategory extends Model
{
    public $timestamps = false;
    protected $fillable = array(
      'cat_id', 'title', 'desc', 'h1', 'h2', 'seo_text',
    );

    public function getCategory(){
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function getSubCats(){
        return $this->hasManyThrough(RuSubCategory::class, SubCategory::class,'cat_id','sub_cat_id','cat_id','id');
    }
}
