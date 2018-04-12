<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Models\Item;
use App;
use App\Http\Controllers\Site\BaseController;
use App\Http\Controllers\Site\StarsController;

/** Retriev and return searching data into view
 * Class SearchEngineController
 * @package App\Http\Controllers
 */
class SearchEngineController extends BaseController
{
    /**
     * String App locale
     */
    private $locale;
    /**
     * @var int  Page count in Pagination
     */
    private $page_count = 6;

    public function __construct()
    {
        parent::__construct();
        $this->locale = mb_strtolower(App::getLocale());
    }

    public function __invoke(Request $request)
    {
        $q = $request->q;
        $sort = ($request->sort) ? $request->sort : 'asc_iname';
        // model
        $item_model = new Item();
        //search and sort config
        $s_config = $this->searchConfig($sort);
        $this->data['items'] = $item_model->search4site($s_config, $q)->paginate($this->page_count);

        return view('site.search.index')->with([
            'q' => $q,
            'class' => 'search',
            'data' => $this->data, //searched items
            'method' => $s_config['method'],
            'title' => __('seo.search-title'),
            'description' => __('seo.search-description'),
            'rating' => $this->stars->index($request),
            'sort' => $sort,
        ]);
    }

    /**getting existing methods from Item model
     * Relationships
     * @return String method
     */
    private function getMethod()
    {
        $methods = array('getRuItem', 'getUkItem');
        switch ($this->locale) {
            case  'uk':
                return $methods[1];
                break;
            default:
                return $methods[0];
        }
    }

    /**
     * getting column which exist in DB
     * @return String column name
     */
    private function getColumn()
    {
        $columns = array('ru_name', 'uk_name');
        switch ($this->locale) {
            case 'uk':
                return $columns[1];
                break;
            default:
                return $columns[0];
        }
    }

    /**
     * creating searchin and sorting config
     * @param String $sort
     * @return array
     */
    private function searchConfig($sort)
    {
        $asc_arr = array('asc_iname', 'asc_brand', 'asc_price');
        $order = (in_array($sort, $asc_arr)) ? 1 : 0;
        $column = $this->getColumn();
        $method = $this->getMethod();
        switch ($sort) {
            case 'asc_iname':
            case 'desc_iname':
                $orderBy = ([
                    'order' => $order,
                    'sortBy' => $method . ".name",
                    'column' => $column,
                    'method' => $method,
                ]);
                break;
            case 'asc_brand':
            case 'desc_brand':
                $orderBy = ([
                    'order' => $order,
                    'sortBy' => "brand.name",
                    'column' => $column,
                    'method' => $method,
                ]);
                break;
            case 'asc_price':
            case 'desc_price':
                $orderBy = ([
                    'sortBy' => 'price',
                    'order' => $order,
                    'column' => $column,
                    'method' => $method,
                ]);
                break;
            default:
                $orderBy = ([
                    'sortBy' => $method . ".$column",
                    'order' => $order,
                    'column' => $column,
                    'method' => $method,
                ]);
                break;
        }
        return $orderBy;
    }
}
