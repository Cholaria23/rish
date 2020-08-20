<div class='top_navigate'>
	<div class="container">
		<ol class='breadcrumbs' itemscope itemtype="http://schema.org/BreadcrumbList">
			<li  class="crumb-li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a itemprop="item" class="crumb" href='{{ URL::to("/") }}'>
					<span itemprop="name">@lang('main.main_page')</span>
				</a>
				<meta itemprop="position" content="1" />
			</li>
			@php
			$i = 1;
			@endphp
			@if (isset($breadcrumbs) && !empty($breadcrumbs) )
				@foreach ($breadcrumbs as $crumb)
					<?php if(isset($i)){ $i++; }?>
					@if(is_array($crumb))
						<li  class="crumb-li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
							<a itemprop="item" class="crumb" href="{{  $crumb['alias'] }}">
								<span itemprop="name">{{ $crumb['name'] }}</span>
							</a>
							<meta itemprop="position" content={{$i}} />
						</li>
					@else
						<li  class="crumb-li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
							<a itemprop="item" class="crumb" href="{{ $crumb->alias }}">
								<span itemprop="name">{{ $crumb->lang->name }}</span>
							</a>
							<meta itemprop="position" content={{$i}} />
						</li>
					@endif
				@endforeach
			@endif
			@if ($page_title != '')
				<li  class="crumb-li" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
					<a itemprop="item" class="crumb js-lastcrumb" href="{{ URL::to(Request::path()) }}">
						<span itemprop="name">{!! $page_title !!}</span>
					</a>
					<meta itemprop="position" content={{$i+1}} />
				</li>
			@endif
		</ol>
	</div>
</div>
