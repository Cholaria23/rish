@if($lead_item->user_first_name != '' || $lead_item->user_last_name != '')
    @if($lead_item->user_first_name != '')
        {{$lead_item->user_first_name}}
    @endif
    @if($lead_item->user_last_name != '')
        {{$lead_item->user_last_name}}
    @endif
@endif
@if($lead_item->content != '')
    {!! $lead_item->content !!}
@endif