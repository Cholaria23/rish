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



{{-- service registration --}}
<div class="mfp-hide popup-wrap mini" id="appointment">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.form.appointment')
		</div>
		<div class="popup-sub-name"></div>
	</div>
	<form method="post" class="registration_form">
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
	    <input type="hidden" name="title" value="@lang('main.form.registration')">
	    <input type="hidden" name="appointment" value="">
	    <input type="hidden" name="lang" value="{{App::getLocale()}}">
	    <div class="popup-info-text">
	        @lang('main.form.required_text')
	    </div>
	    <button type="submit" class="btn-green do_registration_form">@lang('main.btn.sign_up')</button>
	</form>
	<div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>




<div class="mfp-hide popup-wrap mini" id="test-modal">

	<div class="popup-close-js">Dismiss</div>
</div>
