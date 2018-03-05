<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\CustomCollection;

class Item extends Model
{
    protected $attributes =[
        'price'     => 0.00,
        'new_price' => 0.00,
        'photo'     => 'no_image.png'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function categories()
    {
        return $this->hasManyThrough(Category::class, ItemCategory::class,
            'id','id','id','category_id');
    }

    public function description()
    {
        return $this->hasOne(Description::class,'id');
    }

    public function attributes_name()
    {
        return $this->hasManyThrough(Attribute2::class, ItemAttribute::class,
            'id','id','id','attr_id');
    }

    public function attributes()
    {
        return $this->hasMany(ItemAttribute::class,'id');
    }

}
