<?php
if (!function_exists('build_brand_link')) {
    function build_brand_link($alias) {
        return 'brands/'.$alias;
    }
}
if (!function_exists('build_series_link')) {
    function build_series_link($series) {
        return 'brands/'.$series->brand->alias.'/'.$series->alias;
    }
}

if (!function_exists('build_price')) {
    function build_price($price)
    {
        return number_format($price, 2, ',', ' ');
    }
}
if (!function_exists('my_mb_ucfirst')) {
    function my_mb_ucfirst($str) {
        $fc = mb_strtoupper(mb_substr($str, 0, 1));
        return $fc.mb_substr($str, 1);
    }
}

if (!function_exists('get_action_flag')) {
	function get_action_flag($good) {
		$good->action_flag = false;
		if(!empty($good->related_action_units)){
			foreach($good->related_action_units as $unit_action){
				if($unit_action->start == null && $unit_action->end == null){
					$good->action_flag = true;
				} elseif($unit_action->start == null && strtotime($unit_action->end) > time()) {
					$good->action_flag = true;
				} elseif(strtotime($unit_action->start) < time() && strtotime($unit_action->end) > time()){
					$good->action_flag = true;
				} else {
				}
			}
		}
		if(!empty($good->category->related_action_units)){
			foreach($good->category->related_action_units as $unit_action){
				if($unit_action->start == null && $unit_action->end == null){
					$good->action_flag = true;
				} elseif($unit_action->start == null && strtotime($unit_action->end) > time()) {
					$good->action_flag = true;
				} elseif(strtotime($unit_action->start) < time() && strtotime($unit_action->end) > time()){
					$good->action_flag = true;
				} else {
				}
			}
		}
		return $good;
	}
}
if (!function_exists('getMarketFilters')) {
	function getMarketFilters($cat_id,$filter_ids,$good_ids=[]) {
		$ancestors = array_merge(\Demos\Market\MarketCat::ancestors($cat_id), [$cat_id]);
        $descendants = array_merge(\Demos\Market\MarketCat::descendants($cat_id), [$cat_id]);
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

if (!function_exists('build_unit_route')) {
    function build_unit_route($unit) {
        if($unit->is_short_unit == 1 && $unit->short_link != '') {
            $url = "#";
            if (substr($unit->short_link,0,4) != 'http') {
                $url = "http://".$unit->short_link;
            } else {
                $url = $unit->short_link;
            }
            return $url;
        } elseif($unit->category->alias == 'html') {
            return route('first_url',[$unit->alias]);
        }else{
            return route('second_url',[$unit->category->alias,$unit->alias]);;
        }
    }
}

if (!function_exists('build_cat_route')) {
    function build_cat_route($alias) {

		if(app('market_params')->cat_url_prefix == ''){
			return route('first_url',[$alias]);
		} elseif($alias == 'prices') {
			return route('first_url',[$alias]);
        } else {
			return route('market_cat_url',[$alias]);
		}
    }
}

if (!function_exists('build_good_route')) {
    function build_good_route($alias) {

		if(app('market_params')->good_url_prefix == ''){
			return route('first_url',[$alias]);
		} else {
			return route('market_good_url',[$alias]);
		}
    }
}
