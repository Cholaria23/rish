<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class AdvantagesComposer {
    public function compose(View $view) {
        $advantages = \Demos\AdminPanel\Unit::with('lang')->whereHas('category', function($query){
            $query->where('cat_id', 6);
        })->where('is_hidden',0)->whereRaw('IF (is_period = 1, start < NOW(),  1=1 )')->whereRaw('IF (is_period = 1,  (end > NOW() || end is null),  1=1)')->orderBy('sort_order','desc')->get();

        $view->with('advantages', $advantages);        
    }
}