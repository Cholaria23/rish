<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class CheckComposer {
    public function compose(View $view) {
        $checkup = \Demos\AdminPanel\Unit::with('lang')->where('is_hidden',0)->find(6);
        $view->with('checkup', $checkup);        
    }
}