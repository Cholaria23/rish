@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page">
		@include('layouts.main.breadcrumbs')
		<section class="main-section">
			<div class="container">
				<div class="contact-page-wrap">
					<div class="item-contact-wrap">
						@if($unit->lang->h1 != '')
							<h1 class="main-section-title">
								{{$unit->lang->h1}}
							</h1>
						@else
							<h1 class="main-section-title">
								{{$unit->lang->name}}
							</h1>
						@endif
						<div class="item-contact-block-wrap">
							@if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '' ||
							isset(app('contacts')['main']['contacts']['phone_2']) && app('contacts')['main']['contacts']['phone_2'] != '' ||
							isset(app('contacts')['main']['contacts']['phone_3']) && app('contacts')['main']['contacts']['phone_3'] != '' ||
							isset(app('contacts')['main']['contacts']['phone_4']) && app('contacts')['main']['contacts']['phone_4'] != '' ||
							isset(app('contacts')['main']['contacts']['phone_5']) && app('contacts')['main']['contacts']['phone_5'] != ''
							)
							<div class="item-contact-block">
								<div class="contacts-item-title">
									@lang('main.phones')
								</div>
								<div class="item-contact-text">
									@lang('main.hotline_phone')
								</div>
								<ul class="contact-phone-list">
									@if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '')
										<li class="contact-phone-item">
											<a class="contact-phone-link binct-phone-number-1" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1'] ) }}">
												{{app('contacts')['main']['contacts']['lang']['phone_1_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_1_name'] : app('contacts')['main']['contacts']['phone_1']}}
											</a>
										</li>
									@endif
									@if(isset(app('contacts')['main']['contacts']['phone_2']) && app('contacts')['main']['contacts']['phone_2'] != '')
										<li class="contact-phone-item">
											<a class="contact-phone-link binct-phone-number-2" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_2']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_2'] ) }}">
												{{app('contacts')['main']['contacts']['lang']['phone_2_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_2_name'] : app('contacts')['main']['contacts']['phone_2']}}
											</a>
										</li>
									@endif
									@if(isset(app('contacts')['main']['contacts']['phone_3']) && app('contacts')['main']['contacts']['phone_3'] != '')
										<li class="contact-phone-item">
											<a class="contact-phone-link binct-phone-number-3" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_3']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_3'] ) }}">
												{{app('contacts')['main']['contacts']['lang']['phone_3_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_3_name'] : app('contacts')['main']['contacts']['phone_3']}}
											</a>
										</li>
									@endif
									@if(isset(app('contacts')['main']['contacts']['phone_4']) && app('contacts')['main']['contacts']['phone_4'] != '')
										<li class="contact-phone-item">
											<a class="contact-phone-link binct-phone-number-4" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_4']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_4'] ) }}">
												{{app('contacts')['main']['contacts']['lang']['phone_4_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_4_name'] : app('contacts')['main']['contacts']['phone_4']}}
											</a>
										</li>
									@endif
									@if(isset(app('contacts')['main']['contacts']['phone_5']) && app('contacts')['main']['contacts']['phone_5'] != '')
										<li class="contact-phone-item">
											<a class="contact-phone-link binct-phone-number-5" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_5']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_5'] ) }}">
												{{app('contacts')['main']['contacts']['lang']['phone_5_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_5_name'] : app('contacts')['main']['contacts']['phone_5']}}
											</a>
										</li>
									@endif
								</ul>
							</div>
						@endif

						@if(isset(app('contacts')['main']['contacts']['lang']['address']) && app('contacts')['main']['contacts']['lang']['address'] != '')
							<div class="item-contact-block">
								<div class="contacts-item-title">
									@lang('main.address')
								</div>
								<div class="item-contact-text">
									{!! app('contacts')['main']['contacts']['lang']['address'] !!}
								</div>
							</div>
						@endif

						@if(isset(app('contacts')['main']['contacts']['lang']['note_1']) && app('contacts')['main']['contacts']['lang']['note_1'] != '')
							<div class="item-contact-block">
								<div class="contacts-item-title">
									@lang('main.schedule')
								</div>
								<div class="item-contact-text">
									{!! app('contacts')['main']['contacts']['lang']['note_1'] !!}
								</div>
							</div>
						@endif

						@if(isset(app('contacts')['main']['contacts']['email_1']) && app('contacts')['main']['contacts']['email_1'] != '' ||
							isset(app('contacts')['main']['contacts']['email_2']) && app('contacts')['main']['contacts']['email_2'] != ''
							)
							<div class="item-contact-block">
								<div class="contacts-item-title">
									@lang('main.form.email')
								</div>
								<ul class="contact-email-list">
									@if(isset(app('contacts')['main']['contacts']['email_1']) && app('contacts')['main']['contacts']['email_1'] != '')
										<li class="contact-email-item">
											<a class="contact-email-link" href="mailto:{{ app('contacts')['main']['contacts']['email_1'] }}">
												{{app('contacts')['main']['contacts']['lang']['email_1_name'] != '' ? app('contacts')['main']['contacts']['lang']['email_1_name'] : app('contacts')['main']['contacts']['email_1']}}
											</a>
										</li>
									@endif
									@if(isset(app('contacts')['main']['contacts']['email_2']) && app('contacts')['main']['contacts']['email_2'] != '')
										<li class="contact-email-item">
											<a class="contact-email-link" href="mailto:{{ app('contacts')['main']['contacts']['email_2'] }}">
												{{app('contacts')['main']['contacts']['lang']['email_2_name'] != '' ? app('contacts')['main']['contacts']['lang']['email_2_name'] : app('contacts')['main']['contacts']['email_2']}}
											</a>
										</li>
									@endif
								</ul>
							</div>
						@endif

						@if(isset(app('contacts')['main']['contacts']['telegram']) && app('contacts')['main']['contacts']['telegram'] != '' ||
							isset(app('contacts')['main']['contacts']['viber']) && app('contacts')['main']['contacts']['viber'] != ''
							)
							<div class="item-contact-block">
								<div class="contacts-item-title">
									@lang('main.write_us')messangers
								</div>
								<ul class="contact-social-list">
									@if(isset(app('contacts')['main']['contacts']['telegram']) && app('contacts')['main']['contacts']['telegram'] != '')
										<li class="contact-social-item">
											<a class="contact-social-link" href="{{app('contacts')['main']['contacts']['telegram']}}" rel="noopener noreferrer nofollow" target="_blank">
												<svg width="50" height="50">
													<use xlink:href="#telegram"></use>
												</svg>
											</a>
										</li>
									@endif
									@if(isset(app('contacts')['main']['contacts']['viber']) && app('contacts')['main']['contacts']['viber'] != '')
										<li class="contact-social-item">
											<a class="contact-social-link" href="viber://chat?number={{app('contacts')['main']['contacts']['viber']}}" rel="noopener noreferrer nofollow" target="_blank">
												<span class="contacts__item-text">
													<svg width="50" height="50">
														<use xlink:href="#viber"></use>
													</svg>
												</span>
											</a>
										</li>
									@endif
								</ul>
							</div>
						@endif
						</div>
					</div>
					<div class="item-contact-form">
						@if(isset(app('contacts')['main']['contacts']['map_iframe']) && app('contacts')['main']['contacts']['map_iframe'] != '')
							<div class="map-container">
								{!!app('contacts')['main']['contacts']['map_iframe']!!}
							</div>
						@endif
						<div class="item-contact-form-wrap">
							<div class="contact-form-name">
								@lang('main.feedback')
							</div>
							<form method="post" class="feedback_form">
								<div class="contacts-form-inner">
									<div class="contacts-input-wrap">
										<div class="input-wrap">
											<input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')" required>
										</div>
										<div class="input-wrap">
											<input class="input-form" type="email" name="email" placeholder="@lang('main.form.email')" required>
										</div>
										<div class="input-wrap">
											<input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.number_phone')" required>
										</div>
									</div>
									<div class="contacts-textarea-wrap">
										<div class="input-wrap">
											<textarea class="input-form form-input-textarea" name="content" placeholder="@lang('main.form.your_message')" required></textarea>
										</div>
										<button type="submit" class="btn-green do_feedback_form">
											@lang('main.review.send')
										</button>
									</div>
								</div>
								<input type="hidden" name="url" value="{{Request::path()}}">
								<input type="hidden" name="title" value="@lang('main.feedback')">
								<input type="hidden" name="lang" value="{{App::getLocale()}}">
							</form>
							<div class='form-thanks'>@lang('main.form.form_thanks')</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
@stop
@section('scripts')
@stop
