@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
    <div class="page price-page">
        @include('layouts.main.breadcrumbs')
        @if($cat->lang->h1 != '')
            <div class="container">
				<h1 class="page-title">
                    {{$cat->lang->h1}}
	            </h1>
			</div>
        @else
            <div class="container">
				<h1 class="page-title">
                    {{$cat->lang->name}}
	            </h1>
			</div>
        @endif
        <div class="main-section price">
            <div class="container-small">
                <div class="tabs-container">
                    @if($cat->children->count())
                        @if($categories->count())
                            <div class="tabs-btn-wrap">
                                <button class="active-tab-mobile" type="button" name="button">
                                    <span class="active-tab-mobile-text">
                                        @lang('main.view_all_price')
                                    </span>
                                </button>
                                <ul class="tabs">
                                    @foreach ($categories as $cat_item)
                                        @if($cat_item->id == 2)
                                            <li class="tab-link" data-tab="{{$cat_item->id}}">
                                                @lang('main.view_all_price')
                                            </li>
                                        @else
                                            <li class="tab-link" data-tab="{{$cat_item->id}}">
                                                {{$cat_item->lang->name}}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <ul class="tab-content-wrap">
                            @foreach ($cat->children as $first_child_item)
                                <li class="tab-content" id="{{$first_child_item->id}}">
                                    <h2 class="tab-title">
                                        {{$first_child_item->lang->name}}
                                    </h2>
                                    @if($first_child_item->goods->count())
                                        <div class="price-list-wrap">
                                            <ul class="price-list">
                                                @php
                                                    $i = 0;
                                                @endphp
                                                @foreach ($first_child_item->goods as $good_item)
                                                    @php
                                                        $i ++;
                                                    @endphp
                                                    <li class="price-item {{ $i<6 ? 'visible' : 'hide' }}">
                                                        <div class="price-item-wrap">
                                                            @include('layouts.tiles.good',['good' => $good_item])
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            @if($first_child_item->goods->count() > 5)
                                                <div class="more-link-section all_price_js">
                                                    <span class="visible-text">
                                                        @lang('main.view_all_price')
                                                    </span>
                                                    <span class="hide-text text-hide">
                                                        @lang('main.hide-text')
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @else
                        @if($cat->goods->count())
                            <ul class="price-list">
                                @foreach ($cat->goods as $good_item)
                                    <li class="price-item">
                                        <div class="price-item-wrap">
                                            @include('layouts.tiles.good',['good' => $good_item])
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
@stop
