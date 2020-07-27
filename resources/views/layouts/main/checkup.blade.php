@if(isset($checkup) && $checkup)
    {{$checkup->lang->name}}
    @if($checkup->lang->short_desc_1 != '')
        {!!$checkup->lang->short_desc_1!!}
    @endif
    <a href="{{build_unit_route($checkup)}}">@lang('main.btn.checkup')</a>
@endif