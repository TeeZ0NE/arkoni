<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UkTag extends Model
{
    public $timestamps = false;
    public $primaryKey = "tag_id";
    protected $visible=array('uk_name','description','title');
    protected $fillable = array('tag_id','uk_name', 'description', 'title');
}
