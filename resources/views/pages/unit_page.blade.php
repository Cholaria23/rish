@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page">
		<section class="page-section section-with-breadcrumbs">
            <div class="container-small">
				@include('layouts.main.breadcrumbs')
				@if($unit->lang->h1 != '')
					<div class="container">
						<h1 class="page-section-top-title">
							{{$unit->lang->h1}}
						</h1>
					</div>
				@else
					<div class="container">
						<h1 class="page-section-top-title">
							{{$unit->lang->name}}
						</h1>
					</div>
				@endif
			</div>
        </section>
		@if($unit->lang->long_desc_1 != '')
			<section class="main-section">
				<div class="container-small">
					<div class="description">
						{!!$unit->lang->long_desc_1!!}
					</div>
				</div>
			</section>
		@endif

		@if($unit->lang->long_desc_2 != '')
			<section class="main-section">
				<div class="container-small">
					<div class="description">
						{!!$unit->lang->long_desc_2!!}
					</div>
				</div>
			</section>
		@endif

		@if($unit->videos->count())
			@foreach ($unit->videos as $video)
				<section class="main-section">
					<div class="container-small">
						@include('layouts.main.video')
					</div>
				</section>
			@endforeach
		@endif

		@if($unit->galleries->count())
			<section class="main-section">
				<div class="container">
					<div class="popup-gallery-wrap">
						@if($unit->id == 80)
						@else
							<div class="page-section-title-bold">
								@lang('main.gallary')
							</div>
						@endif
						<div class="popup-gallery">
							@foreach ($unit->galleries as $galleri_item)
								@if($galleri_item->photos->count())
									@foreach($galleri_item->photos as $photo)
										<a class="gallery-item" href="{{gallery_photo_img($galleri_item->id,'big',$photo->file)}}" title="@lang('main.photo') {{$unit->lang->name}}">
											<img class="lazyload" data-src="{{gallery_photo_img($galleri_item->id,'small',$photo->file)}}" alt="@lang('main.photo') {{$unit->lang->name}}" title="@lang('main.photo') {{$unit->lang->name}}">
										</a>
									@endforeach
								@endif
							@endforeach
						</div>
					</div>
				</div>
			</section>
		@endif

		@if($unit->rel_faq_groups->count())
			<section class="main-section">
				<div class="container-small">
					<ul class="faq-list" itemtype="https://schema.org/FAQPage" itemscope>
						@foreach ($unit->rel_faq_groups as $faq_group_item)
							@foreach ($faq_group_item->faq as $faq_item)
								<li class="faq-item" itemscope itemtype="https://schema.org/Question" itemprop="mainEntity">
									<div class="faq-question">
										<span class="faq-question-name" itemprop="name">
											{{$faq_item->lang->question}}
										</span>
										<div class="faq-icon"></div>
									</div>
									@if($faq_item->lang->answer != '')
										<div class="faq-answer text" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" itemscope>
											<span itemprop="text">
												{!!$faq_item->lang->answer!!}
											</span>
										</div>
									@endif
								</li>
							@endforeach
						@endforeach
					</ul>
				</div>
			</section>
		@endif

		@if($unit->files->count())
			<section class="main-section">
				<div class="container">
					<div class="page-section-title-bold">
						@lang('main.files')
					</div>
					<ul class="files_list">
						@foreach ($unit->files as $file)
							<li class="file-item">
								<a class="file-item-link" href="{{ URL::to('/storage/files/'.$file->src) }}" target="_blank">
									@foreach (app('brandbook')['extentions'] as $key => $value)
										@if($value['extention'] == $file->extention)
											<span class="file-item-img">
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
							</li>
						@endforeach
					</ul>
				</div>
			</section>
		@endif

		@if($unit->id == 118)
			<section class="main-section">
	            <div class="container-small">
					<div class="item-contact-form-wrap">
						<div class="contact-form-name">
							@lang('main.corporate_form_title')
						</div>
						<div class="contact-form-sub_name">
							@lang('main.corporate_form_desc')
						</div>
						<form method="post" class="corporate_form">
							<div class="input-wrap">
								<input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
							</div>
							<div class="input-wrap">
								<input class="input-form" type="text" name="company" placeholder="@lang('main.form.company_name')">
							</div>
							<div class="input-wrap">
								<input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.number_phone')" required>
							</div>
							<div class="input-wrap">
								<input class="input-form" type="email" name="email" placeholder="@lang('main.form.email')" required>
							</div>
							<input type="hidden" name="lang" value="{{App::getLocale()}}">
							<input type="hidden" name="url" value="{{Request::path()}}">
							<input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
							<button type="submit" class="btn-green do_corporate_form">@lang('main.btn.call_me')</button>
						</form>
						<div class='form-thanks'>@lang('main.form.form_thanks')</div>
					</div>
	            </div>
	        </section>
		@endif

		@if($unit->id == 169)
			<section class="main-section">
	            <div class="container-small">
					<div class="item-contact-form-wrap">
						<div class="contact-form-name text-center">
							@lang('main.send_resume')
						</div>
						<form method="post" class="send_resume_form text-right">
							<div class="input-wrap">
								<input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
							</div>
							<div class="input-wrap">
								<input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.number_phone')" required>
							</div>
							<div class="input-wrap">
								<input class="input-form" type="email" name="email" placeholder="@lang('main.form.email')" required>
							</div>
							<div class="input-file-wrap">
								<div class="input-file-inner">
									<div class="input-file-inner-wrap">
										<input class="form-control input-file" id="input-file-cv" type="file" name="file">
										<label class="label-input-file" for="input-file-cv">
											<span class="label-svg">
												<svg width="24" height="24">
													<use xlink:href="#download"></use>
												</svg>
											</span>
											<span class="label-text">
												@lang('main.upload_file')
											</span>
										</label>
										<div class="label-remove label-remove-cv">
											<svg width="20" height="20">
												<use xlink:href="#label-remove"></use>
											</svg>
										</div>
									</div>
								</div>
							</div>
							<input type="hidden" name="lang" value="{{App::getLocale()}}">
							<input type="hidden" name="url" value="{{Request::path()}}">
							<input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
							<button type="submit" class="btn-green do_send_resume_form">@lang('main.review.send')</button>
						</form>
						<div class='form-thanks'>@lang('main.form.form_thanks')</div>
					</div>
	            </div>
	        </section>
		@endif

		@if($unit->id == 169)
			<section class="main-section">
				<div class="container-small">
					<div class="item-contact-form-wrap">
						<div class="contact-form-name text-center">
							@lang('main.title_request_registration_form')
						</div>
						<form method="post" class="training_form text-right">
							<div class="input-wrap">
								<input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
							</div>
							<div class="input-wrap">
								<input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.number_phone')" required>
							</div>
							<div class="input-wrap">
								<input class="input-form" type="email" name="email" placeholder="@lang('main.form.email')" required>
							</div>
							<div class="input-wrap">
								<input class="input-form" type="text" name="specialization" placeholder="@lang('main.form.specialization')" required>
							</div>
							<input type="hidden" name="lang" value="{{App::getLocale()}}">
							<input type="hidden" name="url" value="{{Request::path()}}">
							<input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
							<button type="submit" class="btn-green do_training_form">@lang('main.review.send')</button>
						</form>
						<div class='form-thanks'>@lang('main.form.form_thanks')</div>
					</div>
				</div>
			</section>
		@endif

	</div>
@stop
@section('scripts')
@stop
