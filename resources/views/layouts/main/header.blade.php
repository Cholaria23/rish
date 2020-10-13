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
										( <a class="header-address-info-link" href="{{build_unit_route($header_data['get_there'])}}">
											{{$header_data['get_there']->lang->name}}
										</a> )
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
						<div class="header-cabinet-wrap desktop">
							@include('layouts.main.header_login')
						</div>
						<a class="btn-green-small popup-js desktop" href="#general_appointment">
							@lang('main.btn.feedback')
						</a>
					</div>
					<button class="header-search-btn desktop" type="button">
						<svg width="16" height="16">
							<use xlink:href="#icon-search"></use>
						</svg>
					</button>
					<div class="search-dropdown">
						<div class="container">
							<div class="search-dropdown-wrap">
								<form class="search-form" action="{{route('search')}}">
									<div class="search-input-holder">
										<input class="search-input"  type="text" name="search" placeholder="@lang('main.header_search')" minlength="3" autocomplete="off" required>
									</div>
									<button class="search-btn">
										@lang('main.btn.find')
									</button>
								</form>
							</div>
						</div>
					</div>
					@if(count(app('langSettings')->langs->pluck('code')->toArray()) > 1)
						<div class="lang-list-wrap desktop">
							<ul class="lang-list">
								@foreach(app('langSettings')->langs->pluck('code')->toArray() as $localeCode)
									<li class="lang-item">
										@if($localeCode == 'en')
											<a class="lang-link {{ ($localeCode == LaravelLocalization::getCurrentLocale()) ? 'active' : '' }}" href="{{URL::to($localeCode) }}">
												{{ strtoupper($localeCode) }}
											</a>
										@else
											<a class="lang-link {{ ($localeCode == LaravelLocalization::getCurrentLocale()) ? 'active' : '' }}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
												{{ strtoupper($localeCode) }}
											</a>
										@endif
									</li>
								@endforeach
							</ul>
							@if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '' ||
							isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != '' || isset(app('contacts')['main']['contacts']['youtube']) && app('contacts')['main']['contacts']['youtube'] != ''
							)
								<ul class="social-list">
									@if(isset(app('contacts')['main']['contacts']['youtube']) && app('contacts')['main']['contacts']['youtube'] != '')
										<li class="social-item">
											<a class="social-link" href="{{app('contacts')['main']['contacts']['youtube']}}" target="_blank" rel="noopener noreferrer nofollow">
												<span class="social-icon">
													<svg width="30" height="30">
														<use xlink:href="#icon-You-tube"></use>
													</svg>
												</span>
											</a>
										</li>
									@endif
									@if(isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != '')
										<li class="social-item">
											<a class="social-link" href="{{app('contacts')['main']['contacts']['instagram']}}" target="_blank" rel="noopener noreferrer nofollow">
												<span class="social-icon">
													<svg width="30" height="30">
														<use xlink:href="#icon-Instagram"></use>
													</svg>
												</span>
											</a>
										</li>
									@endif
									@if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '')
										<li class="social-item">
											<a class="social-link" href="{{app('contacts')['main']['contacts']['facebook']}}" target="_blank" rel="noopener noreferrer nofollow">
												<span class="social-icon">
													<svg width="30" height="30">
														<use xlink:href="#icon-Facebook"></use>
													</svg>
												</span>
											</a>
										</li>
									@endif
								</ul>
							@endif
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
						@lang('main.btn.feedback')
					</a>
					<form class="search-form" action="{{route('search')}}">
						<div class="search-input-holder">
							<input class="search-input"  type="text" name="search" placeholder="@lang('main.search')" minlength="3" autocomplete="off" required>
						</div>
					</form>
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
					@if(isset($header_data['about_company']) && $header_data['about_company'])
						<li class="header-menu-item">
							<a class="header-menu-link" href="{{build_unit_route($header_data['about_company'])}}">
								{{$header_data['about_company']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['services']) && $header_data['services'])
						<li class="header-menu-item has-submenu-services">
							<a class="header-menu-link" href="{{route('first_url',$header_data['services']->alias)}}">
								{{$header_data['services']->lang->name}}
							</a>
							<div class="header-submenu-services-wrap">
								@if($header_data['services']->children->count())
									<div class="header-submenu-services">
							            @foreach ($header_data['services']->children as $firsc_child)
											<div class="header-submenu-services-item">
												<div class="header-submenu-services-title">
													{{$firsc_child->lang->name}}
												</div>
												@if($firsc_child->children->count())
													<ul class="header-submenu-services-list two-columns">
														@foreach ($firsc_child->children as $key => $second_child)
															<li class="header-submenu-services-list-item">
																<a class="header-submenu-services-link" href="{{route('first_url',$second_child->alias)}}">
																	{{$second_child->lang->name}}
																</a>
															</li>
														@endforeach
													</ul>
												@elseif($firsc_child->units->count())
													<ul class="header-submenu-services-list">
														@foreach ($firsc_child->units as $key => $unit_item)
															<li class="header-submenu-services-list-item">
																<a class="header-submenu-services-link" href="{{build_unit_route($unit_item)}}">
																	{{$unit_item->lang->name}}
																</a>
															</li>
														@endforeach
													</ul>
												@endif
											</div>
							            @endforeach
									</div>
						        @endif
							</div>
						</li>
					@endif
					@if(isset($header_data['checkup']) && $header_data['checkup'])
						<li class="header-menu-item">
							<a class="header-menu-link" href="{{build_unit_route($header_data['checkup'])}}">
								{{$header_data['checkup']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['services_top']) && $header_data['services_top'])
						@foreach ($header_data['services_top'] as $services_top)
							<li class="header-menu-item">
								<a class="header-menu-link" href="{{route('first_url',$services_top->alias)}}">
									{{$services_top->lang->name}}
								</a>
							</li>
						@endforeach
					@endif
					@if(isset($header_data['contacts']) && $header_data['contacts'])
						<li class="header-menu-item">
							<a class="header-menu-link" href="{{build_unit_route($header_data['contacts'])}}">
								{{$header_data['contacts']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['answers_questions']) && $header_data['answers_questions'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{build_unit_route($header_data['answers_questions'])}}">
								{{$header_data['answers_questions']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['actions']) && $header_data['actions'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{route('first_url',$header_data['actions']->alias)}}">
								{{$header_data['actions']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['offers']) && $header_data['offers'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{route('first_url',$header_data['offers']->alias)}}">
								{{$header_data['offers']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['news']) && $header_data['news'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{route('first_url',$header_data['news']->alias)}}">
								{{$header_data['news']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['specialist']) && $header_data['specialist'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{build_unit_route($header_data['specialist'])}}">
								{{$header_data['specialist']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['equipment']) && $header_data['equipment'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{route('first_url',$header_data['equipment']->alias)}}">
								{{$header_data['equipment']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['articles']) && $header_data['articles'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{route('first_url',$header_data['articles']->alias)}}">
								{{$header_data['articles']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['prices']) && $header_data['prices'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{build_cat_route($header_data['prices']->alias)}}">
								{{$header_data['prices']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['corporate_clients']) && $header_data['corporate_clients'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{build_unit_route($header_data['corporate_clients'])}}">
								{{$header_data['corporate_clients']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['insurance']) && $header_data['insurance'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{build_unit_route($header_data['insurance'])}}">
								{{$header_data['insurance']->lang->name}}
							</a>
						</li>
					@endif
					@if(isset($header_data['reviews']) && $header_data['reviews'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{build_unit_route($header_data['reviews'])}}">
								{{$header_data['reviews']->lang->name}}
							</a>
						</li>
					@endif
					{{-- @if(isset($header_data['online_consultation']) && $header_data['online_consultation'])
						<li class="header-menu-item mobile">
							<a class="header-menu-link" href="{{build_unit_route($header_data['online_consultation'])}}">
								{{$header_data['online_consultation']->lang->name}}
							</a>
						</li>
					@endif --}}
					<li class="header-menu-item has-submenu desktop">
						<span class="header-menu-link">
							<span class="has-submenu-text">
								@lang('main.more')
							</span>
							<span class="has-submenu-icon">
								<svg width="11" height="6">
									<use xlink:href="#checkmark-down"></use>
								</svg>
							</span>
						</span>
						<div class="header-submenu-wrap">
							<ul class="header-submenu">
								@if(isset($header_data['answers_questions']) && $header_data['answers_questions'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{build_unit_route($header_data['answers_questions'])}}">
											{{$header_data['answers_questions']->lang->name}}
										</a>
									</li>
								@endif
								@if(isset($header_data['actions']) && $header_data['actions'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{route('first_url',$header_data['actions']->alias)}}">
											{{$header_data['actions']->lang->name}}
										</a>
									</li>
								@endif
								@if(isset($header_data['offers']) && $header_data['offers'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{route('first_url',$header_data['offers']->alias)}}">
											{{$header_data['offers']->lang->name}}
										</a>
									</li>
								@endif
								@if(isset($header_data['news']) && $header_data['news'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{route('first_url',$header_data['news']->alias)}}">
											{{$header_data['news']->lang->name}}
										</a>
									</li>
								@endif
								@if(isset($header_data['specialist']) && $header_data['specialist'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{build_unit_route($header_data['specialist'])}}">
											{{$header_data['specialist']->lang->name}}
										</a>
									</li>
								@endif
								@if(isset($header_data['equipment']) && $header_data['equipment'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{route('first_url',$header_data['equipment']->alias)}}">
											{{$header_data['equipment']->lang->name}}
										</a>
									</li>
								@endif
								@if(isset($header_data['articles']) && $header_data['articles'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{route('first_url',$header_data['articles']->alias)}}">
											{{$header_data['articles']->lang->name}}
										</a>
									</li>
								@endif
								@if(isset($header_data['prices']) && $header_data['prices'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{build_cat_route($header_data['prices']->alias)}}">
											{{$header_data['prices']->lang->name}}
										</a>
									</li>
								@endif
								@if(isset($header_data['corporate_clients']) && $header_data['corporate_clients'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{build_unit_route($header_data['corporate_clients'])}}">
											{{$header_data['corporate_clients']->lang->name}}
										</a>
									</li>
								@endif
								@if(isset($header_data['insurance']) && $header_data['insurance'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{build_unit_route($header_data['insurance'])}}">
											{{$header_data['insurance']->lang->name}}
										</a>
									</li>
								@endif
								@if(isset($header_data['reviews']) && $header_data['reviews'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{build_unit_route($header_data['reviews'])}}">
											{{$header_data['reviews']->lang->name}}
										</a>
									</li>
								@endif
								{{-- @if(isset($header_data['online_consultation']) && $header_data['online_consultation'])
									<li class="header-menu-item">
										<a class="header-menu-link" href="{{build_unit_route($header_data['online_consultation'])}}">
											{{$header_data['online_consultation']->lang->name}}
										</a>
									</li>
								@endif --}}
							</ul>
						</div>
					</li>
				</ul>
				<div class="mobile-menu-top mobile">
					@if(isset(app('contacts')['main']['contacts']['lang']['note_1']) && app('contacts')['main']['contacts']['lang']['note_1'] != '' || isset(app('contacts')['main']['contacts']['lang']['address']) && app('contacts')['main']['contacts']['lang']['address'] != '')
						<div class="header-address-wrap">
							<div class="header-cabinet-wrap">
								@include('layouts.main.header_login')
							</div>
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
										( <a class="header-address-info-link" href="{{build_unit_route($header_data['get_there'])}}">
											{{$header_data['get_there']->lang->name}}
										</a> )
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
							@if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '' ||
							isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != '' || isset(app('contacts')['main']['contacts']['youtube']) && app('contacts')['main']['contacts']['youtube'] != ''
							)
								<ul class="social-list">
									@if(isset(app('contacts')['main']['contacts']['youtube']) && app('contacts')['main']['contacts']['youtube'] != '')
										<li class="social-item">
											<a class="social-link" href="{{app('contacts')['main']['contacts']['youtube']}}" target="_blank" rel="noopener noreferrer nofollow">
												<span class="social-icon">
													<svg width="30" height="30">
														<use xlink:href="#icon-You-tube"></use>
													</svg>
												</span>
											</a>
										</li>
									@endif
									@if(isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != '')
										<li class="social-item">
											<a class="social-link" href="{{app('contacts')['main']['contacts']['instagram']}}" target="_blank" rel="noopener noreferrer nofollow">
												<span class="social-icon">
													<svg width="30" height="30">
														<use xlink:href="#icon-Instagram"></use>
													</svg>
												</span>
											</a>
										</li>
									@endif
									@if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '')
										<li class="social-item">
											<a class="social-link" href="{{app('contacts')['main']['contacts']['facebook']}}" target="_blank" rel="noopener noreferrer nofollow">
												<span class="social-icon">
													<svg width="30" height="30">
														<use xlink:href="#icon-Facebook"></use>
													</svg>
												</span>
											</a>
										</li>
									@endif
								</ul>
							@endif
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</header>
