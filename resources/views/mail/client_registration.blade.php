<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@lang('main.request_new_post')</title>
        <style>
            p {
                margin: 0;
                padding: 0;
            }
        </style>
    </head>
    <body>
        <div style="width: 600px;padding: 15px; background: transparent; padding-left: 0px !important; padding-right: 0px !important; font-family: Arial, sans-serif;">
            <table align="left" cellpadding="0" cellspacing="0" border="0" style="margin: 0; background: #ffffff; padding: 10px; width: 100%">
                <tbody>
                    <tr>
                        <td style="border: 0;" width="100%" align="left" valign="top" border="0">
                            <div style="border-width: 0px; border-style: solid; border-radius: 0px; border-color: #ffffff;">
                                <div class="email_header">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 0;">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="bottom" width="100%" border="0" style="vertical-align: middle;">
                                                    <div style="text-align: center; margin-bottom: 45px; padding: 20px 0; background: #fff;">
                                                        <a href="{{ URL::to('/') }}">
                                                            @if (isset(app('seo')['logo_img_1']) && app('seo')['logo_img_1'] != '')
                                                                <img style="border: 0; display: block; margin: 0 auto 0 0; width: 200px; " src="{{ asset('storage/'.app('seo')['logo_img_1']) }}" align="center">
                                                            @endif
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="body-mail">
                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 0;">
                                        <tbody>
                                            <tr>
                                                <td style="border: 0; width: 1%">
                                                    <div style="line-height:0; border: 0; display: block; margin: 0 auto;"><img style="border: 0; display: block; margin: 0 auto; max-width: 100%; height: auto;" src="{{ URL::to('/img/padding.png') }}" alt=""></div>
                                                </td>
                                                <td align="left" valign="top" width="98%" border="0">
                                                    <div style="text-align: left; color: #7b7b7b; font-weight: 400; font-size:18px; font-family: Arial,'Helvetica CY','Nimbus Sans L',sans-serif;">
                                                        <p style="margin: 0 0 10px; color: #7b7b7b; font-weight:bold; font-size: 20px; text-align:center;">@lang('main.email.reg_success') <a href="{{ URL::to('/') }}/" style="color: #244690; text-decoration:none; display:block;">{{env('APP_NAME', 'Laravel')}}</</p>
                                                        <p style="font-size: 16px; margin: 0 0 5px;"><span style="color:#7b7b7b;">@lang('main.email.pass')</span><span style="color:  #2b2b2b;">{{ $password }}</span></p>
                                                        <p style="font-size: 16px; margin: 0 0 5px; color:#7b7b7b;">@lang('main.email.change_pass_cab')</p>
                                                        <p style="font-size: 16px; margin: 5px 0;"><a style="color: #1e4d84" href="{{URL::to('/cabinet')}}">@lang('main.email.link_cabinet')</a></p>
                                                    </div>
                                                </td>
                                                <td style="border: 0; width: 1% color :#ff0000;">
                                                    <div style="line-height:0; border: 0; color :#ff0000;display: block; margin: 0 auto;"><img style="border: 0; display: block; margin: 0 auto; max-width: 100%; height: auto;" src="{{ URL::to('/img/padding.png') }}" alt=""></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="email_footer">
                                    <table style="margin: 0; background-color: #ffffff;" width="100%" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" width="100%" border="0">
                                                    <div style="text-align: left; color: #333333; font-weight: 400; font-size:14px; font-family: Arial, sans-serif;">
                                                        <p style="margin: 0 0 15px 0; text-align: left; font-size: 14px; color: #333;">
                                                            @lang('main.email.with_respect')
                                                        </p>
                                                        @if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '')
                                                            <p style="margin: 0 0 5px 0; text-align: left; font-size: 14px; color: #333333;">
                                                                @lang('main.form.phone')
                                                               <a href="tel:+{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1'] ) }}" style="font-size: 14px; color: #333333; text-decoration: none;">
                                                                   {{app('contacts')['main']['contacts']['phone_1']}}
                                                               </a>
                                                            </p>
                                                        @endif
                                                        @if(isset(app('contacts')['main']['contacts']['email_1']) && app('contacts')['main']['contacts']['email_1'] != '')
                                                            <p style="margin: 0 0 5px 0; text-align: left; font-size: 14px; color: #333333;">
                                                                @lang('main.form.email')
                                                                <a href="mailto:{{app('contacts')['main']['contacts']['email_1']}}" style="font-size: 14px; color: #333333; text-decoration: none;">
                                                                    {{app('contacts')['main']['contacts']['email_1']}}
                                                                </a>
                                                            </p>
                                                        @endif
                                                        @if(isset(app('contacts')['main']['contacts']['lang']['address']) && app('contacts')['main']['contacts']['lang']['address'] != '')
                                                            <div style="margin: 0 0 5px 0; text-align: left; font-size: 14px; color: #333333;">
                                                                {!!app('contacts')['main']['contacts']['lang']['address']!!}
                                                            </div>
                                                        @endif
                                                        <a href="{{ URL::to('/') }}" style="display: inline-block; margin-bottom: 20px; color: #006daf; font-size: 14px;">
                                                            {{ URL::to('/') }}
                                                        </a>
                                                        <p style="margin: 0 0 20px 0;">
                                                            @if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '')
                                                                <a href="{{app('contacts')['main']['contacts']['facebook']}}" target="_blank" style="display: inline-block; margin: 0 20px 0 0;">
                                                                    <img style="border: 0; display: block; width: 24px; height: auto;" alt="facebook" title="facebook" src="{{ URL::to('/img/email_facebook.png') }}" align="center">
                                                                </a>
                                                            @endif
                                                            @if(isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != '')
                                                                <a href="{{app('contacts')['main']['contacts']['instagram']}}" target="_blank" style="display: inline-block; margin: 0 20px 0 0;">
                                                                    <img style="border: 0; display: block; width: 24px; height: auto;" alt="instagram" title="instagram" src="{{ URL::to('/img/email_instagram.png') }}" align="center">
                                                                </a>
                                                            @endif
                                                            @if(isset(app('contacts')['main']['contacts']['youtube']) && app('contacts')['main']['contacts']['youtube'] != '')
                                                                <a href="{{app('contacts')['main']['contacts']['youtube']}}" target="_blank" style="display: inline-block;">
                                                                    <img style="border: 0; display: block; width: 24px; height: auto;" alt="youtube" title="youtube" src="{{ URL::to('/img/email_youtube.png') }}" align="center">
                                                                </a>
                                                            @endif
                                                        </p>
                                                        <p style="color: #333333; font-size: 11px; font-style: italic;">
                                                            @lang('main.email.letter_auto')
                                                            <a href="{{ URL::to('/') }}" style="color: #333333; font-size: 11px; text-decoration: underline; font-style: italic;">
                                                                @lang('main.email.support')
                                                            </a>
                                                        </p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
    </body>
</html>
