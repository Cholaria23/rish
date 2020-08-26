@if(isset($checkup) && $checkup)
    <div class="main-section-title">
        {{$checkup->lang->name}}
    </div>
    @if($checkup->lang->short_desc_1 != '')
        <div class="description">
            {!!$checkup->lang->short_desc_1!!}
        </div>
    @endif
    <a class="btn-green popup-js" href="#chekup">@lang('main.btn.sign_up')</a>
@endif
