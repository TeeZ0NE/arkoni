<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $attributes =[
        'price'     => 0.00,
        'new_price' => 0.00,
        'photo'     => 'no_image.png'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
}
