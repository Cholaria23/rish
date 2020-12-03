@if ($slider->slides->count())
	<section class="main-section">
		<div class="container">
			<div class="main-slider">
				@foreach ($slider->slides as $slide)
					@if($slide->href_1 != '' && $slide->href_2 == '')
						<div class="slide-item">
					@else
						<a href="{{ $slide->href_1 }}" target="{{ ($slide->is_blank_1 == 1) ? "_blank" : "_self" }}" class="slide-item">
					@endif
						<div class="slide-item-img-wrap">
							<div class="slide-item-mask" style="background-color: {{ $slide->mask_color }}; opacity: {{ $slide->mask_opacity / 100 }};">
							</div>
							<picture>
								<source media="(max-width: 1025px)" data-srcset="{{ asset("storage/slider/img_mobile/".$slide->img_mobile) }}">
								<source data-srcset="{{ asset("storage/slider/img_desktop/".$slide->img_desktop) }}">
								<img data-src="{{ asset("storage/slider/img_desktop/".$slide->img_desktop) }}" alt="{{$slide->lang->title}}" class="slide-item-img object-fit-js object-fit-cover lazyload">
							</picture>
						</div>
						<div class="content-slide">
							<div class="slide-item-mask" style="background-color: {{ $slide->mask_color }}; opacity: {{ $slide->mask_opacity / 100 }};">
							</div>
							<div class="content-slide-svg-wrap">
								<svg class="object-fit-js object-fit-cover" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 151.502 104.719"><g transform="translate(-243.793 -273.129)" opacity="0.422"><path d="M303.685,219.912c-12.12,10.3-22.422,33.33-27.27,57.571l-7.878,5.454h0c2.424-27.27,12.12-62.419,35.148-63.025ZM273.99,292.027h0a98.194,98.194,0,0,0-.606,13.332l-5.454,1.818a65.984,65.984,0,0,1-.606-11.514c2.424-.606,4.242-1.818,6.666-3.636Zm-9.09-59.389h0a7.369,7.369,0,0,0-7.272,7.272,7,7,0,0,0,7.272,7.272,7.369,7.369,0,0,0,7.272-7.272c-.606-4.242-3.636-7.272-7.272-7.272Zm-4.242,75.145h0l-6.06.606v-9.7a25.774,25.774,0,0,0,6.666-1.212,70.067,70.067,0,0,0-.606,10.3Zm-7.272-22.422h0c-5.454-38.784-28.482-64.237-27.876-66.661,26.058,6.666,33.936,40.6,35.148,66.055h-1.212Z" transform="translate(55.856 54.429)" fill="#fff" fill-rule="evenodd"/><path d="M256.872,307.639c1.818-7.272,7.878-10.3,14.544-10.908-31.512,21.21,56.359,20.6,52.723-15.15,5.454,2.424,6.06,9.7,1.818,16.362-16.968,27.876-72.115,21.816-69.085,9.7Zm15.15-33.937h0c-8.484-25.452-24.846-44.238-52.723-52.723,34.542-7.878,51.511,25.452,58.177,53.935l-5.454-1.212ZM370.8,222.192h0a53.373,53.373,0,0,0-10.3-1.212c-27.876.606-35.148,23.634-45.45,44.239-16.968,33.936-59.389,22.422-44.239,13.332-7.878,0-10.3,4.848-9.7,9.09,1.212,6.666,38.179,14.544,56.965-12.12C335.047,248.856,332.623,233.706,370.8,222.192Z" transform="translate(24.493 60.027)" fill="#fff" fill-rule="evenodd"/></g></svg>
							</div>
							<div class="content-slide-wrap">
								<div class="slide-title">{!! $slide->lang->title !!}</div>
								<div class="slide-text text">{!! $slide->lang->text !!}</div>
								@if ($slide->data_attr_1 != '')
									<button class="btn-slider open-modal-js" data-popup="{{ $slide->data_attr_1 }}">
										{{ $slide->lang->button_1_caption }}
									</button>
								@else
									@if($slide->href_1 != '' && $slide->href_2 !== '')
										<div class="btn-arrow-wrap">
											<a href="{{$slide->href_1}}" target="{{ ($slide->is_blank_1 == 1) ? "_blank" : "_self" }}" class="btn-arrow">
												<div class="btn-arrow-text">
													{{ $slide->lang->button_1_caption }}
												</div>
											</a>
											<a href="{{$slide->href_2}}" target="{{ ($slide->is_blank_2 == 1) ? "_blank" : "_self" }}" class="btn-arrow">
												<div class="btn-arrow-text">
													{{ $slide->lang->button_2_caption }}
												</div>
											</a>
										</div>
									@else
										<span class="btn-arrow">
											<div class="btn-arrow-text">
												{{ $slide->lang->button_1_caption }}
											</div>
										</span>
									@endif
								@endif
							</div>
						</div>
					@if($slide->href_1 != '' && $slide->href_2 == '')
						</div>
					@else
						</a>
					@endif
				@endforeach
			</div>
		</div>
	</section>
	@section('scripts')
	@parent
		<script>
		      $(document).ready(function(){
		          $('.main-slider').slick({
					  slidesToShow: 1,
			          slidesToScroll: 1,
					  rows: 0,
		              autoplay: {{ ($slider->is_auto == 1) ? "true" : "false" }},
		              autoplaySpeed: {{ $slider->timeout *1000}},
					  arrows: false,
					  dots: true,
					  draggable: true,
					  responsive: [
			              {
			                breakpoint: 1025,
			                settings: {
			                  adaptiveHeight: true,
							  autoplay: false,
			                }
			              }
			            ]
		          });
		      });
		</script>
	@stop
@endif
