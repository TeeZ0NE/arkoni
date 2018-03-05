<?php

namespace App\Models;

use App\RuSubCategory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = array(
    'cat_id', 'sub_cat_slug'
    );
    public $timestamps = false;

    public function getCategory(){
        return $this->belongsTo(Categories::class,'cat_id');
    }

    public function getRuSubCategory(){
        return $this->hasMany(RuSubCategory::class,'sub_cat_id');
    }

    public function getUkSubCategory(){
        return $this->hasMany(UkSubCategory::class,'sub_cat_id');
    }
}
