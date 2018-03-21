<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    protected $fillable = array(
        'price', 'new_price', 'item_photo', 'brand_id', 'enabled', 'item_url_slug',
    );

    /**
     * get item's brand
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * get item's RU lang
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getRuItem()
    {
        return $this->hasOne(RuItem::class, 'item_id', 'id');
    }

    /**
     * get UK lang
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUkItem()
    {
        return $this->hasOne(UkItem::class, 'item_id');
    }

    public function getItemAttributes()
    {
        return $this->hasMany(ItemAttribute::class, 'item_id');
    }

    public function getItemCategories()
    {
        return $this->hasMany(ItemCategory::class, 'item_id');
    }

    /**
     * get 4 item shortcuts whitch it has and shortcutname
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getItemShortcut(){
        return $this->hasManyThrough(Shortcut::class,ItemShortcut::class,'item_id','id','id','shortcut_id');
    }
    /**searchin and sorting items
     * sort by price, enabled, by brand, by RU name
     * @param null $q Query what we searchin
     * @param $sort asc or desc
     * @return array or null
     */
    public function searchAndSort($q = Null, $sort)
    {
        $asc_arr = array('asc_iname', 'asc_brand', 'asc_price', 'asc_enabled');
        $order = (in_array($sort, $asc_arr)) ? 'asc' : 'desc';
        switch ($sort) {
            case 'asc_iname':
            case 'desc_iname':
                $order_by = 'rui.ru_name';
                break;

            case 'asc_brand':
            case 'desc_brand':
                $order_by = 'b.name';
                break;

            case 'asc_price':
            case 'desc_price':
                $order_by = 'price';
                break;

            case 'asc_enabled':
            case 'desc_enabled':
                $order_by = 'enabled';
                break;
            default:
                $order_by = 'rui.ru_name';
                break;
        }

        return DB::table('items as i')->
        select('rui.ru_name', 'uki.uk_name', 'i.*', 'b.name as b_name', 'rui.desc')->
        join('brands as b', 'i.brand_id', '=', 'b.id')->
        join('ru_items as rui', 'rui.item_id', '=', 'i.id')->
        join('uk_items as uki', 'uki.item_id', '=', 'i.id')->
        where('i.id', '=', $q)->
        orWhere($order_by, 'LIKE', '%'.$q.'%')->
        orderBy($order_by, $order);
    }

    public function getAllItems(){
        return DB::table('items as i')->
        select('rui.ru_name', 'uki.uk_name', 'i.*', 'b.name as b_name', 'rui.desc')->
        join('brands as b', 'i.brand_id', '=', 'b.id')->
        join('ru_items as rui', 'rui.item_id', '=', 'i.id')->
        join('uk_items as uki', 'uki.item_id', '=', 'i.id')->
        orderBy('rui.ru_name', 'asc');
    }

/*
    public function search(Request $request)
    {
        $request->flash();
        $order = "asc";
        $order_by = "";
        $rsort = $request->sort;
        $q = $request->q;
        $count = $this->item::count();
        $asc_arr = array('asc_iname', 'asc_brand', 'asc_price', 'asc_enabled');
        $desc_arr = array('desc_iname', 'desc_brand', 'desc_price', 'desc_enabled');

        if (in_array($rsort, $asc_arr)) {
            $order = 'asc';
        }
        if (in_array($rsort, $desc_arr)) {
            $order = 'desc';
        }
        switch ($rsort) {
            case 'asc_iname':
            case 'desc_iname':
                $order_by = 'name';
                break;

            case 'asc_brand':
            case 'desc_brand':
                $order_by = 'brand';
                break;

            case 'asc_price':
            case 'desc_price':
                $order_by = 'price';
                break;

            case 'asc_enabled':
            case 'desc_enabled':
                $order_by = 'enabled';
                break;
            default:
                $order_by = 'name';
                break;
        }
        // empty search request
        if (empty($request->q)) {
            switch ($order_by) {
                case 'brand':
                    $brands = $this->brand::with(['items'])
                        ->orderBy('name', $order)
                        ->paginate($this->pag_count);
                    break;

                default:
                    $items = $this->item::with(['brand'])
                        ->orderBy($order_by, $order)
                        ->paginate($this->pag_count);
                    break;
            }
        } else {
            switch ($order_by) {
                case 'brand':
                    $brands = $this->brand::with(['items'])
                        ->where('name', 'LIKE', '%' . $q . '%')
                        ->orderBy('name', $order)
                        ->paginate($this->pag_count);
                    break;

                default:
                    $items = $this->item::with(['brand'])
                        ->where('name', 'LIKE', '%' . $q . '%')
                        ->orWhere('tags', 'LIKE', '%' . $q . '%')
                        ->orderBy($order_by, $order)
                        ->paginate($this->pag_count);
                    break;
            }
        }
        // returning view
        switch ($order_by) {
            case 'brand':
                return view('admin.pages.items')
                    ->with([
                        'brands' => $brands,
                        'count' => $count,
                        'sort' => $rsort
                    ]);
                break;

            default:
                return view('admin.pages.items')
                    ->with([
                        'items' => $items,
                        'count' => $count,
                        'sort' => $rsort
                    ]);
                break;
        }


    }*/
}
