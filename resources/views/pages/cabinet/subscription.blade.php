<div class="tab-pane subscribe-block" id="tab_subscribe">
    <h2 class="title-tab-cabinet mobile-title">@lang('cabinet.personal_data.subscription')</h2>
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
    </div>
</div>
