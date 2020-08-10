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
			</div>
		</section>
	@endif

	<section class="main-section">
		<div class="container">
			<div class="checkup-block">
				<div class="checkup-column">
					<div class="checkup-item big">
						@include('layouts.main.checkup')
					</div>
					<div class="checkup-item small text">
						@lang('main.form.feedback_text_1')
					</div>
				</div>
				<div class="checkup-column">
					<div class="checkup-item small text">
						@lang('main.form.feedback_text_2')
					</div>
					<div class="checkup-item big">
						<div class="main-section-title">
							@lang('main.form.checkup-form-title')
						</div>
						<form method="post" class="appointment_form">
				            <div class="input-wrap">
				            	<input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.name')" required>
				            </div>
				            <div class="input-wrap">
				            	<input class="input-form" type="text" name="name" placeholder="@lang('main.form.phone')">
				            </div>
				            <input type="hidden" name="lang" value="{{App::getLocale()}}">
				            <button type="submit" class="btn-green do_appointment_form">@lang('main.btn.sign_up')</button>
				        </form>
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

	@if(isset($specialists) && $specialists)
		<section class="main-section">
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
				<div class="specialists-wrap">
					@foreach ($specialists as $specialist_item)
						<div class="specialists-holder">
							@include('layouts.tiles.specialist_tile')
						</div>
					@endforeach
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
			</div>
		</section>
	@endif

	{{-- @include('layouts.main.advantages') --}}

	@if(isset($special_actions) && $special_actions)
		<section class="main-section">
			<div class="container">
				<div class="special-actions-wrap">
					<div class="special-action-holder">
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
				{!!$unit->lang->long_desc_1!!}
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
