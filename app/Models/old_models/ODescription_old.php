<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    public $timestamps  = false;

    public function item()
    {
        return $this->belongsTo(Item::class, 'id');
    }
}