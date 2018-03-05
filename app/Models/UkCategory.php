<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UkCategory extends Model
{
    public $timestamps = false;
    protected $fillable = array(
        'cat_id', 'title', 'desc', 'h1', 'h2', 'seo_text',
    );

    public function getCategory(){
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
