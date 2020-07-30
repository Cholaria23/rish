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
    @if(isset($cat->popular_units) && $cat->popular_units && $cat->popular_units->count())
        @lang('main.popular_units')
        @foreach ($cat->popular_units as $unit_item)
			@include('layouts.tiles.news')
        @endforeach
    @endif
    @if($cat->lang->pre_info != '')
        {!! $cat->lang->pre_info !!}
    @endif
    @if($cat->units->count())
        @foreach ($cat->units as $unit_item)
			@include('layouts.tiles.news')
        @endforeach
    @else
        @lang('main.empty_cat')
	@endif
    @if($cat->lang->post_info != '')
        {!! $cat->lang->post_info !!}
    @endif
@stop
@section('scripts')
@stop