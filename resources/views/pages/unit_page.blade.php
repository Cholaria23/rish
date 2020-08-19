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
	@if($unit->lang->long_desc_1 != '')
		{!!$unit->lang->long_desc_1!!}
	@endif
	@if($unit->lang->long_desc_2 != '')
		{!!$unit->lang->long_desc_2!!}
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
				@foreach($galleri_item->photos as $photo)
					<a class="description-gallary-holder" href="{{gallery_photo_img($galleri_item->id,'big',$photo->file)}}" data-rel="lightcase:gallery">
						<img class="description-gallary-item lazyload" data-src="{{gallery_photo_img($galleri_item->id,'small',$photo->file)}}" alt="@lang('main.photo') {{$unit->lang->name}} " title="@lang('main.photo') {{$unit->lang->name}} ">
					</a>
				@endforeach
			@endif
		@endforeach
	@endif

@stop
@section('scripts')
@stop
