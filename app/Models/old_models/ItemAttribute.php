<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemAttribute extends Model
{
    protected $fillable = array(
    'name',
    'value'
  );
    public $timestamps  = false;
    
/**
 * getting attridutes and it's name from Attribute class
 * @method attributes_and_names
 * @return Array         return array with values and names of attributes
 */
    public function attributes_and_names()
    {
        return $this->hasOne(Attribute::class,'id','attr_id');
    }

/**
 * Just taking attributes and own values without name
 * @method attributes
 * @return Array
 */
    public function attributes()
    {
        return $this->belongsTo(Item::class,'id');
    }
}
