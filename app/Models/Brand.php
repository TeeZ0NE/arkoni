<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps  = false;
    protected $fillable=array('name');

    public function items(){
        return $this->hasMany(Items::class, 'brand_id', 'brand_id');
    }
}
