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
use \Demos\AdminPanel\Specialist;

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

        $cat_tabs = Cat::with('lang')->whereIn('id', array_merge(Cat::descendants(2),Cat::descendants(3)))->where('is_hidden',0)->orderBy('sort_order','asc')->get();

        if($cat_tabs->count()){
            foreach($cat_tabs as $item_tab){
                $item_tab->units = $item_tab->units()->with('lang')->whereHas('category', function($query) use ($item_tab) {
                    $query->where('cat_id', $item_tab->id);
                })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('date_publication','desc')->limit(4)->get();
            }
        }

        $blog = Unit::with('lang')->whereHas('category', function($query){
            $query->whereIn('cat_id', Cat::descendants(2));
        })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('date_publication','desc')->limit(4)->get();

        $special_actions = Unit::with('lang')->whereHas('category', function($query){
            $query->whereIn('cat_id', Cat::descendants(3));
        })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('date_publication','desc')->limit(4)->get();
        $special_actions_cat = Cat::with('lang')->whereIn('id', Cat::descendants(3))->where('is_hidden',0)->orderBy('sort_order','asc')->get();
        $services = \Demos\AdminPanel\Cat::with([
            'lang',
            'children' => function ($query) {
                $query->with([
                    'lang'
                ])->where('is_hidden',0)->orderBy('sort_order','asc');
            }
        ])->where('is_hidden',0)->find(4);

        $services_top = \Demos\AdminPanel\Cat::with('lang')->whereIn('id',\Demos\AdminPanel\Cat::descendants(4))->where('spec_option_1',1)->where('is_hidden',0)->orderBy('sort_order','asc')->get();

        $specialist = Unit::with('lang')->where('is_hidden',0)->find(79);

        $specialists = Specialist::with('lang')->where('is_hidden',0)->where('is_top',1)->where('is_block',0)->orderBy('sort_order','desc')->limit(4)->get();

        $leads = Lead::with(['goods','answers' => function ($query) {
            $query->where('is_hidden',0);
        }])->whereIn('form_type_id',[8])->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc')->limit(5)->get();

        $reviews = Unit::with('lang')->where('is_hidden',0)->find(4);

        $advantages = Unit::with('lang')->whereHas('category', function($query){
            $query->where('cat_id', 6);
        })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('sort_order','desc')->get();

        $virtual_tour = \Demos\AdminPanel\Unit::with('lang')->where('is_hidden',0)->find(178);

        $page_data = [
            'unit' => $unit,
            'blog' => $blog,
            'cat_tabs' => $cat_tabs,
            'special_actions' => $special_actions,
            'special_actions_cat' => $special_actions_cat,
            'services' => $services,
            'services_top' => $services_top,
            'specialist' => $specialist,
            'specialists' => $specialists,
            'leads' => $leads,
            'reviews' => $reviews,
            'advantages' => $advantages,
            'virtual_tour' => $virtual_tour,
            'meta_type' => 'unit'
        ];
        View::share('page_title', $unit->lang->name);
        return View::make('pages.main_page', $page_data);
    }

    public function indexEn() {
        App::setLocale('en');
        $unit = Unit::with('lang')->find(142);
        if (isset($unit) && Auth::guard('admin_account')->check()) {
            View::share('admin_edit_link', route('admin.units.editUnit', $unit->id));
        }
        $our_mission = Unit::with('lang')->where('is_hidden',0)->find(143);
        $directions = Unit::with('lang')->where('is_hidden',0)->find(147);
        $translator = Unit::with('lang')->where('is_hidden',0)->find(144);
        $check_up = Unit::with('lang')->where('is_hidden',0)->find(151);
        $telemed = Unit::with('lang')->where('is_hidden',0)->find(152);
        $standards = Unit::with('lang')->where('is_hidden',0)->find(153);
        $offer = \Demos\AdminPanel\Cat::with([
            'lang',
            'units' => function ($query) {
                $query->with('lang')->where('is_hidden',0)->orderBy('sort_order','desc');
            }
        ])->where('is_hidden',0)->find(45);
        $pricelist = \Demos\AdminPanel\Cat::with([
            'lang',
            'units' => function ($query) {
                $query->with('lang')->where('is_hidden',0)->orderBy('sort_order','desc');
            }
        ])->where('is_hidden',0)->find(46);
        $departments = \Demos\AdminPanel\Cat::with([
            'lang',
            'units' => function ($query) {
                $query->with('lang')->where('is_hidden',0)->orderBy('sort_order','desc');
            }
        ])->where('is_hidden',0)->find(44);
        $principles = \Demos\AdminPanel\Cat::with([
            'lang',
            'units' => function ($query) {
                $query->with('lang')->where('is_hidden',0)->orderBy('sort_order','desc');
            }
        ])->where('is_hidden',0)->find(47);
        $directions_list = Cat::with('lang')->where('spec_option_2',1)->where('is_hidden',0)->orderBy('sort_order','asc')->get();
        $page_data = [
            "unit" => $unit,
            "our_mission" => $our_mission,
            "directions" => $directions,
            "translator" => $translator,
            "check_up" => $check_up,
            "telemed" => $telemed,
            "standards" => $standards,
            "offer" => $offer,
            "pricelist" => $pricelist,
            "departments" => $departments,
            "principles" => $principles,
            "directions_list" => $directions_list,
            'meta_type' => 'unit',
        ];
        View::share('page_title', $unit->lang->name);
        return View::make('pages.en_main_page', $page_data);
    }

    public function showUnit($alias,$cat_alias=NULL) {
        $unit = Unit::with([
                'lang',
                'additions' => function($query){
                    $query->where('is_hidden', 0)->with(['children' => function($query){
                        $query->where('is_hidden', 0)->orderBy('sort_order');
                    }]);
                },
                'videos' => function ($query) {
                    $query->with('lang')->where('is_hidden',0);
                },
                'rel_categories' => function ($query) {
                    $query->with('lang')->where('is_hidden',0)->withPivot('rel_type_id');
                },
                'leads' => function ($query) {
                    $query->with(['answers' => function ($query) {
                        $query->where('is_hidden',0);
                    }])->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc');
                },
                'rel_faq_groups' => function ($query) {
                    $query->with([
                        'lang',
                        'faq' => function ($query) {
                            $query->with('lang')/*->where('is_hidden',0)*/->orderBy('sort_order','asc');
                        }
                    ])->where('is_hidden',0)->orderBy('sort_order','asc');
                }
        ])->where('alias', $alias)->first();
        if (isset($unit) && Auth::guard('admin_account')->check()) {
            View::share('admin_edit_link', route('admin.units.editUnit', $unit->id));
        }
        if($unit){
            if(!empty($unit->related_market_cats)){
                foreach ($unit->related_market_cats as $market_cat){
                    $market_cat->goods = $market_cat->goods()->where('is_hidden',0)->where('is_archive',0)->CatSorting($market_cat->id)->get();
                }
            }
            $this->calculate_market_goods($unit);
            $cats = array_merge(Cat::ancestors($unit->category->id),[$unit->category->id]);
            $breadcrumbs = Cat::with('lang')->whereIn('id', $cats)
                        ->where('alias', '!=', 'html')
                        ->where('is_hidden_bc',0)
                        ->orderBy('sort_order', 'asc')
                        ->get();
            if($breadcrumbs->count()){
                foreach ($breadcrumbs as $crumb) {
                    $crumb->alias = route('first_url',$crumb->alias);
                }
            }
            $this->calculate_visitors($unit);
            View::share('page_title', $unit->lang->name);
            $rel_types = \Demos\AdminPanel\UnitsRelType::get();
            $news = Unit::with('lang')->where('id','!=',$unit->id)->where('cat_id',$unit->cat_id)->where('is_hidden',0)->orderBy('date_publication','desc')->limit(3)->get();
            $reviews = Unit::with('lang')->where('is_hidden',0)->find(4);

            $virtual_tour = \Demos\AdminPanel\Unit::with('lang')->where('is_hidden',0)->find(178);

            $page_data = [
                'unit' => $unit,
                'news' => $news,
                'reviews' => $reviews,
                'rel_types' => $rel_types,
                'breadcrumbs' => $breadcrumbs,
                'virtual_tour' => $virtual_tour,
                'meta_type' => 'unit'
            ];
            if($unit->id == 2){
                $view = 'pages.contact_page';
            } elseif($unit->id == 178){
                $view = 'pages.virtual_page';
            } elseif(in_array($unit->cat_id, array_merge(Cat::descendants(2),[2]))){
                $cat_ids = [];
                $tmp_rel_cat_ids = [];
                $tmp_rel_3_cat_ids = [];
                $rel_service_cats = new \Illuminate\Database\Eloquent\Collection;
                $rel_service_units = new \Illuminate\Database\Eloquent\Collection;
                if($rel_types->count()){
                    foreach ($rel_types as $type_item){
                        if ($type_item->id == 3){
                            if(count(array_pluck($unit->related_units[$type_item->id]['units'],'id'))){
                                $rel_service_units =  Unit::with('lang')->whereIn('id',array_pluck($unit->related_units[$type_item->id]['units'],'id'))->orderBy('sort_order','desc')->get();
                            }
                            if(count(array_pluck($unit->related_units[$type_item->id]['units'],'cat_id'))){
                                $tmp_rel_cat_ids = array_pluck($unit->related_units[$type_item->id]['units'],'cat_id');
                            }
                        }
                    }
                }
                if($unit->rel_categories->count()){
                    foreach($unit->rel_categories as $tmp_rel_cat){
                        if($tmp_rel_cat->pivot->rel_type_id == 3){
                            $tmp_rel_3_cat_ids [] = $tmp_rel_cat->id;
                        }
                    }
                }
                $tmp_rel_cat_ids = array_merge($tmp_rel_cat_ids,$tmp_rel_3_cat_ids);

                if(count($tmp_rel_cat_ids)){
                    $rel_service_cats =  Cat::with('lang')->whereIn('id',$tmp_rel_cat_ids)->orderBy('sort_order','asc')->get();
                }
                $page_data['rel_service_cats'] = $rel_service_cats;
                $page_data['rel_service_units'] = $rel_service_units;
                $view = 'pages.news_page';
            } elseif(in_array($unit->cat_id, array_merge(Cat::descendants(3),[3]))) {
                $tmp_rel_cat_ids = [];
                $tmp_rel_3_cat_ids = [];
                $rel_service_cats = new \Illuminate\Database\Eloquent\Collection;
                $rel_service_units = new \Illuminate\Database\Eloquent\Collection;
                if($rel_types->count()){
                    foreach ($rel_types as $type_item){
                        if ($type_item->id == 3){
                            if(count(array_pluck($unit->related_units[$type_item->id]['units'],'id'))){
                                $rel_service_units =  Unit::with('lang')->whereIn('id',array_pluck($unit->related_units[$type_item->id]['units'],'id'))->orderBy('sort_order','desc')->get();
                            }
                            if(count(array_pluck($unit->related_units[$type_item->id]['units'],'cat_id'))){
                                $tmp_rel_cat_ids = array_pluck($unit->related_units[$type_item->id]['units'],'cat_id');
                            }
                        }
                    }
                }
                if($unit->rel_categories->count()){
                    foreach($unit->rel_categories as $tmp_rel_cat){
                        if($tmp_rel_cat->pivot->rel_type_id == 3){
                            $tmp_rel_3_cat_ids [] = $tmp_rel_cat->id;
                        }
                    }
                }
                $tmp_rel_cat_ids = array_merge($tmp_rel_cat_ids,$tmp_rel_3_cat_ids);

                if(count($tmp_rel_cat_ids)){
                    $rel_service_cats =  Cat::with('lang')->whereIn('id',$tmp_rel_cat_ids)->orderBy('sort_order','asc')->get();
                }
                $page_data['rel_service_cats'] = $rel_service_cats;
                $page_data['rel_service_units'] = $rel_service_units;
                $view = 'pages.actions_page';
            } elseif($unit->id == 6) {
                $view = 'pages.checkup_page';

                $checkup_info = Unit::with('lang')->whereHas('category', function($query){
                    $query->where('cat_id', 41);
                })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('sort_order','desc')->get();
                $page_data['checkup_info'] = $checkup_info;

            } elseif($unit->cat_id == 7) {
                $view = 'pages.equipment_page';
            } elseif($unit->id == 5) {
                $view = 'pages.online_consultation';
            } elseif($unit->id == 3) {
                $specialist = Unit::with('lang')->where('is_hidden',0)->find(79);
                $specialists = Specialist::with('lang')->where('is_hidden',0)->where('is_top',1)->where('is_block',0)->orderBy('sort_order','desc')->limit(4)->get();
                $leads = Lead::with(['goods','answers' => function ($query) {
                    $query->where('is_hidden',0);
                }])->whereIn('form_type_id',[8])->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc')->limit(5)->get();
                $reviews = Unit::with('lang')->where('is_hidden',0)->find(4);
                $advantages = Unit::with('lang')->whereHas('category', function($query){
                    $query->where('cat_id', 6);
                })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('sort_order','desc')->get();

                $page_data['specialist'] = $specialist;
                $page_data['specialists'] = $specialists;
                $page_data['leads'] = $leads;
                $page_data['reviews'] = $reviews;
                $page_data['advantages'] = $advantages;
                $view = 'pages.about_page';
            } elseif($unit->id == 4){
                $unit->leads = Lead::with(['answers' => function ($query) {
                    $query->where('is_hidden',0);
                }])->where('form_type_id',8)->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc')->paginate(15);
                $view = 'pages.reviews';
            } elseif($unit->id == 79) {
                if($this->request->has('search') && $this->request->get('search') != '') {
                    $search = strtolower($this->request->get('search'));
                    $result_specialists_ids =[];

                    $specialists = Specialist::with('lang')->where('is_hidden', 0)->whereHas('lang', function($query) use ($search) {
                        $query->where(function ($query) use ($search) {
                            $query->where('first_name', 'LIKE', '%'.$search.'%')->orWhere('last_name', 'LIKE', '%'.$search.'%')->orWhere('father_name', 'LIKE', '%'.$search.'%');
                        });
                    })->get();

                    foreach ($specialists as $specialist) {
                        $result_specialists_ids[] = $specialist->id;
                    }

                    // $specialists = Specialist::with('lang')->where('is_hidden', 0)->whereNotIn('id', $result_specialists_ids)->whereHas('lang', function($query) use ($search) {
                    //     $query->where(function($query) use ($search){
                    //         $query->where('long_desc_1', 'LIKE', '%'.$search.'%')->orWhere('long_desc_2', 'LIKE', '%'.$search.'%');
                    //     });
                    // })->get();

                    // foreach ($specialists as $specialist) {
                    //     $result_specialists_ids[] = $specialist->id;
                    // }

                    $search_array = explode(" ", $search);
                    if (!empty($search_array)) {
                        foreach ($search_array as $search_item) {
                            $specialists = Specialist::with('lang')
                                ->whereNotIn('id', $result_specialists_ids)
                                ->where('is_hidden', 0)
                                ->whereHas('lang', function($query) use ($search_item) {
                                    $query->where(function ($query) use ($search_item) {
                                        $query->where('first_name', 'LIKE', '%'.$search_item.'%')->orWhere('last_name', 'LIKE', '%'.$search_item.'%')->orWhere('father_name', 'LIKE', '%'.$search_item.'%');
                                    });
                                }
                            )->get();

                            foreach ($specialists as $specialist) {
                                $result_specialists_ids[] = $specialist->id;
                            }
                        }
                    }
                    // foreach ($search_array as $search_item) {
                    //     $specialists = Specialist::with('lang')->where('is_hidden', 0)->whereNotIn('id', $result_specialists_ids)->whereHas('lang', function($query) use ($search_item) {
                    //         $query->where(function($query) use ($search_item){
                    //             $query->where('long_desc_1', 'LIKE', '%'.$search_item.'%')->orWhere('long_desc_2', 'LIKE', '%'.$search_item.'%');
                    //         });
                    //     })->get();

                    //     foreach ($specialists as $specialist) {
                    //         $result_specialists_ids[] = $specialist->id;
                    //     }
                    // }

                    $specialists = Specialist::with('lang')->where('is_hidden',0)
                        ->whereHas('rel_units', function ($query) use ($search) {
                            $query->whereIn('cat_id', Cat::descendants(4))->whereHas('lang', function($query)  use ($search) {
                                $query->where('name', 'LIKE', '%'.$search.'%');
                            });
                    })->whereNotIn('id', $result_specialists_ids)->get();

                    foreach ($specialists as $specialist) {
                        $result_specialists_ids[] = $specialist->id;
                    }

                    $specialists = Specialist::with('lang')->where('is_hidden',0)
                        ->whereHas('rel_units_categories', function ($query) use ($search) {
                            $query->whereIn('cat_id', Cat::descendants(4))->whereHas('lang', function($query)  use ($search) {
                                $query->where('name', 'LIKE', '%'.$search.'%');
                            });
                    })->whereNotIn('id', $result_specialists_ids)->get();

                    foreach ($specialists as $specialist) {
                        $result_specialists_ids[] = $specialist->id;
                    }

                    if(count($result_specialists_ids)){
                        $specialists = Specialist::with('lang')->where('is_hidden',0)->where('is_block',0)->whereIn('id',$result_specialists_ids)->orderBy('sort_order','desc')->paginate(8);
                        $specialists->appends([
                            'search' => $search,
                        ]);
                    } else {
                        $specialists = new \Illuminate\Database\Eloquent\Collection;
                    }

                } else {
                    $specialists = Specialist::with('lang')->where('is_hidden',0)->where('is_block',0)->orderBy('sort_order','desc')->paginate(8);
                }


                $view = 'pages.expert_list';



                $page_data['specialists'] = $specialists;
            } elseif(in_array($unit->cat_id, Cat::descendants(4))) {
                $view = 'pages.services_page';
            } else {
                $view = 'pages.unit_page';
            }

            return View::make($view, $page_data);
        } else {
            return Redirect::to('404');
        }
    }

    public function showCat($alias) {
        $cat = Cat::with([
                'lang',
                'videos' => function ($query) {
                    $query->with('lang')->where('is_hidden',0);
                },
                'children' => function ($query) {
                    $query->with([
                        'lang',
                        'children' => function ($query) {
                            $query->with('lang')->where('is_hidden',0)->orderBy('sort_order','asc');
                        },
                        'units' => function ($query) {
                            $query->with('lang')->where('is_hidden',0)->orderBy('sort_order','desc');
                        }
                    ])->where('is_hidden',0)->orderBy('sort_order','asc');
                },
                'leads' => function ($query) {
                    $query->with(['answers' => function ($query) {
                        $query->where('is_hidden',0);
                    }])->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc');
                },
                'rel_faq_groups' => function ($query) {
                    $query->with([
                        'lang',
                        'faq' => function ($query) {
                            $query->with('lang')/*->where('is_hidden',0)*/->orderBy('sort_order','asc');
                        }
                    ])->where('is_hidden',0)->orderBy('sort_order','asc');
                }
            ])->where('alias', $alias)->first();
        if ($cat) {
            if(!empty($cat->related_market_cats)){
                foreach ($cat->related_market_cats as $market_cat){
                    $market_cat->goods = $market_cat->goods()->where('is_hidden',0)->where('is_archive',0)->CatSorting($market_cat->id)->get();
                }
            }
            $cats = Cat::ancestors($cat->id);
            $breadcrumbs = Cat::with('lang')->whereIn('id', $cats)
                                    ->where('alias', '!=', 'html')
                                    ->where('is_hidden_bc',0)
                                    ->orderBy('sort_order', 'asc')
                                    ->get();
            if($breadcrumbs->count()){
                foreach ($breadcrumbs as $crumb) {
                    $crumb->alias = route('first_url',$crumb->alias);
                }
            }
            if (isset($cat) && Auth::guard('admin_account')->check()) {
                View::share('admin_edit_link', route('admin.units.categories', 'cat_id='.$cat->id));
            }
            $reviews = Unit::with('lang')->where('is_hidden',0)->find(4);
            $query = Unit::with([
                'lang',
                'videos' => function ($query) {
                    $query->with('lang')->where('is_hidden',0);
                }
            ])->whereHas('category', function($query) use ($cat){
                $query->whereIn('cat_id', array_merge(Cat::descendants($cat->id),[$cat->id]));
            })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)');
            $first_query = clone $query;
            $popular_query = clone $query;
            $cat->units = $first_query->orderBy('sort_order','desc')->get();
            if(in_array($cat->id, array_merge(array_merge(Cat::descendants(2),[2]), array_merge(Cat::descendants(3),[3])))) {
                $cat->popular_units = $popular_query->orderBy('visitors','desc')->limit(4)->get();
                $cat->units = $query->orderBy('date_publication','desc')->paginate(8);
                if(in_array($cat->id, array_merge(Cat::descendants(2),[2]))){
                    $view = 'pages.news_list';
                } else {
                    $view = 'pages.actions_list';
                }
            } elseif ($cat->id == 7) {
                $view = 'pages.equipment_list';
            } elseif ($cat->id == 4) {
                $view = 'pages.services_list';
            } elseif(in_array($cat->id, Cat::descendants(4))) {
                $view = 'pages.services_list_page';
            } else {
                $view = 'pages.cat_page';
            }
            $this->calculate_market_goods($cat);
            $page_data = [
                'reviews' => $reviews,
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

    public function showExpert($alias) {
        $expert = Specialist::with([
                'lang',
                'appoints',
                'videos' => function ($query) {
                    $query->with('lang')->where('is_hidden',0);
                },
                'images_1' =>function ($query) {
                    $query->where('is_hidden',0)->orderBy('sort_order','asc');
                },
                'leads' => function ($query) {
                    $query->with(['answers' => function ($query) {
                        $query->where('is_hidden',0);
                    }])->whereIn('form_type_id',[8])->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc');
                },
                'rel_faq_groups' => function ($query) {
                    $query->with([
                        'lang',
                        'faq' => function ($query) {
                            $query->with('lang')/*->where('is_hidden',0)*/->orderBy('sort_order','asc');
                        }
                    ])->where('is_hidden',0)->orderBy('sort_order','asc');
                }
            ])->where('alias', $alias)->first();
        $specialist = Unit::with('lang')->where('is_hidden',0)->find(79);
        if($expert){
            if (Auth::guard('admin_account')->check()) {
                View::share('admin_edit_link', route('admin.specialists.editSpecialist', $expert->id));
            }
            $expert->related_market_cats_flag = 0;
            if(!empty($expert->related_market_cats)){
                foreach ($expert->related_market_cats as $related_market_cat){
                    if(isset($related_market_cat['cats']) && count($related_market_cat['cats'])){
                        foreach($related_market_cat['cats'] as $market_cat){
                            $market_cat->goods = $market_cat->goods()->where('is_hidden',0)->where('is_archive',0)->CatSorting($market_cat->id)->get();
                            $expert->related_market_cats_flag += $market_cat->goods->count();
                        }
                    }
                }
            }
            $breadcrumbs = [];
            $breadcrumbs[] = [
                'alias' => build_unit_route($specialist),
                'name' => $specialist->lang->name,
            ];
            View::share('page_title', $expert->lang->first_name." ".$expert->lang->last_name);
            $_articles = $expert->rel_units()
                    ->where('is_hidden', 0)
                    ->where('specialists_units_relations.rel_type_id', 1)
                    ->with(['lang', 'rel_units' => function($query) {
                        $query->where('units_relations.rel_type_id', 1)->with('lang');
                    }])
                    ->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')
                    ->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')
                    ->orderBy('specialists_units_relations.sort_order')
                    ->get();
            $articles = [];
            foreach ($_articles as $_article) {
                if ($_article->rel_units->count()){
                    $articles[$_article->rel_units[0]->alias]['name'] = $_article->rel_units[0]->lang->name;
                    $articles[$_article->rel_units[0]->alias]['articles'][] = $_article;
                }
            }
            $expert->articles = $articles;
            $expert->activity = $expert->rel_units()->where('is_hidden', 0)->orderBy('specialists_units_relations.sort_order')->where('specialists_units_relations.rel_type_id', 2)->with('lang')->get();
            $expert->company = $expert->rel_units()->where('is_hidden', 0)->orderBy('specialists_units_relations.sort_order')->where('specialists_units_relations.rel_type_id', 3)->with('lang')->get();
            $expert->xp = FALSE;
            $xp_val = \DB::table('specialists_chars_relations')->where('specialist_id', $expert->id)->where('val_id', 1)->first();
            if ($xp_val && $xp_val->own_value != '') {
                $xp_array = json_decode($xp_val->own_value, true);
                if (isset($xp_array[App::getLocale()])) {
                    $expert->xp = date('Y') - $xp_array[App::getLocale()];
                }
            }

            if ($expert->is_consultant) {
                $first_day = Carbon::createFromDate(date('Y'), date('m'), date('d'), 'Europe/Kiev')->addDays(3);
                $begin = new DateTime($first_day->format('Y-m-d'));
                $end = new DateTime($first_day->format('Y-m-d'));
                $end = $end->modify( '+28 day' );
                $interval = new DateInterval('P1D');
                $daterange = new DatePeriod($begin, $interval, $end);
                $work_days = explode(",", $expert->work_days);
                $dates = [];
                $page = 0;
                $day = 0;
                $days_ow_week = [
                    Lang::get('main.day_1'),
                    Lang::get('main.day_2'),
                    Lang::get('main.day_3'),
                    Lang::get('main.day_4'),
                    Lang::get('main.day_5'),
                    Lang::get('main.day_6'),
                    Lang::get('main.day_7'),
                ];
                $appoints = [];
                foreach ($expert->appoints as $appoint) {
                    $appoints[$appoint->date->format('d.m.Y')][] = $appoint->time;
                }

                foreach($daterange as $date){
                    $day_of_week = \Carbon\Carbon::parse($date)->dayOfWeek;
                    $day_of_week = ($day_of_week != 0) ? $day_of_week : 7;
                    $start_var_name = 'work_day_'.$day_of_week.'_start';
                    $end_var_name = 'work_day_'.$day_of_week.'_end';
                    $start = $expert->$start_var_name;
                    $end = $expert->$end_var_name;
                    $_date = $date->format('d.m.Y');
                    $day_period = [];
                    $is_work_day = (in_array($day_of_week, $work_days));
                    if ($is_work_day) {
                        $_day_period = new DatePeriod(
                            new DateTime($_date.' '.$expert->$start_var_name.':00'),
                            new DateInterval('P0Y0DT0H'.$expert->appoint_interval.'M'),
                            new DateTime($_date.' '.$expert->$end_var_name.':00')
                        );
                        foreach ($_day_period as $key => $value) {
                            $time = $value->format('H:i');
                            $day_period[] = [
                                'time' => $time,
                                'date' => $date->format('Y-m-d'),
                                'is_active' => (!isset($appoints[$_date]) || !in_array($time, $appoints[$_date]))
                            ];
                        }
                    }
                    $dates[$page][$day] = [
                        'date' => $date->format('d.m'),
                        'day' => $days_ow_week[$day_of_week-1],
                        'is_work_day' => $is_work_day,
                        'day_period' => $day_period,
                    ];
                    $day++;
                    if ($day == 7) {
                        $day = 0;
                        $page++;
                    }
                }
            } else {
                $dates = FALSE;
            }
            $reviews = Unit::with('lang')->where('is_hidden',0)->find(4);
            $directions_consultation = Cat::with('lang')->where('is_hidden',0)->where('parent_id',4)->orderBy('sort_order','asc')->get();
            $page_data = [
                'dates' => $dates,
                'reviews' => $reviews,
                'expert' => $expert,
                'breadcrumbs' => $breadcrumbs,
                'directions_consultation' => $directions_consultation,
                'meta_type' => 'expert'
            ];
            $view = 'pages.expert_page';
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
