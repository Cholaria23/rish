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
		{{$specialists[0]->category->lang->name}}
		@foreach ($specialists as $unit_item)
			@include('layouts.tiles.specialist_tile')
		@endforeach
		<a href="{{route('first_url',$specialists[0]->category->alias)}}">
			@lang('main.all_specialists')
		</a>
	@endif
	@if(isset($leads) && $leads->count())
		@lang('main.reviews')
		@foreach ($leads as $lead_item)
			@if($lead_item->user_first_name != '' || $lead_item->user_last_name != '')
				@if($lead_item->user_first_name != '')
					{{$lead_item->user_first_name}}
				@endif
				@if($lead_item->user_last_name != '')
					{{$lead_item->user_last_name}}
				@endif
			@endif
			@if($lead_item->content != '')
				{!! $lead_item->content !!}
			@endif
		@endforeach
		<a href="{{build_unit_route($reviews)}}">@lang('main.all_reviews')</a>
	@endif

	@include('layouts.main.advantages')
	@if(isset($special_actions) && $special_actions)
		@lang('main.action_title')
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