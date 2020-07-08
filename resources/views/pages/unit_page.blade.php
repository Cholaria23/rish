@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	@foreach($unit->chars_vals as $chars_val)
		<p>{{ $chars_val['name'] }}: {{ $chars_val['value'] }}</p>
	@endforeach

	@foreach($unit->additions as $addition)
		@include("AdminPanel::units.additions.parts.".$addition->type->alias)
		<hr>
	@endforeach

@stop
@section('scripts')
@stop