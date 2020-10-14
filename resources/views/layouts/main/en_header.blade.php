<header class="header">
	<div class="header-top">
		<div class="container">
			<div class="header-top-wrap">
				@if(isset($unit) && $unit->alias == "main")
					@if (isset(app('seo')['logo_svg_1']) && app('seo')['logo_svg_1'] != '')
						<div class="header-logo">
							{!! app('seo')['logo_svg_1'] !!}
						</div>
					@endif
				@else
					@if (isset(app('seo')['logo_svg_1']) && app('seo')['logo_svg_1'] != '')
						<a href="/" class="header-logo">
							{!! app('seo')['logo_svg_1'] !!}
						</a>
					@endif
				@endif
				<div class="header-top-right">
					@if(isset(app('contacts')['main']['contacts']['lang']['note_1']) && app('contacts')['main']['contacts']['lang']['note_1'] != '' || isset(app('contacts')['main']['contacts']['lang']['address']) && app('contacts')['main']['contacts']['lang']['address'] != '')
						<div class="header-address-wrap desktop">
							@if(isset(app('contacts')['main']['contacts']['lang']['note_1']) && app('contacts')['main']['contacts']['lang']['note_1'] != '')
								<div class="header-address-item">
									<div class="header-address-icon">
										<svg width="15" height="16">
											<use xlink:href="#icon-calendar"></use>
										</svg>
									</div>
									<div class="header-address-info">
										{!! app('contacts')['main']['contacts']['lang']['note_1'] !!}
									</div>
								</div>
							@endif
							@if(isset(app('contacts')['main']['contacts']['lang']['address']) && app('contacts')['main']['contacts']['lang']['address'] != '')
								<div class="header-address-item">
									<div class="header-address-icon">
										<svg width="11" height="15">
											<use xlink:href="#icon-map"></use>
										</svg>
									</div>
									<div class="header-address-info">
										{!! app('contacts')['main']['contacts']['lang']['address'] !!}
									</div>
								</div>
							@endif
						</div>
					@endif
					<div class="header-contact-block desktop">
						@if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '')
							<a class="header-contact-link binct-phone-number-1" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1'] ) }}">
								{{app('contacts')['main']['contacts']['lang']['phone_1_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_1_name'] : app('contacts')['main']['contacts']['phone_1']}}
							</a>
						@endif
						<a class="header-callback-popup popup-js" href="#callback">
							@lang('main.btn.callback')
						</a>
					</div>
					<div class="header-btns-wrap">
						<a class="btn-green-small popup-js desktop" href="#general_appointment">
							@lang('main.btn.make_appointment')
						</a>
					</div>
					@if(count(app('langSettings')->langs->pluck('code')->toArray()) > 1)
						<div class="lang-list-wrap desktop">
							<ul class="lang-list">
								@foreach(app('langSettings')->langs->pluck('code')->toArray() as $localeCode)
									<li class="lang-item">
										<a class="lang-link {{ ($localeCode == LaravelLocalization::getCurrentLocale()) ? 'active' : '' }}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
											{{ strtoupper($localeCode) }}
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					@endif
					<div class="burger-menu mobile">
	                    <div class="menu__icon">
	                    </div>
	                </div>
				</div>
			</div>
		</div>
	</div>
	<div class="header-menu">
		<div class="container">
			<div class="header-menu-wrap">
				<div class="mobile-menu-top mobile">
					<a class="btn-green-small popup-js" href="#general_appointment">
						@lang('main.btn.make_appointment')
					</a>
					<div class="header-contact-block">
						@if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '')
							<a class="header-contact-link binct-phone-number-1" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1'] ) }}">
								{{app('contacts')['main']['contacts']['lang']['phone_1_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_1_name'] : app('contacts')['main']['contacts']['phone_1']}}
							</a>
						@endif
						<a class="header-callback-popup popup-js" href="#callback">
							@lang('main.btn.callback')
						</a>
					</div>
				</div>
				<ul class="header-menu-list">
					@if(isset($unit) && $unit)
						<li class="header-menu-item">
							<span class="header-menu-link header-scroll-js" data-scroll="{{$unit->lang->name}}">
								{{$unit->lang->name}}
							</span>
						</li>
					@endif
                    {{-- @if(isset($offer) && $offer)
                        <li class="header-menu-item">
                            <span class="header-menu-link header-scroll-js" data-scroll="{{$offer->lang->name}}">
                                {{$offer->lang->name}}
                            </span>
                        </li>
                    @endif --}}
                    @if(isset($our_mission) && $our_mission)
						<li class="header-menu-item">
							<span class="header-menu-link header-scroll-js" data-scroll="{{$our_mission->lang->name}}">
								{{$our_mission->lang->name}}
							</span>
						</li>
					@endif
                    @if(isset($directions) && $directions)
						<li class="header-menu-item">
							<span class="header-menu-link header-scroll-js" data-scroll="{{$directions->lang->name}}">
								{{$directions->lang->name}}
							</span>
						</li>
					@endif
                    @if(isset($pricelist) && $pricelist)
                        <li class="header-menu-item">
                            <span class="header-menu-link header-scroll-js" data-scroll="{{$pricelist->lang->name}}">
                                {{$pricelist->lang->name}}
                            </span>
                        </li>
                    @endif
                    @if(isset($translator) && $translator)
						<li class="header-menu-item">
							<span class="header-menu-link header-scroll-js" data-scroll="{{$translator->lang->name}}">
								{{$translator->lang->name}}
							</span>
						</li>
					@endif
                    @if(isset($standards) && $standards)
						<li class="header-menu-item">
							<span class="header-menu-link header-scroll-js" data-scroll="{{$standards->lang->name}}">
								{{$standards->lang->name}}
							</span>
						</li>
					@endif
                    @if(isset($departments) && $departments)
						<li class="header-menu-item">
							<span class="header-menu-link header-scroll-js" data-scroll="{{$departments->lang->name}}">
								{{$departments->lang->name}}
							</span>
						</li>
					@endif
                    @if(isset($check_up) && $check_up)
                        <li class="header-menu-item">
                            <span class="header-menu-link header-scroll-js" data-scroll="{{$check_up->lang->name}}">
                                {{$check_up->lang->name}}
                            </span>
                        </li>
                    @endif
                    @if(isset($telemed) && $telemed)
                        <li class="header-menu-item">
                            <span class="header-menu-link header-scroll-js" data-scroll="{{$telemed->lang->name}}">
                                {{$telemed->lang->name}}
                            </span>
                        </li>
                    @endif
                    {{-- @if(isset($principles) && $principles)
                        <li class="header-menu-item">
                            <span class="header-menu-link header-scroll-js" data-scroll="{{$principles->lang->name}}">
                                {{$principles->lang->name}}
                            </span>
                        </li>
                    @endif --}}
				</ul>
				<div class="mobile-menu-top mobile">
					@if(isset(app('contacts')['main']['contacts']['lang']['note_1']) && app('contacts')['main']['contacts']['lang']['note_1'] != '' || isset(app('contacts')['main']['contacts']['lang']['address']) && app('contacts')['main']['contacts']['lang']['address'] != '')
						<div class="header-address-wrap">
							@if(isset(app('contacts')['main']['contacts']['lang']['note_1']) && app('contacts')['main']['contacts']['lang']['note_1'] != '')
								<div class="header-address-item">
									<div class="header-address-icon">
										<svg width="15" height="16">
											<use xlink:href="#icon-calendar"></use>
										</svg>
									</div>
									<div class="header-address-info">
										{!! app('contacts')['main']['contacts']['lang']['note_1'] !!}
									</div>
								</div>
							@endif
							@if(isset(app('contacts')['main']['contacts']['lang']['address']) && app('contacts')['main']['contacts']['lang']['address'] != '')
								<div class="header-address-item">
									<div class="header-address-icon">
										<svg width="11" height="15">
											<use xlink:href="#icon-map"></use>
										</svg>
									</div>
									<div class="header-address-info">
										{!! app('contacts')['main']['contacts']['lang']['address'] !!}
									</div>
								</div>
							@endif
						</div>
					@endif
					@if(count(app('langSettings')->langs->pluck('code')->toArray()) > 1)
						<div class="lang-list-wrap">
							<ul class="lang-list">
								@foreach(app('langSettings')->langs->pluck('code')->toArray() as $localeCode)
									<li class="lang-item">
										<a class="lang-link {{ ($localeCode == LaravelLocalization::getCurrentLocale()) ? 'active' : '' }}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
											{{ strtoupper($localeCode) }}
										</a>
									</li>
								@endforeach
							</ul>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</header>
