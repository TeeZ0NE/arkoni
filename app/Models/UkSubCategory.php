<?php

namespace App\Models;

//use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;

class UkSubCategory extends Model
{
    public $timestamps = false;
    public $primaryKey = 'sub_cat_id';
    protected $fillable = array(
        'sub_cat_id', 'uk_name', 'title', 'desc', 'h1', 'h2', 'seo_text', 'seo_text_2'
    );

    public function getSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_cat_id');
    }

    /**
     * returning all UK relations to parent UK category
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getSubCategories(){
        return $this->hasManyThrough(UkSubCategory::class, SubCategory::class,'cat_id','sub_cat_id','cat_id','id');
    }
}
