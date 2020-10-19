@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<section class="landing-section landing-main-section">
		<div class="container">
			<div class="landing-section-wrap">
				<div class="landing-section-item">
					<div class="landing-section-inner">
						@if($unit->lang->long_desc_1 != '')
							<div class="landing-description">
								{!!$unit->lang->long_desc_1!!}
							</div>
						@endif
						@if($unit->lang->long_desc_2 != '')
							<div class="landing-description">
								{!!$unit->lang->long_desc_2!!}
							</div>
						@endif
					</div>
				</div>
				<div class="landing-section-item landing-section-item-first-pos">
					<img class="landing-section-item-img" src="{{unit_img('big',$unit->img_1)}}" alt="{{$unit->lang->name}}" title="{{$unit->lang->name}}">
				</div>
			</div>
		</div>
	</section>


	@if(isset($offer) && $offer->units->count() )
		<section class="landing-section offer-section">
			<div class="container">
				@if($offer->lang->pre_info != '')
					<div class="landing-description">
						{!!$offer->lang->pre_info!!}
					</div>
				@endif
				<ul class="landing-offer-wrap">
					@foreach ($offer->units as $unit_item)
						<li class="landing-offer-item">
							@if($unit_item->svg != '')
								<div class="landing-offer-icon">
									{!! $unit_item->svg !!}
								</div>
							@endif
							<div class="landing-offer-name">
								{{$unit_item->lang->name}}
							</div>
						</li>
					@endforeach
				</ul>
				@if($offer->lang->post_info != '')
					<div class="landing-description">
						{!!$offer->lang->post_info!!}
					</div>
				@endif
			</div>
		</section>
	@endif


	@if(isset($our_mission) && $our_mission)
		<section class="landing-section with-bg our_mission">
			<div class="container">
				<div class="landing-section-wrap">
					<div class="landing-section-item">
						<img class="landing-section-item-img lazyload" data-src="{{unit_img('big',$our_mission->img_1)}}" alt="{{$our_mission->lang->name}}" title="{{$our_mission->lang->name}}">
					</div>
					<div class="landing-section-item">
						<div class="landing-section-inner">
							@if($our_mission->lang->long_desc_1 != '')
								<div class="landing-description">
									{!!$our_mission->lang->long_desc_1!!}
								</div>
							@endif
							@if($our_mission->lang->long_desc_2 != '')
								<div class="landing-description">
									{!!$our_mission->lang->long_desc_2!!}
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</section>
	@endif

	@if(isset($directions) && $directions)
		<section class="landing-section directions">
			<div class="container-small">
				@if($directions->lang->long_desc_1 != '')
					<div class="landing-description">
						{!!$directions->lang->long_desc_1!!}
					</div>
				@endif
				@if(isset($directions_list) && $directions_list->count())
					<ul class="landing-directions-list">
						@foreach ($directions_list as $direction_item)
							<li class="landing-directions-item">
								{{$direction_item->lang->name}}
							</li>
						@endforeach
					</ul>
				@endif
				@if($directions->lang->long_desc_2 != '')
					<div class="landing-description">
						{!!$directions->lang->long_desc_2!!}
					</div>
				@endif
				<div class="popup-btn-wrap">
					<a class="btn-light-green popup-js" href="#question-services">
						@lang('main.btn.ask_question')
					</a>
					<a class="btn-green popup-js" href="#appointment-services">
						@lang('main.btn.make_appointment')
					</a>
				</div>
			</div>
		</section>
	@endif


	@if(isset($pricelist) && $pricelist->units->count() )
		<section class="landing-section pricelist">
			<div class="container-middle">
				@if($pricelist->lang->pre_info != '')
					<div class="landing-description">
						{!!$pricelist->lang->pre_info!!}
					</div>
				@endif
				<div class="landing-pricelist-wrap">
					@foreach ($pricelist->units as $unit_item)
						<div class="landing-pricelist-holder">
							<div class="landing-pricelist-item">
								<img class="landing-pricelist-img lazyload" data-src="{{unit_img('small',$unit_item->img_1)}}" alt="{{$unit_item->lang->name}}" title="{{$unit_item->lang->name}}">
								<div class="landing-pricelist-name">
									{{$unit_item->lang->name}}
								</div>
								<div class="landing-pricelist-price-block">
									@if($unit_item->lang->short_desc_1 != '')
										<div class="landing-pricelist-price">
											{{$unit_item->lang->short_desc_1}}
										</div>
									@endif
									<a class="btn-green popup-js appointment-btn-js" href="#appointment" data-subtitle="{{$unit_item->lang->name}}">
										@lang('main.btn.make_appointment')
									</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
				@if($pricelist->lang->post_info != '')
					<div class="landing-description">
						{!!$pricelist->lang->post_info!!}
					</div>
				@endif
			</div>
		</section>
	@endif

	@if(isset($translator) && $translator)
		<section class="landing-section translator">
			<div class="container-middle">
				<div class="landing-translator-wrap">
					<div class="landing-translator-info">
						@if($translator->lang->long_desc_1 != '')
							<div class="landing-description">
								{!!$translator->lang->long_desc_1!!}
							</div>
						@endif
						@if($translator->lang->long_desc_2 != '')
							<div class="landing-description">
								{!!$translator->lang->long_desc_2!!}
							</div>
						@endif
						<a class="btn-light-green popup-js" href="#personal_ranslator">
							@lang('main.btn.order_translator')
						</a>
					</div>
					<div class="landing-translator-img">
						<img class="object-fit-js object-fit-cover lazyload" data-src="{{unit_img('big',$translator->img_1)}}" alt="{{$translator->lang->name}}" title="{{$translator->lang->name}}">
					</div>
				</div>
			</div>
		</section>
	@endif

	@if(isset($departments) && $departments->units->count() )
		<section class="landing-section departments">
			<div class="container">
				@if($departments->lang->pre_info != '')
					<div class="landing-description">
						{!!$departments->lang->pre_info!!}
					</div>
				@endif
				<div class="departments-wrap clearfix">
					@foreach ($departments->units as $key => $unit_item)
						@if ($key%2 == 0)
							<div class="departments-holder-wrap">
								@if ($unit_item->img_1 != '')
									<div class="departments-holder left">
										<div class="landing-departments-title mobile">
											{{$unit_item->lang->name}}
										</div>
										<div class="departments-item departments-item-img">
											<img class="lazyload" data-src="{{unit_img('big',$unit_item->img_1)}}" alt="{{$unit_item->lang->name}}" title="{{$unit_item->lang->name}}">
										</div>
									</div>
								@endif
								@if($unit_item->lang->long_desc_1 != '')
									<div class="departments-holder rigth">
										<div class="landing-departments-title desktop">
											{{$unit_item->lang->name}}
										</div>
										<div class="departments-item">
											<div class="landing-description">
												{!!$unit_item->lang->long_desc_1!!}
											</div>
										</div>
									</div>
								@endif
							</div>
						@else
							<div class="departments-holder-wrap">
								@if($unit_item->lang->long_desc_1 != '')
									<div class="departments-holder left">
										<div class="landing-departments-title desktop">
											{{$unit_item->lang->name}}
										</div>
										<div class="departments-item">
											<div class="landing-description">
												{!!$unit_item->lang->long_desc_1!!}
											</div>
										</div>
									</div>
								@endif
								<div class="departments-holder rigth departments-holder-first-pos">
									<div class="landing-departments-title mobile">
										{{$unit_item->lang->name}}
									</div>
									@if ($unit_item->img_1 != '')
										<div class="departments-item departments-item-img">
											<img class="lazyload" data-src="{{unit_img('big',$unit_item->img_1)}}" alt="{{$unit_item->lang->name}}" title="{{$unit_item->lang->name}}">
										</div>
									@endif
								</div>
							</div>
						@endif
					@endforeach
				</div>
				@if($departments->lang->post_info != '')
					<div class="landing-description">
						{!!$departments->lang->post_info!!}
					</div>
				@endif
			</div>
		</section>
	@endif

	@if(isset($check_up) && $check_up)
		<section class="landing-section with-bg check_up">
			<div class="container">
				<div class="landing-section-wrap">
					<div class="landing-section-item">
						<img class="landing-section-item-img lazyload" data-src="{{unit_img('big',$check_up->img_1)}}" alt="{{$check_up->lang->name}}" title="{{$check_up->lang->name}}">
					</div>
					<div class="landing-section-item">
						<div class="landing-section-inner">
							@if($check_up->lang->long_desc_1 != '')
								<div class="landing-description">
									{!!$check_up->lang->long_desc_1!!}
								</div>
							@endif
							@if($check_up->lang->long_desc_2 != '')
								<div class="landing-description">
									{!!$check_up->lang->long_desc_2!!}
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</section>
	@endif

	@if(isset($telemed) && $telemed)
		<section class="landing-section telemed">
			<div class="container-middle">
				<div class="landing-section-wrap">
					<div class="landing-section-item">
						<div class="landing-section-inner">
							@if($telemed->lang->long_desc_1 != '')
								<div class="landing-description">
									{!!$telemed->lang->long_desc_1!!}
								</div>
							@endif
							@if($telemed->lang->long_desc_2 != '')
								<div class="landing-description">
									{!!$telemed->lang->long_desc_2!!}
								</div>
							@endif
						</div>
					</div>
					<div class="landing-section-item landing-section-item-first-pos">
						<img class="landing-section-item-img lazyload" data-src="{{unit_img('big',$telemed->img_1)}}" alt="{{$telemed->lang->name}}" title="{{$telemed->lang->name}}">
					</div>
				</div>
			</div>
		</section>
	@endif

	@if(isset($principles) && $principles->units->count() )
		<section class="landing-section with-bg principles">
			<div class="container-small">
				@if($principles->lang->pre_info != '')
					<div class="landing-description">
						{!!$principles->lang->pre_info!!}
					</div>
				@endif
				<div class="landing-principles-wrap">
					@foreach ($principles->units as $unit_item)
						<div class="landing-principles-holder">
							@if($unit_item->svg != '')
								<div class="landing-principles-icon">
									{!! $unit_item->svg !!}
								</div>
							@endif
							<div class="landing-principles-name">
								{{$unit_item->lang->name}}
							</div>
						</div>
					@endforeach
				</div>
				@if($principles->lang->post_info != '')
					<div class="landing-description">
						{!!$principles->lang->post_info!!}
					</div>
				@endif
			</div>
		</section>
	@endif

	@if(isset($standards) && $standards)
		<section class="landing-section standards">
			<div class="container">
				<div class="landing-section-wrap">
					<div class="landing-section-item">
						<img class="landing-section-item-img lazyload" data-src="{{unit_img('big',$standards->img_1)}}" alt="{{$standards->lang->name}}" title="{{$standards->lang->name}}">
					</div>
					<div class="landing-section-item">
						<div class="landing-section-inner">
							@if($standards->lang->long_desc_1 != '')
								<div class="landing-description">
									{!!$standards->lang->long_desc_1!!}
								</div>
							@endif
							@if($standards->lang->long_desc_2 != '')
								<div class="landing-description">
									{!!$standards->lang->long_desc_2!!}
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</section>
	@endif

@stop
@section('scripts')
@stop
