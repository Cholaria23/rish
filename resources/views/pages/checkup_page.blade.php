@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page checkup-page">
		@include('layouts.main.breadcrumbs')
		@if($unit->lang->h1 != '')
			<div class="container">
				<div class="page-section-top-title">
					{{$unit->lang->h1}}
				</div>
			</div>
		@else
			<div class="container">
				<div class="page-section-top-title">
					{{$unit->lang->name}}
				</div>
			</div>
		@endif
		@if($unit->lang->short_desc_1 != '')
			<div class="checkup-subtitle">
				<div class="container-small">
					{!!$unit->lang->short_desc_1!!}
				</div>
			</div>
		@endif
		@if($unit->lang->long_desc_1 != '')
			<div class="main-section">
				<div class="container-small">
					<div class="description description-with-check">
						{!!$unit->lang->long_desc_1!!}
					</div>
					<div class="popup-btn-wrap">
	                    <a class="btn-light-green-small popup-js" href="#callback">
	                        <span class="btn-light-green-small-icon">
	                            <svg width="20" height="20">
	                                <use xlink:href="#phone"></use>
	                            </svg>
	                        </span>
							@lang('main.btn.call_me')
						</a>
	                    <a class="btn-green-small popup-js" href="#chekup">
							@lang('main.sign_up_chekup')
						</a>
	                </div>
				</div>
			</div>
		@endif
		@if(!empty($unit->related_goods) && $unit->related_goods->count() || !empty($unit->related_market_cats) && $unit->related_market_cats)
			<section class="main-section">
				<div class="container-small">
					<div class="page-section-title-bold">
						@lang('main.price')
					</div>
					@if(!empty($unit->related_goods) || !empty($unit->related_market_cats) && $unit->related_market_cats)
						<ul class="price-list">
							@if(!empty($unit->related_market_cats))
								@foreach ($unit->related_market_cats as $market_cat)
									@php
									$i = 0;
									@endphp
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
							@if(!empty($unit->related_goods))
								@php
								$k = $i;
								@endphp
								@foreach ($unit->related_goods as $good)
									@php
									$k ++;
									@endphp
									<li class="price-item {{ $k<6 ? 'visible' : 'hide' }}">
										<div class="price-item-wrap">
											@include('layouts.tiles.good')
										</div>
									</li>
								@endforeach
							@endif
						</ul>
					@endif
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

		@if(isset($checkup_info) && $checkup_info->count())
			<div class="main-section">
				<div class="container">
					<div class="checkup-services-wrap">
						@foreach ($checkup_info as $key => $unit_item)
							@if(in_array($key,[0,1,2,3,4,5,6,7,8]))
								<div class="checkup-services-holder">
									<div class="checkup-services-item">
										<div class="checkup-services-title">
											<div class="checkup-services-count">
												0{{$key+1}}
											</div>
											<div class="checkup-services-name">
												{{$unit_item->lang->name}}
											</div>
										</div>
										@if($unit_item->lang->long_desc_1 != '')
											<div class="description">
												{!! $unit_item->lang->long_desc_1 !!}
											</div>
										@endif
									</div>
								</div>
							@else
								<div class="checkup-services-holder">
									<div class="checkup-services-item">
										<div class="checkup-services-title">
											<div class="checkup-services-count">
												{{$key+1}}
											</div>
											<div class="checkup-services-name">
												{{$unit_item->lang->name}}
											</div>
										</div>
										@if($unit_item->lang->long_desc_1 != '')
											<div class="description">
												{!! $unit_item->lang->long_desc_1 !!}
											</div>
										@endif
									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
		@endif

		@if($unit->lang->long_desc_2 != '')
			<div class="main-section">
				<div class="container-small">
					<div class="description">
						{!!$unit->lang->long_desc_2!!}
					</div>
				</div>
			</div>
		@endif
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
