<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemShortcut extends Model
{
    public $timestamps = false;

    /**
     * getting item shorcuts with name
     * @return Array
     */

    public function getShortcut()
    {
        return $this->belongsTo(Shortcut::class, 'shortcut_id');
    }

    /**
     * get shortcuts 4 current item
     * @param Int $id item ID
     * @return Array ofshortcuts
     */
    public function getListOfShortcuts($id)
    {
        return $this::where('item_id', $id)->pluck('shortcut_id')->toArray();
    }
}
