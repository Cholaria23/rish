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
	{{$unit->date_publication->format('d')}}/{{$unit->date_publication->format('m')}}
	@lang('main.titles.'.$unit->category->id)
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

	@if(isset($rel_service_units) && $rel_service_units->count())
		@foreach ($rel_service_cats as $rel_service_cat)
			{{$rel_service_cat->lang->name}}
			@foreach ($rel_service_units as $unit_item)
				@if($rel_service_cat->id == $unit_item->cat_id)
					<a href="{{build_unit_route($unit_item)}}">{{$unit_item->lang->name}}</a>
				@endif
			@endforeach
		@endforeach
	@endif

	@if(isset($news) && $news->count())
		@lang('main.last_units')
		@foreach ($news as $unit_item)
			@if (in_array($unit_item->cat_id, \Demos\AdminPanel\Cat::descendants(2)))
				@include('layouts.tiles.news')
			@elseif(in_array($unit_item->cat_id, \Demos\AdminPanel\Cat::descendants(3)))
				@include('layouts.tiles.actions')
			@endif
		@endforeach
	@endif
@stop
@section('scripts')
@stop
