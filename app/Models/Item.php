<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = array(
        'price', 'old_price', 'item_photo', 'brand_id', 'enabled', 'item_url_slug',
    );

    /**
     * get item's brand
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * get item's RU lang
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getRuItem()
    {
        return $this->hasOne(RuItem::class, 'item_id', 'id')->select('item_id', 'ru_name as name', 'desc as description');
    }

    /**
     * get UK lang
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUkItem()
    {
        return $this->hasOne(UkItem::class, 'item_id')->select('item_id', 'uk_name as name', 'desc as description');
    }

    public function getItemAttributes()
    {
        return $this->hasMany(ItemAttribute::class, 'item_id');
    }

    public function getItemCategories()
    {
        return $this->hasMany(ItemCategory::class, 'item_id');
    }

    public function getSubCategories()
    {
        return $this->belongsToMany(SubCategory::class, 'item_categories', 'item_id', 'sub_cat_id');
    }

    /**
     * @param Integer $id SubCategory ID
     * @param Array $sort_config getting config 4 sorting
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getSubCategoryItems($id, $sort_config, $bs=Null)
    {
        $all_items = $this::with([$sort_config['method'], 'getSubCategories', 'brand', 'getItemShortCut', 'getItemTag', $sort_config['ti_method']])->
        where('enabled', 1)->
        whereHas('getSubCategories', function ($f) use ($id) {
            $f->where('id', $id);
        })->
//        whereIn('brand_id',[1,2])->
        select('id', 'item_photo', 'price', 'old_price', 'brand_id', 'item_url_slug')->
        get();
        //if has filter to brand do filter
        if($bs){
            $items = ($sort_config['order'])
                ? $all_items->whereIn('brand_id',$bs)->sortBy($sort_config['sortBy'])
                : $all_items->whereIn('brand_id',$bs)->sortByDesc($sort_config['sortBy']);
        }else{
            $items = ($sort_config['order'])
                ? $all_items->sortBy($sort_config['sortBy'])
                : $all_items->sortByDesc($sort_config['sortBy']);
        }
         //getting array with existing brands IDs
         $brand_ids = $all_items->pluck('brand_id');
        $data=array(
            'items'=>$items,
            'brand_ids'=>$brand_ids,
            );
        return $data;
    }

    /**
     * @param Integer $id SubCategory ID
     * @param Array $sort_config getting config 4 sorting
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTagItems($id, $sort_config, $bs=Null)
    {
        $all_items = $this::with([$sort_config['method'], 'getSubCategories', 'brand', 'getItemShortCut', 'getItemTag', $sort_config['ti_method']])->
        where('enabled', 1)->
        whereHas('getItemTag', function ($f) use ($id) {
            $f->where('id', $id);
        })->
//        whereIn('brand_id',[1,2])->
        select('id', 'item_photo', 'price', 'old_price', 'brand_id', 'item_url_slug')->
        get();
        //if has filter to brand do filter
        if($bs){
            $items = ($sort_config['order'])
                ? $all_items->whereIn('brand_id',$bs)->sortBy($sort_config['sortBy'])
                : $all_items->whereIn('brand_id',$bs)->sortByDesc($sort_config['sortBy']);
        }else{
            $items = ($sort_config['order'])
                ? $all_items->sortBy($sort_config['sortBy'])
                : $all_items->sortByDesc($sort_config['sortBy']);
        }
         //getting array with existing brands IDs
         $brand_ids = $all_items->pluck('brand_id');
        $data=array(
            'items'=>$items,
            'brand_ids'=>$brand_ids,
            );
        return $data;
    }

    /**
     * get 4 item shortcuts whitch it has and shortcutname
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getItemShortcut()
    {
        return $this->hasManyThrough(Shortcut::class, ItemShortcut::class, 'item_id', 'id', 'id', 'shortcut_id');
    }

    /**
     * get item tag ID and URL only
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getItemTag()
    {
        return $this->hasManyThrough(Tag::class, ItemTag::class, 'item_id', 'id', 'id', 'tag_id');
    }

    /**
     * getting RU lang tags
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getItemRuTag()
    {
        return $this->hasManyThrough(RuTag::class, ItemTag::class, 'item_id', 'tag_id', 'id', 'tag_id');
    }

    /**
     * getting UK lang tags
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getItemUkTag()
    {
        return $this->hasManyThrough(UkTag::class, ItemTag::class, 'item_id', 'tag_id', 'id', 'tag_id');
    }

    public function getItemRuTagName()
    {
        return $this->hasManyThrough(RuTag::class, ItemTag::class, 'item_id', 'tag_id', 'id', 'tag_id')->select('ru_name');
    }

    /**
     * search with methods or in methods which exist
     * @param String $column ru_name, name, etc
     * @param String $method brand, getUkItem, etc.
     * @param String or Int $q query to search
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search($column, $method, $q = Null)
    {
        //if sorting in child tables
        if ($method) {
            return Item::with(['brand', 'getRuItem', 'getUkItem', 'getItemRuTag'])->
            where('id', $q)
                ->orWhereHas($method, function ($f) use ($column, $q) {
                    $f->where($column, 'LIKE', '%' . $q . '%');
                })->get();
        } else {
            //sorting in parent table
            return Item::with(['brand', 'getRuItem', 'getUkItem', 'getItemRuTag'])->
            where('id', $q)->
            orWhere($column, 'LIKE', '%' . $q . '%')->
            get();
        }
    }

    /**
     * search with methods or in methods which exist
     * @param String $column ru_name, name, etc
     * @param String $method brand, getUkItem, etc.
     * @param String or Int $q query to search
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search4site(Array $s_config, $q = Null)
    {
        $column = $s_config['column'];
        //if sorting in child tables
        $all_items = $this::with(['brand', $s_config['method']])->
        whereHas($s_config['method'], function ($f) use ($q, $column) {
            $f->where($column, 'LIKE', '%' . $q . '%')->
            orWhere('desc', 'LIKE', '%' . $q . '%');
        })->
        orWhereHas('brand', function ($f) use ($q) {
            $f->where('name', 'LIKE', '%' . $q . '%');
        })->
        select('id', 'price', 'old_price', 'item_url_slug', 'item_photo', 'brand_id')->
        get();
        $items = ($s_config['order'])
            ? $all_items->sortBy($s_config['sortBy'])
            : $all_items->sortByDesc($s_config['sortBy']);
        return $items;
    }
    public function getItemSubCategoryId($item_id){
        return $this::with(['getItemCategories'])->find($item_id)->getItemCategories->first()->sub_cat_id;
    }

    /**
     * get item parent category
     * @param  integer $item_id item ID
     * @return Integer
     */
    public function getItemCategoryId($item_id){
        return $this::with('getSubCategories')->find($item_id)->getSubCategories->first()->cat_id;
    }
}
