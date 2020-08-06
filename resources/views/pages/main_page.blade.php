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
				@foreach ($services_top as $cat_item)
					@include('layouts.tiles.service_tile')
				@endforeach
			</div>
		</section>
	@endif

	@include('layouts.main.checkup')


	@include('layouts.main.feedback')

	@if($unit->lang->long_desc_2 != '')
		<section class="main-section">
			{!!$unit->lang->long_desc_2!!}
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

	@include('layouts.main.advantages')

	@if(isset($special_actions) && $special_actions)
		<section class="main-section">
			@lang('main.action_title')
			@if($special_actions_cat->count())
				@foreach($special_actions_cat as $cat_item)
					<a href="{{route('first_url',$cat_item->alias)}}">{{$cat_item->lang->name}}</a>
				@endforeach
			@endif
			@foreach ($special_actions as $unit_item)
				@include('layouts.tiles.news')
			@endforeach
		</section>
	@endif
	@if($unit->lang->long_desc_1 != '')
		<section class="main-section">
			<div class="container">
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
