<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="{{ app()->getLocale() }}" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@lang('main.order_package_title')</title>
        <style>
            p {
                margin: 0;
                padding: 0;
            }
        </style>
    </head>
    <body>
        <div style="width: 600px; padding: 15px; background: transparent; padding-left: 0px !important; padding-right: 0px !important; font-family: Arial, sans-serif;">
            <table align="left" cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0; background: #ffffff; padding: 10px;">
                <tbody>
                    <tr>
                        <td style="border: 0;" align="left" valign="top" border="0">
                            <div style="border-width: 0px; border-style: solid; border-radius: 0px; border-color: #ffffff;">
                                <div class="email_header">
                                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0;">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="bottom" border="0" style="vertical-align: middle;">
                                                    <div style="text-align: left; margin-bottom: 45px; padding: 15px 0; background: #ffffff;">
                                                        <a href="{{ URL::to('/') }}" style="display:inline-block;">
                                                            @if (isset(app('seo')['logo_img_1']) && app('seo')['logo_img_1'] != '')
                                                                <img style="border: 0; display: block; margin: 0 auto 0 0; width: 150px; height: auto; text-align: left;" src="{{ asset('storage/'.app('seo')['logo_img_1']) }}">
                                                            @endif
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="body-mail">
                                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; margin: 0;">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" border="0">
                                                    <div style="margin-bottom: 20px;text-align: left; font-size:14px; font-family: Arial, sans-serif;">
                                                        <div style="padding-bottom:10px;">
                                                            <p style="margin: 0; padding-bottom: 15px; text-align: left; font-size: 14px; color: #343434; font-weight: bold; border-bottom: 1px solid #f2f2f2;">
                                                                @lang('main.email.your_data'):
                                                            </p>
                                                            @if (isset($name) && $name != '')
                                                                <p style="display: flex; align-items: center; justify-content: space-between;font-size: 14px; margin: 0; padding: 10px 0; color: #343434; font-weight: 400; border-bottom: 1px solid #f2f2f2;">
                                                                    <span style="width: 50%; text-align: left; font-size: 14px; color: #343434;">
                                                                        @Lang('main.form.name'):
                                                                    </span>
                                                                    <span style="width: 50%; text-align: right; font-size: 14px; color: #343434;">
                                                                        {{ $name }}
                                                                    </span>
                                                                </p>
                                                            @endif
                                                            @if (isset($phone) && $phone != '')
                                                                <p style="display: flex; align-items: center; justify-content: space-between;font-size: 14px; margin: 0; padding: 10px 0; color: #343434; font-weight: 400; border-bottom: 1px solid #f2f2f2;">
                                                                    <span style="width: 50%; text-align: left; font-size: 14px; color: #343434;">
                                                                        @Lang('main.form.phone'):
                                                                    </span>
                                                                    <span style="width: 50%; color:#343434; text-decoration:none; text-align: right;">
                                                                        {{ $phone }}
                                                                    </span>
                                                                </p>
                                                            @endif
                                                            @if (isset($email) && $email != '')
                                                                <p style="display: flex; align-items: center; justify-content: space-between;font-size: 14px; margin: 0; padding: 10px 0; color: #343434; font-weight: 400; border-bottom: 1px solid #f2f2f2;">
                                                                    <span style="width: 50%; text-align: left; font-size: 14px; color: #343434;">
                                                                        @Lang('main.form.email'):
                                                                    </span>
                                                                    <span style="width: 50%; text-align: right; font-size: 14px; color: #343434;">
                                                                        {{ $email }}
                                                                    </span>
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="email_footer">
                                    <table style="width: 100%; margin: 0; background-color: #ffffff;" cellpadding="0" cellspacing="0" border="0">
                                        <tbody>
                                            <tr>
                                                <td align="left" valign="top" border="0">
                                                    <div style="text-align: left; color: #343434; font-weight: 400; font-size:14px; font-family: Arial, sans-serif;">
                                                        <p style="margin: 0 0 15px 0; text-align: left; font-size: 14px; color: #343434;">
                                                            @lang('main.email.with_respect')
                                                            @if(isset($form_type->lang_sender[App::getLocale()]) && $form_type->lang_sender[App::getLocale()] !='')
                                                                {{$form_type->lang_sender[App::getLocale()]}}
                                                            @else
                                                                RISHON
                                                            @endif
                                                        </p>
                                                        @if(isset(app('contacts')['main']['contacts']['phone_1']) && app('contacts')['main']['contacts']['phone_1'] != '')
                                                            <p style="margin: 0 0 5px 0; text-align: left; font-size: 14px; color: #343434;">
                                                                @lang('main.email.phone')
                                                               <a href="tel:{{ substr(preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1']),0,1) == '0' ? '' : '+' }}{{ preg_replace( '/[^0-9]/', '', app('contacts')['main']['contacts']['phone_1'] ) }}" style="font-size: 14px; color: #343434; text-decoration: none;">
                                                                   {{app('contacts')['main']['contacts']['phone_1']}}
                                                               </a>
                                                            </p>
                                                        @endif
                                                        @if(isset(app('contacts')['main']['contacts']['email_1']) && app('contacts')['main']['contacts']['email_1'] != '')
                                                            <p style="margin: 0 0 5px 0; text-align: left; font-size: 14px; color: #343434;">
                                                                e-mail:
                                                                <a href="mailto:{{app('contacts')['main']['contacts']['email_1']}}" style="font-size: 14px; color: #343434; text-decoration: none;">
                                                                    {{app('contacts')['main']['contacts']['email_1']}}
                                                                </a>
                                                            </p>
                                                        @endif
                                                        @if(isset(app('contacts')['main']['contacts']['lang']['address']) && app('contacts')['main']['contacts']['lang']['address'] != '')
                                                            <div style="margin: 0 0 5px 0; text-align: left; font-size: 14px; color: #343434;">
                                                                {!!app('contacts')['main']['contacts']['lang']['address']!!}
                                                            </div>
                                                        @endif
                                                        <a href="{{ URL::to('/') }}" style="display: inline-block; margin-bottom: 20px; color: #3c615d; font-size: 14px;">
                                                            {{env('APP_NAME', 'Laravel')}}
                                                        </a>
                                                        <p style="margin: 0 0 20px 0;">
                                                            @if(isset(app('contacts')['main']['contacts']['facebook']) && app('contacts')['main']['contacts']['facebook'] != '')
                                                                <a href="{{app('contacts')['main']['contacts']['facebook']}}" target="_blank" style="display: inline-block; margin: 0 20px 0 0;">
                                                                    <img style="border: 0; display: block; width: 24px; height: auto;" alt="facebook" title="facebook" src="{{ asset('img/email_facebook.png') }}" align="center">
                                                                </a>
                                                            @endif
                                                            @if(isset(app('contacts')['main']['contacts']['instagram']) && app('contacts')['main']['contacts']['instagram'] != '')
                                                                <a href="{{app('contacts')['main']['contacts']['instagram']}}" target="_blank" style="display: inline-block; margin: 0 20px 0 0;">
                                                                    <img style="border: 0; display: block; width: 24px; height: auto;" alt="instagram" title="instagram" src="{{ asset('img/email_instagram.png') }}" align="center">
                                                                </a>
                                                            @endif
                                                            @if(isset(app('contacts')['main']['contacts']['youtube']) && app('contacts')['main']['contacts']['youtube'] != '')
                                                                <a href="{{app('contacts')['main']['contacts']['youtube']}}" target="_blank" style="display: inline-block;">
                                                                    <img style="border: 0; display: block; width: 24px; height: auto;" alt="youtube" title="youtube" src="{{ asset('img/email_youtube.png') }}" align="center">
                                                                </a>
                                                            @endif
                                                        </p>
                                                        <p style="color: #343434; font-size: 11px; font-style: italic;">
                                                            @lang('main.email.letter_auto')
                                                            <a href="{{ URL::to('/') }}" style="color: #343434; font-size: 11px; text-decoration: underline; font-style: italic;">
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
