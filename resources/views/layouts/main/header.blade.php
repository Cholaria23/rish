<header class="header">
	@if(isset(app('contacts')['main']['contacts']['lang']['note_1']) && app('contacts')['main']['contacts']['lang']['note_1'] != '')
		{!! app('contacts')['main']['contacts']['lang']['note_1'] !!}
	@endif
	@if(isset(app('contacts')['main']['contacts']['lang']['address']) && app('contacts')['main']['contacts']['lang']['address'] != '')
		{!! app('contacts')['main']['contacts']['lang']['address'] !!}
	@endif
	@if(count(app('langSettings')->langs->pluck('code')->toArray()) > 1)
		<div class="burger-menu__lang langlist">
			<ul class="langlist__ul">
				@foreach(app('langSettings')->langs->pluck('code')->toArray() as $localeCode)
					<li class="langlist__item">
						<a class="burger-menu__link langlist__link {{ ($localeCode == LaravelLocalization::getCurrentLocale()) ? 'active_link' : '' }}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
							{{ strtoupper($localeCode) }}
						</a>
					</li>
				@endforeach
			</ul>
		</div>
	@endif
	{{-- logo --}}
	{{-- search --}}
	@if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '')
        <a class="contacts__phones_item mini-flex" href="tel:+{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1'] ) }}">
            {{app('contacts')['main']['contacts']['lang']['phone_1_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_1_name'] : app('contacts')['main']['contacts']['phone_1']}}
        </a>
	@endif
	{{-- callback --}}
	{{-- feedback --}}


	@if(isset($header_data['about_company']) && $header_data['about_company'])
		<a href="{{build_unit_route($header_data['about_company'])}}">
			{{$header_data['about_company']->lang->name}}
		</a>
	@endif
	@if(isset($header_data['services']) && $header_data['services'])
		<a href="{{route('first_url',$header_data['services']->alias)}}">
			{{$header_data['services']->lang->name}}
		</a>
	@endif
	@if(isset($header_data['checkup']) && $header_data['checkup'])
		<a href="{{build_unit_route($header_data['checkup'])}}">
			{{$header_data['checkup']->lang->name}}
		</a>
	@endif
	@if(isset($header_data['services_top']) && $header_data['services_top'])
		@foreach ($header_data['services_top'] as $services_top)
			<a href="{{route('first_url',$services_top->alias)}}">
				{{$services_top->lang->name}}
			</a>
		@endforeach
	@endif
	@if(isset($header_data['contacts']) && $header_data['contacts'])
		<a href="{{build_unit_route($header_data['contacts'])}}">
			{{$header_data['contacts']->lang->name}}
		</a>
	@endif


	@if(isset($header_data['actions']) && $header_data['actions'])
		<a href="{{route('first_url',$header_data['actions']->alias)}}">
			{{$header_data['actions']->lang->name}}
		</a>
	@endif
	@if(isset($header_data['specialists']) && $header_data['specialists'])
		<a href="{{route('first_url',$header_data['specialists']->alias)}}">
			{{$header_data['specialists']->lang->name}}
		</a>
	@endif
	@if(isset($header_data['equipment']) && $header_data['equipment'])
		<a href="{{route('first_url',$header_data['equipment']->alias)}}">
			{{$header_data['equipment']->lang->name}}
		</a>
	@endif
	@if(isset($header_data['reviews']) && $header_data['reviews'])
		<a href="{{build_unit_route($header_data['reviews'])}}">
			{{$header_data['reviews']->lang->name}}
		</a>
	@endif
	@if(isset($header_data['prices']) && $header_data['prices'])
		<a href="{{build_cat_route($header_data['prices']->alias)}}">
			{{$header_data['prices']->lang->name}}
		</a>
	@endif
</header>
