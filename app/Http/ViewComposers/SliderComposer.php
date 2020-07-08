<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class SliderComposer {
    public function compose(View $view) {
    	$slider = \Demos\AdminPanel\Slider::first();
    	$slides_query = \Demos\AdminPanel\Slide::where('is_hidden', 0)->with('lang');

    	if ($slider->is_random == 0) {
			$slides_query->orderBy('sort_order', 'desc');
    	} else {
    		$slides_query->inRandomOrder();
    	}    	

    	$slides = $slides_query->get();

    	$slides = $slides->filter(function($item){
    		if ($item->is_period == 0) {
    			return TRUE;
    		} else {    			
    			if ($item->start == '' || $item->start < now()) {
    				if ($item->end == '' || $item->end > now()) {
    					return TRUE;
    				}
    			} else {    				
    				return FALSE;
    			}
    		}
    	});

    	$slider->slides = $slides;
        $view->with('slider', $slider);        
    }
}