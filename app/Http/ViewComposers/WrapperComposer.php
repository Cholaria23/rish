<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class WrapperComposer {
    public function compose(View $view) {
        $all_specialists = \Demos\AdminPanel\Specialist::with('lang')->where('is_hidden',0)->where('is_block',0)->orderBy('sort_order','desc')->get();
        $view->with([
            'seo' => \Demos\AdminPanel\Seo::first(),
            'all_specialists' => $all_specialists,
        ]);        
    }
}