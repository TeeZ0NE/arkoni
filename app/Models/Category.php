<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = array(
    'name',
    'url_slug',
    'parent_id'
  );
  public $timestamps  = false;

  public function setNameAttribute($value)
  {
    return $this->attributes['name'] = mb_strtolower($value);
  }

  /*public function sub_cat()
  {
    return $this->belongsTo(Category::class,'parent_id','id');
  }

  public function parent_cat()
  {
    return $this->hasMany(Category::class,'id','parent_id');
  }*/
/**
 * [parent_cat description]
 * @return [type] [description]
 */
  public function parent_cat()
  {
    return $this->belongsTo(ParentCategory::class,'parent_id');
  }
/**
 * get list of items in current category
 * @return Array [description]
 */
  public function items() 
  {
    return $this->hasManyThrough(Item::class,ItemCategory::class,
      'category_id','id','id','id');
  }

}
