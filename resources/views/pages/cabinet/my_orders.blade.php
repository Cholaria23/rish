<div class="orders-block" id="tab_orders">
    <h2 class="title-tab-cabinet blue-title mobile-title">@lang('cabinet.tab_menu.my_orders')</h2>
    @if ($user->orders->count())
        <div class='orders-container'>
            @foreach ($user->orders as $order)
                {{-- {{dump($order->status)}} --}}
            <div class='order-outer'>

                <div class="order-top">
                    <div class="order-top--info">
                        <span class="bold">
                            @lang('cabinet.number_order') {{ $order->id }},
                        </span>
                         {{ $order->created_at->format('d.m.Y') }}
                    </div>
                    <div class="order-top--status">
                        @if ($order->status )
                            <span class='status_{{ $order->status_id }}' >
                                 {{-- {{ Lang::get('cabinet.order_status.'.$order->status.'.text')  }} --}}
                                 {{json_decode($order->status['name'],true)[App::getLocale()]}}
                             </span>
                        @else
                            <span class='status_{{ $order->status_id }}' >
                                -
                             </span>
                        @endif
                    </div>
                </div>
                
                @if ($order->goods->count())
                    <div class='order-info'>
                        <div class="order-info-content cart_section order-list-container">
                            {{-- <div class="cart-good-item item-title-block">
                                <div class="cart-good-wrapper">
                                    <div class="cart-good-cover">
                                        @lang('cabinet.good_name')
                                    </div>
                                    <div class="cart-good-info">
                                        <div class="cart-good-quantity">
                                            @lang('cabinet.qty')
                                        </div>
                                        <div class="cart-item-result">
                                            @lang('cabinet.summ'),  {{app('main_curr')->lang->short_name}}
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <?php $goods_count = 0; ?>
                            @foreach ($order->goods as $good)
                                <div class="order-item">
                                    @if(isset($good->img_1) && $good->img_1 != '')
                                        <a class="order-item--img" href="{{build_good_link($good->alias)}}">
                                            <img src="{{good_img('thumb',$good->img_1)}}" alt="{{ $good->lang->name }}" title="{{ $good->lang->name }}">
                                        </a>
                                    @endif
                                    <div class="order-item--info">
                                        <a class="order-item--title"  href="{{build_good_link($good->alias)}}">
                                            {{ $good->lang->name }}
                                        </a>
                                        @if($good->article != '')
                                            <div class="order-item--code">
                                                 @lang('main.cart.product_art_short'): {{ $good->article }}
                                            </div>
                                         @endif
                                    </div>
                                    <div class="order-item--count">
                                        {{ $good->pivot->count }} @lang('cabinet.items')
                                    </div>
                                    <div class="order-item--price">
                                        {{ $good->pivot->price }}{{app('main_curr')->lang->short_name}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="total-box">
                            <div class="order-details">
                                @if ($order->lastname != '')
                                    <div class="order-details--item">
                                        <span class="name-title">@lang('cabinet.personal_data.last_name'):</span>
                                        <span class="name-value">{{ $order->last_name }}</span>
                                    </div>
                                @endif
                                @if ($order->first_name != '')
                                    <div class="order-details--item">
                                        <span class="name-title">@lang('cabinet.personal_data.first_name'):</span>
                                        <span class="name-value">{{ $order->first_name }}</span>
                                    </div>
                                @endif
                                @if ($order->fathername != '')
                                    <div class="order-details--item">
                                        <span class="name-title">@lang('cabinet.personal_data.father_name'):</span>
                                        <span class="name-value">{{ $order->father_name }}</span>
                                    </div>
                                @endif
                                @if ($order->email != '')
                                    <div class="order-details--item">
                                        <span class="name-title">@lang('cabinet.personal_data.email'):</span>
                                        <span class="name-value">{{ $order->email }}</span>
                                    </div>
                                @endif
                                    <div class="order-details--item">
                                        <span class="name-title">@lang('cabinet.personal_data.payment'): </span>
                                        <span class="name-value">
                                             {{json_decode($order->payment['name'],true)[App::getLocale()]}}
                                        </span>
                                    </div>
                                    {{-- <span class="name-title">@lang('main.cart.delivery'): </span>
                                    <span class="name-value">
                                        {{json_decode($order->delivery['name'],true)[App::getLocale()]}}
                                    </span> --}}
                                @if ($order->phone != '')
                                    <div class="order-details--item">
                                        <span class="name-title">@lang('cabinet.personal_data.phone'):</span>
                                        <span class="name-value">{{ $order->phone }}</span>
                                    </div>
                                @endif
                                {{-- @if ($order->delivery != 'self' && $order->delivery != 'self_bar')
                                    <div class="order-date_item order-date_item-address">
                                        <span class="client-title">@lang('main.cart.shop_user_delivery_address')</span>
                                        @if (isset($order->city) && $order->city!='')
                                            <span class="name-title">
                                                @if ($order->delivery != 'delivery')
                                                    @lang('main.cart.city'):
                                                @endif
                                            </span>
                                            <span class="name-value">{{ $order->city }}</span>
                                        @endif
                                        @if (isset($order->street) && $order->street!='')
                                            <span class="name-title">@lang('main.cart.street'):</span>
                                            <span class="name-value">{{ $order->street }}</span>
                                        @endif
                                        @if (isset($order->building) && $order->building!='')
                                            <span class="name-title">@lang('main.cart.building'):</span>
                                            <span class="name-value">{{ $order->building }}</span>
                                        @endif
                                        @if (isset($order->room) && $order->room!='')
                                            <span class="name-title">@lang('main.cart.room'):</span>
                                            <span class="name-value">{{ $order->room }}</span>
                                        @endif
                                        @if (isset($order->unit) && $order->unit!='')
                                            <span class="name-title">@lang('main.cart.unit'):</span>
                                            <span class="name-value">{{ $order->unit }}</span>
                                        @endif
                                    </div>
                                @endif --}}
                                @if ($order->comment)
                                    <div class="order-details--item">
                                        <span style='display:block;'>@lang('cabinet.comment'): <span class="text">{{ $order->comment }}</span></span>
                                    </div>
                                @endif
                            </div>
                            <div class="order-item--count">
                                <span class="bold">@lang('cabinet.total'):</span>
                            </div>
                            <div class="order-item--price">
                                {{ $order->sum }} {{app('main_curr')->lang->short_name}}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @endforeach
        </div>
    @else
        <p class="orders-title">@lang('cabinet.no_orders')</p>
    @endif
</div>
