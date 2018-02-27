<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
  protected $fillable = array(
    'name'
  );
  public $timestamps  = false;

  public function setNameAttribute($value)
  {
    return $this->attributes['name'] = mb_strtolower($value);
  }
}
