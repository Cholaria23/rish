@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page">
		@include('layouts.main.breadcrumbs')
	</div>
	@if($unit->lang->h1 != '')
		<div class="container">
			<div class="page-section-top-title">
				{{$unit->lang->h1}}
			</div>
		</div>
	@else
		<div class="container">
			<div class="page-section-top-title">
				{{$unit->lang->name}}
			</div>
		</div>
	@endif
	@if($unit->lang->long_desc_1 != '')
		<div class="main-section">
			<div class="container-small">
				<div class="description">
					{!!$unit->lang->long_desc_1!!}
				</div>
			</div>
		</div>
	@endif

	<form >
		
	</form>

	@if($unit->lang->long_desc_2 != '')
		<div class="main-section">
			<div class="container-small">
				<div class="description">
					{!!$unit->lang->long_desc_2!!}
				</div>
			</div>
		</div>
	@endif

@stop
@section('scripts')
@stop
