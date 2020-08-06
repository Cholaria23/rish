@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	@include('layouts.main.slider')
	@if($unit->lang->long_desc_1 != '')
		{!!$unit->lang->long_desc_1!!}
	@endif
	@if(isset($services) && $services->children->count())
		@foreach ($services->children as $cat_item)
			@include('layouts.tiles.service_tile')
		@endforeach
	@endif
	@include('layouts.main.checkup')

	@if(isset($services_top) && $services_top)
		@lang('main.main_services')
		<a href="{{route('first_url',$services->alias)}}">
			@lang('main.all_services')
		</a>
		@foreach ($services_top as $cat_item)
			@include('layouts.tiles.service_tile')
		@endforeach
	@endif

	@include('layouts.main.feedback')

	@if($unit->lang->long_desc_2 != '')
		{!!$unit->lang->long_desc_2!!}
	@endif

	@if(isset($specialists) && $specialists)
		{{$specialist->lang->name}}
		@foreach ($specialists as $specialist_item)
			@include('layouts.tiles.specialist_tile')
		@endforeach
		<a href="{{build_unit_route($specialist)}}">
			@lang('main.all_specialists')
		</a>
	@endif
	@if(isset($leads) && $leads->count())
		@lang('main.reviews')
		@foreach ($leads as $lead_item)
			@include('layouts.tiles.lead')
		@endforeach
		<a href="{{build_unit_route($reviews)}}">@lang('main.all_reviews')</a>
	@endif

	@include('layouts.main.advantages')
	@if(isset($special_actions) && $special_actions)
		@lang('main.action_title')
		@if($special_actions_cat->count())
			@foreach($special_actions_cat as $cat_item)
				<a href="{{route('first_url',$cat_item->alias)}}">{{$cat_item->lang->name}}</a>
			@endforeach
		@endif
		@foreach ($special_actions as $unit_item)
			@include('layouts.tiles.news')
		@endforeach
	@endif
	@if(isset($blog) && $blog)
		@lang('main.blog_title')
		@foreach ($blog as $unit_item)
			@include('layouts.tiles.news')
		@endforeach
	@endif
@stop
@section('scripts')
@stop