@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page search_page">
		<section class="page-section section-with-breadcrumbs">
            <div class="container-small">
				@include('layouts.main.breadcrumbs')
				<h1 class="main-section-title">
					{!!$page_title!!}
					<span>
						({{$count}})
					</span>
				</h1>
			</div>
        </section>
		<section class="main-section">
			<div class="container-small">
				@if(
					isset($services) && count($services) ||
					isset($services_categories) && count($services_categories) ||
					isset($news) && count($news) ||
					isset($articles) && count($articles) ||
					isset($actions) && count($actions) ||
					isset($specialists) && count($specialists) ||
					isset($equipments) && count($equipments) ||
					isset($units) && count($units)
					)
					<div class="tabs-container">
						<div class="tabs-btn-wrap">
							<button class="active-tab-mobile" type="button" name="button">
								<span class="active-tab-mobile-text">
									@lang('main.view_all_price')
								</span>
							</button>
							<ul class="tabs">
								@if(isset($services) && count($services))
									<li class="tab-link" data-tab="services">
										@lang('main.search_arr.services') ({{count($services)}})
									</li>
								@endif
								@if(isset($services_categories) && count($services_categories))
									<li class="tab-link" data-tab="services_categories">
										@lang('main.search_arr.services_categories') ({{count($services_categories)}})
									</li>
								@endif
								@if(isset($news) && count($news))
									<li class="tab-link" data-tab="news">
										@lang('main.search_arr.news') ({{count($news)}})
									</li>
								@endif
								@if(isset($articles) && count($articles))
									<li class="tab-link" data-tab="articles">
										@lang('main.search_arr.articles') ({{count($articles)}})
									</li>
								@endif
								@if(isset($actions) && count($actions))
									<li class="tab-link" data-tab="actions">
										@lang('main.search_arr.actions') ({{count($actions)}})
									</li>
								@endif
								@if(isset($specialists) && count($specialists))
									<li class="tab-link" data-tab="specialists">
										@lang('main.search_arr.specialists') ({{count($specialists)}})
									</li>
								@endif
								@if(isset($equipments) && count($equipments))
									<li class="tab-link" data-tab="equipments">
										@lang('main.search_arr.equipments') ({{count($equipments)}})
									</li>
								@endif
								@if(isset($units) && count($units))
									<li class="tab-link" data-tab="units">
										@lang('main.search_arr.units') ({{count($units)}})
									</li>
								@endif
							</ul>
						</div>
						<ul class="tab-content-wrap">
							@if(isset($services) && count($services))
								<li class="tab-content" id="services">
									<div class="tab-content-inner">
										<div class="servises-block">
											@foreach ($services as $unit_item)
												@include('layouts.tiles.search')
											@endforeach
										</div>
									</div>
								</li>
							@endif
							@if(isset($services_categories) && count($services_categories))
								<li class="tab-content" id="services_categories">
									<div class="tab-content-inner">
										<div class="servises-block">
											@foreach ($services_categories as $unit_item)
												@include('layouts.tiles.search')
											@endforeach
										</div>
									</div>
								</li>
							@endif
							@if(isset($news) && count($news))
								<li class="tab-content" id="news">
									<div class="tab-content-inner">
										@foreach ($news as $unit_item)
											@include('layouts.tiles.search')
										@endforeach
									</div>
								</li>
							@endif
							@if(isset($articles) && count($articles))
								<li class="tab-content" id="articles">
									<div class="tab-content-inner">
										@foreach ($articles as $unit_item)
											@include('layouts.tiles.search')
										@endforeach
									</div>
								</li>
							@endif
							@if(isset($actions) && count($actions))
								<li class="tab-content" id="actions">
									<div class="tab-content-inner">
										@foreach ($actions as $unit_item)
											@include('layouts.tiles.search')
										@endforeach
									</div>
								</li>
							@endif
							@if(isset($specialists) && count($specialists))
								<li class="tab-content" id="specialists">
									<div class="tab-content-inner">
										@foreach ($specialists as $unit_item)
											@include('layouts.tiles.search')
										@endforeach
									</div>
								</li>
							@endif
							@if(isset($equipments) && count($equipments))
								<li class="tab-content" id="equipments">
									<div class="tab-content-inner">
										@foreach ($equipments as $unit_item)
											@include('layouts.tiles.search')
										@endforeach
									</div>
								</li>
							@endif
							@if(isset($units) && count($units))
								<li class="tab-content" id="units">
									<div class="tab-content-inner">
										@foreach ($units as $unit_item)
											@include('layouts.tiles.search')
										@endforeach
									</div>
								</li>
							@endif
						</ul>
					</div>
				@endif
			</div>
		</section>
	</div>
@stop
@section('scripts')
@stop
