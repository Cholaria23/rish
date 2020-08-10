@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
	@include('layouts.main.breadcrumbs')
	@if($unit->lang->h1 != '')
		<h1>
			{{$unit->lang->h1}}
		</h1>
	@else
		<h1>
			{{$unit->lang->name}}
		</h1>
	@endif

	@if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '' ||
		isset(app('contacts')['main']['contacts']['phone_2']) && app('contacts')['main']['contacts']['phone_2'] != '' ||
		isset(app('contacts')['main']['contacts']['phone_3']) && app('contacts')['main']['contacts']['phone_3'] != '' ||
		isset(app('contacts')['main']['contacts']['phone_4']) && app('contacts')['main']['contacts']['phone_4'] != '' ||
		isset(app('contacts')['main']['contacts']['phone_5']) && app('contacts')['main']['contacts']['phone_5'] != '' 

	)
		@if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '')
			<a class="contacts__phones_item mini-flex" href="tel:+{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1'] ) }}">
				{{app('contacts')['main']['contacts']['lang']['phone_1_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_1_name'] : app('contacts')['main']['contacts']['phone_1']}}
			</a>
		@endif
		@if(isset(app('contacts')['main']['contacts']['phone_2']) && app('contacts')['main']['contacts']['phone_2'] != '')
			<a class="contacts__phones_item mini-flex" href="tel:+{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_2'] ) }}">
				{{app('contacts')['main']['contacts']['lang']['phone_2_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_2_name'] : app('contacts')['main']['contacts']['phone_2']}}
			</a>
		@endif
		@if(isset(app('contacts')['main']['contacts']['phone_3']) && app('contacts')['main']['contacts']['phone_3'] != '')
			<a class="contacts__phones_item mini-flex" href="tel:+{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_3'] ) }}">
				{{app('contacts')['main']['contacts']['lang']['phone_3_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_3_name'] : app('contacts')['main']['contacts']['phone_3']}}
			</a>
		@endif
		@if(isset(app('contacts')['main']['contacts']['phone_4']) && app('contacts')['main']['contacts']['phone_4'] != '')
			<a class="contacts__phones_item mini-flex" href="tel:+{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_4'] ) }}">
				{{app('contacts')['main']['contacts']['lang']['phone_4_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_4_name'] : app('contacts')['main']['contacts']['phone_4']}}
			</a>
		@endif
		@if(isset(app('contacts')['main']['contacts']['phone_5']) && app('contacts')['main']['contacts']['phone_5'] != '')
			<a class="contacts__phones_item mini-flex" href="tel:+{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_5'] ) }}">
				{{app('contacts')['main']['contacts']['lang']['phone_5_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_5_name'] : app('contacts')['main']['contacts']['phone_5']}}
			</a>
		@endif
	@endif

	@if(isset(app('contacts')['main']['contacts']['lang']['address']) && app('contacts')['main']['contacts']['lang']['address'] != '')
		{!! app('contacts')['main']['contacts']['lang']['address'] !!}
	@endif

	@if(isset(app('contacts')['main']['contacts']['lang']['note_1']) && app('contacts')['main']['contacts']['lang']['note_1'] != '')
		{!! app('contacts')['main']['contacts']['lang']['note_1'] !!}
	@endif

	@if(isset(app('contacts')['main']['contacts']['email_1']) && app('contacts')['main']['contacts']['email_1'] != '' ||
		isset(app('contacts')['main']['contacts']['email_2']) && app('contacts')['main']['contacts']['email_2'] != ''
	)
		@if(isset(app('contacts')['main']['contacts']['email_1']) && app('contacts')['main']['contacts']['email_1'] != '')
			<a class="contacts__emails_item mini-flex" href="mailto:{{ app('contacts')['main']['contacts']['email_1'] }}">
				{{app('contacts')['main']['contacts']['lang']['email_1_name'] != '' ? app('contacts')['main']['contacts']['lang']['email_1_name'] : app('contacts')['main']['contacts']['email_1']}}
			</a>
		@endif
		@if(isset(app('contacts')['main']['contacts']['email_2']) && app('contacts')['main']['contacts']['email_2'] != '')
			<a class="contacts__emails_item mini-flex" href="mailto:{{ app('contacts')['main']['contacts']['email_2'] }}">
				{{app('contacts')['main']['contacts']['lang']['email_2_name'] != '' ? app('contacts')['main']['contacts']['lang']['email_2_name'] : app('contacts')['main']['contacts']['email_2']}}
			</a>
		@endif
	@endif

	@if(isset(app('contacts')['main']['contacts']['telegram']) && app('contacts')['main']['contacts']['telegram'] != '' ||
        isset(app('contacts')['main']['contacts']['viber']) && app('contacts')['main']['contacts']['viber'] != '' 
	)
		<ul>
			@if(isset(app('contacts')['main']['contacts']['telegram']) && app('contacts')['main']['contacts']['telegram'] != '')
				<li>
					<a href="{{app('contacts')['main']['contacts']['telegram']}}">
						<span class="contacts__item-text">
							@lang('main.telegram')
						</span>
					</a>
				</li>
			@endif
			@if(isset(app('contacts')['main']['contacts']['viber']) && app('contacts')['main']['contacts']['viber'] != '')
				<li>
					<a href="{{app('contacts')['main']['contacts']['viber']}}">
						<span class="contacts__item-text">
							@lang('main.viber')
						</span>
					</a>
				</li>
			@endif
		</ul>
	@endif
	@if(isset(app('contacts')['main']['contacts']['map_iframe']) && app('contacts')['main']['contacts']['map_iframe'] != '')
		{!!app('contacts')['main']['contacts']['map_iframe']!!}
	@endif
	

@stop
@section('scripts')
@stop