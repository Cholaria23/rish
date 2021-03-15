@if(Auth::guard('web')->check())
    <div class="cabinet icons-item login-hover js_mobile_cabinet">
        <div class="header-log">
            <a class="header-log-link" href="/cabinet">
                <span class="header-log-icon">
                    <svg width="15" height="15">
    					<use xlink:href="#cabinet-icon"></use>
    				</svg>
                </span>
                <span class="header-log-text">
                    @lang('cabinet.page_title')
                </span>
            </a>
        </div>

        <div class="cabinet-menu-cover desctop-cabinet">
            <ul class="cabinet-menu">
                <li class='cabinet-li' >
                    <a class='cabinet-link' data href='/cabinet#personal_data'>
                        @lang('cabinet.tab_menu.personal_data')
                    </a>
                </li>
                <li class='cabinet-li'>
                    <a class='cabinet-link' href='/cabinet#wish_lists'>
                        @lang('cabinet.wish_lists.wish_list')
                    </a>
                </li>
                <li class="cabinet-li">
                    <a href="#" class="cabinet-link a-logout">@lang('cabinet.logout')</a>
                </li>
            </ul>
        </div>
  </div>
@else
    <div class="header-log">
        <a class="popup-js header-log-link" href="#login">
            <span class="header-log-icon">
                <svg width="15" height="15">
					<use xlink:href="#cabinet-icon"></use>
				</svg>
            </span>
            <span class="header-log-text">
                @lang('cabinet.personal_area')
            </span>
        </a>
    </div>
@endif
