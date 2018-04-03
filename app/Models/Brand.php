<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps  = false;
    protected $fillable=array('name');

    public function items(){
        return $this->hasMany(Item::class, 'brand_id', 'id');
    }

    public function getSubCategoryBrands($brand_ids){
        return $this::whereIn('id', $brand_ids)->get();
    }
}
