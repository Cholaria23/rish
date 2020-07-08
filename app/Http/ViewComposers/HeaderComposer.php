<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class HeaderComposer {
    public function compose(View $view) {
    	$header_data = [];
        $view->with('header_data', $header_data);        
    }
}