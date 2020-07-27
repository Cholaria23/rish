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
use \Demos\Market\Brand;
use \Demos\Market\Good;
use \Demos\Market\Order;
use \Demos\AdminPanel\FormType;
use \Demos\AdminPanel\Lead;

class PageController extends Controller {

    protected $request;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $unit = Unit::with('lang')->where('alias','=','main')->first();
        if (isset($unit) && Auth::guard('admin_account')->check()) {
            View::share('admin_edit_link', route('admin.units.editUnit', $unit->id));
        }

        $blog = Unit::with('lang')->whereHas('category', function($query){
            $query->whereIn('cat_id', Cat::descendants(2));
        })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('date_publication','desc')->limit(4)->get();

        $special_actions = Unit::with('lang')->whereHas('category', function($query){
            $query->whereIn('cat_id', Cat::descendants(3));
        })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('date_publication','desc')->limit(4)->get();

        $services = \Demos\AdminPanel\Cat::with([
            'lang',
            'children' => function ($query) {
                $query->with([
                    'lang'                    
                ])->where('is_hidden',0)->orderBy('sort_order','asc');
            }
        ])->where('is_hidden',0)->find(4);

        $services_top = \Demos\AdminPanel\Cat::with('lang')->whereIn('id',\Demos\AdminPanel\Cat::descendants(4))->where('spec_option_1',1)->where('is_hidden',0)->orderBy('sort_order','asc')->get();

        $specialists = Unit::with('lang')->whereHas('category', function($query){
            $query->where('cat_id', 5);
        })->where('is_hidden',0)->where('is_top',1)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('sort_order','desc')->limit(4)->get();
        
        $leads = Lead::with(['goods','answers' => function ($query) {
            $query->where('is_hidden',0);
        }])->whereIn('form_type_id',[8])->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc')->limit(5)->get();

        $reviews = Unit::with('lang')->where('is_hidden',0)->find(4);

        $advantages = Unit::with('lang')->whereHas('category', function($query){
            $query->where('cat_id', 6);
        })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('sort_order','desc')->get();

        $page_data = [
            'unit' => $unit,
            'blog' => $blog,
            'special_actions' => $special_actions,
            'services' => $services,
            'services_top' => $services_top,
            'specialists' => $specialists,
            'leads' => $leads,
            'reviews' => $reviews,
            'advantages' => $advantages,
            'meta_type' => 'unit'
        ];
        View::share('page_title', $unit->lang->name);
        return View::make('pages.main_page', $page_data);
    }

    public function showUnit($alias,$cat_alias=NULL) {
        $unit = Unit::with(['lang', 'additions' => function($query){
            $query->where('is_hidden', 0)->with(['children' => function($query){
                $query->where('is_hidden', 0)->orderBy('sort_order');
            }]);
        }])->where('alias', $alias)->first();
        if (isset($unit) && Auth::guard('admin_account')->check()) {
            View::share('admin_edit_link', route('admin.units.editUnit', $unit->id));
        }
        if($unit){
            $cats = array_merge(Cat::ancestors($unit->category->id),[$unit->category->id]);
            $breadcrumbs = Cat::with('lang')->whereIn('id', $cats)
                        ->where('alias', '!=', 'html')
                        ->where('is_hidden_bc',0)
                        ->orderBy('sort_order', 'asc')
                        ->get();
            $this->calculate_visitors($unit);
            View::share('page_title', $unit->lang->name);
            $page_data = [
                'unit' => $unit,
                'breadcrumbs' => $breadcrumbs,
                'meta_type' => 'unit'
            ];
            if($unit->id == 2){
                $view = 'pages.contact_page';
            } else {
                $view = 'pages.unit_page';
            }

            return View::make($view, $page_data);
        } else {
            return Redirect::to('404');
        }
    }

    public function showCat($alias) {
        $cat = Cat::with('lang')->where('alias', $alias)->first();
        if ($cat) {
            $cats = Cat::ancestors($cat->id);
            $breadcrumbs = Cat::with('lang')->whereIn('id', $cats)
                                    ->where('alias', '!=', 'html')
                                    ->where('is_hidden_bc',0)
                                    ->orderBy('sort_order', 'asc')
                                    ->get();
            if (isset($cat) && Auth::guard('admin_account')->check()) {
                View::share('admin_edit_link', route('admin.units.categories', 'cat_id='.$cat->id));
            }

            $query = Unit::with([
                'lang',
                'videos' => function ($query) {
                    $query->with('lang')->where('is_hidden',0);
                }
            ])->whereHas('category', function($query) use ($cat){
                $query->whereIn('cat_id', array_merge(Cat::descendants($cat->id),[$cat->id]));
            })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)');
            $first_query = clone $query;
            $cat->units = $first_query->orderBy('sort_order','desc')->get();
            if(in_array($cat->id, array_merge(Cat::descendants(4),[4]))) {
                $cat->units = $query->orderBy('date_publication','desc')->paginate(10);
                $view = 'pages.news_list';
            } else {
                $view = 'pages.cat_page';
            }
            $page_data = [
                'cat' => $cat,
                'breadcrumbs' => $breadcrumbs,
                'meta_type' => 'cat_unit'
            ];

            View::share('page_title',  $cat->lang->name);
            return View::make($view, $page_data);
        } else {
            return Redirect::to('404');
        }

    }

    public function getCabinet () {
        
        if (Auth::guard('web')->check()) {
            View::share('page_title', Lang::get("cabinet.page_title"));
            $id = Auth::guard('web')->user()->id;
            $user = \Demos\AdminPanel\User::find($id);
 
            $orders_query = Order::orderBy('created_at', 'desc')->with('status', 'goods.lang');
            if($user){
                $orders_query->where(function($query) use ($user){
                    $query->where('user_id', $user->id);
                    if ($user->email != ''){
                        $query->orWhere('email', $user->email);
                    }
                    $search_phone = preg_replace( '/[^0-9]/', '', "%".$user->phone_1."%");
                    if ($search_phone != ''){
                        $query->orWhere('phone', 'LIKE', "%".$search_phone."%");
                    }
 
                    $search_phone = preg_replace( '/[^0-9]/', '', "%".$user->phone_2."%");
                    if ($search_phone != ''){
                        $query->orWhere('phone', 'LIKE', "%".$search_phone."%");
                    }
 
                });
            }
            $user->orders = $orders_query->get(); 
            $page_data = [
                'user' => $user,
            ];
 
            $view = 'pages.cabinet.cabinet_page';
            return View::make($view, $page_data);
        } else {
            return Redirect::to('./');
        }
 
 
    }

    public function calculate_visitors(Unit $unit) {
        $viewed_units = explode(",", Cookie::get('viewed_units'));
        if (!in_array($unit->id, $viewed_units)) {
            $unit->visitors = $unit->visitors + 1;
            unset($unit['related_goods']);
            unset($unit['related_market_cats']);
            unset($unit['related_market_cats_flag']);
            unset($unit['related_market_actions_cats_flag']);
            unset($unit['related_action_cats']);
            unset($unit['related_action_goods']);
            $unit->save();
            $viewed_units[] = $unit->id;
            Cookie::queue(Cookie::make('viewed_units', implode(",", $viewed_units), 60*24*365));
        }
    }

    public function calculate_market_goods($unit) {
        $unit->related_market_cats_flag = 0;
        if(!empty($unit->related_market_cats)){
            foreach($unit->related_market_cats as $market_cat){
                if($market_cat->goods->count()){
                    $unit->related_market_cats_flag += $market_cat->goods->count();
                }
            }
        }
    }

    public function calculate_market_actions_goods($unit) {
        $unit->related_market_actions_cats_flag = 0;
        if(!empty($unit->related_action_cats)){
            foreach($unit->related_action_cats as $market_cat){
                if($market_cat->goods->count()){
                    $unit->related_market_actions_cats_flag += $market_cat->goods->count();
                }
            }
        }
    }
}
?>
