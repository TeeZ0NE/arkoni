<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentCategory extends Model
{
    protected $fillable = array(
    'name',
    'url_slug',
  );
  public $timestamps  = false;

  public function sub_cat()
  {
    return $this->hasMany(Category::class,'parent_id');
  }
}
