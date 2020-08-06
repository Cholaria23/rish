@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
    @include('layouts.main.breadcrumbs')
    @if($cat->lang->h1 != '')
		<h1>
			{{$cat->lang->h1}}
		</h1>
	@else
		<h1>
			{{$cat->lang->name}}
		</h1>
    @endif
    @if($cat->lang->pre_info != '')
        {!! $cat->lang->pre_info !!}
    @endif
    {{-- related_units --}}
    @if(isset($cat->related_goods) && $cat->related_goods && $cat->related_goods->count())
        @lang('main.price')
        @foreach ($cat->related_goods as $good)
            @include('layouts.tiles.good')
        @endforeach
    @endif
    @if($cat->lang->post_info != '')
        {!! $cat->lang->post_info !!}
    @endif
    @if($cat->units->count())
        @foreach ($cat->units as $unit_item)
            @include('layouts.tiles.service_unit_tile')
        @endforeach
    @endif
    @if(isset($cat->related_specialists) && $cat->related_specialists && isset($cat->related_specialists[1]) && isset($cat->related_specialists[1]['specialists']))
        @foreach ($cat->related_specialists[1]['specialists'] as  $specialist_item)
            @include('layouts.tiles.specialist_tile')
        @endforeach
    @endif

    @if(isset($cat->related_units) && $cat->related_units && $cat->related_units->count() && get_cat_id_flag($cat->related_units,[7]))
        @lang('main.equipment')
        @foreach ($cat->related_units as $unit_item)
            @if(in_array($unit_item->cat_id, [7]))
                @include('layouts.tiles.equipment')
            @endif
        @endforeach
    @endif

    @if($cat->leads->count())
        @lang('main.reviews')
        @foreach ($cat->leads as $lead_item)
            @include('layouts.tiles.lead')
        @endforeach
    @endif

    @if(isset($cat->related_units) && $cat->related_units && $cat->related_units->count() && get_cat_id_flag($cat->related_units,\Demos\AdminPanel\Cat::descendants(2)))
        @lang('main.useful_info')
        @foreach ($cat->related_units as $unit_item)
            @if(in_array($unit_item->cat_id, \Demos\AdminPanel\Cat::descendants(2)))
                @include('layouts.tiles.news')
            @endif
        @endforeach
    @endif

    @if($cat->galleries->count())
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
    @endif

@stop
@section('scripts')
@stop