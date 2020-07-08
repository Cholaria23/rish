<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class WrapperComposer {
    public function compose(View $view) {
        $view->with('seo', \Demos\AdminPanel\Seo::first());        
    }
}