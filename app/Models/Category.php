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

    public function RuCategory()
    {
        return $this->hasOne(RuCategory::class, 'cat_id');
    }

    public function UkCategory()
    {
        return $this->hasOne(UkCategory::class, 'cat_id');
    }

    /**
     * getting just name and ID of categories
     * Default returnin' without search and sort by name RU
     * @param String $q what we searching
     * @param string $sort sorting
     * @return Array
     */
    public function getNameAndId($q = Null, $sort = 'asc')
    {
        return DB::table('categories')
            ->select('uk_categories.name as uk_name', 'ru_categories.name as ru_name', 'id')
            ->join('uk_categories', 'uk_categories.cat_id', '=', 'categories.id')
            ->join('ru_categories', 'ru_categories.cat_id', '=', 'categories.id')
            ->where('uk_categories.name', 'LIKE', '%' . $q . '%')
            ->orWhere('ru_categories.name', 'LIKE', '%' . $q . '%')
            ->orderBy('ru_categories.name', $sort)
            ->get();
    }
}
