<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
class ViewComposerServiceProvider extends ServiceProvider {
    public function boot() {
        view()->composer("layouts.main.wrapper","App\Http\ViewComposers\WrapperComposer");
        view()->composer("layouts.main.slider","App\Http\ViewComposers\SliderComposer");
        view()->composer("layouts.main.header","App\Http\ViewComposers\HeaderComposer");
        view()->composer("layouts.main.footer","App\Http\ViewComposers\FooterComposer");
    }
    public function register() {

    }
}