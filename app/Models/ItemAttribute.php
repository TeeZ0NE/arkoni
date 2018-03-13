<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemAttribute extends Model
{
    public $timestamps = false;
    protected $fillable = array(
        'item_id',
    );
    public function attributesLang(){
        return $this->belongsTo(Attribute::class, 'attr_id');
    }
    public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }
}
