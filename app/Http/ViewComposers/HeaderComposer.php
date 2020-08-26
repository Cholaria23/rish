<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class HeaderComposer {
    public function compose(View $view) {
        $about_company = \Demos\AdminPanel\Unit::with('lang')->where('is_hidden',0)->find(3);
        $checkup = \Demos\AdminPanel\Unit::with('lang')->where('is_hidden',0)->find(6);
        $contacts = \Demos\AdminPanel\Unit::with('lang')->where('is_hidden',0)->find(2);
        $reviews = \Demos\AdminPanel\Unit::with('lang')->where('is_hidden',0)->find(4);
        $online_consultation = \Demos\AdminPanel\Unit::with('lang')->where('is_hidden',0)->find(5);
        
        $actions = \Demos\AdminPanel\Cat::with('lang')->where('is_hidden',0)->find(17);
        $specialists = \Demos\AdminPanel\Cat::with('lang')->where('is_hidden',0)->find(5);
        $equipment = \Demos\AdminPanel\Cat::with('lang')->where('is_hidden',0)->find(7);

        $services_top = \Demos\AdminPanel\Cat::with('lang')->whereIn('id',\Demos\AdminPanel\Cat::descendants(4))->where('spec_option_1',1)->where('is_hidden',0)->orderBy('sort_order','asc')->get();

        $services = \Demos\AdminPanel\Cat::with([
                'lang',
                'children' => function ($query) {
                    $query->with([
                        'lang',
                        'children' => function ($query) {
                            $query->with('lang')->where('is_hidden',0)->orderBy('sort_order','asc');
                        }
                    ])->where('is_hidden',0)->orderBy('sort_order','asc');
                }
            ])->where('is_hidden',0)->find(4);

        $prices = \Demos\Market\MarketCat::with('lang')->where('is_hidden',0)->find(2);

    	$header_data = [
            'about_company' => $about_company,
            'checkup' => $checkup,
            'contacts' => $contacts,
            'reviews' => $reviews,
            'online_consultation' => $online_consultation,
            'actions' => $actions,
            'specialists' => $specialists,
            'equipment' => $equipment,
            'services_top' => $services_top,
            'services' => $services,
            'prices' => $prices,
        ];
        $view->with('header_data', $header_data);
    }
}
