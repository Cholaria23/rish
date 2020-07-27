<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
class ViewComposerServiceProvider extends ServiceProvider {
    public function boot() {
        view()->composer("layouts.main.wrapper","App\Http\ViewComposers\WrapperComposer");
        view()->composer("layouts.main.slider","App\Http\ViewComposers\SliderComposer");
        view()->composer("layouts.main.header","App\Http\ViewComposers\HeaderComposer");
        view()->composer("layouts.main.footer","App\Http\ViewComposers\FooterComposer");
        view()->composer("layouts.main.checkup","App\Http\ViewComposers\CheckComposer");
        view()->composer("layouts.main.advantages","App\Http\ViewComposers\AdvantagesComposer");
    }
    public function register() {

    }
}