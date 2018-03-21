<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SubCategory extends Model
{
    protected $fillable = array(
        'cat_id', 'sub_cat_url_slug', 'sub_cat_photo'
    );
    public $timestamps = false;

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function RuSubCategory()
    {
        return $this->hasOne(RuSubCategory::class, 'sub_cat_id', 'id');
    }

    public function UkSubCategory()
    {
        return $this->hasOne(UkSubCategory::class, 'sub_cat_id', 'id');
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
        return DB::table('sub_categories as sc')->
        select('uc.uk_name as c_uk_name', 'rc.ru_name as c_ru_name', 'sc.id', 'usc.uk_name', 'rsc.ru_name', 'sub_cat_photo')->
        join('ru_categories as rc', 'rc.cat_id', '=', 'sc.cat_id')->
        join('uk_categories as uc', 'uc.cat_id', '=', 'sc.cat_id')->
        join('uk_sub_categories as usc', 'usc.sub_cat_id', '=', 'sc.id')->
        join('ru_sub_categories as rsc', 'rsc.sub_cat_id', '=', 'sc.id')->
        where('sc.id', 'LIKE', '%' . $q . '%')->
        orWhere('usc.uk_name', 'LIKE', '%' . $q . '%')->
        orWhere('rsc.ru_name', 'LIKE', '%' . $q . '%')->
        orderBy('rsc.ru_name', $sort);
    }

    /**
     * getting 4 select option RU ID and names
     * @return Array of ID and RU names
     */
    public function getRuCategories()
    {
        return RuCategory::get(['cat_id', 'ru_name']);
    }

    /**
     * gettin' just ID and RU names when creatin' new Item
     * @return Object with ru_name and id
     */
    public function getRuSubCategoryIdAndName()
    {
        return DB::table('ru_sub_categories as rsc')->
        select('rsc.ru_name', 'sc.id', 'rc.ru_name as cat_name')->
        join('sub_categories AS sc', 'rsc.sub_cat_id', '=', 'sc.id')->
        join('ru_categories AS rc', 'rc.cat_id', '=', 'sc.cat_id')->
        orderBy('rsc.ru_name')->
        get();
    }
}

