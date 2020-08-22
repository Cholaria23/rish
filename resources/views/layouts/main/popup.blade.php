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
	    <input type="hidden" name="title" value="@lang('main.btn.question_specialist')">
	    <input type="hidden" name="appointment" value="">
	    <input type="hidden" name="lang" value="{{App::getLocale()}}">
	    <button type="submit" class="btn-green do_question_form">@lang('main.review.send')</button>
	</form>
	<div class='form-thanks'>@lang('main.form.form_thanks')</div>
</div>




<div class="mfp-hide popup-wrap mini" id="test-modal">

	<div class="popup-close-js">Dismiss</div>
</div>
