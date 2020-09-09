<footer class="footer">
    <div class="container-small">
        <div class="footer-wrap">
            <div class="footer-contacts">
                @if(isset($unit) && $unit->alias == "main")
                    @if (isset(app('seo')['logo_svg_1']) && app('seo')['logo_svg_1'] != '')
                        <div class="footer-logo">
                            {!! app('seo')['logo_svg_1'] !!}
                        </div>
                    @endif
                @else
                    @if (isset(app('seo')['logo_svg_1']) && app('seo')['logo_svg_1'] != '')
                        <a href="/" class="footer-logo">
                            {!! app('seo')['logo_svg_1'] !!}
                        </a>
                    @endif
                @endif
                <div class="footer-contacts-wrap">
                    @if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '')
                        <a class="footer-contacts-phone" href="tel:+{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1'] ) }}">
                            {{app('contacts')['main']['contacts']['lang']['phone_1_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_1_name'] : app('contacts')['main']['contacts']['phone_1']}}
                        </a>
                    @endif
                    @if(isset(app('contacts')['main']['contacts']['phone_2']) && app('contacts')['main']['contacts']['phone_2'] != '')
                        <a class="footer-contacts-phone" href="tel:+{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_2'] ) }}">
                            {{app('contacts')['main']['contacts']['lang']['phone_2_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_2_name'] : app('contacts')['main']['contacts']['phone_2']}}
                        </a>
                    @endif
                    @if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '' ||
                    isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != '' || isset(app('contacts')['main']['contacts']['youtube']) && app('contacts')['main']['contacts']['youtube'] != ''
                    )
                        <ul class="social-list">
                            @if(isset(app('contacts')['main']['contacts']['youtube']) && app('contacts')['main']['contacts']['youtube'] != '')
                                <li class="social-item">
                                    <a class="social-link" href="{{app('contacts')['main']['contacts']['youtube']}}" target="_blank" rel="noreferrer">
                                        <span class="social-icon">
                                            <svg width="35" height="35">
                                                <use xlink:href="#icon-You-tube"></use>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                            @endif
                            @if(isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != '')
                                <li class="social-item">
                                    <a class="social-link" href="{{app('contacts')['main']['contacts']['instagram']}}" target="_blank" rel="noreferrer">
                                        <span class="social-icon">
                                            <svg width="35" height="35">
                                                <use xlink:href="#icon-Instagram"></use>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                            @endif
                            @if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '')
                                <li class="social-item">
                                    <a class="social-link" href="{{app('contacts')['main']['contacts']['facebook']}}" target="_blank" rel="noreferrer">
                                        <span class="social-icon">
                                            <svg width="35" height="35">
                                                <use xlink:href="#icon-Facebook"></use>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
            <div class="footer-subscription">
                <div class="footer-subscription-text">
                    @lang('main.subscription_text')
                </div>
                <form class="new-post-form">
                    <div class="input-wrap">
                        <input class="input-form" type="text" name="email" placeholder="e-mail" required="">
                    </div>
                    <input type="hidden" name="lang" value="{{App::getLocale()}}">
                    <button type="submit" class="do-new-post-form">
                        <svg width="17" height="15">
                            <use xlink:href="#right-arrow-white"></use>
                        </svg>
                    </button>
                </form>
                <div class="form-thanks">
                    @lang('main.form.form_thanks_subscription')
                </div>
                <div class="footer-copyright">
                    @lang('main.footer_copyright',['date'=>date('Y')])
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="overlay"></div>
