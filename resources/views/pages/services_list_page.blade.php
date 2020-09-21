@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
    <div class="page {{isset($cat) && $cat->id == 11 ? 'hirurgiya-page' : ''}}">
        <section class="page-section section-with-breadcrumbs">
            <div class="container-small">
                @include('layouts.main.breadcrumbs')
                @if($cat->lang->h1 != '')
                    <h1 class="page-section-top-title">
                        {{$cat->lang->h1}}
                    </h1>
                @else
                    <h1 class="page-section-top-title">
                        {{$cat->lang->name}}
                    </h1>
                @endif
            </div>
        </section>
        <section class="main-section top-section">
            <div class="container-small">
                @if($cat->lang->pre_info != '')
                    <div class="main-section-top-subtitle description">
                        {!! $cat->lang->pre_info !!}
                    </div>
                @endif
                <div class="popup-btn-wrap">
                    <a class="btn-light-green-small popup-js" href="#callback">
                        <span class="btn-light-green-small-icon">
                            <svg width="20" height="20">
                                <use xlink:href="#phone"></use>
                            </svg>
                        </span>
						@lang('main.btn.call_me')
					</a>
                    <a class="btn-green-small popup-js appointment-btn-js" href="#appointment" data-subtitle="{{$cat->lang->name}}">
						@lang('main.btn.make_appointment')
					</a>
                </div>
            </div>
        </section>

        @if($cat->units->count())
            <section class="main-section">
                <div class="container-small">
                    <div class="page-section-title-bold">
                        @lang('main.service_direction')
                    </div>
                    <ul class="services-list">
                        @foreach ($cat->units as $unit_item)
                            <li class="services-list-item">
                                @include('layouts.tiles.service_unit_tile')
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif

        @if(isset($cat->related_goods) && $cat->related_goods && $cat->related_goods->count() || !empty($cat->related_market_cats) && $cat->related_market_cats && $cat->related_market_cats_flag)
            <section class="main-section">
                <div class="container-small">
                    <div class="page-section-title-bold">
                        @lang('main.price')
                    </div>
                    <ul class="price-list">
                        @if(!empty($cat->related_market_cats)  && $cat->related_market_cats && $cat->related_market_cats_flag)
                            @php
                            $i = 0;
                            @endphp
                            @foreach ($cat->related_market_cats as $market_cat)
                                @foreach ($market_cat->goods as $good)
                                    @php
                                        $i ++;
                                    @endphp
                                    <li class="price-item {{ $i<6 ? 'visible' : 'hide' }}">
                                        <div class="price-item-wrap">
                                            @include('layouts.tiles.good')
                                        </div>
                                    </li>
                                @endforeach
                            @endforeach
                        @endif
                        @php
							$k = 0;
						@endphp
                        @foreach ($cat->related_goods as $good)
                            @php
                                $k ++;
							@endphp
                            <li class="price-item {{ $k<6 ? 'visible' : 'hide' }}">
								<div class="price-item-wrap">
                                    @include('layouts.tiles.good')
	                            </div>
							</li>
                        @endforeach
                    </ul>
                    @if (isset($i) && $i > 5 || isset($k) && $k > 5)
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
            </section>
        @endif

        @if($cat->lang->post_info != '')
            <section class="main-section">
                <div class="container-small">
                    <div class="description">
                        {!! $cat->lang->post_info !!}
                    </div>
                </div>
            </section>
        @endif


        @if(isset($cat->related_units) && $cat->related_units && $cat->related_units->count() && get_cat_id_flag($cat->related_units,[7]))
            <section class="main-section">
                <div class="container-small">
                    <div class="page-section-title-bold">
                        @lang('main.equipment')
                    </div>
                    <ul class="equipment-list">
                        @foreach ($cat->related_units as $unit_item)
                            @if(in_array($unit_item->cat_id, [7]))
                                <li class="equipment-item">
                                    @include('layouts.tiles.equipment')
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif

        @if(isset($cat->related_specialists) && $cat->related_specialists && isset($cat->related_specialists[1]) && isset($cat->related_specialists[1]['specialists']) && $cat->related_specialists[1]['specialists']->count())
            <section class="main-section">
    			<div class="container">
                    <div class="page-section-title-bold">
                        @lang('main.our_specialists')
                    </div>
                    <div class="specialists-wrap mobile-slider-js">
                        @foreach ($cat->related_specialists[1]['specialists'] as  $specialist_item)
                            <div class="specialists-holder">
                                @include('layouts.tiles.specialist_tile')
                            </div>
                        @endforeach
                    </div>
                    <div class="popup-btn-wrap">
                        <a class="btn-light-green-small popup-js question-btn-js" href="#question">
                            <span class="btn-light-green-small-icon">
                                <svg width="19" height="19">
                                    <use xlink:href="#chat"></use>
                                </svg>
                            </span>
                            @lang('main.btn.question_specialist')
                        </a>
                        <a class="btn-green-small popup-js appointment-btn-js" href="#appointment" data-subtitle="{{$cat->lang->name}}">
                            @lang('main.btn.make_appointment')
                        </a>
                    </div>
                </div>
    		</section>
        @endif


        @if($cat->leads->count())
            <section class="main-section reviews">
    			<div class="container-small">
    				<div class="main-section-title-wrap">
    					<div class="main-section-title">
    						@lang('main.reviews')
    					</div>
    					<a class="btn-arrow" href="{{build_unit_route($reviews)}}">
    						<span class="btn-arrow-text">
    							@lang('main.all_reviews')
    						</span>
    					</a>
    				</div>
                    <div class="section-inner">
                        <div class="reviews-slider">
                            @foreach ($cat->leads as $lead_item)
                                @include('layouts.tiles.lead')
                            @endforeach
                        </div>
                        <div class="counter-slider-wrap">
                            <a class="popup-js btn-arrow-transparent" href="#reviews">
                                <span class="btn-arrow-text">
                                    @lang('main.give_feedback')
                                </span>
                            </a>
                            <div class="counter-slider-holder">
                                <div class="counter-slider">
                                    @php
                                    $i = 0;
                                    @endphp
                                    @foreach($cat->leads as $lead_item)
                                        @php
                                        $i ++;
                                        @endphp
                                        <div class="counter-slider-item">
                                            <div class="count-slide">
                                                {{$i}}<span class="all-count-slide">/{{$cat->leads->count()}}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
    					</div>
                        <div class="btn-wrap"></div>
                    </div>
    			</div>
    		</section>
        @endif

        {{-- @if(isset($cat->related_units) && $cat->related_units && $cat->related_units->count() && get_cat_id_flag($cat->related_units,\Demos\AdminPanel\Cat::descendants(2)))
            @lang('main.useful_info')
            @foreach ($cat->related_units as $unit_item)
                @if(in_array($unit_item->cat_id, \Demos\AdminPanel\Cat::descendants(2)))
                    @include('layouts.tiles.news')
                @endif
            @endforeach
        @endif --}}

        {{-- @if($cat->galleries->count())
            @foreach ($cat->galleries as $galleri_item)
                @lang('main.gallary')
                @if($galleri_item->photos->count())
                    @foreach($galleri_item->photos as $photo)
                        <a class="description-gallary-holder" href="{{gallery_photo_img($galleri_item->id,'big',$photo->file)}}" data-rel="lightcase:gallery">
                            <img class="description-gallary-item lazyload" data-src="{{gallery_photo_img($galleri_item->id,'small',$photo->file)}}" alt="@lang('main.photo') {{$cat->lang->name}} " title="@lang('main.photo') {{$cat->lang->name}} ">
                        </a>
                    @endforeach
                @endif
            @endforeach
        @endif --}}

        <section class="main-section">
            <div class="container">
                <div class="question-block">
                    <div class="question-block-item">
                        <div class="question-block-svg-wrap">
							<svg class="object-fit-js object-fit-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 151.502 104.719"><g transform="translate(-243.793 -273.129)" opacity="0.422"><path d="M303.685,219.912c-12.12,10.3-22.422,33.33-27.27,57.571l-7.878,5.454h0c2.424-27.27,12.12-62.419,35.148-63.025ZM273.99,292.027h0a98.194,98.194,0,0,0-.606,13.332l-5.454,1.818a65.984,65.984,0,0,1-.606-11.514c2.424-.606,4.242-1.818,6.666-3.636Zm-9.09-59.389h0a7.369,7.369,0,0,0-7.272,7.272,7,7,0,0,0,7.272,7.272,7.369,7.369,0,0,0,7.272-7.272c-.606-4.242-3.636-7.272-7.272-7.272Zm-4.242,75.145h0l-6.06.606v-9.7a25.774,25.774,0,0,0,6.666-1.212,70.067,70.067,0,0,0-.606,10.3Zm-7.272-22.422h0c-5.454-38.784-28.482-64.237-27.876-66.661,26.058,6.666,33.936,40.6,35.148,66.055h-1.212Z" transform="translate(55.856 54.429)" fill="#fff" fill-rule="evenodd"/><path d="M256.872,307.639c1.818-7.272,7.878-10.3,14.544-10.908-31.512,21.21,56.359,20.6,52.723-15.15,5.454,2.424,6.06,9.7,1.818,16.362-16.968,27.876-72.115,21.816-69.085,9.7Zm15.15-33.937h0c-8.484-25.452-24.846-44.238-52.723-52.723,34.542-7.878,51.511,25.452,58.177,53.935l-5.454-1.212ZM370.8,222.192h0a53.373,53.373,0,0,0-10.3-1.212c-27.876.606-35.148,23.634-45.45,44.239-16.968,33.936-59.389,22.422-44.239,13.332-7.878,0-10.3,4.848-9.7,9.09,1.212,6.666,38.179,14.544,56.965-12.12C335.047,248.856,332.623,233.706,370.8,222.192Z" transform="translate(24.493 60.027)" fill="#fff" fill-rule="evenodd"/></g></svg>
						</div>
                        <div class="question-item-wrap">
                            <div class="main-section-title">
                                @lang('main.have_questions')
                            </div>
                            <div class="text">
                                @lang('main.leave_your_contacts')
                            </div>
                        </div>
                    </div>
                    <div class="question-block-item">
						<div class="question-form-wrap">
							<form method="post" class="callback_form">
                                <div class="input-wrap">
                                    <input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
                                </div>
								<div class="input-wrap">
									<input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.phone')" required>
								</div>
								<input type="hidden" name="lang" value="{{App::getLocale()}}">
                                <input type="hidden" name="url" value="{{Request::path()}}">
                                <input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
								<button type="submit" class="btn-green do_callback_form">@lang('main.btn.call_me')</button>
							</form>
							<div class="form-thanks">
								@lang('main.form.form_thanks')
							</div>
						</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
@section('scripts')
@stop
