<a class="equipment-block-link" href="{{build_unit_route($unit_item)}}">
    <span class="equipment-img-wrap">
        <img class="equipment-img lazyload" data-src="{{unit_img('small',$unit_item->img_1)}}" alt="{{$unit_item->lang->name}}" title="{{$unit_item->lang->name}}">
    </span>
    <span class="equipment-info-wrap">
        <span class="equipment-info-name">
            {{$unit_item->lang->name}}
        </span>
        @if($unit_item->lang->short_desc_1 != '')
            <span class="equipment-info-desc text">
                {!!$unit_item->lang->short_desc_1!!}
            </span>
        @endif
    </span>
</a>
