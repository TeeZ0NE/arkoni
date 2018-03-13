<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    public $timestamps = false;
    protected $fillable =array(
        'item_id',
    );
    public function getCategories(){
        return $this->belongsTo(Item::class,'item_id','id');
    }
    public function getListOfCategories($id){
        return $this::where('item_id',$id)->pluck('sub_cat_id')->toArray();
    }
}
