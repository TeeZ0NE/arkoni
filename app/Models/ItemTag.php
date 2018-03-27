<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemTag extends Model
{
    public  $timestamps = false;

    public function getItem(){
        return $this->belongsTo(Item::class,'item_id');
    }

    public function getTag() {
        return $this->belongsTo(Tag::class,'tag_id');
    }

    public function getListOfTags($id){
        return $this::where('item_id',$id)->pluck('tag_id')->toArray();
    }
}
