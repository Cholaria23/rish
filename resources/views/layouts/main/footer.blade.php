<footer class="footer">
    {{-- logo --}}
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
    {{-- subscribe --}}
    @if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '' ||
        isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != ''
    )
        <ul>
            @if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '')
                <li>
                    <a href="{{app('contacts')['main']['contacts']['facebook']}}">
                        <span class="contacts__item-text">
                            @lang('main.facebook')
                        </span>
                    </a>
                </li>
            @endif
            @if(isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != '')
                <li>
                    <a href="{{app('contacts')['main']['contacts']['instagram']}}">
                        <span class="contacts__item-text">
                            @lang('main.instagram')
                        </span>
                    </a>
                </li>
            @endif
        </ul>
    @endif
    @lang('main.footer_copyright',['date'=>date('Y')])
</footer>
