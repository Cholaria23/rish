@if(isset($checkup) && $checkup)
    <section class="main-section">
        {{$checkup->lang->name}}
        @if($checkup->lang->short_desc_1 != '')
            {!!$checkup->lang->short_desc_1!!}
        @endif
        <a href="{{build_unit_route($checkup)}}">@lang('main.btn.checkup')</a>
    </section>
@endif
