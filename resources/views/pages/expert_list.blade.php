@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page">
		@if(isset($specialists) && $specialists)
			<section class="page-section section-with-breadcrumbs">
	            <div class="container">
					@include('layouts.main.breadcrumbs')
					<h1 class="page-section-top-title">
						@lang('main.our_specialists')
					</h1>
				</div>
        	</section>
			<section class="main-section specialists">
				<div class="container">
					<div class="search-specialists-block">
						<div class="page-section-title">
							@lang('main.form.search_specialist')
						</div>
						<form class="search-specialists-form" action="/expert/?search=">
							<div class="search-specialists-input-holder">
								<input class="search-specialists-input"  type="text" name="search" placeholder="@lang('main.form.search_name_direction')" minlength="3" autocomplete="off" required>
							</div>
							<button class="search-btn">
								@lang('main.btn.find')
							</button>
						</form>
					</div>
                    <div class="specialists-wrap">
						@foreach ($specialists as $specialist_item)
							<div class="specialists-holder">
								@include('layouts.tiles.specialist_tile')
							</div>
						@endforeach
					</div>
					@if($specialists instanceof \Illuminate\Pagination\LengthAwarePaginator)
						{{$specialists->links()}}
					@endif
				</div>
			</section>
		@endif
	</div>
@stop
@section('scripts')
@stop
