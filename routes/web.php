<?php

if (strpos(Request::path(), '//')) {
    header('Location: '.str_replace("http:/", "http://", str_replace("//", "/", Request::fullUrl())));
    die();
}
if(Request::get('page') == 1){
    // var_dump(Request::path());
    header('Location: ' . URL::to(Request::path()), TRUE, 301);
    exit();
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('service')->group(function () {
    Route::get('/close-cookie', 'ServiceController@closeCookie')->name('service.closeCookie');
    Route::post('/post-send', 'ServiceController@postSend')->name('service.postSend');
    Route::post('/post-load-file', 'ServiceController@postLoadFile')->name('service.postLoadFile');
    Route::post('/post-fill-user-fields', 'ServiceController@postFillUserFields')->name('service.postFillUserFields');
    Route::post('/post-set-compare', 'ServiceController@postSetCompare')->name('service.postSetCompare');
    Route::post('/post-del-compare', 'ServiceController@postDelCompare')->name('service.postDelCompare');
    // CABINET
    Route::post('/post-register', 'ServiceController@postRegister')->name('service.postRegister');
    Route::post('/post-password', 'ServiceController@postPassword')->name('service.postPassword');
    Route::post('/post-save-user', 'ServiceController@postSaveUser')->name('service.postSaveUser');
    Route::post('/post-login', 'ServiceController@postLogin')->name('service.postLogin');
    Route::post('/post-logout', 'ServiceController@postLogout')->name('service.postLogout');
    Route::post('/post-save-user-password', 'ServiceController@postSaveUserPassword')->name('service.postSaveUserPassword');
    // LOAD LEADS
    Route::post('/post-load-more-leads', 'ServiceController@postLoadMoreLeads')->name('service.postLoadMoreLeads');
    // LOAD GOODS
    Route::post('/post-load-more-goods', 'ServiceController@postLoadMoreGoods')->name('service.postLoadMoreGoods');
    Route::post('/post-get-typeahead', 'ServiceController@postGetTypeahead')->name('service.postGetTypeahead');
    Route::post('/post-typeahead', 'ServiceController@postTypeahead')->name('service.postTypeahead');
    // WISHLIST
    Route::post('/post-add-wishlist', 'ServiceController@postAddWishList')->name('service.postAddWishList');
    Route::post('/post-add-good-to-wishlist', 'ServiceController@postAddGoodToWishList')->name('service.postAddGoodToWishList');
    Route::post('/post-add-good-in-list-to-wishlist', 'ServiceController@postAddGoodInListToWishList')->name('service.postAddGoodInListToWishList');
    Route::post('/post-edit-wishlist', 'ServiceController@postEditWishList')->name('service.postEditWishList');
    Route::post('/post-remove-wishlist', 'ServiceController@postRemoveWishList')->name('service.postRemoveWishList');
    Route::post('/post-remove-wish-good', 'ServiceController@postRemoveWishGood')->name('service.postRemoveWishGood');
    // CART
    Route::post('/post-reload-top-cart', 'ServiceController@postReloadTopCart')->name('service.postReloadTopCart');
    Route::post('/post-reload-good-order', 'ServiceController@postReloadGoodOrder')->name('service.postReloadGoodOrder');
    Route::post('/post-reload-order-cart', 'ServiceController@postReloadOrderCart')->name('service.postReloadOrderCart');
    Route::post('/post-show-good-order', 'ServiceController@postShowGoodOrder')->name('service.postShowGoodOrder');
    Route::post('/post-remove-cart', 'ServiceController@postRemoveCart')->name('service.postRemoveCart');
    Route::post('/post-update-cart', 'ServiceController@postUpdateCart')->name('service.postUpdateCart');
    Route::post('/post-check-order', 'ServiceController@postCheckOrder')->name('service.postCheckOrder');
    Route::post('/post-do-order', 'ServiceController@postDoOrder')->name('service.postDoOrder');
    Route::post('/post-fast-order', 'ServiceController@postFastOrder')->name('service.postFastOrder');

});

//заглушки для CKFinder из клинта.
Route::any('/ckfinder/connector', function (){
    return view('errors.404');
})->name('ckfinder_connector');

Route::any('/ckfinder/browser', function (){
    return view('errors.404');
})->name('ckfinder_browser');


Route::group(
[
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
],
function() {
    Route::get('/', 'PageController@index')->name('index');
    Route::get('cabinet/', 'PageController@getCabinet')->name('indexCabinet');
    Route::view('/404/', 'errors.404')->name('404');
    Route::view('/500/', 'errors.500')->name('500');
    Route::get('/catalog/cart/', 'ShopController@getCart')->name('getCart');
    Route::get('/catalog/order/', 'ShopController@getOrder')->name('getOrder');
    Route::get('/catalog/', 'ShopController@showCat')->name('showCat');
    Route::get('brands/', 'ShopController@showBrands')->name('showBrands');
    Route::get('brands/{slug}/', function($slug) {
        if (Demos\Market\Brand::where('alias', '=', $slug)->count() > 0 ) {
            $controller = App::make('App\Http\Controllers\ShopController');
            return $controller->showBrand($slug);
        } else {
            return Redirect::to('404');
        }
    })->name('showBrand');
    Route::get('brands/{slug}/{alias}/', function($slug,$alias) {
        if (Demos\Market\BrandSeries::where('alias', '=', $alias)->count() > 0 ) {
            $controller = App::make('App\Http\Controllers\ShopController');
            return $controller->showSeries($slug,$alias);
        } else {
            return Redirect::to('404');
        }
    });

    Route::get('search/', 'SearchController@showSearch')->name('search');
    if(class_exists(\Demos\Market\MarketServiceProvider::class) && app('market_params')->cat_url_prefix != ''){
        $slash_check = substr(app('market_params')->cat_url_prefix, -1) != '/'? '/':'';
        Route::get(app('market_params')->cat_url_prefix.$slash_check.'{slug}', function($slug){
            if (Demos\Market\MarketCat::where('alias', '=', $slug)->count() > 0 ) {
                $controller = App::make('App\Http\Controllers\ShopController');
                return $controller->showCat($slug);
            } else {
                return Redirect::to('404');
            }
        })->name('market_cat_url');
    }
    if(class_exists(\Demos\Market\MarketServiceProvider::class) && app('market_params')->good_url_prefix != '') {
        $slash_check = substr(app('market_params')->good_url_prefix, -1) != '/'? '/':'';
        Route::get(app('market_params')->good_url_prefix.$slash_check.'{slug}/', function($slug){
            if (Demos\Market\Good::where('alias', '=', $slug)->count() > 0 ) {
                $controller = App::make('App\Http\Controllers\ShopController');
                return $controller->showGood($slug);
            } else {
                return Redirect::to('404');
            }
        })->name('market_good_url');
    }

    Route::get('expert/{slug}/', function($slug) {
        if (Demos\AdminPanel\Specialist::where('alias', '=', $slug)->count() > 0 ) {
            $controller = App::make('App\Http\Controllers\PageController');
            return $controller->showExpert($slug);
        } else {
            return Redirect::to('404');
        }
    })->where([
        'slug' => '[a-zA-Z0-9-_]+'
    ])->name('expert');

    Route::get('{cat}/{slug}/', function($cat, $slug) {
        if (Demos\AdminPanel\Unit::where('alias', '=', $slug)->count() > 0 ) {
            $controller = App::make('App\Http\Controllers\PageController');
            return $controller->showUnit($slug,$cat);
        } else {
            return Redirect::to('404');
        }
    })->name('second_url');

    Route::get('{slug}/', function($slug) {
        if (Demos\AdminPanel\Cat::where('alias', '=', $slug)->count() > 0) {
            $controller = App::make('App\Http\Controllers\PageController');
            return $controller->showCat($slug);
        } elseif (Demos\AdminPanel\Unit::where('alias', '=', $slug)->count() > 0 ) {
            $controller = App::make('App\Http\Controllers\PageController');
            return $controller->showUnit($slug);
        } elseif (class_exists(\Demos\Market\MarketServiceProvider::class) && Demos\Market\MarketCat::where('alias', '=', $slug)->count() > 0 ) {
            $controller = App::make('App\Http\Controllers\ShopController');
            return $controller->showCat($slug);
        }  elseif (class_exists(\Demos\Market\MarketServiceProvider::class) && Demos\Market\Good::where('alias', '=', $slug)->count() > 0 ) {
            $controller = App::make('App\Http\Controllers\ShopController');
            return $controller->showGood($slug);
        } else {
            return Redirect::to('404');
        }
    })->where([
        'slug' => '[a-zA-Z0-9-_]+'
    ])->name('first_url');
});
