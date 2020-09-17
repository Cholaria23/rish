@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="unit-page">
		<div class="container">
			<div class="unit-page-wrap">
				<div class="unit-page-main">
					@include('layouts.main.breadcrumbs')
					@if($unit->lang->h1 != '')
						<h1 class="main-section-title">
							{{$unit->lang->h1}}
						</h1>
					@else
						<h1 class="main-section-title">
							{{$unit->lang->name}}
						</h1>
					@endif
					<div class="unit-category-info">
						<span class="unit-category-info-date">
							<span class="bold">{{$unit->date_publication->format('d')}}</span>/{{$unit->date_publication->format('m')}}
						</span>
						<div class="unit-category-info-name">
							@lang('main.titles.'.$unit->category->id)
						</div>
					</div>
					@if(isset($unit->related_specialists) && $unit->related_specialists && isset($unit->related_specialists[3]) && isset($unit->related_specialists[3]['specialists']))
						<div class="unit-category-link-wrap">
							@foreach ($unit->related_specialists[3]['specialists'] as  $specialist_item)
								<a class="unit-category-link" href="{{build_expert_route($specialist_item->alias)}}">
									<span class="unit-category-img-wrap">
										<img class="unit-category-img lazyload" data-src="{{specialist_cover('thumb', $specialist_item->img_1)}}" alt="{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}" title="{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}">
									</span>
									<span class="unit-category-name-wrap">
										<span class="unit-category-author">
											@lang('main.titles.author.author')
											@lang('main.titles.author.'.$unit->category->id)
										</span>
										<span class="unit-category-name">
											{{$specialist_item->lang->last_name}}
											{{$specialist_item->lang->first_name}}
											{{$specialist_item->lang->father_name}}
										</span>
										@if(isset($specialist_item->chars_vals[2]) && isset($specialist_item->chars_vals[2]['values']))
											<span class="unit-category-desc">
												{{-- <svg width="26" height="26">
													<use xlink:href="#spec_active"></use>
												</svg> --}}
												{{implode(", ",$specialist_item->chars_vals[2]['values'])}}
											</span>
										@endif
									</span>
								</a>
							@endforeach
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
					@if($unit->videos->count())
						@foreach ($unit->videos as $video)
							@include('layouts.main.video')
						@endforeach
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


					@if($unit->galleries->count())
						@foreach ($unit->galleries as $galleri_item)
							<div class="popup-gallery-wrap">
								<div class="page-section-title-bold">
									@lang('main.gallary')
								</div>
								@if($galleri_item->photos->count())
									<div class="popup-gallery">
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

					@if(isset($rel_service_units) && $rel_service_units->count() || isset($rel_service_cats) && $rel_service_cats->count())
						@lang('main.news_direction')
						@if(isset($rel_service_cats) && $rel_service_cats->count())
							@foreach ($rel_service_cats as $rel_service_cat)
								<div class="activity-area-block">
									<div class="page-section-title">
										{{$rel_service_cat->lang->name}}
									</div>
									@if(isset($rel_service_units) && $rel_service_units->count())
										<div class="activity-area-item-wrap">
											@foreach ($rel_service_units as $unit_item)
												@if($rel_service_cat->id == $unit_item->cat_id)
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
												@endif
											@endforeach
										</div>
									@endif
								</div>
							@endforeach
						@endif
					@endif
				</div>
				@if(isset($news) && $news->count())
					<div class="unit-page-aside">
						<div data-simplebar data-simplebar-auto-hide="false" class="unit-page-aside-inner sticky-with-hiden simplebar">
							<div class="aside-title">
								@lang('main.last_units')
							</div>
							<div class="special-actions-wrap mobile-slider-js">
								@foreach ($news as $unit_item)
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
					</div>
				@endif
			</div>
		</div>
	</div>
@stop
@section('scripts')
@stop
