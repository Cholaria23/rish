@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	@include('layouts.main.breadcrumbs')
	<img src="{{specialist_cover('small', $expert->img_1)}}" alt="{{$expert->lang->last_name}} {{$expert->lang->first_name}} {{$expert->lang->father_name}}" title="{{$expert->lang->last_name}} {{$expert->lang->first_name}} {{$expert->lang->father_name}}">
	<h1>
		{{$expert->lang->last_name}}
		{{$expert->lang->first_name}}
		{{$expert->lang->father_name}}
	</h1>

	@if(isset($expert->chars_vals[4]) && isset($expert->chars_vals[4]['values']))
		<ul>
			@foreach ($expert->chars_vals[4]['values'] as $val_item)
				<li>{{$val_item}}</li>
			@endforeach
		</ul>
	@endif

	@if($expert->experiences->count())
		@foreach($expert->experiences as $xp)
			@choice('main.xp',(date("Y")-$xp->start),["year" => (date("Y")-$xp->start)])
		@endforeach
	@endif
	@if(isset($expert->chars_vals[2]) && isset($expert->chars_vals[2]['values']))
		{{implode(",",$expert->chars_vals[2]['values'])}}
	@endif
	@if($expert->lang->long_desc_1 != '')
		{!!$expert->lang->long_desc_1!!}
	@endif
	@if($expert->lang->long_desc_2 != '')
		{!!$expert->lang->long_desc_2!!}
	@endif
	@if (isset($expert->related_cats[1]) && count($expert->related_cats[1]['cats']) || isset($expert->related_units[2]) && count($expert->related_units[2]['units']))
		@php
			$unit_block_ids = [];
		@endphp
		@foreach ($expert->related_cats[1]['cats'] as $cat_item)
			@include('layouts.tiles.service_tile')
			@foreach ($expert->related_units[2]['units'] as $unit_item)
				@if($cat_item->id == $unit_item->cat_id)
					@php
						$unit_block_ids[] = $unit_item->id;
					@endphp
					@include('layouts.tiles.service_unit_tile')
				@endif
			@endforeach
		@endforeach
		@foreach ($expert->related_units[2]['units'] as $unit_item)
			@if(!in_array($unit_item->id,$unit_block_ids))
				@include('layouts.tiles.service_unit_tile')
			@endif
		@endforeach
	@endif
	@if($expert->images_1->count()) 
		@lang('main.diploms')
		@foreach ($expert->images_1 as $key => $img_item)
			<img src="{{specialist_image('small',$img_item->src)}}" alt="{{$expert->lang->last_name}} {{$expert->lang->first_name}} {{$expert->lang->father_name}} @lang('main.diploms') {{$key+1}}" title="{{$expert->lang->last_name}} {{$expert->lang->first_name}} {{$expert->lang->father_name}} @lang('main.diploms') {{$key+1}}">
		@endforeach
	@endif
	@if($expert->leads->count())
		@lang('main.reviews')
		@foreach ($expert->leads as $lead_item)
			@include('layouts.tiles.lead')
		@endforeach
	@endif

	@if(isset($expert->related_units[3]) && count($expert->related_units[3]['units']))
		@lang('main.expert_publication')
		@foreach ($expert->related_units[3]['units'] as $unit_item)
			@if (in_array($unit_item->cat_id, \Demos\AdminPanel\Cat::descendants(2)))
				@include('layouts.tiles.news')
			@elseif(in_array($unit_item->cat_id, \Demos\AdminPanel\Cat::descendants(3)))
				@include('layouts.tiles.actions')
			@endif
		@endforeach
	@endif
@stop
@section('scripts')
@stop