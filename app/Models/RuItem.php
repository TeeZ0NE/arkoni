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
}
