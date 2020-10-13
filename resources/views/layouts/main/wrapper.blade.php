<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
	<head>
		<base href="{{ URL::to('/') }}" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, user-scalable=0">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		{!! $seo->yandex_verification !!}
		{!! $seo->google_verification !!}
		@include('layouts.main.meta')
		@if(Request::has('page') && Request::get('page'))
		@else
			<link rel="canonical" href="{{URL::to(Request::path())}}" />
		@endif
		@include('layouts.main.favicon')
		@yield('links')
		@yield('header_scripts')
		{!! $seo->google_analytics !!}
		{!! $seo->facebook_pixel !!}
		@if ( $seo->noindex == 1)
	        <meta name="robots" content="noindex, nofollow" />
	    @endif
		<link rel="stylesheet" href="{{ asset('/css/fonts.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
		{!! $seo->google_tm_start !!}
	</head>
	<body>
		{!! $seo->google_tm_end !!}
		@if (isset($admin_edit_link))
	        <a href="{{ $admin_edit_link }}" title="@lang('main.edit')" class="edit-btn" style="position:fixed;left:50px;top:230px;z-index: 99999;width: 40px;height: 40px;display: flex;border-radius: 50%;border: 2px solid #812ca4;justify-content: space-around;align-items: center;transition: all .2s linear;background: transparent;" target="_blank">
	            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;" xml:space="preserve">
	                <g>
	                    <path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897   C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436   c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44   c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421   c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z    M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919   c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703   c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986   C147.097,447.637,146.36,447.193,145.734,446.572z" fill="#812ca4"/>
	                </g>
	            </svg>
	        </a>
		@endif
		@if(App::getLocale() == 'en')
			@include('layouts.main.en_header')
		@else
			@include('layouts.main.header')
		@endif
		<main class="main">
			@yield('page')
		</main>
		@if(App::getLocale() == 'en')
			@include('layouts.main.en_footer')
		@else
			@include('layouts.main.footer')
		@endif
		@include('layouts.main.popup')
		<div class='up_button'>
		   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="21" height="13" viewBox="0 0 21 13"><defs><path id="g6dfa" d="M183.546 178.33l-9.215 9.216c-.213.213-.331.497-.331.8 0 .304.118.589.33.802l.68.679c.441.441 1.16.441 1.602 0l7.738-7.74 7.747 7.748c.214.213.498.331.801.331.304 0 .588-.118.802-.33l.678-.68c.213-.213.331-.497.331-.8 0-.304-.118-.589-.33-.802l-9.225-9.225a1.126 1.126 0 0 0-.803-.33c-.305 0-.59.117-.805.33z"/></defs><g><g transform="translate(-174 -178)"><use fill="#37b6b7" xlink:href="#g6dfa"/></g></g></svg>
	   </div>
	   <div class="appointment-online-btn-wrap">
		   @if(isset($unit) && in_array($unit->id,[1]) || isset($cat) && in_array($cat->id,[13]))
			   <a class="popup-js appointment-online-popup-btn appointment_test-js" href="#appointment_test">
				   <span>
					   @lang('main.test')
				   </span>
			   </a>
			   <a class="popup-js appointment-online-popup-btn" href="#vaccination">
				   <span>
					   @lang('main.vaccination')
				   </span>
			   </a>
		   @endif
		   <a class="popup-js appointment-online-btn" href="#appointment-online-popup">
			   <span>
				   @lang('main.form.appointment')
			   </span>
		   </a>
	   </div>
		@include('layouts.main.svg_sprite')
		<script defer type="text/javascript">
			var routes = {
				'postSend' : "{{route('service.postSend')}}",
				'postLoadFile' : "{{route('service.postLoadFile')}}",
				'postRegister' : "{{route('service.postRegister')}}",
				'postPassword' : "{{route('service.postPassword')}}",
				'postSaveUser' : "{{route('service.postSaveUser')}}",
				'postLogin' : "{{route('service.postLogin')}}",
				'postLogout' : "{{route('service.postLogout')}}",
				'postSaveUserPassword' : "{{route('service.postSaveUserPassword')}}",
			}
		</script>
		<script type="text/javascript" src="{{asset('/js/manifest.js')}}"></script>
		<script type="text/javascript" src="{{asset('/js/vendor.js')}}"></script>
		<script type="text/javascript" src="{{asset('/js/app.js')}}"></script>
		@if (App::getLocale() !== "en")
			<script defer type="text/javascript" src='/js/messages_{{ App::getLocale() }}.js'></script>
		@endif
		<script>
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
			@if (app('params')->is_cookie == 1)
				<?php $is_cookie_shown = session()->get('cookie_shown', FALSE); ?>
				@if (!$is_cookie_shown)
						function closeCookie(){
							$.post('{{ route('service.closeCookie') }}', {}, function (data) {
								if (data.status == 'ok') {
									$(".about_cookie_outer").hide();
								}
							});
						};
				@endif
			@endif
		</script>
		@yield('scripts')
		@if(Auth::guard('web')->check())
			<script>
				$(window).on('load',function() {
					$.ajax({
						url: "{{route('service.postFillUserFields')}}",
						type: 'POST',
						dataType: 'json',
						data: { '_token' :  "{{ csrf_token() }}" },
						success: function (data) {
							if (data.status==='exist') {
								$('input[name="name"]').val(data.name);
								$('input[name="name"]').val(data.firstname);
								$('input[name="firstname"]').val(data.firstname);
								$('input[name="lastname"]').val(data.lastname);
								$('input[name="fathername"]').val(data.fathername);
								$('input[name="city"]').each(function() {
									if (!$(this).prop('readonly')) {
										$(this).val(data.city);
									};
								});
								$('input[name="street"]').val(data.street);
								$('input[name="building"]').val(data.building);
								$('input[name="room"]').val(data.room);
								$('input[name="email"]').val(data.email);
								$('input[name="phone"]').val(data.phone);

								$(".form__input").each(function () {
									if ($(this).val() != '') {
										$(this).siblings().addClass("active");
										$(this).addClass('active-input');
									}
								});
							}
						}
					});
				});
			</script>
		@endif
		@if (app('params')->is_nocopy == 1 && !app('params')->permitted)
        <style type="text/css">
            body{
			  -webkit-touch-callout: none;
			    -webkit-user-select: none;
			     -khtml-user-select: none;
			       -moz-user-select: none;
			        -ms-user-select: none;
			            user-select: none;
		            }
		        </style>
		        <script type="text/javascript">
		            window.oncontextmenu = function (event) {
		                 event.preventDefault();
		            }
		            window.onkeydown = function(evt) {
		                if(evt.keyCode == 123) return false;
		            };
		            window.onkeypress = function(evt) {
		                if(evt.keyCode == 123) return false;
		            };
		            window.onkeydown = function(evt) {
		                if(evt.ctrlKey && evt.keyCode == 85) return false;
		            };
		            window.onkeydown = function(evt) {
		                if(evt.ctrlKey && evt.keyCode == 85 || evt.ctrlKey && evt.shiftKey && evt.keyCode == 73) return false;
		            };
		            window.ondragstart = function() { return false; }
		        </script>
	    @endif
		{!! $seo->yandex_metrika !!}
		{!! $seo->jivosite !!}
	</body>
</html>
