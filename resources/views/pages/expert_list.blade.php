@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	@include('layouts.main.breadcrumbs')
	@if(isset($specialists) && $specialists)
		@foreach ($specialists as $specialist_item)
			@include('layouts.tiles.specialist_tile')
		@endforeach
		@if($specialists instanceof \Illuminate\Pagination\LengthAwarePaginator)
			{{$specialists->links()}}
		@endif
	@endif

@stop
@section('scripts')
@stop