<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $fillable = array(
    'name',
    'url_slug'
  );
  public $timestamps  = false;

  public function items(){
    return $this->hasMany(Item::class,'brand_id');
  }
}