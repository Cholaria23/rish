@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page">
		@include('layouts.main.breadcrumbs')
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

		@if($unit->lang->long_desc_2 != '')
			<div class="main-section">
				<div class="container-small">
					<div class="description">
						{!!$unit->lang->long_desc_2!!}
					</div>
				</div>
			</div>
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
	@foreach ($unit->videos as $video)
		<div class="main-section">
			<div class="container-small">
				@include('layouts.main.video')
			</div>
		</div>
	@endforeach
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
							@foreach($galleri_item->photos as $photo)
								<a class="gallery-item" href="{{gallery_photo_img($galleri_item->id,'big',$photo->file)}}" title="@lang('main.photo') {{$unit->lang->name}}">
									<img class="lazyload" data-src="{{gallery_photo_img($galleri_item->id,'small',$photo->file)}}" alt="@lang('main.photo') {{$unit->lang->name}}" title="@lang('main.photo') {{$unit->lang->name}}">
								</a>
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	@endforeach
@endif
	</div>

@stop
@section('scripts')
@stop
