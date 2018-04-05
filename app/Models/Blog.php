<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = array('title','url_slug','body','published','photo');
    public function getBlogs2AdminIndex(){
        return $this->select('id','title','published','created_at','updated_at','views','photo');
    }

    public function search($q){
        return $this::where('id',$q)->
            orWhere('title','LIKE','%'.$q.'%')->
            orWhere('body','LIKE','%'.$q.'%')->
            select('id','title','published','created_at','updated_at','views','photo');
    }
}
