<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UkItem extends Model
{
    protected $primaryKey = "item_id";
    protected $fillable = array(
        'item_id', 'uk_name', 'desc',
    );
    public $timestamps = false;
}
