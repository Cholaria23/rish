@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page reviews-page padding-bottom">
		@include('layouts.main.breadcrumbs')
		<div class="unit-page-section">
			<div class="container-small">
				<div class="write-reviews-block">
					@if($unit->lang->h1 != '')
						<h1 class="page-title">
							{{$unit->lang->h1}}
						</h1>
					@else
						<h1 class="page-title">
							{{$unit->lang->name}}
						</h1>
					@endif
					<button class="big-ligth-btn open-reviews-form" type="button" name="button">
						@lang('main.write_reviews')
					</button>
					<div class="write-reviews-form-wrap">
						<div class="popup-content">
							<div class="close">
					            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48"><path d="M28.2 24L47.1 5.1c1.2-1.2 1.2-3.1 0-4.2 -1.2-1.2-3.1-1.2-4.2 0L24 19.7 5.1 0.9c-1.2-1.2-3.1-1.2-4.2 0 -1.2 1.2-1.2 3.1 0 4.2l18.9 18.9L0.9 42.9c-1.2 1.2-1.2 3.1 0 4.2C1.5 47.7 2.2 48 3 48s1.5-0.3 2.1-0.9l18.9-18.9L42.9 47.1c0.6 0.6 1.4 0.9 2.1 0.9s1.5-0.3 2.1-0.9c1.2-1.2 1.2-3.1 0-4.2L28.2 24z"></path></svg>
					        </div>
					        <div class="popup-name">
					            @lang('main.form.give_review')
					        </div>
					        <form method="post" class="review_form" enctype="multipart/form-data">
								<div class="review-form-inner">
									<div class="review-input-wrap">
										<div class="input-wrap">
											<div class="input-block">
												<input class="form-input" type="text" name="name" title="@lang('main.form.input_name')" required>
												<label class="span-placeholder required" style="top: 12px; left: 15px;">@lang('main.form.your_name')</label>
											</div>
										</div>
										<div class="input-wrap">
											<div class="input-block">
												<input class="form-input" type="email" name="email">
												<label class="span-placeholder" style="top: 12px; left: 15px;">@lang('main.form.email')</label>
											</div>
										</div>
									</div>
									<div class="review-textarea-wrap">
										<div class="input-wrap">
											<div class="input-block">
												<textarea class="form-input form-input--textarea" name="content" title="@lang('main.form.input_review')" required></textarea>
												<label class="span-placeholder required" style="top: 12px; left: 15px;">@lang('main.form.your_review')</label>
											</div>
										</div>
									</div>
								</div>
					            <div class="input-file-wrap">
									<div class="input-file-inner">
										<div class="input-file-inner-wrap">
											<input class="form-control input-file" id="input-file-1" type="file" name="file" accept=".jpg,.jpeg,.png,.gif">
											<label class="label-input-file" for="input-file-1">
												<span class="label-svg">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24"><defs><path id="k4eca" d="M1371.992 1270.989a.75.75 0 0 1-.75-.75v-15.49a.75.75 0 0 1 1.5 0v15.49a.75.75 0 0 1-.75.75z"/><path id="k4ecb" d="M1371.992 1270.989a.744.744 0 0 1-.53-.22l-3.997-3.998a.75.75 0 0 1 1.06-1.06l3.468 3.468 3.468-3.468a.75.75 0 0 1 1.06 1.06l-3.998 3.998a.751.751 0 0 1-.531.22z"/><path id="k4ecc" d="M1381.236 1277.984h-18.488a2.75 2.75 0 0 1-2.748-2.748v-4.497a.75.75 0 0 1 1.499 0v4.497c0 .688.56 1.249 1.25 1.249h18.487c.688 0 1.249-.56 1.249-1.25v-4.496a.75.75 0 0 1 1.499 0v4.497a2.75 2.75 0 0 1-2.748 2.748z"/></defs><g><g transform="translate(-1360 -1254)"><g><use fill="#3c615d" xlink:href="#k4eca"/></g><g><use fill="#3c615d" xlink:href="#k4ecb"/></g><g><use fill="#3c615d" xlink:href="#k4ecc"/></g></g></g></svg>
												</span>
												<span class="label-text">
													@lang('main.upload_photo')
												</span>
											</label>
											<div class="label-remove">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 408.5 408.5"><path d="M87.7 388.8c0.5 11 9.5 19.7 20.5 19.7h191.9c11 0 20.1-8.7 20.5-19.7l13.7-289.3H74L87.7 388.8zM247.7 171.3c0-4.6 3.7-8.3 8.4-8.3h13.4c4.6 0 8.4 3.7 8.4 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3zM189.2 171.3c0-4.6 3.7-8.3 8.3-8.3h13.4c4.6 0 8.3 3.7 8.3 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3L189.2 171.3zM130.8 171.3c0-4.6 3.7-8.3 8.3-8.3h13.4c4.6 0 8.3 3.7 8.3 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3z"></path><path d="M343.6 21h-88.5V4.3c0-2.4-1.9-4.3-4.3-4.3h-93c-2.4 0-4.3 1.9-4.3 4.3v16.7H64.9c-7.1 0-12.9 5.8-12.9 12.9V74.5h304.5V33.9C356.5 26.8 350.7 21 343.6 21z"></path></svg>
											</div>
										</div>
										<div class="input-file-inner-wrap">
											<input class="form-control input-file" id="input-file-2" type="file" name="file" accept=".jpg,.jpeg,.png,.gif">
											<label class="label-input-file" for="input-file-2">
												<span class="label-svg">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 24 24"><defs><path id="k4eca" d="M1371.992 1270.989a.75.75 0 0 1-.75-.75v-15.49a.75.75 0 0 1 1.5 0v15.49a.75.75 0 0 1-.75.75z"/><path id="k4ecb" d="M1371.992 1270.989a.744.744 0 0 1-.53-.22l-3.997-3.998a.75.75 0 0 1 1.06-1.06l3.468 3.468 3.468-3.468a.75.75 0 0 1 1.06 1.06l-3.998 3.998a.751.751 0 0 1-.531.22z"/><path id="k4ecc" d="M1381.236 1277.984h-18.488a2.75 2.75 0 0 1-2.748-2.748v-4.497a.75.75 0 0 1 1.499 0v4.497c0 .688.56 1.249 1.25 1.249h18.487c.688 0 1.249-.56 1.249-1.25v-4.496a.75.75 0 0 1 1.499 0v4.497a2.75 2.75 0 0 1-2.748 2.748z"/></defs><g><g transform="translate(-1360 -1254)"><g><use fill="#3c615d" xlink:href="#k4eca"/></g><g><use fill="#3c615d" xlink:href="#k4ecb"/></g><g><use fill="#3c615d" xlink:href="#k4ecc"/></g></g></g></svg>
												</span>
												<span class="label-text">
													@lang('main.upload_photo')
												</span>
											</label>
											<div class="label-remove">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 408.5 408.5"><path d="M87.7 388.8c0.5 11 9.5 19.7 20.5 19.7h191.9c11 0 20.1-8.7 20.5-19.7l13.7-289.3H74L87.7 388.8zM247.7 171.3c0-4.6 3.7-8.3 8.4-8.3h13.4c4.6 0 8.4 3.7 8.4 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3zM189.2 171.3c0-4.6 3.7-8.3 8.3-8.3h13.4c4.6 0 8.3 3.7 8.3 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3L189.2 171.3zM130.8 171.3c0-4.6 3.7-8.3 8.3-8.3h13.4c4.6 0 8.3 3.7 8.3 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3z"></path><path d="M343.6 21h-88.5V4.3c0-2.4-1.9-4.3-4.3-4.3h-93c-2.4 0-4.3 1.9-4.3 4.3v16.7H64.9c-7.1 0-12.9 5.8-12.9 12.9V74.5h304.5V33.9C356.5 26.8 350.7 21 343.6 21z"></path></svg>
											</div>
										</div>
									</div>
									<div class="popup-info-text">
										@lang('main.form.upload_img')
									</div>
								</div>
					            <div class="error-file-info">
					                <div class="max-size">
					                    @lang('main.max_size')
					                </div>
					            </div>
					            <input type="hidden" name="url" value="{{Request::path()}}">
					            <input type="hidden" name="title" value="@lang('main.form.give_review')">
					            <input type="hidden" name="lang" value="{{App::getLocale()}}">
					            <button type="submit" class="popup-btn do_review_form">@lang('main.form.send')</button>
					        </form>
					    </div>
					</div>
					<div class='form-thanks'>@lang('main.form.thank_reviews')</div>
				</div>
			</div>
		</div>
		@if($unit->lang->long_desc_1 != '' || $unit->lang->long_desc_2 != '' || $unit->videos->count())
			<section class="unit-page-section">
				<div class="container-small">
					@if($unit->lang->long_desc_1 != '')
						<div class="description">
							{!! $unit->lang->long_desc_1 !!}
						</div>
					@endif
					@if($unit->lang->long_desc_2 != '')
						<div class="description">
							{!! $unit->lang->long_desc_2 !!}
						</div>
					@endif
					@if($unit->videos->count())
						@foreach ($unit->videos as $video)
							@include('layouts.main.video')
						@endforeach
					@endif
				</div>
			</section>
		@endif

		@if(isset($unit->leads) && $unit->leads->count())
			<section class="unit-page-section">
				<div class="container-small">
					<ul class="reviews-list">
						@foreach ($unit->leads as $lead_item)
							<li class="reviews-item">
								@if($lead_item->user_first_name != '' || $lead_item->user_last_name != '')
									<div class="reviews-item-name-wrap">
										<div class="reviews-item-name">
											@if($lead_item->user_first_name != '')
												<span>
													{{$lead_item->user_first_name}}
												</span>
											@endif
											@if($lead_item->user_last_name != '')
												<span>
													{{$lead_item->user_last_name}}
												</span>
											@endif
										</div>
										@if($lead_item->updated_at != '')
											<div class="reviews-item-date">
												{{$lead_item->updated_at->format('d.m.Y')}}
											</div>
										@endif
									</div>
								@endif
								@if($lead_item->content != '')
									<div class="reviews-item-text">
										<div class="description">
											{!! $lead_item->content !!}
										</div>
									</div>
								@endif
								@if ($lead_item->files->count())
									<div class="reviews-img-wrap">
										@foreach ($lead_item->files as $file_item)
											<div class="reviews-img-item">
												<a class="reviews-img-link" href="{{asset('storage/leads/files/'.$file_item->url)}}" data-rel="lightcase:gallery">
													<img class="reviews-img" src="{{asset('storage/leads/files/'.$file_item->url)}}">
												</a>
											</div>
										@endforeach
									</div>
								@endif
								@if (isset($lead_item->unit->lang->name) && $lead_item->unit->lang->name != '')
									<div class="reviews-item-source">
										@lang('main.procedure'):
										<span class="reviews-item-source-info">
											{{$lead_item->unit->lang->name}}
										</span>
									</div>
								@endif
								@if($lead_item->source_link != '')
									<div class="reviews-item-source">
										@lang('main.source'):
										<a class="reviews-item-source-link" href="{{$lead_item->source_link}}" target="_blank">
											{{$lead_item->source_name}}
										</a>
									</div>
								@elseif ($lead_item->source_name != '')
									<div class="reviews-item-source">
										@lang('main.source'):
										<span class="reviews-item-source-info">
											{{$lead_item->source_name}}
										</span>
									</div>
								@endif
							</li>
						@endforeach
					</ul>
				</div>
			</section>
			@if($unit->leads instanceof \Illuminate\Pagination\LengthAwarePaginator)
				{{$unit->leads->links()}}
			@endif
		@else
			<section class="unit-page-section">
				<div class="container-small">
					<div class="description text-center">
						@lang('main.empty_leads')
					</div>
				</div>
			</section>
		@endif

		@if($unit->galleries->count())
			<section class="unit-page-section">
				<div class="container-small">
					<h2 class="section-page-title text-left">
						@lang('main.titles.gallery')
					</h2>
					<div class="description-gallary-wrap">
						@foreach ($unit->galleries as $galleri_item)
							@if($galleri_item->photos->count())
								@php
									$i = 0;
								@endphp
								@foreach($galleri_item->photos as $photo)
									@php
									$i ++;
									@endphp
									<a class="description-gallary-holder" href="{{gallery_photo_img($galleri_item->id,'big',$photo->file)}}" data-rel="lightcase:gallery">
										<img class="description-gallary-item lazyload" data-src="{{gallery_photo_img($galleri_item->id,'small',$photo->file)}}" title="@lang('main.photo')_{{$i}} {{$unit->lang->name}}" alt="@lang('main.photo')_{{$i}} {{$unit->lang->name}}">
									</a>
								@endforeach
							@endif
						@endforeach
					</div>
				</div>
			</section>
		@endif

		@if($unit->files->count())
			<section class="unit-page-section">
				<div class="container-small">
					<h2 class="section-page-title text-left">
						@lang('main.titles.files')
					</h2>
					@foreach ($unit->files as $file)
						<a class="files__link" href="{{ URL::to('/storage/files/'.$file->src) }}" target="_blank">
							@foreach (app('brandbook')['extentions'] as $key => $value)
								@if($value['extention'] == $file->extention)
									<span class="files__img-wr">
										{!!$value['svg']!!}
									</span>
								@endif
							@endforeach
							<span>
								@if($file->lang && $file->lang->name != '')
									{{$file->lang->name}}
								@else
									{{ $file->src }}
								@endif
							</span>
						</a>
					@endforeach
				</div>
			</section>
		@endif

		@if($unit->cat_id == 14)
			@if($rel_types->count())
				@foreach ($rel_types as $type_item)
					@if ($type_item->id == 4)
						@if (isset($unit->related_units[$type_item->id]) && count($unit->related_units[$type_item->id]['units']))
							<section class="unit-page-section service-section">
								<div class="container-small">
									<h2 class="section-page-title text-left">
										@lang('main.titles.service_equipment')
									</h2>
									<ul class="top-services-wrap">
										@foreach ($unit->related_units[$type_item->id]['units'] as $unit_item)
											<li class="top-services-holder">
												@include('layouts.tiles.service')
											</li>
										@endforeach
									</ul>
								</div>
							</section>
						@endif
					@endif
				@endforeach
			@endif
		@endif
	</div>
@stop
@section('scripts')
@stop
