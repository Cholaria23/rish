{{-- <div>
@if ($slider->is_auto == 1)
	Атоматическое листание включено
@else
	Атоматическое листание выключено
@endif
</div>
<div>
	Время каждого слайда: {{ $slider->timeout }}с
</div>

@foreach ($slider->slides as $slide)
	<div>
		Цвет маски: {{ $slide->mask_color }}
		Прозрачность маски (*0 - абсолютно прозрачная, 100 - абсолютно непрозрачная): {{ $slide->mask_opacity }}
	</div>
	<div>
		<p>Изображение desktop</p>
		<img src="{{ asset("storage/slider/img_desktop/".$slide->img_desktop) }}">
	</div>
	<div>
		<p>Изображение mobile</p>
		<img src="{{ asset("storage/slider/img_mobile/".$slide->img_mobile) }}">
	</div>

	<div>
		<p>Заголовок</p>
		<div style="color: {{ $slide->title_color }}">{{ $slide->lang->title }}</div>
	</div>
	<div>
		<p>Текст</p>
		<div style="color: {{ $slide->text_color }}">{!! $slide->lang->text !!}</div>
	</div>
	<div>
		<p>Кнопка 1</p>
		@if ($slide->href_1 != '')
			<a href="{{ $slide->href_1 }}" target="{{ ($slide->is_blank_1 == 1) ? "_blank" : "_self" }}">{{ $slide->lang->button_1_caption }}</a>
		@endif
	</div>
	<div>
		<p>Кнопка 1</p>
		@if ($slide->href_2 != '')
			<a href="{{ $slide->href_2 }}" target="{{ ($slide->is_blank_2 == 1) ? "_blank" : "_self" }}">{{ $slide->lang->button_2_caption }}</a>
		@endif
	</div>
@endforeach --}}


@if ($slider->slides->count())
	<div class="main-slider">
		@foreach ($slider->slides as $slide)
			<div class="slide-item">
				<div class="slide-item-mask" style="background-color: {{ $slide->mask_color }}; opacity: {{ $slide->mask_opacity / 100 }};">
				</div>
				<picture class="slide-item-img">
					<source media="(max-width: 800px)" srcset="{{ asset("storage/slider/img_mobile/".$slide->img_mobile) }}">
					<source srcset="{{ asset("storage/slider/img_desktop/".$slide->img_desktop) }}">
					<img src="{{ asset("storage/slider/img_desktop/".$slide->img_desktop) }}" alt="{{$slide->lang->title}}" class="slide-item-img">
				</picture>
				<div class="content-slide">
					<div class="container">
						<div class="content-slide-wrap">
							<h2 class="main-title" style="color: {{$slide->title_color}}">{!! $slide->lang->title !!}</h2>
							<div class="main-subtitle" style="color: {{$slide->text_color}}">{!! $slide->lang->text !!}</div>
							@if ($slide->data_attr_1 != '')
								<button class="btn-slider open-modal-js" data-popup="{{ $slide->data_attr_1 }}">
									{{ $slide->lang->button_1_caption }}
								</button>
							@elseif ($slide->href_1 != '')
								<a class="btn-slider" href="{{ $slide->href_1 }}" target="{{ ($slide->is_blank_1 == 1) ? "_blank" : "_self" }}">
									{{ $slide->lang->button_1_caption }}
								</a>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
	@section('scripts')
	@parent
		{{-- <script>
		      $(document).ready(function(){
		          $('.main-slider').slick({
					  slidesToShow: 1,
			          slidesToScroll: 1,
					  rows: 0,
		              autoplay: {{ ($slider->is_auto == 1) ? "true" : "false" }},
		              autoplaySpeed: {{ $slider->timeout *1000}},
					  arrows: false,
					  dots: false,
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
		</script> --}}
	@stop
@endif
