@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')

	@if($unit->lang->long_desc_1 != '')
		{!!$unit->lang->long_desc_1!!}
	@endif
	@if($unit->lang->long_desc_2 != '')
		{!!$unit->lang->long_desc_2!!}
	@endif
	<img src="{{unit_img('small',$unit->img_1)}}" alt="{{$unit->lang->name}}" title="{{$unit->lang->name}}">


	@if(isset($offer) && $offer->units->count() )
		@if($offer->lang->pre_info != '')
			{!!$offer->lang->pre_info!!}
		@endif
		@foreach ($offer->units as $unit_item)
			@if($unit_item->svg != '')
				{!! $unit_item->svg !!}
			@endif
			{{$unit_item->lang->name}}
		@endforeach
		@if($offer->lang->post_info != '')
			{!!$offer->lang->post_info!!}
		@endif
	@endif


	@if(isset($our_mission) && $our_mission)
		<img src="{{unit_img('small',$our_mission->img_1)}}" alt="{{$our_mission->lang->name}}" title="{{$our_mission->lang->name}}">
		@if($our_mission->lang->long_desc_1 != '')
			{!!$our_mission->lang->long_desc_1!!}
		@endif
		@if($our_mission->lang->long_desc_2 != '')
			{!!$our_mission->lang->long_desc_2!!}
		@endif
	@endif

	@if(isset($directions) && $directions)
		@if($directions->lang->long_desc_1 != '')
			{!!$directions->lang->long_desc_1!!}
		@endif
		@if(isset($directions_list) && $directions_list->count())
			<ul>
				@foreach ($directions_list as $direction_item)
					<li>
						{{$direction_item->lang->name}}
					</li>
				@endforeach
			</ul>
		@endif
		@if($directions->lang->long_desc_2 != '')
			{!!$directions->lang->long_desc_2!!}
		@endif
	@endif


	@if(isset($pricelist) && $pricelist->units->count() )
		@if($pricelist->lang->pre_info != '')
			{!!$pricelist->lang->pre_info!!}
		@endif
		@foreach ($pricelist->units as $unit_item)
			<img src="{{unit_img('small',$unit_item->img_1)}}" alt="{{$unit_item->lang->name}}" title="{{$unit_item->lang->name}}">
			{{$unit_item->lang->name}}
			@if($unit_item->lang->short_desc_1 != '')
				{{$unit_item->lang->short_desc_1}}
			@endif
		@endforeach
		@if($pricelist->lang->post_info != '')
			{!!$pricelist->lang->post_info!!}
		@endif
	@endif

	@if(isset($translator) && $translator)
		<img src="{{unit_img('small',$translator->img_1)}}" alt="{{$translator->lang->name}}" title="{{$translator->lang->name}}">
		@if($translator->lang->long_desc_1 != '')
			{!!$translator->lang->long_desc_1!!}
		@endif
		@if($translator->lang->long_desc_2 != '')
			{!!$translator->lang->long_desc_2!!}
		@endif
	@endif
	
	@if(isset($departments) && $departments->units->count() )
		@if($departments->lang->pre_info != '')
			{!!$departments->lang->pre_info!!}
		@endif
		@foreach ($departments->units as $key => $unit_item)
			@if ($key%2 == 0)
				<img src="{{unit_img('small',$unit_item->img_1)}}" alt="{{$unit_item->lang->name}}" title="{{$unit_item->lang->name}}">
				{{$unit_item->lang->name}}
				@if($unit_item->lang->long_desc_1 != '')
					{!!$unit_item->lang->long_desc_1!!}
				@endif
			@else
				{{$unit_item->lang->name}}
				@if($unit_item->lang->long_desc_1 != '')
					{!!$unit_item->lang->long_desc_1!!}
				@endif
				<img src="{{unit_img('small',$unit_item->img_1)}}" alt="{{$unit_item->lang->name}}" title="{{$unit_item->lang->name}}">
			@endif
		@endforeach
		@if($departments->lang->post_info != '')
			{!!$departments->lang->post_info!!}
		@endif
	@endif

	@if(isset($check_up) && $check_up)
		<img src="{{unit_img('small',$check_up->img_1)}}" alt="{{$check_up->lang->name}}" title="{{$check_up->lang->name}}">
		@if($check_up->lang->long_desc_1 != '')
			{!!$check_up->lang->long_desc_1!!}
		@endif
		@if($check_up->lang->long_desc_2 != '')
			{!!$check_up->lang->long_desc_2!!}
		@endif
	@endif

	@if(isset($telemed) && $telemed)
		<img src="{{unit_img('small',$telemed->img_1)}}" alt="{{$telemed->lang->name}}" title="{{$telemed->lang->name}}">
		@if($telemed->lang->long_desc_1 != '')
			{!!$telemed->lang->long_desc_1!!}
		@endif
		@if($telemed->lang->long_desc_2 != '')
			{!!$telemed->lang->long_desc_2!!}
		@endif
	@endif
	
	@if(isset($principles) && $principles->units->count() )
		@if($principles->lang->pre_info != '')
			{!!$principles->lang->pre_info!!}
		@endif
		@foreach ($principles->units as $unit_item)
			@if($unit_item->svg != '')
				{!! $unit_item->svg !!}
			@endif
			{{$unit_item->lang->name}}
		@endforeach
		@if($principles->lang->post_info != '')
			{!!$principles->lang->post_info!!}
		@endif
	@endif

	@if(isset($standards) && $standards)
		<img src="{{unit_img('small',$standards->img_1)}}" alt="{{$standards->lang->name}}" title="{{$standards->lang->name}}">
		@if($standards->lang->long_desc_1 != '')
			{!!$standards->lang->long_desc_1!!}
		@endif
		@if($standards->lang->long_desc_2 != '')
			{!!$standards->lang->long_desc_2!!}
		@endif
	@endif




@stop
@section('scripts')
@stop
