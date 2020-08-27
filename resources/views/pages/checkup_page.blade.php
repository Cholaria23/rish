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
	@if($unit->lang->short_desc_1 != '')
		{!!$unit->lang->short_desc_1!!}
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
	@if(!empty($unit->related_goods) && $unit->related_goods->count() || !empty($unit->related_market_cats) && $unit->related_market_cats)
		<section class="main-section">
			<div class="container-small">
				<div class="page-section-title-bold">
					@lang('main.price')
				</div>
				@if(!empty($unit->related_goods) || !empty($unit->related_market_cats) && $unit->related_market_cats)
					<ul class="price-list">
						@if(!empty($unit->related_market_cats))
							@foreach ($unit->related_market_cats as $market_cat)
								@php
									$i = 0;
								@endphp
								@foreach ($market_cat->goods as $good)
									@php
										$i ++;
									@endphp
									<li class="price-item {{ $i<6 ? 'visible' : 'hide' }}">
										<div class="price-item-wrap">
											@include('layouts.tiles.good')
										</div>
									</li>
								@endforeach
							@endforeach
						@endif
						@if(!empty($unit->related_goods))
								@php
									$k = $i;
								@endphp
								@foreach ($unit->related_goods as $good)
									@php
									$k ++;
									@endphp
									<li class="price-item {{ $k<6 ? 'visible' : 'hide' }}">
										<div class="price-item-wrap">
											@include('layouts.tiles.good')
										</div>
									</li>
								@endforeach

						@endif
						
					</ul>
				@endif
				@if (isset($i) && $i > 5 || isset($k) && $k > 5)
					<div class="more-link-section all_price_js">
						<span class="visible-text">
							@lang('main.view_all_price')
						</span>
						<span class="hide-text text-hide">
							@lang('main.hide-text')
						</span>
					</div>
				@endif
			</div>
		</section>
	@endif
	@if($unit->lang->long_desc_2 != '')
		<div class="main-section">
			<div class="container-small">
				<div class="description">
					{!!$unit->lang->long_desc_2!!}
				</div>
			</div>
		</div>
	@endif

	@if(isset($checkup_info) && $checkup_info->count())
		@foreach ($checkup_info as $key => $unit_item)
			@if(in_array($key,[0,1,2,3,4,5,6,7,8]))
				0{{$key+1}} {{$unit_item->lang->name}}
				@if($unit_item->lang->long_desc_1 != '')
					{!! $unit_item->lang->long_desc_1 !!}
				@endif
			@else
				{{$key+1}} 	{{$unit_item->lang->name}}
				@if($unit_item->lang->long_desc_1 != '')
					{!! $unit_item->lang->long_desc_1 !!}
				@endif
			@endif
		@endforeach
	@endif

@stop
@section('scripts')
@stop
