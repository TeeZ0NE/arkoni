<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuTag extends Model
{
    public  $timestamps = false;
    public $primaryKey = "tag_id";
    protected $visible = array('ru_name','title','description');
    protected $fillable = array('tag_id','ru_name','title','description');
}
