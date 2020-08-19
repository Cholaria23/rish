<a href="{{build_unit_route($unit_item)}}">
    <img src="{{unit_img('small',$unit_item->img_1)}}" alt="{{$unit_item->lang->name}}" title="{{$unit_item->lang->name}}">
    {{$unit_item->lang->name}}
</a>
@if($unit_item->lang->short_desc_1 != '')
    {!!$unit_item->lang->short_desc_1!!}
@endif
