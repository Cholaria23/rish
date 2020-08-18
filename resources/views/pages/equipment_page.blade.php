@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page">
		@include('layouts.main.breadcrumbs')
		<div class="main-section">
			<div class="container">
				<div class="unit-block equipment-block">
					<div class="unit-block-img-wrap">
						<div class="sticky">
							<img class="unit-block-img lazyload" data-src="{{unit_img('small',$unit->img_1)}}" alt="{{$unit->lang->name}}" title="{{$unit->lang->name}}">
						</div>
					</div>
					<div class="unit-block-info">
						@if($unit->lang->h1 != '')
							<div class="main-section-title unit-block-title-js">
								{{$unit->lang->h1}}
							</div>
						@else
							<div class="main-section-title unit-block-title-js">
								{{$unit->lang->name}}
							</div>
						@endif
						@if($unit->lang->long_desc_1 != '')
							<div class="description">
								{!!$unit->lang->long_desc_1!!}
							</div>
						@endif
						@if($unit->lang->long_desc_2 != '')
							<div class="description">
								{!!$unit->lang->long_desc_2!!}
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
								@include('layouts.main.video')
							@endforeach
						@endif
						@if($unit->galleries->count())
							@foreach ($unit->galleries as $galleri_item)
								<div class="popup-gallery-wrap">
									@if($galleri_item->photos->count())
										<div class="page-section-title-bold">
											@lang('main.gallary')
										</div>
										<div class="popup-gallery equipment">
											@foreach($galleri_item->photos as $photo)
												<a class="gallery-item" href="{{gallery_photo_img($galleri_item->id,'big',$photo->file)}}" title="@lang('main.photo') {{$unit->lang->name}}">
													<img class="lazyload" data-src="{{gallery_photo_img($galleri_item->id,'small',$photo->file)}}" alt="@lang('main.photo') {{$unit->lang->name}} " title="@lang('main.photo') {{$unit->lang->name}}">
												</a>
											@endforeach
										</div>
									@endif
								</div>
							@endforeach
						@endif
						@if($rel_types->count())
							@foreach ($rel_types as $type_item)
								@if ($type_item->id == 2)
									@if (isset($unit->related_units[$type_item->id]) && count($unit->related_units[$type_item->id]['units']))
										<div class="activity-area-block">
											<div class="page-section-title">
												@lang('main.titles.equipment_in')
											</div>
											<div class="activity-area-item-wrap">
												@foreach ($unit->related_units[$type_item->id]['units'] as $unit_item)
													<div class="activity-area-item unit">
														<a class="services-list-link" href="{{build_unit_route($unit_item)}}">
															{{$unit_item->lang->name}}
															<span class="services-list-icon">
																<svg width="17" height="14">
																	<use xlink:href="#icon-right-arrow-green"></use>
																</svg>
															</span>
														</a>
													</div>
												@endforeach
											</div>
										</div>
									@endif
								@endif
							@endforeach
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@stop
@section('scripts')
@stop
