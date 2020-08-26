<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use \View;
use \Hash;
use \App;
use \Config;
use \Session;
use \Lang;
use \Response;
use \URL;
use \Mail;
use \Cookie;
use \Auth;
use \Cart;
use \Demos\AdminPanel\Unit;
use \Demos\AdminPanel\Cat;
use \Demos\AdminPanel\FormType;
use \Demos\AdminPanel\Lead;
use \Demos\AdminPanel\LeadFile;
use \Demos\Market\MarketCat;
use \Demos\Market\Good;
use \Demos\Market\MarketChar;
use \Demos\Market\MarketCharVal;
use \Demos\AdminPanel\User;
use \Demos\Market\Order;
use \Demos\Market\Brand;
use \Demos\Market\BrandSeries;

class ServiceController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request) {
		$this->request = $request;
	}

    public function postLoadFile() {
        // Decode base64 data
        $file_name = [];
        if(isset($this->request->get('data')['file_0']) && $this->request->get('data')['file_0'] != '' ){
            $file_name [] = $this->uploadFile($this->request->get('data')['file_0']);
        }
        if(isset($this->request->get('data')['file_1']) && $this->request->get('data')['file_1'] != '' ){
            $file_name [] = $this->uploadFile($this->request->get('data')['file_1']);
        }
        if(isset($this->request->get('data')['file_2']) && $this->request->get('data')['file_2'] != '' ){
            $file_name [] = $this->uploadFile($this->request->get('data')['file_2']);
		}
		if(isset($this->request->get('data')['file_3']) && $this->request->get('data')['file_3'] != '' ){
            $file_name [] = $this->uploadFile($this->request->get('data')['file_3']);
		}
		if(isset($this->request->get('data')['file_4']) && $this->request->get('data')['file_4'] != '' ){
            $file_name [] = $this->uploadFile($this->request->get('data')['file_4']);
		}
		if(isset($this->request->get('data')['file_5']) && $this->request->get('data')['file_5'] != '' ){
            $file_name [] = $this->uploadFile($this->request->get('data')['file_5']);
		}
		if(isset($this->request->get('data')['file_6']) && $this->request->get('data')['file_6'] != '' ){
            $file_name [] = $this->uploadFile($this->request->get('data')['file_6']);
        }
		return Response::make(['success'=>200,'file_name' => $file_name]);
    }

    public function postSend() {
        $data_req = $this->request->get('data');
        $subj = $this->request->get('subj');
        $_token = $this->request->get('_token');
        parse_str($data_req, $data);
        if(isset($data['lang']) && $data['lang'] != ''){
            App::setLocale($data['lang']);
        }
        $lang = App::getLocale();
        try {
            $form_type = FormType::with(['accounts' => function ($query) {
                $query->where('is_banned', 0)->where('email', '!=', '');
            }])->where('alias', $subj)->firstOrFail();
			$data['form_type'] = $form_type;
            $save_data['user_first_name'] = (isset($data['name']) && $data['name'] != '') ? $data['name'] : '';
            $save_data['user_email'] = (isset($data['email']) && $data['email'] != '') ? $data['email'] : '';
            $save_data['user_phone'] = (isset($data['phone']) && $data['phone'] != '') ? $data['phone'] : '';
            $save_data['user_ip'] = isset($_SERVER['HTTP_X_REAL_IP']) ? $_SERVER['HTTP_X_REAL_IP'] : $_SERVER['REMOTE_ADDR'];
            $save_data['content'] = (isset($data['content']) && $data['content'] != '') ? $data['content'] : '';
            $save_data['content'] .= (isset($data['date_birth']) && $data['date_birth'] != '') ? "<br>".Lang::get('main.year_birth')." ".$data['date_birth'] : '';
            $save_data['content'] .= (isset($data['date']) && $data['date'] != '') ? "<br>".Lang::get('main.data_text')." ".$data['date'] : '';
            $save_data['content'] .= (isset($data['messenger']) && $data['messenger'] != '') ? "<br>".Lang::get('main.consultation_platform')." ".$data['messenger'] : '';
            if(isset($data['unit_id'])){
				$data['unit'] = Unit::with('lang')->find($data['unit_id']);
            }
            if(isset($data['good_id'])){
				$data['good'] = Good::with('lang')->find($data['good_id']);
            }
            if(isset($data['url'])){
                $save_data['page_url'] = $data['url'];
            }
            if(isset($data['title'])){
                $save_data['page_title'] = $data['title'];
			}
			if(isset($data['rating'])){
                $save_data['rating'] = $data['rating'];
            }
            $save_data['form_type_id'] = $form_type->id;

            $lead = new Lead();
            $lead->fill($save_data);
			$lead->save();

			if (isset($data['cat_id']) && $data['cat_id'] != '') {
				$lead->cats()->attach($data['cat_id']);
			}

			if (isset($data['unit_id']) && $data['unit_id'] != '') {
				$lead->units()->attach($data['unit_id']);
			}

			if (isset($data['market_cat_id']) && $data['market_cat_id'] != '') {
				$lead->market_cats()->attach($data['market_cat_id']);
			}

			if (isset($data['good_id']) && $data['good_id'] != '') {
				$lead->goods()->attach($data['good_id']);
			}

			if (isset($data['specialist_id']) && $data['specialist_id'] != '') {
				$lead->specialists()->attach($data['specialist_id']);
			}

			if($this->request->has('file')){
				$files = $this->request->get('file');
				if(count($files)){
					foreach($files as $file){
						$lead_file = new LeadFile();
						$save_data_file['url'] = $file;
						$save_data_file['lead_id'] = $lead->id;
						$save_data_file['type'] = 'image';
						$save_data_file['is_hidden'] = 0;
						$lead_file->fill($save_data_file);
						$lead_file->save();
					}
				}
			}

			if($form_type->accounts->count()){
                foreach ($form_type->accounts as $account) {
                    if($account->email != '') {
                        Mail::send('mail.'.$subj, $data, function ($message) use ($account, $form_type, $lang) {
                            $message->subject($form_type->lang_name[$lang]);
                            $message->from($form_type->back_email, $form_type->lang_sender[$lang]);
                            $message->to($account->email);
                        });
                    }
                }
            }
            if(isset($data['email']) && $data['email'] != ''){
                Mail::send('mail.'.$subj.'_client', $data, function ($message) use ($data, $form_type, $lang) {
                    $message->subject($form_type->lang_name[$lang]);
                    $message->from($form_type->back_email, $form_type->lang_sender[$lang]);
                    $message->to($data['email']);
                });
            }

        } catch (Exception $e) {
            return Response::make($e->getMessage(), 500);
        }
        return Response::make(['status' => 'ok'], 200);
    }

	public function postReloadTopCart() {
		$result['top'] = View::make('pages.catalog.top_cart')->render();
		return  json_encode($result);
	}

	public function postReloadOrderCart() {
		$lang = $this->request->get('lang');
		App::setlocale(isset($lang)?$lang:App::getLocale());

		$result['body'] = View::make('pages.catalog.cart_reload')->render();
		return  json_encode($result);
	}

	public function postReloadGoodOrder() {
		$lang = $this->request->get('lang');
		$good_id = $this->request->get('good_id');
		App::setlocale(isset($lang)?$lang:App::getLocale());
		try {
			$good = Good::with('lang')->findOrFail($good_id);
            $gift_ids = [];
			$gift_arr = [];

			if ($good->c_action_price && $good->c_action_price != 0 && $good->c_action_price <$good->c_price){
				$price = $good->c_action_price;
			}else{
				$price = $good->c_price;
			}
			$cart = array(
					'id' => $good->id,
					'quantity' => 1,
					'name' => $good->lang->name,
					'price' => $price,
					'attributes' => array(
						'img' =>  $good->img_1 != '' ? $good->img_1 : '',
						'alias' => $good->alias != '' ? $good->alias : '',
						'article' => $good->article != '' ? $good->article : '',
						'name_cat' => $good->category->lang->name,
						'code' => $good->code != '' ? $good->code : '',
                        'c_price' => $good->c_price,
                        'c_action_price' => $good->c_action_price,
						'gift_arr' => $gift_arr,
						)
					);
				Cart::add($cart);


            $cart_ids = [];
    		foreach (Cart::getContent() as $tmp_arr) {
    			if ($tmp_arr->id == $good->id) {
    				$good->quantity = $tmp_arr->quantity;
    				$good->rowid = $tmp_arr->rowid;
    				$good->subtotal = $tmp_arr->getPriceSum();
    			}
                $cart_ids [] = $tmp_arr->id;
    		}

        } catch (Exception $e) {
            return Response::make($e->getMessage(), 500);
		}
		return View::make('pages.catalog.good_order_info', array(
            'good' => $good,
            'cart_ids' => isset($cart_ids) ? $cart_ids : false,
			));
	}

	public function postShowGoodOrder () {
        $lang = $this->request->get('lang');
        $good_id = $this->request->get('good_id');
        App::setlocale(isset($lang)?$lang:App::getLocale());
        try {
            $good = Good::with('lang')->findOrFail($good_id);
            $gift_ids = [];

            $gift_arr = [];


            if ($good->c_action_price && $good->c_action_price != 0 && $good->c_action_price <$good->c_price){
                $price = $good->c_action_price;
            }else{
                $price = $good->c_price;
            }
            $cart = array(
                    'id' => $good->id,
                    'quantity' => 1,
                    'name' => $good->lang->name,
                    'price' => $price,
                    'attributes' => array(
                        'img' =>  $good->img_1 != '' ? $good->img_1 : '',
                        'alias' => $good->alias != '' ? $good->alias : '',
                        'article' => $good->article != '' ? $good->article : '',
                        'name_cat' => $good->category->lang->name,
                        'code' => $good->code != '' ? $good->code : '',
                        'c_price' => $good->c_price,
                        'c_action_price' => $good->c_action_price,
                        'gift_arr' => $gift_arr,
                        )
                    );
                // Cart::add($cart);


			$cart_ids = [];
            foreach (Cart::getContent() as $tmp_arr) {
                if ($tmp_arr->id == $good->id) {
                    $good->quantity = $tmp_arr->quantity;
                    $good->rowid = $tmp_arr->rowid;
                    $good->subtotal = $tmp_arr->getPriceSum();
                }
                $cart_ids [] = $tmp_arr->id;
            }

        } catch (Exception $e) {
            return Response::make($e->getMessage(), 500);
        }
        return View::make('pages.catalog.show_order_info', array(
            'good' => $good,
            'cart_ids' => isset($cart_ids) ? $cart_ids : false,
        ));
	}

	public function postRemoveCart() {
		$rowid = $this->request->get('good_id');
		try {

			Cart::remove($rowid);

		} catch (Exception $e) {
			return Response::make($e->getMessage(), 500);
		}
		return Response::make("success", 200);

	}

	public function postUpdateCart() {
		$rowid = $this->request->get('good_id');
		$quantity = $this->request->get('count');
		$cart = Cart::get($rowid);

		if ($quantity < 1) {
			Cart::remove($rowid);
		} else {
			try {
				$good = Good::with("price")->findOrFail($cart->id);

				Cart::update($rowid, array('quantity' => [
					'relative' => false,
					'value' => $quantity])
				);

			} catch (Exception $e) {
				return Response::make($e->getMessage(), 500);
			}
		}

		$cart = Cart::get($rowid);
		$response = array(
			"result" => "success",
			"subtotal" => $cart->price * $quantity,
			"total" => Cart::getTotal(),
			"count" => Cart::getTotalQuantity()
		);
		return Response::json($response);
	}

	public function postCheckOrder() {
		if(Cart::count() >= 1){
			return Response::make("success", 200);
		} else {
			return Response::make("empty_cart", 500);
		};

	}

	public function postDoOrder() {
        if(!Cart::getTotalQuantity()) {
            return Response::make('empty_cart', 200);
        } else {
            try {
                $data_req = $this->request->get('data');
                parse_str($data_req, $data);
                if(isset($data['lang']) && $data['lang'] != ''){
                    App::setLocale($data['lang']);
                }
                $lang = App::getLocale();

                $cart = Cart::getContent();

                $order = New Order;


                $order->delivery_id = isset($data['delivery']) && $data['delivery'] != '' ? $data['delivery'] : '';
                $order->payment_id = isset($data['payment']) && $data['payment'] != '' ? $data['payment'] : '';
                $order->phone = isset($data['phone']) && $data['phone'] != '' ? $data['phone'] : '';
                $order->email = isset($data['email']) && $data['email'] != '' ? $data['email'] : '';
                $order->last_name = isset($data['lastname']) && $data['lastname'] != '' ? $data['lastname'] : '';
                $order->first_name = isset($data['name']) && $data['name'] != '' ? $data['name'] : '';
                $order->father_name = isset($data['father_name']) && $data['father_name'] != '' ? $data['father_name'] : '';
                $order->note = isset($data['content']) && $data['content'] != '' ? $data['content'] : '';
                $order->post_number = isset($data['unit']) && $data['unit'] != '' ? $data['unit'] : '';
                $order->city = isset($data['city']) && $data['city'] != '' ? $data['city'] : '';
                $order->street = isset($data['street']) && $data['street'] != '' ? $data['street'] : '';
                $order->building = isset($data['building']) && $data['building'] != '' ? $data['building'] : '';
                $order->room = isset($data['room']) && $data['room'] != '' ? $data['room'] : '';

                $order->save();
                $data['order_id'] = $order->id;

                foreach ($cart as $row) {
                    $order->goods()->attach($row->id,['order_id' => $order->id, 'price' => $row->price, 'count' => $row->quantity, 'curr_id' => app('main_curr')->id]);
				}

				$data['order_delivery'] = $order->delivery()->first();
				$data['order_payment'] = $order->payment()->first();
				$form_type = FormType::with(['accounts' => function ($query) {
					$query->where('is_banned', 0)->where('email', '!=', '');
				}])->where('alias', 'market_order')->firstOrFail();
				if($form_type->accounts->count()){
					foreach ($form_type->accounts as $account) {
						Mail::send('mail.order.manager', $data, function ($message) use ($account, $form_type, $lang) {
							$message->subject($form_type->lang_name[$lang]);
							$message->from($form_type->back_email, $form_type->lang_sender[$lang]);
							$message->to($account->email);
						});
					}
				}
				if(isset($data['email']) && $data['email'] != ''){
					Mail::send('mail.order.client', $data, function ($message) use ($data, $form_type, $lang) {
						$message->subject($form_type->lang_name[$lang]);
						$message->from($form_type->back_email, $form_type->lang_sender[$lang]);
						$message->to($data['email']);
					});
				}

            } catch (Exception $e) {
                return Response::make($e->getMessage(), 500);
            }
        }
		Cart::clear();
		return Response::make('ok', 200);
	}

	public function postFastOrder() {
		try {
			$data_req = $this->request->get('data');
			parse_str($data_req, $data);
			if(isset($data['lang']) && $data['lang'] != ''){
				App::setLocale($data['lang']);
			}
			$lang = App::getLocale();

			$good = Good::with('lang')->findOrFail($data['good_id']);
			if ($good->c_action_price && $good->c_action_price != 0 && $good->c_action_price <$good->c_price){
				$data['price'] = $good->c_action_price;
				$good->email_price = $good->c_action_price;
			}else{
				$data['price'] = $good->c_price;
				$good->email_price = $good->c_price;
			}

			$order = New Order;

			$order->phone = isset($data['phone']) && $data['phone'] != '' ? $data['phone'] : '';
			$order->first_name = isset($data['name']) && $data['name'] != '' ? $data['name'] : '';
			$order->save();
			$data['order_id'] = $order->id;
			$data['count'] = 1;

			$order->goods()->attach($good->id,['order_id' => $order->id, 'price' => $data['price'], 'count' => $data['count'], 'curr_id' => app('main_curr')->id]);

			$data['good'] = $good;

			$form_type = FormType::with(['accounts' => function ($query) {
                $query->where('is_banned', 0)->where('email', '!=', '');
            }])->where('alias', 'market_order')->firstOrFail();
			if($form_type->accounts->count()){
				foreach ($form_type->accounts as $account) {
					Mail::send('mail.order.fast_manager', $data, function ($message) use ($account, $form_type, $lang) {
						$message->subject(Lang::get('order_email.fast_order'));
						$message->from($form_type->back_email, $form_type->lang_sender[$lang]);
						$message->to($account->email);
					});
				}
			}

		} catch (Exception $e) {
			return Response::make($e->getMessage(), 500);
		}
		// Cart::destroy();
		return Response::make('ok', 200);
	}

    public function postSetCompare() {
		$data['good_id']      = $this->request->get('good_id');
		$data['cat_id']  = $this->request->get('good_cat');
		$good = Good::with('lang')->findOrFail($data['good_id']);
		$good_ids = Cookie::get('good_id');

			$good_ids .= '-'.$data['good_id'];

		$cat_ids = Cookie::get('cat_id');

			$cat_ids .= '-'.$data['cat_id'];

		Cookie::queue('cat_id', $cat_ids, 7200);
		Cookie::queue('good_id', $good_ids, 7200);
		$comp_arr = array_unique(explode('-', $good_ids));
		$compare_icon_ids = $comp_arr;
		$result['id'] = $data['good_id'];
		$result['compare'] = View::make('layouts.main.header_compare_icon', [
			'updated_ids' => $compare_icon_ids
		])->render();
		$result['icon'] = View::make('layouts.main.good_compare_icon', [
			'updated_ids' => $compare_icon_ids,
			'good' => $good,
			])->render();
		return Response::JSON([
			"ok"=> 200,
			'result' => $result,
		]);

	}
	public function postDelCompare() {
		$data['good_id']      = $this->request->get('good_id');
		$data['cat_id']  = $this->request->get('good_cat');
		$good = Good::with('lang')->findOrFail($data['good_id']);
		$good_ids = Cookie::get('good_id');

			$good_ids .= '-'.$data['good_id'];

			$compare_arr = explode('-', $good_ids);

				$compare_arr = array_flip($compare_arr); //Меняем местами ключи и значения
				unset ($compare_arr[$data['good_id']]) ; //Удаляем элемент массива
				$compare_arr = array_flip($compare_arr); //Меняем местами ключи и значения

			$good_ids = implode('-',$compare_arr);

		Cookie::queue('good_id', $good_ids, 7200);

		$comp_arr = array_unique(explode('-', $good_ids));
		$compare_icon_ids = $comp_arr;

		$result['id'] = $data['good_id'];
		$result['compare'] = View::make('layouts.main.header_compare_icon', [
			'updated_ids' => $compare_icon_ids
		])->render();
		$result['icon'] = View::make('layouts.main.good_compare_icon', [
			'updated_ids' => $compare_icon_ids,
			'good' => $good,
			])->render();

		return Response::JSON([
			"ok"=> 200,
			'result' => $result,
		]);
	}

	/**
	 *
	 * Wishlist
	 *
	**/
	public function postAddWishList() {
		$data = $this->request->all();
		$data['lang'] = isset($data['lang']) ? $data['lang'] : App::getLocale();
		try {
			$user = User::find(Auth::guard('web')->user()->id);
			$good_id = $data['good_id'];
			$wish_list = new \Demos\Market\Wishlist();
			$wish_list->name = $data['wish_list'];
			$user->wishlists()->save($wish_list);
			$wish_list->goods()->attach($good_id);
			$wish_list_count = 0;
			$user_list = User::with('wishlists.goods')->find(Auth::guard('web')->user()->id);
			if($user_list->wishlists->count()){
				foreach($user_list->wishlists as $wishlist){
					$wish_list_count += $wishlist->goods->count();
				}
			}
			$good = Good::with('lang')->find($data['good_id']);
			$wish_list_view = View::make('pages.catalog.wishlist', [
				'user' => $user,
				'good' => $good,
			])->render();
		} catch (Exception $e) {
			return Response::make($e->getMessage(), 500);
		}
		return Response::JSON([
			"ok"=> 200,
			'wish_list_view' => $wish_list_view,
			'wish_count' => $wish_list_count,
		]);
	}

	public function postAddGoodToWishList() {
		$data = $this->request->all();
		$data['lang'] = isset($data['lang']) ? $data['lang'] : App::getLocale();
		try {
			$user = User::find(Auth::guard('web')->user()->id);
			$good_id = $data['good_id'];
			$list_id = $data['list_id'];
			$wish_list = \Demos\Market\Wishlist::find($list_id);
			$wish_list->goods()->attach($good_id);
			$wish_list_count = 0;
			$user_list = User::with('wishlists.goods')->find(Auth::guard('web')->user()->id);
			if($user_list->wishlists->count()){
				foreach($user_list->wishlists as $wishlist){
					$wish_list_count += $wishlist->goods->count();
				}
			}
			$good = Good::with('lang')->find($data['good_id']);
			$wish_list_view = View::make('pages.catalog.wishlist', [
				'user' => $user,
				'good' => $good,
			])->render();
		} catch (Exception $e) {
			return Response::make($e->getMessage(), 500);
		}
		return Response::JSON([
			"ok"=> 200,
			'wish_list_view' => $wish_list_view,
			'wish_count' => $wish_list_count
		]);
	}

	public function postAddGoodInListToWishList() {
		$data = $this->request->all();
		$data['lang'] = isset($data['lang']) ? $data['lang'] : App::getLocale();
		try {
			if(Auth::guard('web')->check()) {
				$user = User::find(Auth::guard('web')->user()->id);
				$good_id = $data['good_id'];

				if(!isset($data['list_id'])) {
					$wish_list = $user->wishlists()->first();
				} else {
					$list_id = $data['list_id'];
					$wish_list = \Demos\Market\Wishlist::find($list_id);
				}

				if(!$wish_list) {
					$wish_list = new \Demos\Market\Wishlist();
					$wish_list->name = 'Лист';
					$user->wishlists()->save($wish_list);
				}

				$wish_list->goods()->attach($good_id);
			}
		} catch (Exception $e) {
			return Response::make($e->getMessage(), 500);
		}
		$wish_list_count = 0;
		$wishlist_icon_ids = [];
		$user_list = User::with('wishlists.goods')->find(Auth::guard('web')->user()->id);
		if($user_list->wishlists->count()){
			foreach($user_list->wishlists as $wishlist){
				$wish_list_count += $wishlist->goods->count();
				$wishlist_icon_ids = array_merge($wishlist_icon_ids,$wishlist->goods->pluck('id')->toArray());
			}
		}
		$good = Good::find($data['good_id']);
		$result['id'] = $data['good_id'];
		$result['wishlist'] = View::make('layouts.main.header_wishlist_icon', [
			'updated_ids' => $wishlist_icon_ids
		])->render();
		$result['icon'] = View::make('layouts.main.good_wishlist_icon', [
			'updated_ids' => $wishlist_icon_ids,
			'good' => $good,
			])->render();
		return Response::JSON([
			"ok"=> 200,
			"result" => $result,
			'wish_count' => $wish_list_count
		]);
	}

	public function postEditWishList() {
		$data = $this->request->all();

		$user = User::find(Auth::guard('web')->user()->id);
		$lists = $user->wishlists()->pluck('id')->toArray();

		if ( in_array($data['id'], $lists) ){
			$list = \Demos\Market\Wishlist::find($data['id']);
			$list->$data['field'] = $data['value'];
			if ( $list->save() )
				return Response::make("ok", 200);
		}
	}

	public function postRemoveWishList() {
		$data = $this->request->all();

		$user = User::find(Auth::guard('web')->user()->id);
		$lists = $user->wishlists()->pluck('id')->toArray();

		if ( in_array($data['id'], $lists) ){
			$list = \Demos\Market\Wishlist::find($data['id']);
			if ( $list->delete() )
				return Response::make("ok", 200);
		}
	}

	public function postRemoveWishGood() {
		$data = $this->request->all();
		try {
			$user = User::find(Auth::guard('web')->user()->id);

			if(!isset($data['list_id'])) {
				$wish_list = $user->wishlists()->first();
			} else {
				$list_id = $data['list_id'];
				$wish_list = \Demos\Market\Wishlist::find($list_id);
			}
			$wish_list_count = 0;
			$wishlist_icon_ids = [];
			$wish_list->goods()->detach($data['good_id']);
			if($user->wishlists->count()){
				foreach($user->wishlists as $wishlist){
					$wish_list_count += $wishlist->goods->count();
					$wishlist_icon_ids = array_merge($wishlist_icon_ids,$wishlist->goods->pluck('id')->toArray());
				}
			}
			$good = Good::find($data['good_id']);
			$result['id'] = $data['good_id'];
			$result['wishlist'] = View::make('layouts.main.header_wishlist_icon', [
				'updated_ids' => $wishlist_icon_ids
			])->render();
			$result['icon'] = View::make('layouts.main.good_wishlist_icon', [
				'updated_ids' => $wishlist_icon_ids,
				'good' => $good,
				])->render();
		} catch (Exception $e) {
			return Response::make($e->getMessage(), 500);
		}
		return  Response::JSON([
			"ok"=> 200,
			"result" => $result,
			'wish_count' => $wish_list_count
		]);


	}

	public function postLoadMoreLeads(){
		$data['good_id']      = $this->request->get('good_id');
		$take_for_load_leads   = $this->request->get('take_for_load_leads');
		$data['offset']       = $this->request->get('offset',0);

		$good = Good::where('id', '=', $data['good_id'])->with([
			"leads" => function ($query) use ($data,$take_for_load_leads) {
				$query->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc')->skip($data['offset'] )
				->take($take_for_load_leads)
				->get();
			}
			])->first();

		$leads_service_count = $good->leads()->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc')->count() - $take_for_load_leads;
		$result['leads_render'] = View::make('pages.catalog.load_leads', [
			'good' => $good,
			'offset' => $data['offset']
		])->render();

		$result['default_count'] = ($leads_service_count - $data['offset'] < $take_for_load_leads) ? $leads_service_count - $data['offset'] : $take_for_load_leads;
		$result['remaining_count'] = $leads_service_count - $data['offset'];

		return  json_encode($result);
	}

	public function postLoadMoreGoods () {
		$data = $this->request->all();
		if(isset($data['lang']) && $data['lang'] != ''){
            App::setLocale($data['lang']);
        }
		$lang = App::getLocale();
		$input = json_decode(str_replace('&quot;', '"', $this->request->get('input', [])),true);
		$_filters = (isset($input['filter'])) ? $input['filter'] : [];
		$_brands  = (isset($input['brand'])) ? $input['brand'] : [];
		$_series   = (isset($input['series'])) ? $input['series'] : [];
		$_prices_filt   = (isset($input['prices_filt'])) ? $input['prices_filt'] : [];
		$_type = isset($input['type']) ?  $input['type'] : '';
		$_sort = isset($input['sort']) ?  $input['sort'] : '';

		if(isset($data['brand_id']) && $data['brand_id'] != '') {

			$query = $this->good
                    ->with([
                        'lang',
                        'price',
                        'category.lang',
                        "leads" => function ($query) {
                            $query->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc');
                        }
                    ])
                    ->where('is_archive', '=', '0')
                    ->where('market_goods.is_hidden', '=', '0')
                    ->where('brand_id', $data['brand_id']);


			//  price start filter
			$query_price_goods = clone $query;
			$prices_collect = $query_price_goods->where(function($query) {
				$query->whereHas('price', function($query) {
					$query->join('market_currs as curr', 'curr.id', '=', 'curr_id')->whereRaw("value * curr.rate");
				});
			})->get();
			$price_filter['min'] = '';
			$price_filter['max'] = '';
			if($prices_collect->count()){
				foreach($prices_collect as $tmp_price){
					if ($tmp_price->c_action_price && $tmp_price->c_action_price != 0 && $tmp_price->c_action_price < $tmp_price->c_price){
						$tmp_price->c_filter_price = $tmp_price->c_action_price;
					} else {
						$tmp_price->c_filter_price = $tmp_price->c_price;
					}
				}
				$price_filter['min'] = $prices_collect->min('c_filter_price');
				$price_filter['max'] = $prices_collect->max('c_filter_price');
			}

			$_filter_prices = $_prices_filt;
			if (!empty($_filter_prices) ) {
				if ($_filter_prices['min'] == ''){
					$_filter_prices['min'] = 0;
				}
				if ($_filter_prices['max'] == ''){
					$_filter_prices['max'] = $prices_collect->max('c_filter_price');
				}
				$active_filters['price_min'] = $_filter_prices['min'];
				$active_filters['price_max'] = $_filter_prices['max'];

				$query->where(function($query) use ($_filter_prices) {
					if ($_filter_prices['min'] OR $_filter_prices['max']) {
						$query->whereHas('price', function($query) use ($_filter_prices) {
							$query->join('market_currs as curr', 'curr.id', '=', 'curr_id')
							->whereRaw("value * curr.rate between ".($_filter_prices['min'] -0.01)." and ".($_filter_prices['max'] +0.01 ))
							->whereHas('type', function ($query) {
								$query->where(function ($query) {
									$query->where(function($query) {
										$query
										->where(function($query) {
										$query
											->whereRaw("date_start IS NOT NULL AND date_end IS NOT NULL")
											->where('date_start', '<', \DB::raw('NOW()'))
											->where('date_end', '>', \DB::raw('NOW()'));
										})
										->orWhereRaw("date_start IS NULL AND date_end IS NULL");
									});
									$query->where('is_action',1);
								})->orWhere('is_main',1);
							});
						});
					}
				});
			}
			if($_sort){
				$sort = $_sort;
				switch ($sort) {
					case 'price_asc':
						$query->selectRaw('market_goods.*')
							->join('market_prices as mp', 'mp.good_id', '=', 'market_goods.id')
							->join('market_currs as mcurr', 'mp.curr_id', '=', 'mcurr.id')
							->where('mp.value', '!=', 0)
							->groupBy('market_goods.id')
							->orderByRaw("if (mp.value='' OR mp.value is null,0,1) DESC")
							->orderByRaw('(mp.value * mcurr.rate) asc');
					break;
					case 'price_desc':
						$query->selectRaw('market_goods.*')
							->join('market_prices as mp', 'mp.good_id', '=', 'market_goods.id')
							->join('market_currs as mcurr', 'mp.curr_id', '=', 'mcurr.id')
							->where('mp.value', '!=', 0)
							->groupBy('market_goods.id')
							->orderByRaw("if (mp.value='' OR mp.value is null,0,1) DESC")
							->orderByRaw('(mp.value * mcurr.rate) desc');
					break;

					case 'remains':
						$query->where('remains','>','0');
					break;
					case 'new_asc':
						$query->orderBy('is_new','desc');
					break;
					case 'top_asc':
						$query->orderBy('is_top','desc');
					break;
				}
			}

		} elseif(isset($data['series_id']) && $data['series_id'] != '') {

			$query = $this->good
                    ->with([
                        'lang',
                        'price',
                        'category.lang',
                        "leads" => function ($query) {
                            $query->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc');
                        }
                    ])
                    ->where('is_archive', '=', '0')
                    ->where('market_goods.is_hidden', '=', '0')
                    ->where('brand_series_id', $data['series_id']);


			//  price start filter
			$query_price_goods = clone $query;
			$prices_collect = $query_price_goods->where(function($query) {
				$query->whereHas('price', function($query) {
					$query->join('market_currs as curr', 'curr.id', '=', 'curr_id')->whereRaw("value * curr.rate");
				});
			})->get();
			$price_filter['min'] = '';
			$price_filter['max'] = '';
			if($prices_collect->count()){
				foreach($prices_collect as $tmp_price){
					if ($tmp_price->c_action_price && $tmp_price->c_action_price != 0 && $tmp_price->c_action_price < $tmp_price->c_price){
						$tmp_price->c_filter_price = $tmp_price->c_action_price;
					} else {
						$tmp_price->c_filter_price = $tmp_price->c_price;
					}
				}
				$price_filter['min'] = $prices_collect->min('c_filter_price');
				$price_filter['max'] = $prices_collect->max('c_filter_price');
			}

			$_filter_prices = $_prices_filt;
			if (!empty($_filter_prices) ) {
				if ($_filter_prices['min'] == ''){
					$_filter_prices['min'] = 0;
				}
				if ($_filter_prices['max'] == ''){
					$_filter_prices['max'] = $prices_collect->max('c_filter_price');
				}
				$active_filters['price_min'] = $_filter_prices['min'];
				$active_filters['price_max'] = $_filter_prices['max'];

				$query->where(function($query) use ($_filter_prices) {
					if ($_filter_prices['min'] OR $_filter_prices['max']) {
						$query->whereHas('price', function($query) use ($_filter_prices) {
							$query->join('market_currs as curr', 'curr.id', '=', 'curr_id')
							->whereRaw("value * curr.rate between ".($_filter_prices['min'] -0.01)." and ".($_filter_prices['max'] +0.01 ))
							->whereHas('type', function ($query) {
								$query->where(function ($query) {
									$query->where(function($query) {
										$query
										->where(function($query) {
										$query
											->whereRaw("date_start IS NOT NULL AND date_end IS NOT NULL")
											->where('date_start', '<', \DB::raw('NOW()'))
											->where('date_end', '>', \DB::raw('NOW()'));
										})
										->orWhereRaw("date_start IS NULL AND date_end IS NULL");
									});
									$query->where('is_action',1);
								})->orWhere('is_main',1);
							});
						});
					}
				});
			}
			if($_sort){
				$sort = $_sort;
				switch ($sort) {
					case 'price_asc':
						$query->selectRaw('market_goods.*')
							->join('market_prices as mp', 'mp.good_id', '=', 'market_goods.id')
							->join('market_currs as mcurr', 'mp.curr_id', '=', 'mcurr.id')
							->where('mp.value', '!=', 0)
							->groupBy('market_goods.id')
							->orderByRaw("if (mp.value='' OR mp.value is null,0,1) DESC")
							->orderByRaw('(mp.value * mcurr.rate) asc');
					break;
					case 'price_desc':
						$query->selectRaw('market_goods.*')
							->join('market_prices as mp', 'mp.good_id', '=', 'market_goods.id')
							->join('market_currs as mcurr', 'mp.curr_id', '=', 'mcurr.id')
							->where('mp.value', '!=', 0)
							->groupBy('market_goods.id')
							->orderByRaw("if (mp.value='' OR mp.value is null,0,1) DESC")
							->orderByRaw('(mp.value * mcurr.rate) desc');
					break;

					case 'remains':
						$query->where('remains','>','0');
					break;
					case 'new_asc':
						$query->orderBy('is_new','desc');
					break;
					case 'top_asc':
						$query->orderBy('is_top','desc');
					break;
				}
			}

		} elseif(isset($data['cat_id']) && $data['cat_id'] != '') {
			$cat = MarketCat::where('id', '=', $data['cat_id'])->with([
                'lang',
                'rel_goods',
				'children' => function ($query){
					$query->with(['lang', 'children' => function ($query){
						$query->with('lang')->where('is_hidden',0)->orderBy('sort_order','asc');
					}])->where('is_hidden',0)->orderBy('sort_order','asc');
				}])->first();

			$descendants = array_merge(MarketCat::descendants($cat->id), [$cat->id]);
			$ancestors = array_merge(MarketCat::ancestors($cat->id), [$cat->id]);

			$rel_ids = $cat->rel_goods->pluck('id')->toArray();

			$query = Good::with('lang', 'price','category.lang')
				->where('is_archive', '=', '0')
				->where('market_goods.is_hidden', '=', '0')
				->where(function($query) use($descendants, $rel_ids) {
					$query->whereIn('cat_id', $descendants)->orWhereIn('id', $rel_ids);
				})
				->orderBy('spec_option_1','desc');

			if(!$_sort || ($_sort && $_sort == 'default') || ($_sort && $_sort == null)){
				$query->CatSorting($cat->id);
			}

			if($_type && $_type == 'sale'){
				$select_arr = [];
				$arr = \DB::select('select g.id from market_goods as g, market_prices as p where g.id = p.good_id and p.price_type_id = 2 and p.value > 0
				union all
				select g.id from market_goods as g, market_goods_actions as a where g.id = a.good_id and NOW() BETWEEN ifnull( a.start, NOW()) and ifnull(a.end, NOW())');
				if(count($arr)){
					foreach($arr as $item_arr){
						$select_arr[] = $item_arr->id;
					}
					$select_arr = array_unique($select_arr);
				}
				$query->whereIn('market_goods.id',$select_arr);
			}

			$query_all_goods = clone $query;
			$all_goods_ids = $query_all_goods->pluck('id')->toArray();

			if($cat->is_tag == 0) {
				$tag_rel_type_id = 5;

				$tag_categori_ids = [];
				$tag_categori_ids = \DB::table('market_cats_relations')->where('rel_type_id', $tag_rel_type_id)->whereIn('good_id', $all_goods_ids)->pluck('cat_id');
				$cat->tag_categories =  MarketCat::with('lang')->whereIn('id',$tag_categori_ids)->orderBy('sort_order','asc')->get();
			}
			$query_count = clone $query;
			$count_goods = $query_count->count();
			$active_filters['filters'] = [];
			if(!empty($_filters)){
				$query->filter($_filters);
				$active_filters['filters'] = MarketCharVal::with('lang', 'char')->whereIn('id', $_filters)->get();

			}

			//  price start filter
			$query_price_goods = clone $query;
			$prices_collect = $query_price_goods->where(function($query) {
				$query->whereHas('price', function($query) {
					$query->join('market_currs as curr', 'curr.id', '=', 'curr_id')->whereRaw("value * curr.rate");
				});
			})->get();

			$price_filter['min'] = '';
			$price_filter['max'] = '';
			if($prices_collect->count()){
				foreach($prices_collect as $tmp_price){
					if ($tmp_price->c_action_price && $tmp_price->c_action_price != 0 && $tmp_price->c_action_price < $tmp_price->c_price){
						$tmp_price->c_filter_price = $tmp_price->c_action_price;
					} else {
						$tmp_price->c_filter_price = $tmp_price->c_price;
					}
				}
				$price_filter['min'] = $prices_collect->min('c_filter_price');
				$price_filter['max'] = $prices_collect->max('c_filter_price');
			}

			$_filter_prices = $_prices_filt;
			if (!empty($_filter_prices) ) {
				if ($_filter_prices['min'] == ''){
					$_filter_prices['min'] = 0;
				}
				if ($_filter_prices['max'] == ''){
					$_filter_prices['max'] = $prices_collect->max('c_filter_price');
				}
				$active_filters['price_min'] = $_filter_prices['min'];
				$active_filters['price_max'] = $_filter_prices['max'];

				$query->where(function($query) use ($_filter_prices) {
					if ($_filter_prices['min'] OR $_filter_prices['max']) {
						$query->whereHas('price', function($query) use ($_filter_prices) {
							$query->join('market_currs as curr', 'curr.id', '=', 'curr_id')
							->whereRaw("value * curr.rate between ".($_filter_prices['min'] -0.01)." and ".($_filter_prices['max'] +0.01 ))
							->whereHas('type', function ($query) {
								$query->where(function ($query) {
									$query->where(function($query) {
										$query
										->where(function($query) {
										$query
											->whereRaw("date_start IS NOT NULL AND date_end IS NOT NULL")
											->where('date_start', '<', \DB::raw('NOW()'))
											->where('date_end', '>', \DB::raw('NOW()'));
										})
										->orWhereRaw("date_start IS NULL AND date_end IS NULL");
									});
									$query->where('is_action',1);
								})->orWhere('is_main',1);
							});
						});
					}
				});
			}
			$query_ids = clone $query;
			$_good_ids = $query_ids->pluck('id');
			$brand_ids = $query->distinct()->pluck('brand_id');
			$series_ids = $query->distinct()->pluck('brand_series_id');
			$brands = Brand::with([
				'lang',
				'goods' => function ($query) use($descendants, $rel_ids,$_good_ids) {
					$query->with('lang')->where(function ($query) use($descendants,$rel_ids,$_good_ids){
						$query->where(function ($query) use($descendants,$rel_ids,$_good_ids) {
							$query->whereIn('market_goods.id',$_good_ids)->orWhereIn('market_goods.id',$rel_ids)/*->orWhereIn('cat_id',$descendants)*/;
						})->groupBy('market_goods.id')->get();
					})->where('is_archive',0)->where('is_hidden',0);
				},
				"series" => function ($query) use($descendants, $series_ids, $rel_ids,$_good_ids) {
					$query->with([
						'lang',
						'goods' => function ($query) use($descendants, $rel_ids,$_good_ids) {
							$query->with('lang')->where(function ($query) use($descendants,$rel_ids,$_good_ids){
								$query->where(function ($query) use($descendants,$rel_ids,$_good_ids) {
									$query->whereIn('market_goods.id',$_good_ids)->orWhereIn('market_goods.id',$rel_ids)/*->orWhereIn('cat_id',$descendants)*/;
								})->groupBy('market_goods.id')->get();
							})->where('is_archive',0)->where('is_hidden',0);
						}
					])->whereIn("id",$series_ids)->where('is_hidden',0)->orderBy('sort_order','asc');
				}
			])->whereIn('id',$brand_ids)->get();
			// $_brands = $this->request->get('brand', []);
			$active_filters['brands'] = [];

			if(!empty($_brands)){
				$query->whereIn('brand_id',$_brands);
				$active_filters['brands'] = Brand::with('lang')->whereIn('id', $_brands)->get();

			}

			$series_ids = $query->distinct()->pluck('brand_series_id');
			$series = BrandSeries::with(['lang', 'goods' => function ($query) use($descendants, $rel_ids) {
				$query->with('lang')->where(function ($query) use($descendants,$rel_ids){
					$query->whereIn('cat_id',$descendants)->orWhereIn('market_goods.id',$rel_ids)->groupBy('market_goods.id')->get();
				})->where('is_archive',0)->where('is_hidden',0);
			}])->whereIn('id',$series_ids)->whereIn('brand_id',$this->request->get('brand', []))->get();

			$active_filters['series'] = [];

			if(!empty($_series)){
				$query->whereIn('brand_series_id',$_series);
				$active_filters['series'] = BrandSeries::with('lang')->whereIn('id', $_series)->get();

			}

			if($_sort){
				$sort = $_sort;
				switch ($sort) {
					case 'price_asc':
						$query->selectRaw('market_goods.*')
							->join('market_prices as mp', 'mp.good_id', '=', 'market_goods.id')
							->join('market_currs as mcurr', 'mp.curr_id', '=', 'mcurr.id')
							->where('mp.value', '!=', 0)
							->groupBy('market_goods.id')
							->orderByRaw("if (mp.value='' OR mp.value is null,0,1) DESC")
							->orderByRaw('(mp.value * mcurr.rate) asc');
					break;
					case 'price_desc':
						$query->selectRaw('market_goods.*')
							->join('market_prices as mp', 'mp.good_id', '=', 'market_goods.id')
							->join('market_currs as mcurr', 'mp.curr_id', '=', 'mcurr.id')
							->where('mp.value', '!=', 0)
							->groupBy('market_goods.id')
							->orderByRaw("if (mp.value='' OR mp.value is null,0,1) DESC")
							->orderByRaw('(mp.value * mcurr.rate) desc');
					break;

					case 'remains':
						$query->where('remains','>','0');
					break;
					case 'new_asc':
						$query->orderBy('is_new','desc');
					break;
					case 'top_asc':
						$query->orderBy('is_top','desc');
					break;
				}
			}
		}


		$take_count = $this->request->get('take_goods');

		$_g = $query->get();
		$goods_service_count =  $_g->count() - $take_count;

		$goods = $query->selectRaw('market_goods.*')
				->with([
                    'lang',
                    'price',
                    'category.lang',
                    "leads" => function ($query) {
                        $query->where('is_hidden',0)->where('parent_id',null)->orderBy('created_at','desc');
                    }
            ])
				->skip($this->request->get('offset',0))
				->take($take_count)
				->get();


		$result['goods_render'] = View::make('pages.catalog.load_goods', [
			'goods' => $goods,
			'offset' => $this->request->get('offset',0),
		// 	'input' => $input
		])->render();
		$result['default_count'] = Lang::choice('main.more_goods',$goods_service_count - $this->request->get('offset',0) < $take_count? $goods_service_count - $this->request->get('offset',0) : $take_count, ["load_count" => $goods_service_count - $this->request->get('offset',0) < $take_count? $goods_service_count - $this->request->get('offset',0) : $take_count]);
		$result['remaining_count'] = $goods_service_count - $this->request->get('offset',0);

		return  json_encode($result);
	}

    /**
     * Registration cabinet
     */
    public function postRegister() {
        $data_req = $this->request->get('data');
        parse_str($data_req, $data);
		$data['lang'] = isset($data['lang']) ? $data['lang'] : App::getLocale();
		try {
            $deleted_user = \Demos\AdminPanel\User::where("email", "=", $data['email'])->where('deleted_at', '!=', NULL)->withTrashed()->first();

            if($deleted_user){
                $data['password'] = str_random(5);
                $deleted_user->password = Hash::make($data['password']);
                $deleted_user->deleted_at = null;
                $deleted_user->save();

                $params = Config::get('mail.from');
                $data['sender'] = $params['name'];
                $data['back_email'] = $params['address'];

                Mail::send('mail.client_registration', $data, function($message) use($data) {
                    $message->subject("Регистрация");
                    $message->from($data['back_email'], $data['sender']);
                    $message->to($data['email']);
                });
                return Response::make("deleted", 200);

            }

            $user = \Demos\AdminPanel\User::where("email", "=", $data['email'])->where('deleted_at', NULL)->first();

			if (!$user) {
				$data['password'] = str_random(5);
				$user = new \Demos\AdminPanel\User(array(
                    'email' => $data['email'],
					'login' => $data['email'],
					'password' => Hash::make($data['password']),
					'hash' => $data['password'],
					'lang' => $data['lang'],
					)
				);
				$user->save();

                $params = Config::get('mail.from');
				$data['sender'] = $params['name'];
				$data['back_email'] = $params['address'];

				Mail::send('mail.client_registration', $data, function($message) use($data) {
					$message->subject("Регистрация");
					$message->from($data['back_email'], $data['sender']);
					$message->to($data['email']);
				});
			} else {
				return Response::make("email", 200);
			}
		} catch (Exception $e) {
			return Response::make($e->getMessage(), 500);
		}

		if ( Auth::guard('web')->attempt(array('email' => $data['email'], 'password' => $data['password'])) ) {
			return Response::make("success", 200);
		}
    }

    public function postPassword() {
        $data_req = $this->request->get('data');
        parse_str($data_req, $data);
		try {
			$user = User::where("email", "=", $data['email'])->first();
			if ($user) {
				$data['password'] = str_random(5);
				$data['email'] = $user->email;
                $user->password = Hash::make($data['password']);
				$user->hash = $data['password'];
				$user->save();

				$params = Config::get('mail.from');
				$data['sender'] = $params['name'];
				$data['back_email'] = $params['address'];

				Mail::send('mail.client_restore_password', $data, function($message) use($data) {
					$message->subject("Сброс пароля");
					$message->from($data['back_email'], $data['sender']);
					$message->to($data['email']);
				});

			} else {
				return Response::make("no_email", 200);
			}

		} catch (Exception $e) {
			return Response::make($e->getMessage(), 500);
		}
		return Response::make("success", 200);
    }

    public function postLogin() {
        $data_req = $this->request->get('data');
        parse_str($data_req, $data);
		try {
			if ( Auth::guard('web')->attempt(array('email' => $data['email'], 'password' => $data['password'])) ) {
				return Response::make("success", 200);
			} else {
				return Response::make("wrong_pass", 200);
			}

		} catch (Exception $e) {
			return Response::make($e->getMessage(), 500);
		}
		return Response::make("success", 200);

    }

    public function postLogout() {
		try {
			Auth::logout();
		} catch (Exception $e) {
			return Response::make($e->getMessage(), 500);
		}
		return Response::make("success", 200);

    }

    public function postSaveUserPassword() {
		$data_req = $this->request->get('data');
		parse_str($data_req, $data_pass);

		$user = User::find(Auth::guard('web')->user()->id);

		if ( Auth::guard('web')->attempt(array('email' => Auth::guard('web')->user()->email, 'password' => $data_pass['old_password'])) ) {
			$user->password = Hash::make($data_pass['password']);

			try {
				$user->save();
			} catch (Exception $e) {
				return Response::make("error", 500);
			}

			return Response::make("success", 200);

		} else {
			return Response::make('wrong_password', 200);
		}
    }

    public function postSaveUser() {
		$data = $this->request->get('data');
        $user = User::find(Auth::guard('web')->user()->id);
        $field = $data['field'];
		$value = $data['value'];
		if($field == 'email'){
			if(User::where('login', '=', $value)->exists()) {
				return Response::make("email", 200);
			}
			$user->login = $value;
		}
		$user->$field = $value;
		if ( $user->save() )
			return Response::make("ok", 200);
	}

	public function postFillUserFields () {
		if (Auth::guard('web')->check()) {
			$user = User::find(Auth::guard('web')->user()->id);
			$phone = '';
			if($user->phone_1 != ''){
				$phone = $user->phone_1;
			} elseif ($user->phone_2 != '') {
				$phone = $user->phone_2;
			}
			$response = array(
				"status" => "exist",
				"firstname" => $user->first_name,
				"lastname" => $user->last_name,
				"fathername" => $user->father_name,
				"name" => $user->first_name,
				"email" => $user->email,
				"phone" => $phone,
				"city" => $user->city,
				"street" => $user->street,
				"building" => $user->building,
				"room" => $user->room,
			);
		} else {
			$response = array(
				"status" => "not_exist"
			);
		}
		return Response::make(json_encode($response), 200);
	}

	public function postTypeahead () {
		$query = htmlspecialchars($this->request->get('query'));
		$this->request->get('lang') ? App::setLocale($this->request->get('lang')) : '';
		$goods_result = Good::search($query, 'db_goods_names_'.App::getLocale(),  null);
		$names = '';
		if($goods_result){
            $goods = Good::with('lang')
				->whereIn('market_goods.id', array_keys($goods_result['matches']))->limit(20)->get();
			$lang_data = array_pluck($goods->toArray(), 'lang');
			$names = array_pluck($lang_data, 'name');
		}
		return Response::json($names);
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function closeCookie(Request $request) {
        $request->session()->put('cookie_shown', TRUE);
        return Response::make(['status' => 'ok'], 200);
	}

	private function uploadFile ($file) {
        list($type, $data) = explode(';', $file);
		list(, $data) = explode(',', $data);
		$file_data = base64_decode($data);
		// Get file mime type
		$finfo = finfo_open();
		$file_mime_type = finfo_buffer($finfo, $file_data, FILEINFO_MIME_TYPE);
		// File extension from mime type
        switch ($file_mime_type) {
            case 'image/jpeg':
                $file_type = 'jpeg';
                break;
            case 'image/jpg':
                $file_type = 'jpg';
                break;
            case 'image/png':
                $file_type = 'png';
                break;
            case 'image/gif':
                $file_type = 'gif';
                break;
            case 'application/pdf':
                $file_type = 'pdf';
                break;
            case 'text/plain':
                $file_type = 'txt';
                break;
            case 'application/msword':
                $file_type = 'doc';
                break;
            case 'application/vnd.ms-excel':
                $file_type = 'xls';
                break;
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                $file_type = 'docx';
                break;
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                $file_type = 'xlsx';
                break;
            case 'application/vnd.oasis.opendocument.spreadsheet':
                $file_type = 'ods';
                break;
            case 'application/vnd.oasis.opendocument.text':
                $file_type = 'odt';
                break;
            case 'application/rtf':
                $file_type = 'rtf';
                break;
            default:
                $file_type = 'other';
                break;
        }
        // Set a unique name to the file and save
        $file_name = uniqid() . '.' . $file_type;
        $file_path = "./storage/leads/files/" . $file_name;
        file_put_contents($file_path, $file_data);
        switch ($file_type) {
            case 'jpg':
            case 'png':
            case 'jpeg':
            case 'gif':
                $file_url = '<a target="_blank" href="'.$file_path.'"><img style="max-width:300px;" src="'.$file_path.'" alt="" class="img-responsive"></a>';
                break;
            default:
                $file_url= '<a target="_blank" href="'.$file_path.'">Файл пользователя - '.$file_path.'</a>';
            break;
                break;
        }
        return $file_name;
    }
}
?>
