@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page">
		@include('layouts.main.breadcrumbs')
		<div class="main-section">
			<div class="container">
				<div class="unit-block specialist-block">
					<div class="unit-block-img-wrap">
						<div class="sticky">
							<img class="unit-block-img lazyload" data-src="{{specialist_cover('small', $expert->img_1)}}" alt="{{$expert->lang->last_name}} {{$expert->lang->first_name}} {{$expert->lang->father_name}}" title="{{$expert->lang->last_name}} {{$expert->lang->first_name}} {{$expert->lang->father_name}}">
						</div>
					</div>
					<div class="unit-block-info">
						<div class="main-section-title unit-block-title-js">
							{{$expert->lang->last_name}}
							{{$expert->lang->first_name}}
							{{$expert->lang->father_name}}
						</div>
						@if(isset($expert->chars_vals[4]) && isset($expert->chars_vals[4]['values']))
							<ul class="specialist-activities-list">
								@foreach ($expert->chars_vals[4]['values'] as $val_item)
									<li class="specialist-activities-item">
										{{$val_item}}
									</li>
								@endforeach
							</ul>
						@endif
						@if($expert->experiences->count() || isset($expert->chars_vals[2]) && isset($expert->chars_vals[2]['values']))
							<div class="specialist-status-wrap">
								@if($expert->experiences->count())
									@foreach($expert->experiences as $xp)
										<div class="specialist-status-item">
											<div class="specialist-status-svg">
												<svg width="26" height="26">
					                                <use xlink:href="#clock"></use>
					                            </svg>
											</div>
											<div class="specialist-status-text">
												@choice('main.xp',(date("Y")-$xp->start),["year" => (date("Y")-$xp->start)])
											</div>
										</div>
									@endforeach
								@endif
								@if(isset($expert->chars_vals[2]) && isset($expert->chars_vals[2]['values']))
									<div class="specialist-status-item">
										<div class="specialist-status-svg">
											<svg width="26" height="26">
												<use xlink:href="#spec_active"></use>
											</svg>
										</div>
										<div class="specialist-status-text">
											{{implode(",",$expert->chars_vals[2]['values'])}}
										</div>
									</div>
								@endif
							</div>
						@endif
						<div class="popup-btn-wrap">
							<a class="btn-light-green-small popup-js" href="#test-modal">
								<span class="btn-light-green-small-icon">
									<svg width="19" height="19">
										<use xlink:href="#chat"></use>
									</svg>
								</span>
								@lang('main.btn.question_specialist')
							</a>
							<a class="btn-green-small popup-js" href="#test-modal">
								@lang('main.btn.make_appointment')
							</a>
						</div>
						@if($expert->lang->long_desc_1 != '')
							<div class="description">
								{!!$expert->lang->long_desc_1!!}
							</div>
						@endif
						@if($expert->lang->long_desc_2 != '')
							<div class="description">
								{!!$expert->lang->long_desc_2!!}
							</div>
						@endif
						@if (isset($expert->related_cats[1]) && count($expert->related_cats[1]['cats']) || isset($expert->related_units[2]) && count($expert->related_units[2]['units']))
							@php
							$unit_block_ids = [];
							@endphp
							<div class="activity-area-block">
								<div class="page-section-title-bold">
									@lang('main.activity_area')
								</div>
								<div class="activity-area-item-wrap">
									@foreach ($expert->related_cats[1]['cats'] as $cat_item)
										<div class="activity-area-item cat">
											@include('layouts.tiles.service_tile')
										</div>
										@foreach ($expert->related_units[2]['units'] as $unit_item)
											@if($cat_item->id == $unit_item->cat_id)
												@php
												$unit_block_ids[] = $unit_item->id;
												@endphp
												<div class="activity-area-item unit">
													@include('layouts.tiles.service_unit_tile')
												</div>
											@endif
										@endforeach
									@endforeach
									@foreach ($expert->related_units[2]['units'] as $unit_item)
										@if(!in_array($unit_item->id,$unit_block_ids))
											<div class="activity-area-item">
												@include('layouts.tiles.service_unit_tile')
											</div>
										@endif
									@endforeach
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>


	@if($expert->images_1->count())
		<section class="main-section">
			<div class="container">
				<div class="page-section-title-bold">
					@lang('main.diploms')
				</div>
				<div class="popup-gallery diploms-gallery">
					@foreach ($expert->images_1 as $key => $img_item)
						<a href="{{specialist_image('big',$img_item->src)}}" class="gallery-item" title="{{$expert->lang->last_name}} {{$expert->lang->first_name}} {{$expert->lang->father_name}} @lang('main.diploms') {{$key+1}}">
							<img class="lazyload" data-src="{{specialist_image('small',$img_item->src)}}" alt="{{$expert->lang->last_name}} {{$expert->lang->first_name}} {{$expert->lang->father_name}} @lang('main.diploms') {{$key+1}}" title="{{$expert->lang->last_name}} {{$expert->lang->first_name}} {{$expert->lang->father_name}} @lang('main.diploms') {{$key+1}}">
						</a>
					@endforeach
				</div>
			</div>
		</section>
	@endif

	@if($expert->leads->count())
		<section class="main-section reviews">
			<div class="container-small">
				<div class="main-section-title-wrap">
					<div class="main-section-title">
						@lang('main.reviews')
					</div>
					<a class="btn-arrow" href="{{build_unit_route($reviews)}}">
						<span class="btn-arrow-text">
							@lang('main.all_reviews')
						</span>
					</a>
				</div>
				<div class="section-inner">
					<div class="reviews-slider">
						@foreach ($expert->leads as $lead_item)
							@include('layouts.tiles.lead')
						@endforeach
					</div>
					<div class="counter-slider">
						@php
						$i = 0;
						@endphp
						@foreach($expert->leads as $lead_item)
							@php
							$i ++;
							@endphp
							<div class="counter-slider-item">
								<div class="count-slide">
									{{$i}}<span class="all-count-slide">/{{$expert->leads->count()}}</span>
								</div>
							</div>
						@endforeach
					</div>
					<div class="btn-wrap"></div>
				</div>
			</div>
    	</section>
	@endif

	@if(isset($expert->related_units[3]) && count($expert->related_units[3]['units']))
		<section class="main-section">
			<div class="container">
				<div class="page-section-title-bold">
					@lang('main.expert_publication')
				</div>
				<div class="special-actions-wrap mobile-slider-js">
					@foreach ($expert->related_units[3]['units'] as $unit_item)
						@if (in_array($unit_item->cat_id, \Demos\AdminPanel\Cat::descendants(2)))
							<div class="special-action-holder">
								@include('layouts.tiles.news')
							</div>
						@elseif(in_array($unit_item->cat_id, \Demos\AdminPanel\Cat::descendants(3)))
							<div class="special-action-holder">
								@include('layouts.tiles.actions')
							</div>
						@endif
					@endforeach
				</div>
			</div>
		</section>
	@endif
@stop
@section('scripts')
@stop
