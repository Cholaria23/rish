@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	@include('layouts.main.breadcrumbs')
	@if($unit->lang->h1 != '')
		<h1>
			{{$unit->lang->h1}}
		</h1>
	@else
		<h1>
			{{$unit->lang->name}}
		</h1>
	@endif
	<img src="{{unit_logo($unit->logo)}}" alt="{{$unit->lang->name}}" title="{{$unit->lang->name}}">
	@include('layouts.main.advantages')


	@if($unit->lang->long_desc_1 != '')
		{!!$unit->lang->long_desc_1!!}
	@endif
	@if($unit->lang->long_desc_2 != '')
		{!!$unit->lang->long_desc_2!!}
	@endif

	@if(isset($specialists) && $specialists)
		<section class="main-section">
			<div class="container">
				<div class="main-section-title-wrap">
					<div class="main-section-title">
						{{$specialist->lang->name}}
					</div>
					<a class="btn-arrow" href="{{build_unit_route($specialist)}}">
						<span class="btn-arrow-text">
							@lang('main.all_specialists')
						</span>
					</a>
				</div>
				<div class="specialists-wrap">
					@foreach ($specialists as $specialist_item)
						<div class="specialists-holder">
							@include('layouts.tiles.specialist_tile')
						</div>
					@endforeach
				</div>
			</div>
		</section>
	@endif

	@if(isset($leads) && $leads->count())
		<section class="main-section">
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
				<div class="reviews-slider">
					@foreach ($leads as $lead_item)
						@include('layouts.tiles.lead')
					@endforeach
				</div>
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
			</div>
		</section>
	@endif

	@if($unit->files->count())
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
	@endif

	@if($unit->videos->count())
		@foreach ($unit->videos as $video)
			@include('layouts.main.video')
		@endforeach
	@endif
	@if($unit->galleries->count())
		@foreach ($unit->galleries as $galleri_item)
			@lang('main.gallary')
			@if($galleri_item->photos->count())
				@foreach($galleri_item->photos as $key => $photo)
					<a class="description-gallary-holder" href="{{gallery_photo_img($galleri_item->id,'big',$photo->file)}}" data-rel="lightcase:gallery">
						<img class="description-gallary-item lazyload" data-src="{{gallery_photo_img($galleri_item->id,'small',$photo->file)}}" alt="@lang('main.photo') {{$key+1}} {{$unit->lang->name}} " title="@lang('main.photo') {{$key+1}} {{$unit->lang->name}} ">
					</a>
				@endforeach
			@endif
		@endforeach
	@endif

@stop
@section('scripts')
@stop