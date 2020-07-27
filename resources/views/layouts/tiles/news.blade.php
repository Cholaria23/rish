<a href="{{build_unit_route($unit_item)}}">
    <img src="{{unit_img('small',$unit_item->img_1)}}" alt="{{$unit_item->lang->name}}" title="{{$unit_item->lang->name}}">

    @lang('main.titles.'.$unit_item->category->id)

    @if($unit_item->is_period == 1)
        @if($unit_item->start != '' && $unit_item->end != '')
            {{$unit_item->start->format('d.m.Y')}} - {{$unit_item->end->format('d.m.Y')}}
        @elseif($unit_item->start == null && strtotime($unit_item->end) > time())
            @if($unit_item->end != '')
                {{$unit_item->end->format('d.m.Y')}}
            @endif
        @else
            @lang('main.perpetual_share')
        @endif
    @else
        {{$unit_item->date_publication->format('d.m.Y')}}
    @endif

    {{$unit_item->lang->name}}
</a>
@if($unit_item->lang->short_desc_1 != '')
    {!!$unit_item->lang->short_desc_1!!}
@endif
