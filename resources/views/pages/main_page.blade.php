@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	@include('layouts.main.slider')

	{{-- @if(isset($services) && $services->children->count())
		<section class="main-section">
			<div class="container-small">

				@foreach ($services->children as $cat_item)
					@include('layouts.tiles.service_tile')
				@endforeach
			</div>
		</section>
	@endif --}}

	@if(isset($services_top) && $services_top)
		<section class="main-section">
			<div class="container-small">
				<div class="main-section-title-wrap">
					<div class="main-section-title">
						@lang('main.main_services')
					</div>
					<a class="btn-arrow" href="{{route('first_url',$services->alias)}}">
						<span class="btn-arrow-text">
							@lang('main.all_services')
						</span>
					</a>
				</div>
				<div class="section-inner">
					<div class="services-top-text description">
						@lang('main.main_services_text')
					</div>
					<div class="services-top-wrap">
						@foreach ($services_top as $cat_item)
							<div class="services-top-holder">
								@include('layouts.tiles.service_tile')
							</div>
						@endforeach
					</div>
					<div class="btn-wrap"></div>
				</div>
			</div>
		</section>
	@endif

	<section class="main-section">
		<div class="container">
			<div class="checkup-block">
				<div class="checkup-column">
					<div class="checkup-item big">
						<div class="checkup-item-svg-wrap">
							<svg class="object-fit-js object-fit-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 151.502 104.719"><g transform="translate(-243.793 -273.129)" opacity="0.422"><path d="M303.685,219.912c-12.12,10.3-22.422,33.33-27.27,57.571l-7.878,5.454h0c2.424-27.27,12.12-62.419,35.148-63.025ZM273.99,292.027h0a98.194,98.194,0,0,0-.606,13.332l-5.454,1.818a65.984,65.984,0,0,1-.606-11.514c2.424-.606,4.242-1.818,6.666-3.636Zm-9.09-59.389h0a7.369,7.369,0,0,0-7.272,7.272,7,7,0,0,0,7.272,7.272,7.369,7.369,0,0,0,7.272-7.272c-.606-4.242-3.636-7.272-7.272-7.272Zm-4.242,75.145h0l-6.06.606v-9.7a25.774,25.774,0,0,0,6.666-1.212,70.067,70.067,0,0,0-.606,10.3Zm-7.272-22.422h0c-5.454-38.784-28.482-64.237-27.876-66.661,26.058,6.666,33.936,40.6,35.148,66.055h-1.212Z" transform="translate(55.856 54.429)" fill="#fff" fill-rule="evenodd"/><path d="M256.872,307.639c1.818-7.272,7.878-10.3,14.544-10.908-31.512,21.21,56.359,20.6,52.723-15.15,5.454,2.424,6.06,9.7,1.818,16.362-16.968,27.876-72.115,21.816-69.085,9.7Zm15.15-33.937h0c-8.484-25.452-24.846-44.238-52.723-52.723,34.542-7.878,51.511,25.452,58.177,53.935l-5.454-1.212ZM370.8,222.192h0a53.373,53.373,0,0,0-10.3-1.212c-27.876.606-35.148,23.634-45.45,44.239-16.968,33.936-59.389,22.422-44.239,13.332-7.878,0-10.3,4.848-9.7,9.09,1.212,6.666,38.179,14.544,56.965-12.12C335.047,248.856,332.623,233.706,370.8,222.192Z" transform="translate(24.493 60.027)" fill="#fff" fill-rule="evenodd"/></g></svg>
						</div>
						<div class="checkup-item-wrap">
							@include('layouts.main.checkup')
						</div>
					</div>
					<div class="checkup-item small">
						<div class="checkup-item-svg-wrap">
							<svg class="object-fit-js object-fit-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 151.502 104.719"><g transform="translate(-243.793 -273.129)" opacity="0.422"><path d="M303.685,219.912c-12.12,10.3-22.422,33.33-27.27,57.571l-7.878,5.454h0c2.424-27.27,12.12-62.419,35.148-63.025ZM273.99,292.027h0a98.194,98.194,0,0,0-.606,13.332l-5.454,1.818a65.984,65.984,0,0,1-.606-11.514c2.424-.606,4.242-1.818,6.666-3.636Zm-9.09-59.389h0a7.369,7.369,0,0,0-7.272,7.272,7,7,0,0,0,7.272,7.272,7.369,7.369,0,0,0,7.272-7.272c-.606-4.242-3.636-7.272-7.272-7.272Zm-4.242,75.145h0l-6.06.606v-9.7a25.774,25.774,0,0,0,6.666-1.212,70.067,70.067,0,0,0-.606,10.3Zm-7.272-22.422h0c-5.454-38.784-28.482-64.237-27.876-66.661,26.058,6.666,33.936,40.6,35.148,66.055h-1.212Z" transform="translate(55.856 54.429)" fill="#fff" fill-rule="evenodd"/><path d="M256.872,307.639c1.818-7.272,7.878-10.3,14.544-10.908-31.512,21.21,56.359,20.6,52.723-15.15,5.454,2.424,6.06,9.7,1.818,16.362-16.968,27.876-72.115,21.816-69.085,9.7Zm15.15-33.937h0c-8.484-25.452-24.846-44.238-52.723-52.723,34.542-7.878,51.511,25.452,58.177,53.935l-5.454-1.212ZM370.8,222.192h0a53.373,53.373,0,0,0-10.3-1.212c-27.876.606-35.148,23.634-45.45,44.239-16.968,33.936-59.389,22.422-44.239,13.332-7.878,0-10.3,4.848-9.7,9.09,1.212,6.666,38.179,14.544,56.965-12.12C335.047,248.856,332.623,233.706,370.8,222.192Z" transform="translate(24.493 60.027)" fill="#fff" fill-rule="evenodd"/></g></svg>
						</div>
						<div class="checkup-item-wrap text">
							@lang('main.form.feedback_text_1')
						</div>
					</div>
				</div>
				<div class="checkup-column">
					<div class="checkup-item small">
						<div class="checkup-item-svg-wrap">
							<svg class="object-fit-js object-fit-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 151.502 104.719"><g transform="translate(-243.793 -273.129)" opacity="0.422"><path d="M303.685,219.912c-12.12,10.3-22.422,33.33-27.27,57.571l-7.878,5.454h0c2.424-27.27,12.12-62.419,35.148-63.025ZM273.99,292.027h0a98.194,98.194,0,0,0-.606,13.332l-5.454,1.818a65.984,65.984,0,0,1-.606-11.514c2.424-.606,4.242-1.818,6.666-3.636Zm-9.09-59.389h0a7.369,7.369,0,0,0-7.272,7.272,7,7,0,0,0,7.272,7.272,7.369,7.369,0,0,0,7.272-7.272c-.606-4.242-3.636-7.272-7.272-7.272Zm-4.242,75.145h0l-6.06.606v-9.7a25.774,25.774,0,0,0,6.666-1.212,70.067,70.067,0,0,0-.606,10.3Zm-7.272-22.422h0c-5.454-38.784-28.482-64.237-27.876-66.661,26.058,6.666,33.936,40.6,35.148,66.055h-1.212Z" transform="translate(55.856 54.429)" fill="#fff" fill-rule="evenodd"/><path d="M256.872,307.639c1.818-7.272,7.878-10.3,14.544-10.908-31.512,21.21,56.359,20.6,52.723-15.15,5.454,2.424,6.06,9.7,1.818,16.362-16.968,27.876-72.115,21.816-69.085,9.7Zm15.15-33.937h0c-8.484-25.452-24.846-44.238-52.723-52.723,34.542-7.878,51.511,25.452,58.177,53.935l-5.454-1.212ZM370.8,222.192h0a53.373,53.373,0,0,0-10.3-1.212c-27.876.606-35.148,23.634-45.45,44.239-16.968,33.936-59.389,22.422-44.239,13.332-7.878,0-10.3,4.848-9.7,9.09,1.212,6.666,38.179,14.544,56.965-12.12C335.047,248.856,332.623,233.706,370.8,222.192Z" transform="translate(24.493 60.027)" fill="#fff" fill-rule="evenodd"/></g></svg>
						</div>
						<div class="checkup-item-wrap text">
							@lang('main.form.feedback_text_2')
						</div>
					</div>
					<div class="checkup-item big">
						<div class="checkup-item-svg-wrap">
							<svg class="object-fit-js object-fit-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 151.502 104.719"><g transform="translate(-243.793 -273.129)" opacity="0.422"><path d="M303.685,219.912c-12.12,10.3-22.422,33.33-27.27,57.571l-7.878,5.454h0c2.424-27.27,12.12-62.419,35.148-63.025ZM273.99,292.027h0a98.194,98.194,0,0,0-.606,13.332l-5.454,1.818a65.984,65.984,0,0,1-.606-11.514c2.424-.606,4.242-1.818,6.666-3.636Zm-9.09-59.389h0a7.369,7.369,0,0,0-7.272,7.272,7,7,0,0,0,7.272,7.272,7.369,7.369,0,0,0,7.272-7.272c-.606-4.242-3.636-7.272-7.272-7.272Zm-4.242,75.145h0l-6.06.606v-9.7a25.774,25.774,0,0,0,6.666-1.212,70.067,70.067,0,0,0-.606,10.3Zm-7.272-22.422h0c-5.454-38.784-28.482-64.237-27.876-66.661,26.058,6.666,33.936,40.6,35.148,66.055h-1.212Z" transform="translate(55.856 54.429)" fill="#fff" fill-rule="evenodd"/><path d="M256.872,307.639c1.818-7.272,7.878-10.3,14.544-10.908-31.512,21.21,56.359,20.6,52.723-15.15,5.454,2.424,6.06,9.7,1.818,16.362-16.968,27.876-72.115,21.816-69.085,9.7Zm15.15-33.937h0c-8.484-25.452-24.846-44.238-52.723-52.723,34.542-7.878,51.511,25.452,58.177,53.935l-5.454-1.212ZM370.8,222.192h0a53.373,53.373,0,0,0-10.3-1.212c-27.876.606-35.148,23.634-45.45,44.239-16.968,33.936-59.389,22.422-44.239,13.332-7.878,0-10.3,4.848-9.7,9.09,1.212,6.666,38.179,14.544,56.965-12.12C335.047,248.856,332.623,233.706,370.8,222.192Z" transform="translate(24.493 60.027)" fill="#fff" fill-rule="evenodd"/></g></svg>
						</div>
						<div class="appointment-form-wrap">
							<div class="main-section-title">
								@lang('main.form.checkup-form-title')
							</div>
							<form method="post" class="appointment_form">
								<div class="input-wrap">
									<input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
								</div>
								<div class="input-wrap">
									<input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.phone')" required>
								</div>
								<input type="hidden" name="lang" value="{{App::getLocale()}}">
								<button type="submit" class="btn-green do_appointment_form">@lang('main.btn.sign_up')</button>
							</form>
							<div class="form-thanks">
								@lang('main.form.form_thanks')
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	@if($unit->lang->long_desc_2 != '')
		<section class="main-section">
			<div class="container-small">
				<div class="main-section-title-wrap">
					<div class="main-section-title">
						@lang('main.about_us')
					</div>
				</div>
				<div class="description">
					{!!$unit->lang->long_desc_2!!}
				</div>
			</div>
		</section>
	@endif

	<section class="main-section">
		<div class="container">
			<div class="virtual-block">
				<div class="virtual-block-info-wrap">
					<div class="virtual-block-info-inner">
						<div class="virtual-block-info-title">
							@lang('main.virtual_tour_title')
						</div>
						<div class="virtual-block-text text">
							@lang('main.virtual_tour_text')
						</div>
						<a class="btn-arrow" href="#">
							<span class="btn-arrow-text">
								@lang('main.look')
							</span>
						</a>
					</div>
				</div>
				<div class="virtual-block-img-wrap">
					<img class="virtual-block-img object-fit-js object-fit-cover lazyload" data-src="img/virtual-tur-img.jpg" alt="rishon virtual-tur-img">
				</div>
			</div>
		</div>
	</section>

	@if(isset($specialists) && $specialists)
		<section class="main-section specialists">
			<div class="container">
				<div class="main-section-title-wrap">
					<div class="main-section-title">
						{{$specialist->lang->name}}
					</div>
					<a class="btn-arrow" href="{{build_unit_route($specialist)}}">
						<span class="btn-arrow-text">
							@lang('main.all_specialists')
						</span>
					</a>
				</div>
				<div class="section-inner">
					<div class="specialists-wrap mobile-slider-js">
						@foreach ($specialists as $specialist_item)
							<div class="specialists-holder">
								@include('layouts.tiles.specialist_tile')
							</div>
						@endforeach
					</div>
					<div class="btn-wrap"></div>
				</div>
			</div>
		</section>
	@endif

	@if(isset($leads) && $leads->count())
		<section class="main-section">
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
						@foreach ($leads as $lead_item)
							@include('layouts.tiles.lead')
						@endforeach
					</div>
					<div class="counter-slider">
						@php
						$i = 0;
						@endphp
						@foreach($leads as $lead_item)
							@php
							$i ++;
							@endphp
							<div class="counter-slider-item">
								<div class="count-slide">
									{{$i}}<span class="all-count-slide">/{{$leads->count()}}</span>
								</div>
							</div>
						@endforeach
					</div>
					<div class="btn-wrap"></div>
				</div>
			</div>
		</section>
	@endif

	{{-- @include('layouts.main.advantages') --}}

	@if(isset($special_actions) && $special_actions)
		<section class="main-section">
			<div class="container">
				<div class="special-action-holder no-slider">
					<div class="special-action-item">
						<div class="special-action-title">
							@lang('main.action_title')
						</div>
						@if($special_actions_cat->count())
							@foreach($special_actions_cat as $cat_item)
								<a class="special-action-link" href="{{route('first_url',$cat_item->alias)}}">
									<span class="special-action-link-text">
										{{$cat_item->lang->name}}
									</span>
								</a>
							@endforeach
						@endif
					</div>
				</div>
				<div class="special-actions-wrap mobile-slider-js">
					<div class="special-action-holder slider">
						<div class="special-action-item">
							<div class="special-action-title">
								@lang('main.action_title')
							</div>
							@if($special_actions_cat->count())
								@foreach($special_actions_cat as $cat_item)
									<a class="special-action-link" href="{{route('first_url',$cat_item->alias)}}">
										<span class="special-action-link-text">
											{{$cat_item->lang->name}}
										</span>
									</a>
								@endforeach
							@endif
						</div>
					</div>
					@foreach ($special_actions as $unit_item)
						<div class="special-action-holder">
							@include('layouts.tiles.news')
						</div>
					@endforeach
				</div>
			</div>
		</section>
	@endif

	@if($unit->lang->long_desc_1 != '')
		<section class="main-section">
			<div class="container-small">
				<div class="description">
					{!!$unit->lang->long_desc_1!!}
				</div>
			</div>
		</section>
	@endif

	{{-- @if(isset($blog) && $blog)
		@lang('main.blog_title')
		@foreach ($blog as $unit_item)
			@include('layouts.tiles.news')
		@endforeach
	@endif --}}

@stop
@section('scripts')
@stop
