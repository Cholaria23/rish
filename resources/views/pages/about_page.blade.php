@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page">
		@include('layouts.main.breadcrumbs')
		<div class="container">
			<div class="main-section-title text-center">
				@lang('main.about_us')
			</div>
		</div>
	</div>
	<div class="main-section">
		<div class="container">
			<div class="about-us-img-wrap">
				<img class="about-us-img lazyload" data-src="{{unit_logo($unit->logo)}}" alt="{{$unit->lang->name}}" title="{{$unit->lang->name}}">
			</div>
			@include('layouts.main.advantages')
		</div>
	</div>


	@if($unit->lang->long_desc_1 != '')
		<div class="main-section">
			<div class="container-small">
				<div class="description">
					{!!$unit->lang->long_desc_1!!}
				</div>
			</div>
		</div>
	@endif

	<section class="main-section">
		<div class="container">
			<div class="virtual-block">
				<div class="virtual-block-info-wrap">
					<div class="virtual-block-info-inner">
						<div class="virtual-block-info-title">
							{{-- @lang('main.virtual_tour_title') --}}
							@lang('main.virtual_tour_title_gallery')
						</div>
						<div class="virtual-block-text text">
							@lang('main.virtual_tour_text')
						</div>
						<a class="btn-arrow" href="/galereya">
							<span class="btn-arrow-text">
								@lang('main.look')
							</span>
						</a>
					</div>
				</div>
				<div class="virtual-block-img-wrap">
					<img class="virtual-block-img object-fit-js object-fit-cover lazyload" data-src="img/virtual-tur-img.jpg" alt="rishon virtual-tur-img">
				</div>
			</div>
		</div>
	</section>

	@if(isset($specialists) && $specialists)
		<section class="main-section">
			<div class="container">
				<div class="main-section-title-wrap">
					<div class="page-section-title-bold">
						{{$specialist->lang->name}}
					</div>
					<a class="btn-arrow" href="{{build_unit_route($specialist)}}">
						<span class="btn-arrow-text">
							@lang('main.all_specialists')
						</span>
					</a>
				</div>
				<div class="specialists-wrap mobile-slider-js">
					@foreach ($specialists as $specialist_item)
						<div class="specialists-holder">
							@include('layouts.tiles.specialist_tile')
						</div>
					@endforeach
				</div>
				<div class="btn-wrap"></div>
			</div>
		</section>
	@endif

	@if(isset($leads) && $leads->count())
		<section class="main-section">
			<div class="container-small">
				<div class="main-section-title-wrap">
					<div class="page-section-title-bold">
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
						@foreach ($leads as $lead_item)
							@include('layouts.tiles.lead')
						@endforeach
					</div>
					<div class="counter-slider-wrap">
						<div class="counter-slider">
							@php
							$i = 0;
							@endphp
							@foreach($leads as $lead_item)
								@php
								$i ++;
								@endphp
								<div class="counter-slider-item">
									<div class="count-slide">
										{{$i}}<span class="all-count-slide">/{{$leads->count()}}</span>
									</div>
								</div>
							@endforeach
						</div>
						<a class="popup-js btn-arrow-transparent" href="#reviews">
							<span class="btn-arrow-text">
								@lang('main.give_feedback')
							</span>
						</a>
					</div>
					<div class="btn-wrap"></div>
				</div>
			</div>
		</section>
	@endif

	{{-- @if($unit->files->count())
		@foreach ($unit->files as $file)
			<a class="files-item-link" href="{{ URL::to('/storage/files/'.$file->src) }}" target="_blank">
				@foreach (app('brandbook')['extentions'] as $key => $value)
					@if($value['extention'] == $file->extention)
						@if($value['svg'] != '')
							<span class="files-item-icon">
								{!!$value['svg']!!}
							</span>
						@elseif($value['icon_src'] != '')
							<img src="{{asset('storage/extentions/'.$value['icon_src'])}}" alt="{{$file->lang && $file->lang->name != ''? $file->lang->name : $file->src }}" title="{{$file->lang && $file->lang->name != ''? $file->lang->name : $file->src }}">
						@endif
					@endif
				@endforeach
				@if($file->lang && $file->lang->name != '')
					<span class="files-item-name">
						{{$file->lang->name}}
					</span>
				@else
					<span class="files-item-name">
						{{ $file->src }}
					</span>
				@endif
			</a>
		@endforeach
	@endif --}}

	@if($unit->videos->count())
		<div class="main-section">
			<div class="container-small">
				@foreach ($unit->videos as $video)
					@include('layouts.main.video')
				@endforeach
			</div>
		</div>
	@endif

	@if($unit->galleries->count())
		@foreach ($unit->galleries as $galleri_item)
			<div class="main-section">
				<div class="container">
					<div class="popup-gallery-wrap">
						<div class="page-section-title-bold">
							@lang('main.gallary')
						</div>
						<div class="popup-gallery">
							@if($galleri_item->photos->count())
								@foreach($galleri_item->photos as $key => $photo)
									<a class="gallery-item" href="{{gallery_photo_img($galleri_item->id,'big',$photo->file)}}" title="@lang('main.photo') {{$key+1}} {{$unit->lang->name}}">
										<img class="lazyload" data-src="{{gallery_photo_img($galleri_item->id,'small',$photo->file)}}" alt="@lang('main.photo') {{$key+1}} {{$unit->lang->name}}" title="@lang('main.photo') {{$key+1}} {{$unit->lang->name}}">
									</a>
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
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
@stop
@section('scripts')
@stop
