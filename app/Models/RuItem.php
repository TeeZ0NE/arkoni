<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuItem extends Model
{
    protected $primaryKey = 'item_id';
    protected $fillable = array(
        'item_id', 'ru_name', 'desc',
    );
    public $timestamps = false;

    public function getRuNameAttribute()
    {
        return $this->attributes['name'];
    }

    public function getDescAttribute(){
        return $this->attributes['desart'];
    }
    public function getItem(){
        return $this->belongsTo(Item::class, 'item_id');
    }
}
