<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shortcut extends Model
{
    public $timestamps=false;

    /**
     * getting all ID's of Shortcuts
     * @return mixed
     */
    public function getShortcutIds(){
        return $this::get(['id'])->pluck('id')->toArray();
    }
}
