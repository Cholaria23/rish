@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page">
		<section class="page-section section-with-breadcrumbs">
            <div class="container-small">
				@include('layouts.main.breadcrumbs')
				@if($unit->lang->h1 != '')
					<div class="container">
						<h1 class="page-section-top-title">
							{{$unit->lang->h1}}
						</h1>
					</div>
				@else
					<div class="container">
						<h1 class="page-section-top-title">
							{{$unit->lang->name}}
						</h1>
					</div>
				@endif
			</div>
        </section>
		@if($unit->lang->long_desc_1 != '')
			<section class="main-section">
				<div class="description">
					{!!$unit->lang->long_desc_1!!}
				</div>
			</section>
		@endif
	</div>
@stop
@section('scripts')
@stop
