@if ($user->wishlists->count())
    <div class="wishlist_container margin-minus">
        <div class="wishlist_container--list wish_list">
            @foreach ($user->wishlists as $list)
                <div class="wishlist_container--list-item wish_a" data-id='{{ $list->id }}'>
                    <a class="editable_list" data-id='{{ $list->id }}'  href="#">{{ $list->name }}</a>
                    <a class='delete-field' data-id='{{ $list->id }}' href='#'><span class="glyphicon glyphicon-remove"></span></a>
                </div>
            @endforeach
        </div>
        <div class="wishlist_container--inner wish_inner">
            @foreach ($user->wishlists as $list)
                @if ($list->goods->count())
                    <div class='wishlist_container--item wish_content' data-id='{{ $list->id }}'>
                        @foreach ($list->goods as $good)
                            <div class="order-item">
                                @if(isset($good->img_1) && $good->img_1 != '')
                                    <div class="order-item--img">
                                        <img src="{{good_img('thumb',$good->img_1)}}" alt="{{ $good->lang->name }}" title="{{ $good->lang->name }}">
                                    </div>
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
                                <a class='remove_wish_good' data-good_id='{{$good->id}}' data-list_id='{{ $list->id }}' href=''></a>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@else
    <p class="title-tab">@lang('cabinet.wish_lists.wish_goods_empty')</p>
@endif
