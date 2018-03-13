<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = array(
        'price', 'new_price', 'item_photo', 'brand_id', 'enabled', 'item_url_slug',
    );

    public  function brand(){
        return $this->belongsTo(Brand::class, 'brand_id');
    }
}
