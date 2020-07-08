<header class="header">
	@if (app('params')->is_cookie == 1)
		<?php $is_cookie_shown = session()->get('cookie_shown', FALSE); ?>
		@if (!$is_cookie_shown)
			<div class="about_cookie_outer">
				@lang('main.cookie_info')
				<a href="about_cookie">@lang('main.more')</a>
				<a href="#" class="close_cookie" onclick="closeCookie(); return false;">&times;</a>
			</div>
		@endif
	@endif
</header>