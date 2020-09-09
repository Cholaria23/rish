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
			<div class="main-section">
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
			</div>
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

	</div>
@stop
@section('scripts')
@stop
