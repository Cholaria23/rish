<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class FooterComposer {
    public function compose(View $view) {
    	$footer_data = [];
        $view->with('footer_data', $footer_data);        
    }
}