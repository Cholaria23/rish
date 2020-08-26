<div class="mfp-hide popup-wrap mini" id="callback">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.btn.callback')
		</div>
	</div>
	<form method="post" class="callback_form">
        <div class="input-wrap">
            <input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.phone')*"  required>
        </div>
        <div class="input-wrap">
            <input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
        </div>
        <input type="hidden" name="url" value="{{Request::path()}}">
        <input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
        <input type="hidden" name="title" value="@lang('main.btn.callback')">
        <input type="hidden" name="lang" value="{{App::getLocale()}}">
        <div class="popup-info-text">
            @lang('main.form.required_text')
        </div>
        <button type="submit" class="btn-green do_callback_form">@lang('main.btn.call_me')</button>
    </form>
   <div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>


<div class="mfp-hide popup-wrap mini" id="general_appointment">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.btn.feedback')
		</div>
	</div>
	<form method="post" class="appointment_form">
        <div class="input-wrap">
            <input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.phone')*"  required>
        </div>
        <div class="input-wrap">
            <input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
        </div>
        <input type="hidden" name="url" value="{{Request::path()}}">
        <input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
        <input type="hidden" name="title" value="@lang('main.btn.feedback')">
        <input type="hidden" name="lang" value="{{App::getLocale()}}">
        <div class="popup-info-text">
            @lang('main.form.required_text')
        </div>
        <button type="submit" class="btn-green do_appointment_form">@lang('main.btn.sign_up')</button>
    </form>
   <div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>



{{-- service registration --}}
<div class="mfp-hide popup-wrap mini" id="appointment">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.form.appointment')
		</div>
		<div class="popup-sub-name"></div>
	</div>
	<form method="post" class="registration_form">
		@if(isset($meta_type) && $meta_type == 'expert')
			<input class="input-form" type="hidden" name="specialist_id" value="{{$expert->id}}">
		@else
			@if(isset($cat) && isset($cat->related_specialists) && $cat->related_specialists && isset($cat->related_specialists[1]) && isset($cat->related_specialists[1]['specialists']) && $cat->related_specialists[1]['specialists']->count() ||
			isset($unit) && isset($unit->related_specialists) && $unit->related_specialists && isset($unit->related_specialists[2]) && isset($unit->related_specialists[2]['specialists']) && $unit->related_specialists[2]['specialists']->count() ||
			isset($all_specialists) && $all_specialists && $all_specialists->count())
				<div class="input-wrap">
					<select class="selectric select-appointment-specialist" name="specialist_id">
						<option value="">@lang('main.form.choose_specialist')</option>
						@if(isset($cat) && isset($cat->related_specialists) && $cat->related_specialists && isset($cat->related_specialists[1]) && isset($cat->related_specialists[1]['specialists']) && $cat->related_specialists[1]['specialists']->count())
							@foreach ($cat->related_specialists[1]['specialists'] as  $specialist_item)
								<option value="{{$specialist_item->id}}">{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}</option>
							@endforeach
						@elseif(isset($unit) && isset($unit->related_specialists) && $unit->related_specialists && isset($unit->related_specialists[2]) && isset($unit->related_specialists[2]['specialists']) && $unit->related_specialists[2]['specialists']->count())
							@foreach ($unit->related_specialists[2]['specialists'] as  $specialist_item)
								<option value="{{$specialist_item->id}}">{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}</option>
							@endforeach
						@else
							@foreach ($all_specialists as $specialist_item)
								<option value="{{$specialist_item->id}}">{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}</option>
							@endforeach
						@endif
					</select>
				</div>
			@endif
		@endif
	    <div class="input-wrap">
            <input class="input-form" class="phone" type="tel" name="phone" placeholder="@lang('main.form.phone')" required>
	    </div>
	    <div class="input-wrap">
            <input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
	    </div>
	    <div class="input-wrap">
            <input class="input-form" type="email" name="email" placeholder="@lang('main.form.email')">
	    </div>
	    <input type="hidden" name="url" value="{{Request::path()}}">
		<input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
	    <input type="hidden" name="title" value="@lang('main.form.appointment')">
	    <input type="hidden" name="appointment" value="">
		<input type="hidden" name="specialist" value="">
	    <input type="hidden" name="lang" value="{{App::getLocale()}}">
	    <div class="popup-info-text">
	        @lang('main.form.required_text')
	    </div>
	    <button type="submit" class="btn-green do_registration_form">@lang('main.btn.sign_up')</button>
	</form>
	<div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>

{{-- specialist --}}
<div class="mfp-hide popup-wrap mini" id="specialist">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.form.appointment')
		</div>
		<div class="popup-sub-name"></div>
	</div>
	<form method="post" class="specialist_form">
	    <div class="input-wrap">
            <input class="input-form" class="phone" type="tel" name="phone" placeholder="@lang('main.form.phone')" required>
	    </div>
	    <div class="input-wrap">
            <input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
	    </div>
	    <div class="input-wrap">
            <input class="input-form" type="email" name="email" placeholder="@lang('main.form.email')">
		</div>
		@if(isset($meta_type) && $meta_type == 'expert')
			<input class="input-form" type="hidden" name="specialist_id" value="{{$expert->id}}">
		@else
			@if(isset($cat) && isset($cat->related_specialists) && $cat->related_specialists && isset($cat->related_specialists[1]) && isset($cat->related_specialists[1]['specialists']) && $cat->related_specialists[1]['specialists']->count() ||
			isset($unit) && isset($unit->related_specialists) && $unit->related_specialists && isset($unit->related_specialists[2]) && isset($unit->related_specialists[2]['specialists']) && $unit->related_specialists[2]['specialists']->count() ||
			isset($all_specialists) && $all_specialists && $all_specialists->count())
				<div class="input-wrap">
					<select class="selectric" name="specialist_id">
						<option value="">@lang('main.form.choose_specialist')</option>
						@if(isset($cat) && isset($cat->related_specialists) && $cat->related_specialists && isset($cat->related_specialists[1]) && isset($cat->related_specialists[1]['specialists']) && $cat->related_specialists[1]['specialists']->count())
							@foreach ($cat->related_specialists[1]['specialists'] as  $specialist_item)
								<option value="{{$specialist_item->id}}">{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}</option>
							@endforeach
						@elseif(isset($unit) && isset($unit->related_specialists) && $unit->related_specialists && isset($unit->related_specialists[2]) && isset($unit->related_specialists[2]['specialists']) && $unit->related_specialists[2]['specialists']->count())
							@foreach ($unit->related_specialists[2]['specialists'] as  $specialist_item)
								<option value="{{$specialist_item->id}}">{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}</option>
							@endforeach
						@else
							@foreach ($all_specialists as $specialist_item)
								<option value="{{$specialist_item->id}}">{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}</option>
							@endforeach
						@endif
					</select>
				</div>
			@endif
		@endif
	    <input type="hidden" name="url" value="{{Request::path()}}">
	    <input type="hidden" name="title" value="@lang('main.form.registration')">
	    <input type="hidden" name="appointment" value="">
	    <input type="hidden" name="lang" value="{{App::getLocale()}}">
	    <div class="popup-info-text">
	        @lang('main.form.required_text')
	    </div>
	    <button type="submit" class="btn-green do_specialist_form">@lang('main.btn.sign_up')</button>
	</form>
	<div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>


{{-- specialist --}}
<div class="mfp-hide popup-wrap big" id="question">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.btn.question_specialist')
		</div>
		<div class="popup-sub-name"></div>
	</div>
	<form method="post" class="question_form">
		<div class="popup-form-wrap">
			<div class="popup-input-wrap">
				<div class="input-wrap">
					<input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')*" required>
				</div>
				<div class="input-wrap">
					<input class="input-form" class="phone" type="tel" name="phone" placeholder="@lang('main.form.phone')*" required>
				</div>
				<div class="input-wrap">
					<input class="input-form" type="email" name="email" placeholder="@lang('main.form.email')">
				</div>
			</div>
			<div class="popup-textarea-wrap">
				@if(isset($meta_type) && $meta_type == 'expert')
					<input class="input-form" type="hidden" name="specialist_id" value="{{$expert->id}}">
				@else
					@if(isset($cat) && isset($cat->related_specialists) && $cat->related_specialists && isset($cat->related_specialists[1]) && isset($cat->related_specialists[1]['specialists']) && $cat->related_specialists[1]['specialists']->count() ||
					isset($unit) && isset($unit->related_specialists) && $unit->related_specialists && isset($unit->related_specialists[2]) && isset($unit->related_specialists[2]['specialists']) && $unit->related_specialists[2]['specialists']->count() ||
					isset($all_specialists) && $all_specialists && $all_specialists->count())
						<div class="input-wrap">
							<select class="selectric select-question" name="specialist_id">
								<option value="">@lang('main.form.choose_specialist')</option>
								@if(isset($cat) && isset($cat->related_specialists) && $cat->related_specialists && isset($cat->related_specialists[1]) && isset($cat->related_specialists[1]['specialists']) && $cat->related_specialists[1]['specialists']->count())
									@foreach ($cat->related_specialists[1]['specialists'] as  $specialist_item)
										<option value="{{$specialist_item->id}}">{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}</option>
									@endforeach
								@elseif(isset($unit) && isset($unit->related_specialists) && $unit->related_specialists && isset($unit->related_specialists[2]) && isset($unit->related_specialists[2]['specialists']) && $unit->related_specialists[2]['specialists']->count())
									@foreach ($unit->related_specialists[2]['specialists'] as  $specialist_item)
										<option value="{{$specialist_item->id}}">{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}</option>
									@endforeach
								@else
									@foreach ($all_specialists as $specialist_item)
										<option value="{{$specialist_item->id}}">{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}</option>
									@endforeach
								@endif
							</select>
						</div>
					@endif
				@endif
				<div class="input-wrap">
					<textarea class="input-form form-input-textarea" name="content" placeholder="@lang('main.form.your_question')*" required></textarea>
				</div>
				<div class="popup-info-text">
					@lang('main.form.required_text')
				</div>
			</div>
		</div>
	    <input type="hidden" name="url" value="{{Request::path()}}">
		<input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
	    <input type="hidden" name="title" value="@lang('main.btn.question_specialist')">
	    <input type="hidden" name="appointment" value="">
	    <input type="hidden" name="lang" value="{{App::getLocale()}}">
	    <button type="submit" class="btn-green do_question_form">@lang('main.review.send')</button>
	</form>
	<div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>




<div class="mfp-hide popup-wrap mini" id="chekup">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.chekup')
		</div>
		<div class="popup-sub-name"></div>
	</div>
	<form method="post" class="chekup_form">
	    <div class="input-wrap">
            <input class="input-form" class="phone" type="tel" name="phone" placeholder="@lang('main.form.phone')" required>
	    </div>
	    <div class="input-wrap">
            <input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
	    </div>
	    <div class="input-wrap">
            <input class="input-form" type="email" name="email" placeholder="@lang('main.form.email')">
	    </div>
	    <input type="hidden" name="url" value="{{Request::path()}}">
	    <input type="hidden" name="title" value="@lang('main.chekup')">
	    <input type="hidden" name="lang" value="{{App::getLocale()}}">
	    <div class="popup-info-text">
	        @lang('main.form.required_text')
	    </div>
	    <button type="submit" class="btn-green do_chekup_form">@lang('main.btn.sign_up')</button>
	</form>
	<div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>

<div class="mfp-hide popup-wrap mini" id="consultation">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.consultation')
		</div>
		<div class="popup-sub-name"></div>
	</div>
	<form method="post" class="consultation_form">
	    <div class="input-wrap">
            <input class="input-form" class="phone" type="tel" name="phone" placeholder="@lang('main.form.phone')" required>
	    </div>
	    <div class="input-wrap">
            <input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
	    </div>
	    <div class="input-wrap">
            <textarea class="input-form form-input-textarea" name="content" placeholder="@lang('main.form.your_question')"></textarea>
	    </div>
		<input type="hidden" name="url" value="{{Request::path()}}">
		<input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
	    <input type="hidden" name="url" value="{{Request::path()}}">
	    <input type="hidden" name="title" value="@lang('main.consultation')">
	    <input type="hidden" name="lang" value="{{App::getLocale()}}">
	    <div class="popup-info-text">
	        @lang('main.form.required_text')
	    </div>
	    <button type="submit" class="btn-green do_consultation_form">@lang('main.btn.sign_up')</button>
	</form>
	<div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>

<div class="modals" id="login">
	<div class="modals__top modals__tabs">
		<div class="modals__tabs-item">
			<button class='modals__tabs-btn active' data-tab="login">
				@lang('cabinet.log_inn')
			</button>
		</div>
		<div class="modals__tabs-item">
			<button class='modals__tabs-btn' data-tab="reg">
				@lang('cabinet.registration')
			</button>
		</div>
	</div>
	<div class="modals__content-wr">
		<div class="modals__content">
			<div class="modals__tabs-panel active" data-block="login">
				{{-- <div class="modals__socials">
					<a href="{{ route('social-login', array('google')) }}" class="modals__socials-link modals__socials-link--google">
					<span class="modals__socials-icon">
						<svg xmlns="https://www.w3.org/2000/svg"  viewBox="0 0 21 21"><g><g><g><path fill="#fbbb00" d="M4.561 12.437l-.716 2.674-2.619.055A10.244 10.244 0 0 1 0 10.29c0-1.706.415-3.315 1.15-4.732h.001l2.331.427 1.021 2.317a6.117 6.117 0 0 0-.33 1.988c0 .755.137 1.479.388 2.147z"/></g><g><path fill="#518ef8" d="M20.4 8.368a10.31 10.31 0 0 1-.045 4.07 10.288 10.288 0 0 1-3.623 5.876l-2.937-.15-.415-2.594a6.133 6.133 0 0 0 2.639-3.132h-5.503v-4.07H20.4z"/></g><g><path fill="#28b446" d="M16.731 18.314h.001a10.246 10.246 0 0 1-6.442 2.266c-3.919 0-7.326-2.19-9.064-5.414l3.335-2.73a6.118 6.118 0 0 0 8.819 3.134z"/></g><g><path fill="#f14336" d="M16.858 2.369l-3.333 2.729a6.12 6.12 0 0 0-9.021 3.204L1.15 5.558A10.288 10.288 0 0 1 10.29 0c2.497 0 4.786.89 6.568 2.369z"/></g></g></g></svg>
					</span>
						<span>@lang('main.reg_via_google')</span>
					</a>
					<a href="{{ route('social-login', array('facebook')) }}" class="modals__socials-link modals__socials-link--facebook">
						<span class="modals__socials-icon">
						<svg xmlns="https://www.w3.org/2000/svg"><path fill="#3b5998" d="M0 10.426C0 4.668 4.668 0 10.426 0s10.426 4.668 10.426 10.426-4.668 10.426-10.426 10.426S0 16.184 0 10.426z"/><path fill="#fff" d="M13.047 10.834h-1.86v6.816H8.368v-6.816h-1.34V8.439h1.34v-1.55c0-1.109.527-2.844 2.844-2.844l2.088.008v2.325h-1.515c-.249 0-.598.124-.598.653v1.41h2.106z"/></svg>
						</span>
						<span>@lang('main.reg_via_facebook')</span>
					</a>
					<a href="{{ route('social-login', array('google')) }}" class="soc-login-link google-login">
						<span class="icon-g-plus"></span>
					</a>
					{{ route('social-login', array('facebook')) }}
				</div> --}}
				{{-- <div class="modals__or">@lang('main.or')</div> --}}

				<form id='cab_form' role='form' method='POST' action='page/cabinet_login' class="forms cab-form">
					<div class="form__item">
						<input class='form__input' type='email' name='email' required />
						<span class="form__label-top">@lang('cabinet.email')</span>
					</div>
					<div class="form__item">
						<input class='form__input form-control' type='password' name='password' required />
						<span class="form__label-top">@lang('cabinet.password')</span>
					</div>
					<div class="modals__info-wr">
						<div class="form__loader">
							<svg>
								<use xlink:href="#icon-loader"></use>
							</svg>
						</div>
						<button class="btn btn--brown" id="submit_login" type='submit'>@lang('cabinet.log_in') </button>
						<a class="modal-magnific"  href="#restore" >@lang('cabinet.forget_password')</a>
					</div>
					<div class="modals__auth-error">@lang('cabinet.incorrect')</div>
			
				</form>
			</div>
			<div class="modals__tabs-panel" data-block="reg">
				{{-- <div class="modals__socials">
					<a href="{{ route('social-login', array('google')) }}" class="modals__socials-link modals__socials-link--google">
						<span class="modals__socials-icon">
						<svg xmlns="https://www.w3.org/2000/svg"  viewBox="0 0 21 21"><g><g><g><path fill="#fbbb00" d="M4.561 12.437l-.716 2.674-2.619.055A10.244 10.244 0 0 1 0 10.29c0-1.706.415-3.315 1.15-4.732h.001l2.331.427 1.021 2.317a6.117 6.117 0 0 0-.33 1.988c0 .755.137 1.479.388 2.147z"/></g><g><path fill="#518ef8" d="M20.4 8.368a10.31 10.31 0 0 1-.045 4.07 10.288 10.288 0 0 1-3.623 5.876l-2.937-.15-.415-2.594a6.133 6.133 0 0 0 2.639-3.132h-5.503v-4.07H20.4z"/></g><g><path fill="#28b446" d="M16.731 18.314h.001a10.246 10.246 0 0 1-6.442 2.266c-3.919 0-7.326-2.19-9.064-5.414l3.335-2.73a6.118 6.118 0 0 0 8.819 3.134z"/></g><g><path fill="#f14336" d="M16.858 2.369l-3.333 2.729a6.12 6.12 0 0 0-9.021 3.204L1.15 5.558A10.288 10.288 0 0 1 10.29 0c2.497 0 4.786.89 6.568 2.369z"/></g></g></g></svg>
						</span>
						<span>@lang('main.reg_via_google')</span>
					</a>
					<a href="{{ route('social-login', array('facebook')) }}" class="modals__socials-link modals__socials-link--facebook">
					<span class="modals__socials-icon">
						<svg xmlns="https://www.w3.org/2000/svg"><path fill="#3b5998" d="M0 10.426C0 4.668 4.668 0 10.426 0s10.426 4.668 10.426 10.426-4.668 10.426-10.426 10.426S0 16.184 0 10.426z"/><path fill="#fff" d="M13.047 10.834h-1.86v6.816H8.368v-6.816h-1.34V8.439h1.34v-1.55c0-1.109.527-2.844 2.844-2.844l2.088.008v2.325h-1.515c-.249 0-.598.124-.598.653v1.41h2.106z"/></svg>
					</span>
						<span>@lang('main.reg_via_facebook')</span>
					</a>
					<a href="{{ route('social-login', array('google')) }}" class="soc-login-link google-login">
						<span class="icon-g-plus"></span>
					</a>
					{{ route('social-login', array('facebook')) }}
				</div>
				<div class="modals__or">@lang('main.or')</div> --}}
				<form id='reg_form' class="forms">
					<div class="form__item">
						<input class='form__input' type='email' name='email' required />
						<span class="form__label-top">@lang('cabinet.email')</span>
					</div>
					<button class="btn btn--brown" id="submit_register"  type='submit'>@lang('cabinet.do_reg')</button>
					<div class="modals__auth-error">@lang('cabinet.exists')</div>
					<div class="form__loader">
						<svg>
							<use xlink:href="#icon-loader"></use>
						</svg>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="modals" id="restore">
	<div class="modals__top">@lang('cabinet.reseting_password')</div>
		<div class="modals__content-wr">
		<div class="modals__content">
			<form  class="forms" id='restore_pass_form'>
				<div class="form__item">
					<input class='form__input' type='email' name='email' required />
					<span class="form__label-top">@lang('cabinet.email')</span>
				</div>
				<button class="btn btn--brown" id="submit_restore"  type='submit'>@lang('cabinet.reset_password') </button>
				<div class="modals__auth-error">@lang('cabinet.no_email')</div>
				<div class="modals__success">@lang('cabinet.pass_sent')</div>
				{{-- <span class='modals__info-text'>@lang('main.login.no_acc')</span> --}}
				<div class="modals__bottom">
					<a href="#login" class="modal-magnific modals__inner-link">@lang('cabinet.back')</a>
				</div>
				<div class="form__loader">
					<svg>
						<use xlink:href="#icon-loader"></use>
					</svg>
				</div>
			</form>
		</div>
	</div>
</div>
