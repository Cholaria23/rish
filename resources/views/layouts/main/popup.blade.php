<div class="mfp-hide popup-wrap appointment-online-wrap" id="appointment-online-popup">
	<div class="appointment-online-inner">
		<iframe class="appointment-online" src="https://booking.lakmus.org/?client=rishon&defaultAppointmentType=appointment&defaultPaymentSource=inclinic&branchId=1" frameborder="0" allowtransparency="true" width="100%" height="100%" style="display: block;"></iframe>
	</div>
</div>

<div class="mfp-hide popup-wrap mini" id="popup-info">
	<div class="popup-name-wrap">
		<div class="popup-info-name">
			@lang('main.popup_info_text')
		</div>
	</div>
</div>

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
		@if(App::getLocale() != 'en')
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
		@endif
	    <div class="input-wrap">
            <input class="input-form" class="phone" type="tel" name="phone" placeholder="@lang('main.form.phone')*" required>
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
            <input class="input-form" class="phone" type="tel" name="phone" placeholder="@lang('main.form.phone')*" required>
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
		<input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
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

<div class="mfp-hide popup-wrap mini popup-cabinet" id="login">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('cabinet.log_inn')
		</div>
	</div>
	{{-- <div class="social-login-block">
		<a href="{{ route('social-login', array('google')) }}" class="social-login-link">
			<span class="social-login-icon">
				<svg width="21" height="21">
					<use xlink:href="#google-icon"></use>
				</svg>
			</span>
			<span class="social-login-name">
				@lang('cabinet.reg_via_google')
			</span>
		</a>
		<a href="{{ route('social-login', array('facebook')) }}" class="social-login-link">
			<span class="social-login-icon">
				<svg width="21" height="21">
					<use xlink:href="#fb-icon"></use>
				</svg>
			</span>
			<span class="social-login-name">
				@lang('cabinet.reg_via_facebook')
			</span>
		</a>
	</div>
	<div class="or-line">
		<span class="or-line-text">
			@lang('cabinet.or')
		</span>
	</div> --}}
	<form class="login-form">
		<div class="input-wrap">
            <input class="input-form" type="email" name="email" placeholder="@lang('cabinet.email')*">
	    </div>
		<div class="input-wrap">
            <input class="input-form" type="password" name="password" placeholder="@lang('cabinet.password')*">
	    </div>
		<div class="recovery-block">
			<div class="recovery-text">
				@lang('cabinet.forget_password')
			</div>
			<a href="#reset" class="recovery-link popup-js">
				@lang('cabinet.reset_password_btn')
			</a>
		</div>
		<button type="submit" class="btn-green do_login-form">
			@lang('cabinet.log_in')
		</button>
		<div class="cabinet-bottom-block">
			<div class="cabinet-bottom-text">
				@lang('cabinet.no_acc')
			</div>
			<a href="#registration" class="cabinet-bottom-link popup-js">
				@lang('cabinet.register')
			</a>
		</div>
		<div class="auth-error" style="display:none">
			@lang('cabinet.incorrect')
		</div>
	</form>
</div>

<div class="mfp-hide popup-wrap mini popup-cabinet" id="registration">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('cabinet.registration')
		</div>
	</div>
	{{-- <div class="social-login-block">
		<a href="{{ route('social-login', array('google')) }}" class="social-login-link">
			<span class="social-login-icon">
				<svg width="21" height="21">
					<use xlink:href="#google-icon"></use>
				</svg>
			</span>
			<span class="social-login-name">
				@lang('cabinet.reg_via_google')
			</span>
		</a>
		<a href="{{ route('social-login', array('facebook')) }}" class="social-login-link">
			<span class="social-login-icon">
				<svg width="21" height="21">
					<use xlink:href="#fb-icon"></use>
				</svg>
			</span>
			<span class="social-login-name">
				@lang('cabinet.reg_via_facebook')
			</span>
		</a>
	</div>
	<div class="or-line">
		<span class="or-line-text">
			@lang('cabinet.or')
		</span>
	</div> --}}
	<form class="registration-form">
		<div class="input-wrap">
            <input class="input-form" type="email" name="email" placeholder="@lang('cabinet.email')*" required>
	    </div>
		<button type="submit" class="btn-green do_registration-form">
			@lang('cabinet.do_reg')
		</button>
		<div class="cabinet-bottom-block">
			<div class="cabinet-bottom-text">
				@lang('cabinet.is_account')
			</div>
			<a href="#login" class="cabinet-bottom-link popup-js">
				@lang('cabinet.log_in')
			</a>
		</div>
		<div class="auth-error" style="display:none">
			@lang('cabinet.exists')
		</div>
		<div class="auth-del" style="display:none">
			@lang('cabinet.deleted')
		</div>
	</form>
</div>

<div class="mfp-hide popup-wrap mini popup-cabinet" id="reset">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('cabinet.reseting_password')
		</div>
	</div>
	<form class="reset-form">
		<div class="input-wrap">
            <input class="input-form" type="email" name="email" placeholder="@lang('cabinet.email')*">
	    </div>
		<button type="submit" class="btn-green do_reset-form">
			@lang('cabinet.reset_password_btn')
		</button>
		<div class="cabinet-bottom-block">
			<a href="#login" class="cabinet-bottom-link popup-js">
				@lang('cabinet.back')
			</a>
		</div>
		<div class="auth-error" style="display:none">
			@lang('cabinet.no_email')
		</div>
		<div class="auth-restored" style="display:none">
			@lang('cabinet.pass_sent')
		</div>
	</form>
</div>


@if(isset($unit) && $unit->id == 4)

@else
	{{-- reviews --}}
	<div class="mfp-hide popup-wrap big" id="reviews">
		<div class="popup-name-wrap">
			<div class="popup-name">
				@lang('main.review.write_reviews')
			</div>
		</div>
		<form method="post" class="review_form" enctype="multipart/form-data">
			<div class="review-form-inner">
				<div class="review-input-wrap">
					<div class="input-wrap">
						<input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')" required>
					</div>
					<div class="input-wrap">
						<input class="input-form" type="email" name="email" placeholder="@lang('main.form.email')">
					</div>
				</div>
				<div class="review-textarea-wrap">
					<div class="input-wrap">
						<textarea class="input-form form-input-textarea" name="content" placeholder="@lang('main.review.input_review')" required></textarea>
					</div>
				</div>
			</div>
			<div class="input-file-wrap">
				<div class="input-file-inner">
					<div class="input-file-inner-wrap">
						<input class="form-control input-file" id="input-file-1" type="file" name="file" accept=".jpg,.jpeg,.png,.gif">
						<label class="label-input-file" for="input-file-1">
							<span class="label-svg">
								<svg width="24" height="24">
									<use xlink:href="#download"></use>
								</svg>
							</span>
							<span class="label-text">
								@lang('main.review.upload_photo')
							</span>
						</label>
						<div class="label-remove">
							<svg width="20" height="20">
								<use xlink:href="#label-remove"></use>
							</svg>
						</div>
					</div>
					<div class="input-file-inner-wrap">
						<input class="form-control input-file" id="input-file-2" type="file" name="file" accept=".jpg,.jpeg,.png,.gif">
						<label class="label-input-file" for="input-file-2">
							<span class="label-svg">
								<svg width="24" height="24">
									<use xlink:href="#download"></use>
								</svg>
							</span>
							<span class="label-text">
								@lang('main.review.upload_photo')
							</span>
						</label>
						<div class="label-remove">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 408.5 408.5"><path d="M87.7 388.8c0.5 11 9.5 19.7 20.5 19.7h191.9c11 0 20.1-8.7 20.5-19.7l13.7-289.3H74L87.7 388.8zM247.7 171.3c0-4.6 3.7-8.3 8.4-8.3h13.4c4.6 0 8.4 3.7 8.4 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3zM189.2 171.3c0-4.6 3.7-8.3 8.3-8.3h13.4c4.6 0 8.3 3.7 8.3 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3L189.2 171.3zM130.8 171.3c0-4.6 3.7-8.3 8.3-8.3h13.4c4.6 0 8.3 3.7 8.3 8.3v165.3c0 4.6-3.7 8.3-8.3 8.3h-13.4c-4.6 0-8.3-3.7-8.3-8.3V171.3z"></path><path d="M343.6 21h-88.5V4.3c0-2.4-1.9-4.3-4.3-4.3h-93c-2.4 0-4.3 1.9-4.3 4.3v16.7H64.9c-7.1 0-12.9 5.8-12.9 12.9V74.5h304.5V33.9C356.5 26.8 350.7 21 343.6 21z"></path></svg>
						</div>
					</div>
				</div>
				<div class="popup-img-info-text">
					@lang('main.review.upload_img')
				</div>
			</div>
			<div class="error-file-info">
				<div class="max-size">
					@lang('main.review.max_size')
				</div>
			</div>
			<input type="hidden" name="url" value="{{Request::path()}}">
			<input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
			<input type="hidden" name="title" value="@lang('main.review.write_reviews')">
			<input type="hidden" name="lang" value="{{App::getLocale()}}">
			<button type="submit" class="btn-green do_review_form">
				@lang('main.review.send')
			</button>
		</form>
		<div class='form-thanks'>@lang('main.review.thank_reviews')</div>
	</div>
@endif


<div class="mfp-hide popup-wrap mini" id="appointment_test">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.test')
		</div>
		<div class="popup-sub-name">
			@lang('main.test_subtitle')
		</div>
	</div>
	<form method="post" class="appointment_test">
        <div class="input-wrap">
            <input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.phone')*"  required>
        </div>
        <div class="input-wrap">
            <input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
        </div>
		<div class="input-wrap">
            <input class="input-form datepicker-after-js" type="text" name="date" placeholder="@lang('main.test_date')">
        </div>
        <input type="hidden" name="url" value="{{Request::path()}}">
        <input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
        <input type="hidden" name="title" value="@lang('main.test')">
        <input type="hidden" name="lang" value="{{App::getLocale()}}">
        <div class="popup-info-text">
            @lang('main.form.required_text')
        </div>
        <button type="submit" class="btn-green do_appointment_test">@lang('main.btn.sign_up')</button>
    </form>
   <div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>

<div class="mfp-hide popup-wrap mini" id="vaccination">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.flu_shots')
		</div>
	</div>
	<form method="post" class="vaccination_form">
        <div class="input-wrap">
            <input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.phone')*" required>
        </div>
        <div class="input-wrap">
            <input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
        </div>
		<div class="input-wrap">
            <input class="input-form" type="text" name="number" placeholder="@lang('main.count_people')">
        </div>
        <input type="hidden" name="url" value="{{Request::path()}}">
        <input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
        <input type="hidden" name="title" value="@lang('main.test')">
        <input type="hidden" name="lang" value="{{App::getLocale()}}">
        <div class="popup-info-text">
            @lang('main.form.required_text')
        </div>
        <button type="submit" class="btn-green do_vaccination_form">@lang('main.btn.sign_up')</button>
    </form>
   <div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>

{{-- landing popup --}}

<div class="mfp-hide popup-wrap mini" id="appointment-services">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.form.appointment')
		</div>
		<div class="popup-sub-name"></div>
	</div>
	<form method="post" class="appointment_services_form">
		@if(isset($directions) && $directions)
			@if(isset($directions_list) && $directions_list->count())
				<div class="input-wrap">
					<select class="selectric select-appointment-services" name="appointment_services_id">
						<option value="">@lang('main.form.choose_services')</option>
						@foreach ($directions_list as $direction_item)
							<option value="{{$direction_item->lang->name}}">{{$direction_item->lang->name}}</option>
						@endforeach
					</select>
				</div>
			@endif
		@endif
	    <div class="input-wrap">
            <input class="input-form" class="phone" type="tel" name="phone" placeholder="@lang('main.form.phone')*" required>
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
	    <input type="hidden" name="appointment_services_id" value="">
	    <input type="hidden" name="lang" value="{{App::getLocale()}}">
	    <div class="popup-info-text">
	        @lang('main.form.required_text')
	    </div>
	    <button type="submit" class="btn-green do_appointment_services">@lang('main.btn.sign_up')</button>
	</form>
	<div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>



<div class="mfp-hide popup-wrap big" id="question-services">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.form.question_services')
		</div>
	</div>
	<form method="post" class="question_services_form">
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
				@if(isset($directions) && $directions)
					@if(isset($directions_list) && $directions_list->count())
						<div class="input-wrap">
							<select class="selectric select-question-services" name="services_id">
								<option value="">@lang('main.form.choose_services')</option>
								@foreach ($directions_list as $direction_item)
									<option value="{{$direction_item->lang->name}}">{{$direction_item->lang->name}}</option>
								@endforeach
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
	    <input type="hidden" name="title" value="@lang('main.form.question_services')">
	    <input type="hidden" name="services_id" value="">
	    <input type="hidden" name="lang" value="{{App::getLocale()}}">
	    <button type="submit" class="btn-green do_question_services">@lang('main.review.send')</button>
	</form>
	<div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>


<div class="mfp-hide popup-wrap mini" id="personal_ranslator">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.form.personal_ranslator')
		</div>
	</div>
	<form method="post" class="personal_ranslator_form">
        <div class="input-wrap">
            <input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.phone')*"  required>
        </div>
        <div class="input-wrap">
            <input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')">
        </div>
        <input type="hidden" name="url" value="{{Request::path()}}">
        <input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
        <input type="hidden" name="title" value="@lang('main.form.personal_ranslator')">
        <input type="hidden" name="lang" value="{{App::getLocale()}}">
        <div class="popup-info-text">
            @lang('main.form.required_text')
        </div>
        <button type="submit" class="btn-green do_personal_ranslator">@lang('main.btn.order')</button>
    </form>
   <div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>

<div class="mfp-hide popup-wrap mini" id="landing-question">
	<div class="popup-name-wrap">
		<div class="popup-name">
			@lang('main.form.question_services')
		</div>
		<div class="popup-sub-name"></div>
	</div>
	<form method="post" class="landing_question_form">
        <div class="input-wrap">
            <input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.phone')*"  required>
        </div>
        <div class="input-wrap">
            <input class="input-form" type="text" name="name" placeholder="@lang('main.form.name')*" required>
        </div>
		<div class="input-wrap">
			<input class="input-form" type="email" name="email" placeholder="@lang('main.form.email')">
		</div>
		<div class="input-wrap">
			<textarea class="input-form form-input-textarea" name="content" placeholder="@lang('main.form.your_question')*" required></textarea>
		</div>
        <input type="hidden" name="url" value="{{Request::path()}}">
        <input type="hidden" name="url_name" value="{{isset($page_title) && $page_title != '' ? $page_title : '' }}">
		<input type="hidden" name="landing_question_id" value="">
        <input type="hidden" name="title" value="@lang('main.form.question_services')">
        <input type="hidden" name="lang" value="{{App::getLocale()}}">
        <div class="popup-info-text">
            @lang('main.form.required_text')
        </div>
        <button type="submit" class="btn-green do_landing_question">@lang('main.btn.send')</button>
    </form>
   <div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>
