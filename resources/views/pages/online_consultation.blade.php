@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page">
		@include('layouts.main.breadcrumbs')
	</div>
	@if($unit->lang->h1 != '')
		<div class="container">
			<div class="page-section-top-title">
				{{$unit->lang->h1}}
			</div>
		</div>
	@else
		<div class="container">
			<div class="page-section-top-title">
				{{$unit->lang->name}}
			</div>
		</div>
	@endif
	@if($unit->lang->long_desc_1 != '')
		<div class="main-section">
			<div class="container-small">
				<div class="description">
					{!!$unit->lang->long_desc_1!!}
				</div>
			</div>
		</div>
	@endif

	<div class="main-section">
		<div class="online-consultation-wrap">
			<form method="post" class="online-consultation-form">
				<div class="input-wrap">
		            <input class="input-form" type="text" name="name" placeholder="@lang('main.fio')">
		        </div>
				<div class="input-name">
					@lang('main.year_birth')
				</div>
				<div class="input-wrap">
		            <input class="input-form datepicker-before-js" type="text" name="date_birth" placeholder="@lang('main.data')">
		        </div>
				<div class="input-wrap">
					<input class="input-form" type="tel" name="phone" placeholder="@lang('main.form.phone')*" required>
				</div>
				<div class="input-name">
					@lang('main.data_text')
				</div>
				<div class="input-wrap">
		            <input class="input-form datepicker-after-js" type="text" name="date" placeholder="@lang('main.data')">
		        </div>
				<div class="input-name">
					@lang('main.consultation_platform')
				</div>
				<div class="input-wrap">
					<input class="input-form" type="text" name="messenger" placeholder="@lang('main.messenger')*" required>
				</div>
		        <input type="hidden" name="lang" value="{{App::getLocale()}}">
		        <div class="popup-info-text">
		            @lang('main.form.required_text')
		        </div>
		        <button type="submit" class="btn-green do-online-consultation">@lang('main.btn.sign_up')</button>
		    </form>
		   <div class='form-thanks'>@lang('main.form.form_thanks')</div>
		</div>
	</div>

	@if($unit->lang->long_desc_2 != '')
		<div class="main-section">
			<div class="container-small">
				<div class="description">
					{!!$unit->lang->long_desc_2!!}
				</div>
			</div>
		</div>
	@endif

@stop
@section('scripts')
@stop
