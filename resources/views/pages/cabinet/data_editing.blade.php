<div class="tab-pane-item password-block">
    <h2 class="title-tab-cabinet blue-title mobile-title">@lang('cabinet.tab_menu.reset_password')</h2>
    <form id="change_password_form" class="form-password">
        <div class='modal-row-p'>
            <div class="input-name required">@lang('cabinet.old_pass')</div>
            <input name='old_password' id='old_password' type='text' class='form-control input-sm' required />
        </div>
        <div class='clearfix'></div>
        <div class='modal-row-p'>
            <div class="input-name required">@lang('cabinet.new_pass')</div>
            <a title="Сгенерировать" class='text-link link-mini' href="#" id='generate_password'>@lang('cabinet.genegate')</a>
            <input name='password' id='password' type='text' class='form-control input-sm' required />
        </div>
        <div class='clearfix'></div>
        <div class='modal-row-p'>
            <div class="input-name required">@lang('cabinet.new_pass_again')</div>
            <input name='password_again' id='password_again' type='text' class='form-control input-sm' required />
        </div>
        <div class='clearfix'></div>
        <div class="good-item-price">
            <button id="change_password" class="btn btn--brown">@lang('cabinet.save')</button>
        </div>
    </form>
    {{-- Управление подпиской --}}
    {{-- <h2 class="title-tab-cabinet mobile-title">@lang('cabinet.personal_data.subscription')</h2>
    <div class="checkbox" style="display: inline-block; margin-top: 0;">
        <label style='padding: 0;'>
        <input type="checkbox" class="bootstrap-switch js-change-value" {{ ( $subscriber && $subscriber->is_active == 1) ? "checked='checked'" : "" }}  value="{{ $subscriber && $subscriber->is_active == 1 ? '1' : '0' }}">
        @if($subscriber && $subscriber->is_active == 1)
            <div class="subscr_lable">&nbsp;@lang('cabinet.personal_data.is_active')</div>
        @else
            <div class="subscr_lable">&nbsp;@lang('cabinet.personal_data.is_not_active')</div>
        @endif
        </label>
    </div>
    <div class='more_subscribe' {{ ( $subscriber && $subscriber->is_active == 1) ? "" : "style='display:none;'" }} >
        <div class="checkbox" style="display: inline-block; margin-top: 0;">
            <input type="checkbox" class='user_checkbox input-hidden' id='is_goods_subscribe' data-field="subscribe_goods" {{ ( $subscriber && $subscriber->subscribe_goods =='1') ? "checked='checked'" : "" }} >
            <label for="is_goods_subscribe" class="checkbox-label">
                &nbsp;@lang('cabinet.personal_data.goods')
                <span class="checkbox-checked"></span>
            </label>
        </div>
        <br />
        <div class="checkbox" style="display: inline-block; margin-top: 0;">
            <input type="checkbox" class='user_checkbox input-hidden' id='is_units_subscribe' data-field="subscribe_units" {{ ( $subscriber && $subscriber->subscribe_units =='1') ? "checked='checked'" : "" }} >
            <label for="is_units_subscribe" class="checkbox-label">
                &nbsp;@lang('cabinet.personal_data.news')
                <span class="checkbox-checked"></span>
            </label>
        </div>
        <br />
        <div class='more_subscribe_units' {{ ( $subscriber && $subscriber->subscribe_units =='1') ? "" : "style='display:none;'" }}>
            @if ($categories->count())
                @foreach ($categories as $cat)
                    <div class="checkbox" style="display: block; margin-top: 0;">
                        <input type="checkbox" class='user_checkbox input-hidden' id="{{ $cat->id }}" data-field="{{ $cat->id }}" {{ (in_array($cat->id, $subscriber_cats)) ? "checked='checked'" : "" }} >
                        <label for="{{ $cat->id }}" class="checkbox-label">
                            &nbsp;{{ $cat->lang->name }}
                        </label>
                    </div>
                @endforeach
            @endif
        </div>
        @if (count($languages) > 1)
            <div style='width: 210px; margin-top: 20px;'>
                <p class='text-bold'><span class="item-caption">@lang('cabinet.personal_data.language')</span></p>
                <select class='select form-control' id='user_lang'>
                    @for ($i = 0; $i < count($languages) ; $i++)
                        <option value="{{ $languages[$i]['code'] }}" {{ ($languages[$i]['code']==$user->lang) ? "selected" : "" }} >{{ $languages[$i]['name'] }}</option>
                    @endfor
                </select>
            </div>
        @endif
    </div> --}}
    {{--Управление подпиской  --}}
</div>
