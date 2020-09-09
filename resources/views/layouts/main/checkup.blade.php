@if(isset($checkup) && $checkup)
    <div class="main-section-title">
        {{$checkup->lang->name}}
    </div>
    @if($checkup->lang->short_desc_1 != '')
        <div class="description">
            {!!$checkup->lang->short_desc_1!!}
        </div>
    @endif
    <div class="checkup-btn-wrap">
        <a class="btn-green" href="{{build_unit_route($checkup)}}">@lang('main.btn.sign_up')</a>
        <a class="btn-green" href="{{build_unit_route($checkup)}}">@lang('main.more_details')</a>
    </div>
@endif
