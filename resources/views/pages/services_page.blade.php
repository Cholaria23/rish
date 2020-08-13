@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	@include('layouts.main.breadcrumbs')
	@if($unit->lang->h1 != '')
		<h1>
			{{$unit->lang->h1}}
		</h1>
	@else
		<h1>
			{{$unit->lang->name}}
		</h1>
	@endif
	@if($unit->lang->long_desc_1 != '')
		{!!$unit->lang->long_desc_1!!}
	@endif
	@if(!empty($unit->related_goods) && $unit->related_goods->count() || !empty($unit->related_market_cats) && $unit->related_market_cats_flag)
		@lang('main.price')
		@if(!empty($unit->related_goods))
			@foreach ($unit->related_goods as $good)
				@include('layouts.tiles.good')
			@endforeach
		@endif
		@if(!empty($unit->related_market_cats))
			@foreach ($unit->related_market_cats as $market_cat)
				@foreach ($market_cat->goods as $good)
					@include('layouts.tiles.good')
				@endforeach
			@endforeach
		@endif
	@endif
	@if($unit->lang->long_desc_2 != '' || $unit->videos->count())
		@if($unit->lang->long_desc_2 != '')
			{!!$unit->lang->long_desc_2!!}
		@endif
		@if($unit->videos->count())
			@foreach ($unit->videos as $video)
				@include('layouts.main.video')
			@endforeach
		@endif
	@endif

	@if($unit->rel_faq_groups->count())
		<h2>
			@lang('main.titles.faq')
		</h2>
		@foreach ($unit->rel_faq_groups as $group_item)
			<h3>{{$group_item->lang->title}}</h3>
			@if($group_item->faq->count())
				@foreach ($group_item->faq as $faq_item)
					@if($faq_item->lang->question != '')
						{!!$faq_item->lang->question!!}
					@endif
					@if($faq_item->lang->answer != '')
						{!!$faq_item->lang->answer!!}
					@endif
					@if($faq_item->lang->link  != '')
						<a href="{{$faq_item->lang->link}}">@lang('main.more')</a>
					@endif
				@endforeach
			@endif
		@endforeach
	@endif

	@if($rel_types->count())
		@foreach ($rel_types as $type_item)
			@if ($type_item->id == 2)
				@if (isset($unit->related_units[$type_item->id]) && count($unit->related_units[$type_item->id]['units']))
					<h2>
						@lang('main.equipment')
					</h2>
					@foreach ($unit->related_units[$type_item->id]['units'] as $unit_item)
						@include('layouts.tiles.equipment')
					@endforeach
				@endif
			@endif
		@endforeach
	@endif

	@if(isset($unit->related_specialists) && $unit->related_specialists && isset($unit->related_specialists[2]) && isset($unit->related_specialists[2]['specialists']))
		@foreach ($unit->related_specialists[2]['specialists'] as  $specialist_item)
			@include('layouts.tiles.specialist_tile')
		@endforeach
	@endif

	@if($unit->leads->count())
        @lang('main.reviews')
        @foreach ($unit->leads as $lead_item)
            @include('layouts.tiles.lead')
        @endforeach
    @endif

	@if($rel_types->count())
		@foreach ($rel_types as $type_item)
			@if ($type_item->id == 3)
				@if (isset($unit->related_units[$type_item->id]) && count($unit->related_units[$type_item->id]['units']))
					<h2>
						@lang('main.useful_info')
					</h2>
					@foreach ($unit->related_units[$type_item->id]['units'] as $unit_item)
						@if (in_array($unit_item->cat_id, \Demos\AdminPanel\Cat::descendants(2)))
							@include('layouts.tiles.news')
						@elseif(in_array($unit_item->cat_id, \Demos\AdminPanel\Cat::descendants(3)))
							@include('layouts.tiles.actions')
						@endif
					@endforeach
				@endif
			@endif
		@endforeach
	@endif

	@if($unit->galleries->count())
		@foreach ($unit->galleries as $galleri_item)
			@lang('main.gallary')
			@if($galleri_item->photos->count())
				@foreach($galleri_item->photos as $photo)
					<a class="description-gallary-holder" href="{{gallery_photo_img($galleri_item->id,'big',$photo->file)}}" data-rel="lightcase:gallery">
						<img class="description-gallary-item lazyload" data-src="{{gallery_photo_img($galleri_item->id,'small',$photo->file)}}" alt="@lang('main.photo') {{$unit->lang->name}} " title="@lang('main.photo') {{$unit->lang->name}} ">
					</a>
				@endforeach
			@endif
		@endforeach
	@endif

@stop
@section('scripts')
@stop