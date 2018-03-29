<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    public $timestamps = false;
    protected $fillable = array('tag_url_slug');

    /**
     * getting only tag ID and lang
     * @return $this
     */
    public function getRuTagsName()
    {
        return $this->hasOne(RuTag::class, 'tag_id')->select(['ru_name', 'tag_id']);
    }

    /**
     * getting only tag ID and lang
     * @return $this
     */
    public function getUkTagsName()
    {
        return $this->hasOne(UkTag::class, 'tag_id')->select(['uk_name', 'tag_id']);
    }

    /**
     * get full info
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUkTag()
    {
        return $this->hasOne(UkTag::class, 'tag_id');
    }

    /**
     * get full info
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getRuTag()
    {
        return $this->hasOne(RuTag::class, 'tag_id');
    }

    public function searchAndSort($q = Null, $sort = 'asc')
    {
        return DB::table('tags as t')->
        select('ut.uk_name', 'rt.ru_name', 'id')->
        join('ru_tags as rt', 'rt.tag_id', '=', 't.id')->
        join('uk_tags as ut', 'ut.tag_id', '=', 't.id')->
        where('t.id', 'LIKE', '%' . $q . '%')->
        orWhere('rt.ru_name', 'LIKE', '%' . $q . '%')->
        orWhere('ut.uk_name', 'LIKE', '%' . $q . '%')->
        orderBy('rt.ru_name', $sort);

    }

    public function items(){
        return $this->belongsToMany(Item::class,'item_tags','item_id','tag_id');
    }
}
