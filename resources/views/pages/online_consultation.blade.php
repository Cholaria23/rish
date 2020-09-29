@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	<div class="page">
		<section class="page-section section-with-breadcrumbs">
            <div class="container">
				@include('layouts.main.breadcrumbs')
				@if($unit->lang->h1 != '')
					<h1 class="page-section-top-title">
						{{$unit->lang->h1}}
					</h1>
				@else
					<h1 class="page-section-top-title">
						{{$unit->lang->name}}
					</h1>
				@endif
			</div>
        </section>
		@if($unit->lang->long_desc_1 != '')
			<section class="main-section">
				<div class="container-small">
					<div class="description">
						{!!$unit->lang->long_desc_1!!}
					</div>
				</div>
			</section>
		@endif
		<section class="main-section">
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
		</section>
		@if($unit->lang->long_desc_2 != '')
			<section class="main-section">
				<div class="container-small">
					<div class="description">
						{!!$unit->lang->long_desc_2!!}
					</div>
				</div>
			</section>
		@endif
	</div>
@stop
@section('scripts')
	{{-- <script src="js/datepicker.min.js"></script>
	<script>
		$(document).ready(function(){

		     if ($('html').attr('lang')=='en') {

		        $.fn.datepicker.language['en'] =  {
		            days: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ,'Saturday'],
		            daysShort: [ 'Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'],
		            daysMin: [ 'Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
		            months: [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ],
		            monthsShort: [ 'Jan.', 'Feb.', 'Mar.', 'Apr.', 'May', 'Jun.', 'Jul.', 'Aug.', 'Sep.', 'Oct.', 'Nov.', 'Dec.' ],
		            today: 'Today',
		            clear: 'Clear',
		            dateFormat: 'dd.mm.yyyy',
		            timeFormat: 'hh:ii',
		            firstDay: 7
		        };

		        $('.datepicker-before-js').datepicker({
		            language: 'en',
		            maxDate: new Date()
		        });

		        $('.datepicker-after-js').datepicker({
		            language: 'en',
		            minDate: new Date()
		        });

		    } else if ($('html').attr('lang')=='uk'){
		        $.fn.datepicker.language['uk'] =  {
		            days: [ 'Неділя', 'понеділок', 'вівторок', 'середа', 'четвер', 'п\'ятницю' ,' суботу '],
		            daysShort: [ 'Вос', 'Пон', 'Вів', 'Сре', 'Чет', 'П\'ят', 'Суб'],
		            daysMin: [ 'Нд', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
		            months: [ 'Січень', 'Лютий', 'Березень', 'Квітень', 'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень', 'Жовтень', 'Листопад', 'Грудень' ],
		            monthsShort: [ 'січень', 'лютий', 'березнь', 'квітень', 'травень', 'червень', 'липень', 'серпень', 'вересень', 'жовтень', 'листопад', 'грудень' ],
		            today: 'Сегодня',
		            clear: 'Очистить',
		            dateFormat: 'dd.mm.yyyy',
		            timeFormat: 'hh:ii',
		            firstDay: 1
		        };

		        $('.datepicker-before-js').datepicker({
		            language: 'uk',
		            maxDate: new Date()
		        });

		        $('.datepicker-after-js').datepicker({
		            language: 'uk',
		            minDate: new Date()
		        });

		    } else {
		        $('.datepicker-before-js').datepicker({
		            maxDate: new Date()
		        });

		        $('.datepicker-after-js').datepicker({
		            minDate: new Date()
		        });
		    }

		});
	</script> --}}
@stop
