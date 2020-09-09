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
        $specialist = \Demos\AdminPanel\Unit::with('lang')->where('is_hidden',0)->find(79);
        $get_there = \Demos\AdminPanel\Unit::with('lang')->where('is_hidden',0)->find(105);
        $answers_questions = \Demos\AdminPanel\Unit::with('lang')->where('is_hidden',0)->find(106);

        $actions = \Demos\AdminPanel\Cat::with('lang')->where('is_hidden',0)->find(17);
        $offers = \Demos\AdminPanel\Cat::with('lang')->where('is_hidden',0)->find(16);
        $articles = \Demos\AdminPanel\Cat::with('lang')->where('is_hidden',0)->find(18);
        $news = \Demos\AdminPanel\Cat::with('lang')->where('is_hidden',0)->find(19);
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
            'specialist' => $specialist,
            'equipment' => $equipment,
            'services_top' => $services_top,
            'services' => $services,
            'prices' => $prices,
            'offers' => $offers,
            'articles' => $articles,
            'news' => $news,
            'get_there' => $get_there,
            'answers_questions' => $answers_questions,
        ];
        $view->with('header_data', $header_data);
    }
}
