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
use \URL;
use \Auth;
use \Cookie;
use \Cache;
use \Demos\AdminPanel\Gallery;
use \Demos\AdminPanel\GalleryPhoto;
use \Demos\AdminPanel\Unit;
use \Demos\AdminPanel\Cat;
use \Demos\AdminPanel\UnitVideo;
use \Demos\Market\MarketCat;
use \Demos\Market\Good;
use \Demos\AdminPanel\Specialist;

class SearchController extends Controller
{
    public function showSearch(Request $request) {

        $search = strtolower($request->search);

        $response = [
            'page_title'   => Lang::get('main.search_page').' «'.$search.'»',
            'meta_title'   => Lang::get('main.search_meta').' «'.$search.'»',
            'count'        => 0,
            'services'     => [],
            'news'         => [],
            'articles'     => [],
            'actions'      => [],
            'specialists'  => [],
            'equipments'   => [],
            'units'        => [],

        ];
        $unset_top_price = TRUE;
        if ($search && mb_strlen(trim($search)) >= 3) {
            $result_units_ids = [];
            $result_specialists_ids = [];

            $block_cats_arr = [1,6,15,5];
            $block_cats = [];
            foreach ($block_cats_arr as $block_cats_id) {
                $desc = array_merge([$block_cats_id], Cat::descendants($block_cats_id));
                $block_cats = array_merge($block_cats, $desc);
            }

            $services_cats = array_merge([4], Cat::descendants(4));
            $news_cats = array_merge([19], Cat::descendants(19));
            $articles_cats = array_merge([18], Cat::descendants(18));
            $actions_cats = array_merge([3], Cat::descendants(3));
            $equipments_cats = array_merge([7], Cat::descendants(7));
            $specialists_cats = array_merge([5], Cat::descendants(5));

            $response['services_cats'] = $services_cats;
            $response['news_cats'] = $news_cats;
            $response['articles_cats'] = $articles_cats;
            $response['actions_cats'] = $actions_cats;
            $response['equipments_cats'] = $equipments_cats;
            $response['specialists_cats'] = $specialists_cats;

            $units = Unit::with('lang')->whereHas('category', function ($query) {
                $query->with('lang')->where('is_hidden',0);
            })->whereNotIn('cat_id', $block_cats)->where('is_hidden', 0)->whereHas('lang', function($query) use ($search) {
                $query->where('name', 'LIKE', '%'.$search.'%');
            })->get();

            $specialists = Specialist::with('lang')->where('is_hidden', 0)->whereHas('lang', function($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('first_name', 'LIKE', '%'.$search.'%')->orWhere('last_name', 'LIKE', '%'.$search.'%')->orWhere('father_name', 'LIKE', '%'.$search.'%');
                });
            })->get();

            foreach ($specialists as $specialist) {
                $result_specialists_ids[] = $specialist->id;
                $response['count'] ++;
                $response['specialists'][] = self::build_search_specialist($specialist, $search);
            }

            foreach ($units as $unit) {
                $result_units_ids[] = $unit->id;
                $response['count'] ++;
                if (in_array($unit->cat_id, $services_cats)) {
                    $response['services'][] = self::build_search_unit($unit, $search);
                } elseif (in_array($unit->cat_id, $news_cats)) {
                    $response['news'][] = self::build_search_unit($unit, $search);
                } elseif (in_array($unit->cat_id, $articles_cats)) {
                    $response['articles'][] = self::build_search_unit($unit, $search);
                } elseif (in_array($unit->cat_id, $actions_cats)) {
                    $response['actions'][] = self::build_search_unit($unit, $search);
                } elseif (in_array($unit->cat_id, $equipments_cats)) {
                    $response['equipments'][] = self::build_search_unit($unit, $search);
                } else {
                    $response['units'][] = self::build_search_unit($unit, $search);
                }
            }

            $units = Unit::with('lang')->whereHas('category', function ($query) {
                $query->with('lang')->where('is_hidden',0);
            })->whereNotIn('cat_id', $block_cats)->where('is_hidden', 0)->whereNotIn('id', $result_units_ids)->whereHas('lang', function($query) use ($search) {
                $query->where(function($query) use ($search){
                    $query->where('long_desc_1', 'LIKE', '%'.$search.'%')->orWhere('long_desc_2', 'LIKE', '%'.$search.'%');
                });
            })->get();

            $specialists = Specialist::with('lang')->where('is_hidden', 0)->whereNotIn('id', $result_specialists_ids)->whereHas('lang', function($query) use ($search) {
                $query->where(function($query) use ($search){
                    $query->where('long_desc_1', 'LIKE', '%'.$search.'%')->orWhere('long_desc_2', 'LIKE', '%'.$search.'%');
                });
            })->get();

            foreach ($specialists as $specialist) {
                $result_specialists_ids[] = $specialist->id;
                $response['count'] ++;
                $response['specialists'][] = self::build_search_specialist($specialist, $search);
            }

            foreach ($units as $unit) {
                $result_units_ids[] = $unit->id;
                $response['count'] ++;
                if (in_array($unit->cat_id, $services_cats)) {
                    $response['services'][] = self::build_search_unit($unit, $search);
                } elseif (in_array($unit->cat_id, $news_cats)) {
                    $response['news'][] = self::build_search_unit($unit, $search);
                } elseif (in_array($unit->cat_id, $articles_cats)) {
                    $response['articles'][] = self::build_search_unit($unit, $search);
                } elseif (in_array($unit->cat_id, $actions_cats)) {
                    $response['actions'][] = self::build_search_unit($unit, $search);
                } elseif (in_array($unit->cat_id, $equipments_cats)) {
                    $response['equipments'][] = self::build_search_unit($unit, $search);
                } else {
                    $response['units'][] = self::build_search_unit($unit, $search);
                }
            }


            $search_array = explode(" ", $search);
            if (!empty($search_array)) {
                foreach ($search_array as $search_item) {
                    $units = Unit::with('lang')->whereHas('category', function ($query) {
                            $query->with('lang')->where('is_hidden',0);
                        })
                        ->whereNotIn('cat_id', $block_cats)
                        ->whereNotIn('id', $result_units_ids)
                        ->where('is_hidden', 0)
                        ->whereHas('lang', function($query) use ($search_item) {
                            $query->where('name', 'LIKE', '%'.$search_item.'%');
                        }
                    )->get();

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
                        $response['count'] ++;
                        $response['specialists'][] = self::build_search_specialist($specialist, $search);
                    }

                    foreach ($units as $unit) {
                        $result_units_ids[] = $unit->id;
                        $response['count'] ++;
                        if (in_array($unit->cat_id, $services_cats)) {
                            $response['services'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $news_cats)) {
                            $response['news'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $articles_cats)) {
                            $response['articles'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $actions_cats)) {
                            $response['actions'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $equipments_cats)) {
                            $response['equipments'][] = self::build_search_unit($unit, $search);
                        } else {
                            $response['units'][] = self::build_search_unit($unit, $search_item);
                        }
                    }
                }
                foreach ($search_array as $search_item) {
                    $units = Unit::with('lang')->whereHas('category', function ($query) {
                            $query->with('lang')->where('is_hidden',0);
                        })
                        ->whereNotIn('cat_id', $block_cats)
                        ->whereNotIn('id', $result_units_ids)
                        ->where('is_hidden', 0)
                        ->whereHas('lang', function($query) use ($search_item) {
                            $query->where(function($query) use ($search_item){
                                $query->where('long_desc_1', 'LIKE', '%'.$search_item.'%')->orWhere('long_desc_2', 'LIKE', '%'.$search_item.'%');
                            });
                        }
                    )->get();

                    $specialists = Specialist::with('lang')->where('is_hidden', 0)->whereNotIn('id', $result_specialists_ids)->whereHas('lang', function($query) use ($search_item) {
                        $query->where(function($query) use ($search_item){
                            $query->where('long_desc_1', 'LIKE', '%'.$search_item.'%')->orWhere('long_desc_2', 'LIKE', '%'.$search_item.'%');
                        });
                    })->get();
        
                    foreach ($specialists as $specialist) {
                        $result_specialists_ids[] = $specialist->id;
                        $response['count'] ++;
                        $response['specialists'][] = self::build_search_specialist($specialist, $search);
                    }
                    foreach ($units as $unit) {
                        $result_units_ids[] = $unit->id;
                        $response['count'] ++;
                        if (in_array($unit->cat_id, $services_cats)) {
                            $response['services'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $news_cats)) {
                            $response['news'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $articles_cats)) {
                            $response['articles'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $actions_cats)) {
                            $response['actions'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $equipments_cats)) {
                            $response['equipments'][] = self::build_search_unit($unit, $search);
                        } else {
                            $response['units'][] = self::build_search_unit($unit, $search_item);
                        }
                    }
                }
            }
            $search_array = [];
            $_search_array = explode(" ", $search);
            foreach ($_search_array as &$search_item) {
                if (mb_strlen($search_item) > 6) {
                    $search_item = mb_substr(mb_substr($search_item, 1), 0, -2);
                    $search_array[] = $search_item;
                } elseif (mb_strlen($search_item) > 5) {
                    $search_item = mb_substr(mb_substr($search_item, 1), 0, -1);
                    $search_array[] = $search_item;
                } elseif (mb_strlen($search_item) > 4) {
                    $search_item = mb_substr($search_item, 0, -1);
                    $search_array[] = $search_item;
                } elseif (mb_strlen($search_item) > 2) {
                    $search_array[] = $search_item;
                }
            }
            if (!empty($search_array)) {
                foreach ($search_array as $search_item) {
                    $units = Unit::with('lang')->whereHas('category', function ($query) {
                            $query->with('lang')->where('is_hidden',0);
                        })
                        ->whereNotIn('cat_id', $block_cats)
                        ->whereNotIn('id', $result_units_ids)
                        ->where('is_hidden', 0)
                        ->whereHas('lang', function($query) use ($search_item) {
                            $query->where('name', 'LIKE', '%'.$search_item.'%');
                        }
                    )->get();

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
                        $response['count'] ++;
                        $response['specialists'][] = self::build_search_specialist($specialist, $search);
                    }
                    foreach ($units as $unit) {
                        $result_units_ids[] = $unit->id;
                        $response['count'] ++;
                        if (in_array($unit->cat_id, $services_cats)) {
                            $response['services'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $news_cats)) {
                            $response['news'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $articles_cats)) {
                            $response['articles'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $actions_cats)) {
                            $response['actions'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $equipments_cats)) {
                            $response['equipments'][] = self::build_search_unit($unit, $search);
                        } else {
                            $response['units'][] = self::build_search_unit($unit, $search_item);
                        }
                    }
                }
                foreach ($search_array as $search_item) {
                    $units = Unit::with('lang')->whereHas('category', function ($query) {
                            $query->with('lang')->where('is_hidden',0);
                        })
                        ->whereNotIn('cat_id', $block_cats)
                        ->whereNotIn('id', $result_units_ids)
                        ->where('is_hidden', 0)
                        ->whereHas('lang', function($query) use ($search_item) {
                            $query->where(function($query) use ($search_item){
                                $query->where('long_desc_1', 'LIKE', '%'.$search_item.'%')->orWhere('long_desc_2', 'LIKE', '%'.$search_item.'%');
                            });
                        }
                    )->get();

                    $specialists = Specialist::with('lang')->where('is_hidden', 0)->whereNotIn('id', $result_specialists_ids)->whereHas('lang', function($query) use ($search_item) {
                        $query->where(function($query) use ($search_item){
                            $query->where('long_desc_1', 'LIKE', '%'.$search_item.'%')->orWhere('long_desc_2', 'LIKE', '%'.$search_item.'%');
                        });
                    })->get();
        
                    foreach ($specialists as $specialist) {
                        $result_specialists_ids[] = $specialist->id;
                        $response['count'] ++;
                        $response['specialists'][] = self::build_search_specialist($specialist, $search);
                    }
                    foreach ($units as $unit) {
                        $result_units_ids[] = $unit->id;
                        $response['count'] ++;
                        if (in_array($unit->cat_id, $services_cats)) {
                            $response['services'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $news_cats)) {
                            $response['news'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $articles_cats)) {
                            $response['articles'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $actions_cats)) {
                            $response['actions'][] = self::build_search_unit($unit, $search_item);
                        } elseif (in_array($unit->cat_id, $equipments_cats)) {
                            $response['equipments'][] = self::build_search_unit($unit, $search);
                        } else {
                            $response['units'][] = self::build_search_unit($unit, $search_item);
                        }
                    }
                }
            }
        }
        if ($unset_top_price) {
            unset($response['goods_fields'][2]);
        }
        return View::make('pages.search_page', $response);
    }

    public static function build_search_unit($unit, $search, $segment='') {
        $response = [
            'name'             => str_ireplace($search, '<b>'.$search.'</b>', $unit->lang->name),
            'cat_name'         => $unit->category->lang->name,
            'cat_id'           => $unit->category->id,
            'short_desc_1'     => str_ireplace($search, '<b>'.$search.'</b>', mb_strtolower($unit->lang->short_desc_1)),
            'short_desc_2'     => str_ireplace($search, '<b>'.$search.'</b>', mb_strtolower($unit->lang->short_desc_2)),
            'date_publication' => ($unit->date_publication != '') ? $unit->date_publication->format('d.m.Y') : NULL,
            'is_outer_href'    => ($unit->is_short_unit == 1) ? 1 : 0,
            'cover'            => self::_build_img($unit->img_1, 'unit'),
        ];
        if ($unit->is_short_unit == 1) {
            $response['href'] = build_unit_route($unit);
            $response['href_segments'] = [];

        } else {
            if ($segment != '') {
                if ($segment == 'services') {
                    $response['href'] = build_unit_route($unit);
                    $response['href_segments'] = [
                        'segment_1'  => $segment,
                        'segment_2'  => $unit->category->alias,
                        'segment_3'  => $unit->alias,
                    ];
                } else {
                    $response['href'] = build_unit_route($unit);
                    $response['href_segments'] = [
                        'segment_1'  => $segment,
                        'segment_2'  => $unit->alias,
                    ];
                }
            } else {
                $response['href'] = build_unit_route($unit);
                $response['href_segments'] = [
                    'segment_1'  => $unit->alias,
                ];
            }
        }
        return $response;
    }

    public static function build_search_specialist($unit, $search, $segment='') {
        $response = [
            'name'             => str_ireplace($search, '<b>'.$search.'</b>', $unit->lang->last_name.' '.$unit->lang->first_name.' '.$unit->lang->father_name),
            'short_desc_1'     => str_ireplace($search, '<b>'.$search.'</b>', mb_strtolower($unit->lang->short_desc_1)),
            'short_desc_2'     => str_ireplace($search, '<b>'.$search.'</b>', mb_strtolower($unit->lang->short_desc_2)),
            'date_publication' => ($unit->date_publication != '') ? $unit->date_publication->format('d.m.Y') : NULL,
            'is_outer_href'    => ($unit->is_short_unit == 1) ? 1 : 0,
            'cover'            => self::_build_img($unit->img_1, 'specialist'),
        ];
        if ($unit->is_short_unit == 1) {
            $response['href'] = build_expert_route($unit->alias);
            $response['href_segments'] = [];

        } else {
            if ($segment != '') {
                if ($segment == 'services') {
                    $response['href'] = build_expert_route($unit->alias);
                    $response['href_segments'] = [
                        'segment_1'  => $segment,
                        'segment_2'  => 'expert',
                        'segment_3'  => $unit->alias,
                    ];
                } else {
                    $response['href'] = build_expert_route($unit->alias);
                    $response['href_segments'] = [
                        'segment_1'  => $segment,
                        'segment_2'  => $unit->alias,
                    ];
                }
            } else {
                $response['href'] = build_expert_route($unit->alias);
                $response['href_segments'] = [
                    'segment_1'  => $unit->alias,
                ];
            }
        }
        return $response;
    }

    public static function _build_img($source, $type) {
        switch ($type) {
            case 'unit':
                if ($source != '') {
                    $img = $source;
                    $path_to_folder = \Config::get('app')['url'].'/storage/units/small';
                } else {
                    $img = app('units_params')->noimage_units;
                    $path_to_folder = \Config::get('app')['url'].'/storage/noimage/units/units/small';
                }
                break;
            case 'category':
                if ($source != '') {
                    $img = $source;
                    $path_to_folder = \Config::get('app')['url'].'/storage/units/categories/small';
                } else {
                    $img = app('units_params')->noimage_cats;
                    $path_to_folder = \Config::get('app')['url'].'/storage/noimage/units/cats/small';
                }
                break;
            case 'unit_video':
                if ($source != '') {
                    $img = $source;
                    $path_to_folder = \Config::get('app')['url'].'/storage/units/video_posters';
                } else {
                    $img = app('units_params')->noimage_units;
                    $path_to_folder = \Config::get('app')['url'].'/storage/noimage/units/units/small';
                }
                break;
            case 'review':
                if ($source != '') {
                    $img = $source;
                    $path_to_folder = \Config::get('app')['url'].'/storage/leads/files';
                } else {
                    $img = app('units_params')->noimage_units;
                    $path_to_folder = \Config::get('app')['url'].'/storage/noimage/units/units/small';
                }
                break;
            case 'market_category':
                if ($source != '') {
                    $img = $source;
                    $path_to_folder = \Config::get('app')['url'].'/storage/market/categories/small';
                } else {
                    $img = app('market_params')->noimage_market_cats;
                    $path_to_folder = \Config::get('app')['url'].'/storage/noimage/market/cats/small';
                }
                break;
            case 'specialist':
                if ($source != '') {
                    $img = $source;
                    $path_to_folder = \Config::get('app')['url'].'/storage/specialists/covers/small';
                } else {
                    $img = app('specialists_params')->noimage_covers;
                    $path_to_folder = \Config::get('app')['url'].'/storage/noimage/specialists/covers/small';
                }
                break;
        }
        $ext = substr($img, strrpos($img, ".") + 1);
        $image = [
            'path_to_folder' => $path_to_folder,
            'filename'       => $img,
            'filename_webp'  => str_replace($ext, "webp", $img)
        ];
        return $image;
    }
}
