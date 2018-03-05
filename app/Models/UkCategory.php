<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UkCategory extends Model
{
    public $timestamps = false;
    public $primaryKey = 'cat_id';
    protected $fillable = array(
        'cat_id', 'name','title', 'desc', 'h1', 'h2', 'seo_text',
    );

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function getSubCats()
    {
        return $this->hasManyThrough(RuSubCategory::class, SubCategory::class, 'cat_id', 'sub_cat_id', 'cat_id', 'id');
    }
}
