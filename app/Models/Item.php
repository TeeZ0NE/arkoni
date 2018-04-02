<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    protected $fillable = array(
        'price', 'old_price', 'item_photo', 'brand_id', 'enabled', 'item_url_slug',
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
        return $this->hasOne(RuItem::class, 'item_id', 'id')->select('item_id', 'ru_name as name', 'desc as description');
    }

    /**
     * get UK lang
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getUkItem()
    {
        return $this->hasOne(UkItem::class, 'item_id')->select('item_id', 'uk_name as name', 'desc as description');
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
    public function getItemShortcut()
    {
        return $this->hasManyThrough(Shortcut::class, ItemShortcut::class, 'item_id', 'id', 'id', 'shortcut_id');
    }

    /**
     * get item tag ID and URL only
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getItemTag()
    {
        return $this->hasManyThrough(Tag::class, ItemTag::class, 'item_id', 'id', 'id', 'tag_id');
    }

    /**
     * getting RU lang tags
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getItemRuTag()
    {
        return $this->hasManyThrough(RuTag::class, ItemTag::class, 'item_id', 'tag_id', 'id', 'tag_id');
    }

    /**
     * getting UK lang tags
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function getItemUkTag()
    {
        return $this->hasManyThrough(UkTag::class, ItemTag::class, 'item_id', 'tag_id', 'id', 'tag_id');
    }

    public function getItemRuTagName()
    {
        return $this->hasManyThrough(RuTag::class, ItemTag::class, 'item_id', 'tag_id', 'id', 'tag_id')->
        select('item_id', 'ru_name');
    }

    /**
     * search with methods or in methods which exist
     * @param String $column ru_name, name, etc
     * @param String $method brand, getUkItem, etc.
     * @param String or Int $q query to search
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search($column, $method, $q = Null)
    {
        //if sorting in child tables
        if ($method) {
            return Item::with(['brand', 'getRuItem', 'getUkItem', 'getItemRuTag'])->
            where('id', $q)
                ->orWhereHas($method, function ($f) use ($column, $q) {
                    $f->where($column, 'LIKE', '%' . $q . '%');
                })->get();
        } else {
            //sorting in parent table
            return Item::with(['brand', 'getRuItem', 'getUkItem', 'getItemRuTag'])->
            where('id', $q)->
            orWhere($column, 'LIKE', '%' . $q . '%')->
            get();
        }
    }

    /**
     * search with methods or in methods which exist
     * @param String $column ru_name, name, etc
     * @param String $method brand, getUkItem, etc.
     * @param String or Int $q query to search
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search4site(Array $s_config, $q = Null)
    {
        $column = $s_config['column'];
        //if sorting in child tables
        $all_items =  $this::with(['brand', $s_config['method']])->
        whereHas($s_config['method'], function ($f) use ($q, $column) {
            $f->where($column, 'LIKE', '%' . $q . '%')->
            orWhere('desc', 'LIKE', '%' . $q . '%');
        })->
        orWhereHas('brand', function ($f) use ($q) {
            $f->where('name', 'LIKE', '%' . $q . '%');
        })->
        select('id', 'price', 'old_price', 'item_url_slug', 'item_photo', 'brand_id')->
        get();
            $items = ($s_config['order'])
            ? $all_items->sortBy($s_config['sortBy'])
            : $all_items->sortByDesc($s_config['sortBy']);
            return $items;
    }
    /* NOT USING
        /**searchin and sorting items
         * sort by price, enabled, by brand, by RU name
         * @param null $q Query what we searchin
         * @param $sort asc or desc
         * @return array or null
         */
//TODO:: delete this method in future
    /*
        public function searchAndSort_old($sort, $q = Null)
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
            orWhere($order_by, 'LIKE', '%' . $q . '%')->
            orderBy($order_by, $order);
        }

        //TODO: eldest. Delete?
        public function getAllItems()
        {
            return DB::table('items as i')->
            select('rui.ru_name', 'uki.uk_name', 'i.*', 'b.name as b_name', 'rui.desc')->
            join('brands as b', 'i.brand_id', '=', 'b.id')->
            join('ru_items as rui', 'rui.item_id', '=', 'i.id')->
            join('uk_items as uki', 'uki.item_id', '=', 'i.id')->
            orderBy('rui.ru_name', 'asc');
        }

        private function orderBy($sort)
        {
            $orderBy = array(
                'method' => Null,
                'column' => Null,
                'sortBy' => Null,
                'order' => Null,
            );
            $asc_arr = array('asc_iname', 'asc_brand', 'asc_price', 'asc_enabled');
            $methods = array('brand', 'getRuItem');
            $columns = array('name', 'ru_name');
            $order = (in_array($sort, $asc_arr)) ? 0 : 1;
            switch ($sort) {
                case 'asc_iname':
                case 'desc_iname':
                    return $orderBy([
                        'method' => $methods[1],
                        'sortBy' => $methods[1] . ".$columns[1]",
                        'order' => $order,
                        'column' => $columns[1]
                    ]);
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
        }
    */

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
