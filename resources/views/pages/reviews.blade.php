@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page reviews-page">
		<section class="page-section section-with-breadcrumbs">
            <div class="container-small">
				@include('layouts.main.breadcrumbs')
				@if($unit->lang->h1 != '')
					<h1 class="page-section-top-title">
						{{$unit->lang->h1}}
					</h1>
				@else
					<h1 class="page-section-top-title">
						{{$unit->lang->name}}
					</h1>
				@endif
			</div>
        </section>
		<section class="main-section">
			<div class="container-small">
				<div class="write-reviews-block">
					<div class="write-reviews-title-wrap">
						<button class="btn-light-green-small scroll-bnt-js" type="button" name="button" data-id="write-reviews-form-wrap">
							@lang('main.review.write_reviews')
						</button>
					</div>
					@if(isset($unit->leads) && $unit->leads->count())
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
											@if($lead_item->created_at != '')
												<div class="reviews-item-date">
													{{$lead_item->created_at->format('d.m.Y')}}
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
										<div class="reviews-img-wrap popup-gallery">
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
									@if($lead_item->answers->count())
				                    @foreach ($lead_item->answers as $answer_item)
				                      <div class='reviews-item-admin'>
				                        <div class="reviews-item-name-wrap">
				                          <div class='reviews-item-name'>
											  @lang('main.review.admin')
										  </div>
				                          @if($answer_item->created_at)
				                          	<div class="reviews-item-date">
				                              {{$answer_item->created_at->format('d.m.Y')}}
				                            </div>
				                          @endif
				                        </div>
				                        <div class="reviews-item-text">
											<div class="description">
												{!!$answer_item->content!!}
											</div>
										</div>
				                      </div>
				                    @endforeach
				                  @endif
								</li>
							@endforeach
						</ul>
						@if($unit->leads instanceof \Illuminate\Pagination\LengthAwarePaginator)
							{{$unit->leads->links('layouts.main.custom_paginate')}}
						@endif
					@else
						<div class="description text-center">
							@lang('main.empty_leads')
						</div>
					@endif
				</div>
			</div>
		</section>


		<section class="main-section">
			<div class="container-small">
				<div class="write-reviews-form-wrap">
					<div class="reviews-svg-decore">
						<svg class="object-fit-js object-fit-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 151.502 104.719"><g transform="translate(-243.793 -273.129)" opacity="0.422"><path d="M303.685,219.912c-12.12,10.3-22.422,33.33-27.27,57.571l-7.878,5.454h0c2.424-27.27,12.12-62.419,35.148-63.025ZM273.99,292.027h0a98.194,98.194,0,0,0-.606,13.332l-5.454,1.818a65.984,65.984,0,0,1-.606-11.514c2.424-.606,4.242-1.818,6.666-3.636Zm-9.09-59.389h0a7.369,7.369,0,0,0-7.272,7.272,7,7,0,0,0,7.272,7.272,7.369,7.369,0,0,0,7.272-7.272c-.606-4.242-3.636-7.272-7.272-7.272Zm-4.242,75.145h0l-6.06.606v-9.7a25.774,25.774,0,0,0,6.666-1.212,70.067,70.067,0,0,0-.606,10.3Zm-7.272-22.422h0c-5.454-38.784-28.482-64.237-27.876-66.661,26.058,6.666,33.936,40.6,35.148,66.055h-1.212Z" transform="translate(55.856 54.429)" fill="#fff" fill-rule="evenodd"/><path d="M256.872,307.639c1.818-7.272,7.878-10.3,14.544-10.908-31.512,21.21,56.359,20.6,52.723-15.15,5.454,2.424,6.06,9.7,1.818,16.362-16.968,27.876-72.115,21.816-69.085,9.7Zm15.15-33.937h0c-8.484-25.452-24.846-44.238-52.723-52.723,34.542-7.878,51.511,25.452,58.177,53.935l-5.454-1.212ZM370.8,222.192h0a53.373,53.373,0,0,0-10.3-1.212c-27.876.606-35.148,23.634-45.45,44.239-16.968,33.936-59.389,22.422-44.239,13.332-7.878,0-10.3,4.848-9.7,9.09,1.212,6.666,38.179,14.544,56.965-12.12C335.047,248.856,332.623,233.706,370.8,222.192Z" transform="translate(24.493 60.027)" fill="#fff" fill-rule="evenodd"/></g></svg>
					</div>
					<div class="reviews-form-block">
						<div class="reviews-form-name">
							@lang('main.review.write_reviews')
						</div>
						<form method="post" class="review_form" enctype="multipart/form-data">
							<div class="review-form-inner">
								<div class="review-input-wrap">
									<div class="input-wrap">
										<input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')" required>
									</div>
									<div class="input-wrap">
										<input class="input-form" type="email" name="email" placeholder="@lang('main.form.email')">
									</div>
								</div>
								<div class="review-textarea-wrap">
									<div class="input-wrap">
										<textarea class="input-form form-input-textarea" name="content" placeholder="@lang('main.review.input_review')" required></textarea>
									</div>
								</div>
							</div>
							<div class="input-file-wrap">
								<div class="input-file-inner">
									<div class="input-file-inner-wrap">
										<input class="form-control input-file" id="input-file-1" type="file" name="file" accept=".jpg,.jpeg,.png,.gif">
										<label class="label-input-file" for="input-file-1">
											<span class="label-svg">
												<svg width="24" height="24">
													<use xlink:href="#download"></use>
												</svg>
											</span>
											<span class="label-text">
												@lang('main.review.upload_photo')
											</span>
										</label>
										<div class="label-remove">
											<svg width="20" height="20">
												<use xlink:href="#label-remove"></use>
											</svg>
										</div>
									</div>
									<div class="input-file-inner-wrap">
										<input class="form-control input-file" id="input-file-2" type="file" name="file" accept=".jpg,.jpeg,.png,.gif">
										<label class="label-input-file" for="input-file-2">
											<span class="label-svg">
												<svg width="24" height="24">
													<use xlink:href="#download"></use>
												</svg>
											</span>
											<span class="label-text">
												@lang('main.review.upload_photo')
											</span>
										</label>
										<div class="label-remove">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 408.5 408.5"><path d="M87.7 388.8c0.5 11 9.5 19.7 20.5 19.7h191.9c11 0 20.1-8.7 20.5-19.7l13.7-289.3H74L87.7 388.8zM247.7 171.3c0-4.6 3.7-8.3 8.4-8.3h13.4c4.6 0 8.4 3.7 8.4 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3zM189.2 171.3c0-4.6 3.7-8.3 8.3-8.3h13.4c4.6 0 8.3 3.7 8.3 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3L189.2 171.3zM130.8 171.3c0-4.6 3.7-8.3 8.3-8.3h13.4c4.6 0 8.3 3.7 8.3 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3z"></path><path d="M343.6 21h-88.5V4.3c0-2.4-1.9-4.3-4.3-4.3h-93c-2.4 0-4.3 1.9-4.3 4.3v16.7H64.9c-7.1 0-12.9 5.8-12.9 12.9V74.5h304.5V33.9C356.5 26.8 350.7 21 343.6 21z"></path></svg>
										</div>
									</div>
								</div>
								<div class="popup-img-info-text">
									@lang('main.review.upload_img')
								</div>
							</div>
							<div class="error-file-info">
								<div class="max-size">
									@lang('main.review.max_size')
								</div>
							</div>
							<input type="hidden" name="url" value="{{Request::path()}}">
							<input type="hidden" name="title" value="@lang('main.review.write_reviews')">
							<input type="hidden" name="lang" value="{{App::getLocale()}}">
							<button type="submit" class="btn-green do_review_form">
								@lang('main.review.send')
							</button>
						</form>
						<div class='form-thanks'>@lang('main.review.thank_reviews')</div>
					</div>
				</div>
			</div>
		</section>




		{{-- @if($unit->lang->long_desc_1 != '' || $unit->lang->long_desc_2 != '' || $unit->videos->count())
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
		@endif --}}


		{{-- @if($unit->galleries->count())
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
		@endif --}}

		{{-- @if($unit->files->count())
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
		@endif --}}

		{{-- @if($unit->cat_id == 14)
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
		@endif --}}
	</div>
@stop
@section('scripts')
@stop
