<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = array(
        'cat_url_slug', 'cat_photo'
    );

    public function RuCategory()
    {
        return $this->hasOne(RuCategory::class, 'cat_id');
    }

    public function UkCategory()
    {
        return $this->hasOne(UkCategory::class, 'cat_id');
    }

    public function RuCategoryJustName()
    {
        return $this->hasOne(RuCategory::class, 'cat_id')->select('cat_id', 'ru_name as name');
    }

    public function UkCategoryJustName()
    {
        return $this->hasOne(UkCategory::class, 'cat_id')->select('cat_id','uk_name as name');
    }
    /**
     * getting just name and ID of categories
     * Default returnin' without search and sort by name RU
     * @param String $q what we searching
     * @param string $sort sorting
     * @return Array
     */
    public function searchAndSort($q = Null, $sort = 'asc')
    {
        return DB::table('categories')->
        select('uk_categories.uk_name', 'ru_categories.ru_name', 'id', 'cat_photo')->
        join('uk_categories', 'uk_categories.cat_id', '=', 'categories.id')->
        join('ru_categories', 'ru_categories.cat_id', '=', 'categories.id')->
        where('categories.id', 'LIKE', '%' . $q . '%')->
        orWhere('uk_categories.uk_name', 'LIKE', '%' . $q . '%')->
        orWhere('ru_categories.ru_name', 'LIKE', '%' . $q . '%')->
        orderBy('ru_categories.ru_name', $sort)->
        get();
    }

    public function getSubcategoriesUrlSlug(){
        return $this->hasMany(SubCategory::class,'cat_id')->select('cat_id','sub_cat_url_slug as slug');
    }

    public function getRuSubCategories(){
        return $this->hasManyThrough(RuSubCategory::class, SubCategory::class, 'cat_id', 'sub_cat_id', 'id', 'id')->select('ru_name as name', 'sub_cat_url');
    }
    /** getting URL of categories their names and own URL sub-categories with names
     * @return Array
     */
    /*
    public function getNamesAndUrlSubCats4Menu()
    {
        return DB::table('categories as c')->
        select('c.cat_url_slug', 'cu.uk_name as catUk', 'sc.sub_cat_url_slug', 'scu.uk_name')->
        join('uk_categories as cu', 'cu.cat_id', '=', 'c.id')->
        join('sub_categories as sc', 'sc.cat_id', '=', 'c.id')->
        join('uk_sub_categories as scu', 'scu.sub_cat_id', '=', 'sc.id')->
        get();
    }*/
}
