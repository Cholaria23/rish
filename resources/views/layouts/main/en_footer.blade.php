<footer class="footer footer-landing">
    <div class="container">
        <div class="footer-wrap">
            <div class="footer-item">
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
            </div>
            <div class="footer-item">
                @if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '' ||
                isset(app('contacts')['main']['contacts']['phone_2']) && app('contacts')['main']['contacts']['phone_2'] != '' ||
                isset(app('contacts')['main']['contacts']['phone_3']) && app('contacts')['main']['contacts']['phone_3'] != '' ||
                isset(app('contacts')['main']['contacts']['phone_4']) && app('contacts')['main']['contacts']['phone_4'] != '' ||
                isset(app('contacts')['main']['contacts']['phone_5']) && app('contacts')['main']['contacts']['phone_5'] != ''
                )
                    <div class="footer-contact-wrap">
                        @if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '')
                            <a class="footer-contacts-phone binct-phone-number-1" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1'] ) }}">
                                {{app('contacts')['main']['contacts']['lang']['phone_1_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_1_name'] : app('contacts')['main']['contacts']['phone_1']}}
                            </a>
                        @endif
                        @if(isset(app('contacts')['main']['contacts']['phone_2']) && app('contacts')['main']['contacts']['phone_2'] != '')
                            <a class="footer-contacts-phone binct-phone-number-2" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_2']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_2'] ) }}">
                                {{app('contacts')['main']['contacts']['lang']['phone_2_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_2_name'] : app('contacts')['main']['contacts']['phone_2']}}
                            </a>
                        @endif
                        @if(isset(app('contacts')['main']['contacts']['phone_3']) && app('contacts')['main']['contacts']['phone_3'] != '')
                            <a class="footer-contacts-phone binct-phone-number-3" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_3']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_3'] ) }}">
                                {{app('contacts')['main']['contacts']['lang']['phone_3_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_3_name'] : app('contacts')['main']['contacts']['phone_3']}}
                            </a>
                        @endif
                        @if(isset(app('contacts')['main']['contacts']['phone_4']) && app('contacts')['main']['contacts']['phone_4'] != '')
                            <a class="footer-contacts-phone binct-phone-number-4" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_4']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_4'] ) }}">
                                {{app('contacts')['main']['contacts']['lang']['phone_4_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_4_name'] : app('contacts')['main']['contacts']['phone_4']}}
                            </a>
                        @endif
                        @if(isset(app('contacts')['main']['contacts']['phone_5']) && app('contacts')['main']['contacts']['phone_5'] != '')
                            <a class="footer-contacts-phone binct-phone-number-5" href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_5']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_5'] ) }}">
                                {{app('contacts')['main']['contacts']['lang']['phone_5_name'] != '' ? app('contacts')['main']['contacts']['lang']['phone_5_name'] : app('contacts')['main']['contacts']['phone_5']}}
                            </a>
                        @endif
                    </div>
                @endif
                @if(isset(app('contacts')['main']['contacts']['email_1']) && app('contacts')['main']['contacts']['email_1'] != '' ||
                    isset(app('contacts')['main']['contacts']['email_2']) && app('contacts')['main']['contacts']['email_2'] != ''
                    )
                    @if(isset(app('contacts')['main']['contacts']['email_1']) && app('contacts')['main']['contacts']['email_1'] != '')
                        <a class="footer-contact-link" href="mailto:{{ app('contacts')['main']['contacts']['email_1'] }}">
                            {{app('contacts')['main']['contacts']['lang']['email_1_name'] != '' ? app('contacts')['main']['contacts']['lang']['email_1_name'] : app('contacts')['main']['contacts']['email_1']}}
                        </a>
                    @endif
                    @if(isset(app('contacts')['main']['contacts']['email_2']) && app('contacts')['main']['contacts']['email_2'] != '')
                        <a class="footer-contact-link" href="mailto:{{ app('contacts')['main']['contacts']['email_2'] }}">
                            {{app('contacts')['main']['contacts']['lang']['email_2_name'] != '' ? app('contacts')['main']['contacts']['lang']['email_2_name'] : app('contacts')['main']['contacts']['email_2']}}
                        </a>
                    @endif
                @endif
            </div>
            <div class="footer-item">
                @if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '' ||
                isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != ''
                )
                    <div class="footer_social_text">
                        @lang('main.landing.footer_social_text'):
                    </div>
                    <ul class="social-list">
                        @if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '')
                            <li class="social-item">
                                <div class="social-item-icon">
                                    <svg width="16" height="16">
                                        <use xlink:href="#icon-Facebook"></use>
                                    </svg>
                                </div>
                                <a class="social-link" href="{{app('contacts')['main']['contacts']['facebook']}}" target="_blank" rel="noopener noreferrer nofollow">
                                    {{substr(app('contacts')['main']['contacts']['facebook'], 12)}}
                                </a>
                            </li>
                        @endif
                        @if(isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != '')
                            <li class="social-item">
                                <div class="social-item-icon">
                                    <svg width="16" height="16">
                                        <use xlink:href="#icon-Instagram"></use>
                                    </svg>
                                </div>
                                <a class="social-link" href="{{app('contacts')['main']['contacts']['instagram']}}" target="_blank" rel="noopener noreferrer nofollow">
                                    {{substr(app('contacts')['main']['contacts']['instagram'], 12)}}
                                </a>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    </div>
</footer>

<div class="overlay"></div>
