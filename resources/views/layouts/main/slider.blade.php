<div>
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
@endforeach