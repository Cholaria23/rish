@if(Auth::guard('web')->check())
    <div class="cabinet icons-item login-hover js_mobile_cabinet">
        <a href="/cabinet" class="login-icon svg-icon">
            <svg width="23" height="25">
            <use xlink:href="#icon-user"></use>
            </svg>
            <span class="burger-menu-link">@lang('cabinet.page_title')</span>
        </a>
        <div class="cabinet-menu-cover desctop-cabinet">
            <ul class="cabinet-menu">
                {{-- <li class="catalog-li">
                    <a href="/cabinet" class="catalog-link">@lang('main.login.cabinet')</a>
                </li> --}}
                <li class='cabinet-li' >
                    <a class='cabinet-link' data href='/cabinet#personal_data'>
                        @lang('cabinet.tab_menu.personal_data')
                    </a>
                </li>
                {{-- <li class='cabinet-li'>
                    <a class='cabinet-link' href='/cabinet#subscribe'>
                        @lang('main.login.subscription')
                    </a>
                </li> --}}
                {{-- <li class='cabinet-li'>
                    <a class='cabinet-link' href='/cabinet#viewed_goods'>
                        @lang('main.login.viewed_two')
                    </a>
                </li> --}}
                <li class='cabinet-li'>
                    <a class='cabinet-link' href='/cabinet#wish_lists'>
                        @lang('cabinet.wish_lists.wish_list')
                    </a>
                </li>
                <li class='cabinet-li'>
                    <a class='cabinet-link' href='/cabinet#orders'>
                        @lang('cabinet.tab_menu.my_orders')
                    </a>
                </li>
                {{-- <li class='cabinet-li'>
                    <a class='cabinet-link' href='/cabinet#password'>
                        @lang('cabinet.tab_menu.reset_password')
                    </a>
                </li> --}}
                <li class="cabinet-li">
                    <a href="#" class="cabinet-link a-logout">@lang('cabinet.logout')</a>
                </li>
            </ul>
        </div>
  </div>
  {{-- <a href="/cabinet" class="header-login-btn">
  </a> --}}
  {{-- <a href="#" class="header-login-btn a-logout svg-text">@lang('main.exit')</a> --}}
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
