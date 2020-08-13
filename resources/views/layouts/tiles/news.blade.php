<?php
	switch ($unit_item->category->id) {
		case 19:
		$class="news";
		break;
		case 18:
		$class="articles";
		break;
		case 17:
		$class="stock";
		break;
		case 16:
		$class="package-offer";
		break;
		default:
		$class="";
		break;
	}
?>
<a class="special-action-item {{$class}}" href="{{build_unit_route($unit_item)}}">
    <span class="special-action-info">
        <span class="special-action-cat">
            @lang('main.titles.'.$unit_item->category->id)
        </span>
        @if($unit_item->is_period == 1)
            @if($unit_item->start != '' && $unit_item->end != '')
                <span class="special-action-period">
                    {{$unit_item->start->format('d.m.Y')}} - {{$unit_item->end->format('d.m.Y')}}
                </span>
            @elseif($unit_item->start == null && strtotime($unit_item->end) > time())
                @if($unit_item->end != '')
                    <span class="special-action-period">
                        {{$unit_item->end->format('d.m.Y')}}
                    </span>
                @endif
            @else
                <span class="special-action-period">
                    @lang('main.perpetual_share')
                </span>
            @endif
        @else
            <span class="special-action-period">
				<span class="special-action-period-bold">{{$unit_item->date_publication->format('d')}}</span>/{{$unit_item->date_publication->format('m')}}
            </span>
        @endif
    </span>
    <span class="special-action-img-wrap">
        <img class="special-action-img lazyload" data-src="{{unit_img('small',$unit_item->img_1)}}" alt="{{$unit_item->lang->name}}" title="{{$unit_item->lang->name}}">
    </span>
    <span class="special-action-name">
        {{$unit_item->lang->name}}
        @if($unit_item->lang->short_desc_1 != '')
            {!!$unit_item->lang->short_desc_1!!}
        @endif
    </span>
</a>
