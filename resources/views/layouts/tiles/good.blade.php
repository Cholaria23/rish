<span class="price-name">
    {{$good->lang->name}}
</span>
<span class="price-count">
    @if($good->c_price_min != 0 || $good->c_price_max != 0)
        @if($good->c_price_min != 0)
            @lang('main.from') {{build_price($good->c_price_min)}}
        @endif
        @if($good->c_price_max != 0)
            @lang('main.to') {{build_price($good->c_price_max)}}
        @endif
        {{app('main_curr')->lang->short_name}}
    @elseif($good->c_price != 0)
        @if(isset($good->c_action_price) && $good->c_action_price != 0 && $good->c_action_price < $good->c_price)
            {{build_price($good->c_action_price)}}
            {{app('main_curr')->lang->short_name}}
        @else
            {{build_price($good->c_price)}}
            {{app('main_curr')->lang->short_name}}
        @endif
    @else
        @lang('main.request_price')
    @endif
</span>
