<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use \View;
use \App;
use \Config;
use \Session;
use \Lang;
use \Response;
use \Redirect;
use \URL;
use \Auth;
use \Cookie;
use \Demos\AdminPanel\Unit;
use \Demos\AdminPanel\Cat;
use \Demos\Market\MarketCat;
use \Demos\Market\Good;
use \Demos\Market\Order;
use \Demos\Market\MarketChar;
use \Demos\Market\MarketCharVal;
use \Demos\Market\Brand;
use \Demos\Market\BrandSeries;



class ShopController extends Controller
{
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Good $good) {
        $this->request = $request;
        $this->good = $good;
    }

    public function showCat($alias="catalog") {
        $cat = MarketCat::where('alias', '=', $alias)->with([
            'lang',
            'rel_goods',
            'children' => function ($query){
                $query->with([
                        'lang',
                        'children' => function ($query){
                            $query->with('lang')->where('is_hidden',0)->orderBy('sort_order','asc');
                        }
                    ])->where('is_hidden',0)->orderBy('sort_order','asc');
            }])->first();
        if ($cat) {
            $cat_id = $cat->id;
            if (isset($cat) && Auth::guard('admin_account')->check()) {
                View::share('admin_edit_link', route('admin.market.categories', ['cat_id' => $cat->id]));
            }
            $cats = MarketCat::ancestors($cat->id);
            $breadcrumbs = MarketCat::with('lang')->whereIn('id', $cats)
                ->where('alias', '!=', 'html')
                ->where('is_hidden_bc',0)
                ->orderBy('sort_order', 'asc')
                ->get();
            $active_class = [];
            if($breadcrumbs->count()){
                foreach ($breadcrumbs as $crumb) {
                    $active_class[] = $crumb->alias;
                    $crumb->alias = build_cat_route($crumb->alias);
                }
            }
            if($this->request->has('type') && $this->request->get('type') == 'sale'){
                View::share('page_title',Lang::get('main.sale_page'));
            } else {
                View::share('page_title',$cat->lang->name);
            }
            $descendants = array_merge(MarketCat::descendants($cat->id), [$cat->id]);
            $ancestors = array_merge(MarketCat::ancestors($cat->id), [$cat->id]);

            // if ($cat->children->count() && !$this->request->has('type')) {

            //     return View::make('pages.catalog.cats_list', [
            //         'breadcrumbs' => $breadcrumbs,
            //         'cat' => $cat,
            //         'brands' => $brands,
            //         'meta_type' => 'cat_good',
            //     ]);
            // } else {
            if($cat->id == 2) {

            } else {
                $rel_ids = $cat->rel_goods->pluck('id')->toArray();
                $all_categories_ids = array_merge(MarketCat::where('parent_id',$cat->id)->pluck('id')->toArray(), [$cat->id]);
                $categories = MarketCat::with('lang')->whereIn('id',$all_categories_ids)->where('is_hidden',0)->orderBy('sort_order','asc')->get();

                

                if($cat->children->count()){
                    foreach($cat->children as $child) {
                        $child->goods = $this->good
                            ->where('is_archive', '=', '0')
                            ->where('market_goods.is_hidden', '=', '0')
                            ->where('cat_id', $child->id)
                            ->CatSorting($child->id)->get();
                    }
                } else {
                    $query = $this->good
                    ->where('is_archive', '=', '0')
                    ->where('market_goods.is_hidden', '=', '0')
                    ->where(function($query) use($descendants, $rel_ids) {
                        $query->whereIn('cat_id', $descendants)->orWhereIn('id', $rel_ids);
                    });

                    if(!$this->request->has('sort') || ($this->request->has('sort') && $this->request->get('sort') == 'default') || ($this->request->has('sort') && $this->request->get('sort') == null)){
                        $query->CatSorting($cat->id);
                    }

                    $cat->goods = $query->get();
                    if($cat->goods->count()){
                        foreach($cat->goods as &$good){
                            $good->load_gift_goods($good,3);
                            get_action_flag($good);
                        }
                    }
                }

            }

                return View::make('pages.catalog.goods_list', [
                    'breadcrumbs' => $breadcrumbs,
                    'categories' => isset($categories) ? $categories : new \Illuminate\Database\Eloquent\Collection,
                    'cat' => $cat,
                    'meta_type' => 'cat_good',
                ]);
            // }


        } else {
            return Redirect::to('404');
        }


    }

    public function showGood($alias) {
        $take_for_load_leads = 3;
        $good = Good::where('alias', '=', $alias)->with([
            'lang',
            'brand',
            "brand_series" => function ($query) use($alias){
                $query->with([
                        'lang',
                        'goods' => function ($query) use($alias){
                            $query->with('lang')->where('is_hidden',0)->where('is_archive',0)->where('alias','!=',$alias)->orderByRaw('RAND()')->limit(15)->get();
                        }
                    ]);
            },
            'videos' => function ($query) {
                $query->where('is_hidden',0);
            },
            'rel_units' => function ($query) {
                $query->with('lang')->where('is_hidden',0);
            },
            "leads" => function ($query) use ($take_for_load_leads) {
                $query->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc');
            }
        ])->first();

        if($good){
            $lead_count = $good->leads()->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc')->count();
            $good->lead_rating = $good->leads()->where('is_hidden',0)->where('parent_id',null)->avg('rating');
            if (isset($good) && Auth::guard('admin_account')->check()) {
                View::share('admin_edit_link', route('admin.market.editGood', ['good_id' => $good->id]));
            }
            $good->action_prices = \Demos\Market\MarketPrice::where('good_id',$good->id)->whereHas('type', function($query){
                $query->where('is_action', 1);
            })->whereRaw('date_start < NOW() AND date_end > NOW()')->first();
            $cats = array_merge(MarketCat::ancestors($good->category->id),[$good->category->id]);
            $breadcrumbs = MarketCat::with('lang')->whereIn('id', $cats)
                ->where('alias', '!=', 'html')
                ->where('is_hidden_bc',0)
                ->orderBy('sort_order', 'asc')
                ->get();
            $active_class = [];
            if($breadcrumbs->count()){
                foreach ($breadcrumbs as $crumb) {
                    $active_class[] = $crumb->alias;
                    $crumb->alias = build_cat_route($crumb->alias);
                }
            }
            $good->group_chars = MarketCat::with(['chars_groups' => function($query) {
                $query->orderBy('market_chars_groups_categories.sort_order', 'asc');
            },
            'chars' => function($query){
                $query->orderBy('market_chars_categories.sort_order', 'asc');
            }])->whereIn('id',[$good->category->id])->get();
            $goods_by_cat = Good::with('lang')->where('id', '!=', $good->id)->where('cat_id', $good->category->id)->where('is_archive',0)->where('is_hidden',0)->get();
            $rel_types = \Demos\Market\MarketRelType::get();

            $viewed_goods = Cookie::get('viewed_goods');
            $viewed_goods = json_decode($viewed_goods, true);
            $month = 2592000; //1 месяц в секундах
            if ($viewed_goods) {
                foreach ($viewed_goods as $viewed_good => $date) {
                    if ((strtotime('NOW') - strtotime($date)) > $month) {
                    unset($viewed_goods[$viewed_good]);
                    }
                }
            }
            $viewed_goods[$good->id] = date('Y-m-d H:i:s');
            asort($viewed_goods);
            $viewed_goods =  array_reverse($viewed_goods, TRUE);
            $viewed_goods = array_slice($viewed_goods, 0, 16, TRUE);
            $viewed_goods = json_encode($viewed_goods);
            Cookie::queue("viewed_goods", $viewed_goods, $month);

            View::share('page_title',$good->lang->name);

            $good->load_gift_goods($good,3);
            get_action_flag($good);

            $spoilers_info = Unit::with('lang')->whereHas('category', function($query) {
                $query->where('cat_id', 10);
            })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('sort_order','desc')->get();


            return View::make('pages.catalog.good', [
                'breadcrumbs' => $breadcrumbs,
                'good' => $good,
                "lead_count"=> $lead_count,
                "take_for_load_leads"=> $take_for_load_leads,
                'spoilers_info' => $spoilers_info,
                'active_class' => $active_class,
                'goods_by_cat' => $goods_by_cat,
                'rel_types' => $rel_types,
                'meta_type' => 'good',
            ]);
        } else {
            return Redirect::to('404');
        }
    }

    public function getOrder () {
        $delivery = \Demos\Market\Delivery::where('is_used',1)->get();
        $payment = \Demos\Market\Payment::where('is_used',1)->get();

        View::share('page_title',Lang::get('main.order.title'));

        return View::make('pages.catalog.cart_ordering', [
            "delivery" => $delivery,
            "payment" => $payment,
        ]);

    }

    public function getCart () {
        // $delivery = \Demos\Market\Delivery::where('is_used',1)->get();
        // $payment = \Demos\Market\Payment::where('is_used',1)->get();

        View::share('page_title',Lang::get('main.order.cart_title'));

        return View::make('pages.catalog.cart', [

        ]);

    }

    public function showBrands () {
        $brands = Brand::with([
                'lang'
            ])->where('is_hidden',0)->get();

        $sorting = app('market_params')->brands_sort_order;
        switch ($sorting) {
            case 'name':
                $brands = $brands->sortBy('lang.name');
                break;

            default:
                $brands = $brands->sortBy('sort_order');
                break;
        }
        $all_brands = [];
        foreach ($brands as $brand) {
            $all_brands[mb_substr(trim($brand->lang->name), 0, 1, 'utf-8')][] = $brand;
        }

        View::share('page_title',Lang::get('main.brand'));

        return View::make('pages.catalog.brands_list', [
            'brands' => $brands,
            'all_brands' => $all_brands,
        ]);
    }

    public function showBrand ($alias) {
        $brand = Brand::with([
                'lang',
                "series" => function ($query) {
                    $query->where('is_hidden',0)->orderBy('sort_order',"desc");
                },
                'videos' => function ($query) {
                    $query->with('lang')->where('is_hidden',0);
                }
            ])->where('alias',$alias)->first();

        if($brand){
            if (isset($brand) && Auth::guard('admin_account')->check()) {
                View::share('admin_edit_link', route('admin.market.brands', ['brand_id' => $brand->id]));
            }
            $breadcrumbs=[];
            $crumb = array(
                'name'  => Lang::get('main.brand'),
                'alias' => 'brands',
            );
            $breadcrumbs[] = $crumb;
            $query = $this->good
                    ->with('lang', 'price','category.lang')
                    ->where('is_archive', '=', '0')
                    ->where('market_goods.is_hidden', '=', '0')
                    ->where('brand_id', $brand->id);
            $active_filters =[];
            $query_count = clone $query;
            $count_goods = $query_count->count();
            //  price start filter
            $query_price_goods = clone $query;
            $prices_collect = $query_price_goods->where(function($query) {
                $query->whereHas('price', function($query) {
                    $query->join('market_currs as curr', 'curr.id', '=', 'curr_id')->whereRaw("value * curr.rate");
                });
            })->get();

            $price_filter['min'] = '';
            $price_filter['max'] = '';
            if($prices_collect->count()){
                foreach($prices_collect as $tmp_price){
                    if ($tmp_price->c_action_price && $tmp_price->c_action_price != 0 && $tmp_price->c_action_price < $tmp_price->c_price){
                        $tmp_price->c_filter_price = $tmp_price->c_action_price;
                    } else {
                        $tmp_price->c_filter_price = $tmp_price->c_price;
                    }
                }
                $price_filter['min'] = $prices_collect->min('c_filter_price');
                $price_filter['max'] = $prices_collect->max('c_filter_price');
            }

            $_filter_prices = $this->request->get('prices_filt', []);
            if (!empty($_filter_prices)) {

                if ($_filter_prices['min'] == ''){
                    $_filter_prices['min'] = 0;
                }
                if ($_filter_prices['max'] == ''){
                    $_filter_prices['max'] = $prices_collect->max('c_filter_price');
                }

                $active_filters['price_min'] = $_filter_prices['min'];
                $active_filters['price_max'] = $_filter_prices['max'];

                $query->where(function($query) use ($_filter_prices) {
                    if ($_filter_prices['min'] OR $_filter_prices['max']) {
                        $query->whereHas('price', function($query) use ($_filter_prices) {
                            $query->join('market_currs as curr', 'curr.id', '=', 'curr_id')
                            ->whereRaw("value * curr.rate between ".($_filter_prices['min'] -0.01)." and ".($_filter_prices['max'] +0.01 ))
                            ->whereHas('type', function ($query) {
                                $query->where(function ($query) {
                                    $query->where(function($query) {
                                        $query
                                        ->where(function($query) {
                                        $query
                                            ->whereRaw("date_start IS NOT NULL AND date_end IS NOT NULL")
                                            ->where('date_start', '<', \DB::raw('NOW()'))
                                            ->where('date_end', '>', \DB::raw('NOW()'));
                                        })
                                        ->orWhereRaw("date_start IS NULL AND date_end IS NULL");
                                    });
                                    $query->where('is_action',1);
                                })->orWhere('is_main',1);
                            });
                        });
                    }
                });
            }

            if($this->request->has('sort')){
                $sort = $this->request->get('sort');
                switch ($sort) {
                    case 'price_asc':
                        $query->selectRaw('market_goods.*')
                            ->join('market_prices as mp', 'mp.good_id', '=', 'market_goods.id')
                            ->join('market_currs as mcurr', 'mp.curr_id', '=', 'mcurr.id')
                            ->where('mp.value', '!=', 0)
                            ->groupBy('market_goods.id')
                            ->orderByRaw("if (mp.value='' OR mp.value is null,0,1) DESC")
                            ->orderByRaw('(mp.value * mcurr.rate) asc');
                    break;
                    case 'price_desc':
                        $query->selectRaw('market_goods.*')
                            ->join('market_prices as mp', 'mp.good_id', '=', 'market_goods.id')
                            ->join('market_currs as mcurr', 'mp.curr_id', '=', 'mcurr.id')
                            ->where('mp.value', '!=', 0)
                            ->groupBy('market_goods.id')
                            ->orderByRaw("if (mp.value='' OR mp.value is null,0,1) DESC")
                            ->orderByRaw('(mp.value * mcurr.rate) desc');
                    break;

                    case 'remains':
                        $query->where('remains','>','0');
                    break;
                    case 'new_asc':
                        $query->orderBy('is_new','desc');
                    break;
                    case 'top_asc':
                        $query->orderBy('is_top','desc');
                    break;
                }
            }
            $cat_ids = $query->distinct()->pluck('cat_id');
            $categories = MarketCat::with('lang')->where('is_hidden',0)->whereIn('id',$cat_ids)->orderBy('sort_order','asc')->get();
            foreach($categories as $cat_item){
                $cat_item->params_count = Good::where('cat_id',$cat_item->id)->where('brand_id',$brand->id)->where('is_hidden',0)->where('is_archive',0)->count();
            }
            $query_count_with_options = clone $query;
            $count_good_with_options = $query_count_with_options->count();
            $take_count = 3;
            $brand->goods =  $query->take($take_count)->get();
            if($brand->goods->count()){
                foreach($brand->goods as &$good){
                    $good->load_gift_goods($good,3);
                    get_action_flag($good);
                }
            }
            View::share('page_title',$brand->lang->name);
            return View::make('pages.catalog.brand_page', [
                'brand' => $brand,
                'categories' => $categories,
                'count_good_with_options' => $count_good_with_options,
                "count_goods" => $count_goods,
                "active_filters" => $active_filters,
                'take_count' => $take_count,
                'breadcrumbs' => $breadcrumbs,
                'price_filter' => $price_filter,
                'meta_type' => 'brand'
            ]);
        } else {
            return Redirect::to('404');
        }
    }

    public function showSeries ($slug,$alias) {
        $series = BrandSeries::with([
                'lang',
                "brand",
                'videos' => function ($query) {
                    $query->with('lang')->where('is_hidden',0);
                }
            ])->where('alias',$alias)->first();

        if($series){
            if (isset($series) && Auth::guard('admin_account')->check()) {
                View::share('admin_edit_link', route('admin.market.editBrandSeries', ['id' => $series->id]));
            }
            $breadcrumbs=[];
            $crumb = array(
                'name'  => Lang::get('main.brand'),
                'alias' => 'brands',
            );
            $breadcrumbs[] = $crumb;
            $crumb = array(
                'name'  => $series->brand->lang->name,
                'alias' => build_brand_link($series->brand->alias),
            );
            $breadcrumbs[] = $crumb;
            $active_filters = [];
            $query = $this->good
                    ->with('lang', 'price','category.lang')
                    ->where('is_archive', '=', '0')
                    ->where('market_goods.is_hidden', '=', '0')
                    ->where('brand_series_id', $series->id);

            $query_count = clone $query;
            $count_goods = $query_count->count();
            //  price start filter
            $query_price_goods = clone $query;
            $prices_collect = $query_price_goods->where(function($query) {
                $query->whereHas('price', function($query) {
                    $query->join('market_currs as curr', 'curr.id', '=', 'curr_id')->whereRaw("value * curr.rate");
                });
            })->get();

            $price_filter['min'] = '';
            $price_filter['max'] = '';
            if($prices_collect->count()){
                foreach($prices_collect as $tmp_price){
                    if ($tmp_price->c_action_price && $tmp_price->c_action_price != 0 && $tmp_price->c_action_price < $tmp_price->c_price){
                        $tmp_price->c_filter_price = $tmp_price->c_action_price;
                    } else {
                        $tmp_price->c_filter_price = $tmp_price->c_price;
                    }
                }
                $price_filter['min'] = $prices_collect->min('c_filter_price');
                $price_filter['max'] = $prices_collect->max('c_filter_price');
            }

            $_filter_prices = $this->request->get('prices_filt', []);
            if (!empty($_filter_prices)) {

                if ($_filter_prices['min'] == ''){
                    $_filter_prices['min'] = 0;
                }
                if ($_filter_prices['max'] == ''){
                    $_filter_prices['max'] = $prices_collect->max('c_filter_price');
                }

                $active_filters['price_min'] = $_filter_prices['min'];
                $active_filters['price_max'] = $_filter_prices['max'];

                $query->where(function($query) use ($_filter_prices) {
                    if ($_filter_prices['min'] OR $_filter_prices['max']) {
                        $query->whereHas('price', function($query) use ($_filter_prices) {
                            $query->join('market_currs as curr', 'curr.id', '=', 'curr_id')
                            ->whereRaw("value * curr.rate between ".($_filter_prices['min'] -0.01)." and ".($_filter_prices['max'] +0.01 ))
                            ->whereHas('type', function ($query) {
                                $query->where(function ($query) {
                                    $query->where(function($query) {
                                        $query
                                        ->where(function($query) {
                                        $query
                                            ->whereRaw("date_start IS NOT NULL AND date_end IS NOT NULL")
                                            ->where('date_start', '<', \DB::raw('NOW()'))
                                            ->where('date_end', '>', \DB::raw('NOW()'));
                                        })
                                        ->orWhereRaw("date_start IS NULL AND date_end IS NULL");
                                    });
                                    $query->where('is_action',1);
                                })->orWhere('is_main',1);
                            });
                        });
                    }
                });
            }

            if($this->request->has('sort')){
                $sort = $this->request->get('sort');
                switch ($sort) {
                    case 'price_asc':
                        $query->selectRaw('market_goods.*')
                            ->join('market_prices as mp', 'mp.good_id', '=', 'market_goods.id')
                            ->join('market_currs as mcurr', 'mp.curr_id', '=', 'mcurr.id')
                            ->where('mp.value', '!=', 0)
                            ->groupBy('market_goods.id')
                            ->orderByRaw("if (mp.value='' OR mp.value is null,0,1) DESC")
                            ->orderByRaw('(mp.value * mcurr.rate) asc');
                    break;
                    case 'price_desc':
                        $query->selectRaw('market_goods.*')
                            ->join('market_prices as mp', 'mp.good_id', '=', 'market_goods.id')
                            ->join('market_currs as mcurr', 'mp.curr_id', '=', 'mcurr.id')
                            ->where('mp.value', '!=', 0)
                            ->groupBy('market_goods.id')
                            ->orderByRaw("if (mp.value='' OR mp.value is null,0,1) DESC")
                            ->orderByRaw('(mp.value * mcurr.rate) desc');
                    break;

                    case 'remains':
                        $query->where('remains','>','0');
                    break;
                    case 'new_asc':
                        $query->orderBy('is_new','desc');
                    break;
                    case 'top_asc':
                        $query->orderBy('is_top','desc');
                    break;
                }
            }
            $cat_ids = $query->distinct()->pluck('cat_id');
            $categories = MarketCat::with('lang')->where('is_hidden',0)->whereIn('id',$cat_ids)->orderBy('sort_order','asc')->get();
            foreach($categories as $cat_item){
                $cat_item->params_count = Good::where('cat_id',$cat_item->id)->where('brand_series_id',$series->id)->where('is_hidden',0)->where('is_archive',0)->count();
            }
            $query_count_with_options = clone $query;
            $count_good_with_options = $query_count_with_options->count();
            $take_count = 3;
            $series->goods =  $query->take($take_count)->get();
            if($series->goods->count()){
                foreach($series->goods as &$good){
                    $good->load_gift_goods($good,3);
                    get_action_flag($good);
                }
            }
            View::share('page_title',$series->lang->name);
            return View::make('pages.catalog.series_page', [
                'series' => $series,
                'categories' => $categories,
                'count_good_with_options' => $count_good_with_options,
                "count_goods" => $count_goods,
                "active_filters" => $active_filters,
                'take_count' => $take_count,
                'breadcrumbs' => $breadcrumbs,
                'price_filter' => $price_filter,
                'meta_type' => 'series'
            ]);
        } else {
            return Redirect::to('404');
        }
    }

    public function getMarketFilters($cat_id,$filter_ids,$good_ids=[]) {
        $ancestors = array_merge(MarketCat::ancestors($cat_id), [$cat_id]);
        $descendants = array_merge(MarketCat::descendants($cat_id), [$cat_id]);
        $_filters = \Demos\Market\MarketChar::with(['lang', 'vals' => function($query) use($descendants, $ancestors,$filter_ids,$good_ids){
            $query->whereHas('goods', function ($query) use ($descendants, $ancestors,$filter_ids,$good_ids){
                $query->whereIn('good_id',$good_ids);
            })->withGoodsCount($filter_ids,$good_ids)
            ->with('lang')->orderBy('sort_order');
        }])->whereHas('goods', function ($query) use ($descendants,$ancestors,$good_ids){
            $query->whereIn('good_id',$good_ids);
        })->where('is_filter', 1)->orderBy('sort_order')->get();

        $filters = [];
        foreach ($_filters as $_filter) {
            $filters[$_filter->id] = [
                'is_multiple' => $_filter->is_multiple,
                'name' => $_filter->lang->name,
                'values' => []
            ];
            foreach ($_filter->vals as $_val) {
                $filters[$_filter->id]['values'][$_val->id]['val'] = ($_val->value != '') ? $_val->value : $_val->lang->lang_value;
                $filters[$_filter->id]['values'][$_val->id]['prefix'] = ($_filter->lang->prefix != "") ? $_filter->lang->prefix : '';
                $filters[$_filter->id]['values'][$_val->id]['suffix'] = ($_filter->lang->suffix != "") ? $_filter->lang->suffix : '';
                $filters[$_filter->id]['goods_count'][$_val->id] = $_val->goods_in_val;
            }
        }
        return $filters;
    }
}
