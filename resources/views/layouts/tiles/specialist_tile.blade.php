<img src="{{specialist_cover('small', $specialist_item->img_1)}}" alt="{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}" title="{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}">
<a href="{{build_expert_route($specialist_item->alias)}}">
    {{$specialist_item->lang->last_name}}
    {{$specialist_item->lang->first_name}}
    {{$specialist_item->lang->father_name}}
</a>
@if($specialist_item->lang->short_desc_1 != '')
    {{$specialist_item->lang->short_desc_1}}
@endif
@if(isset($specialist_item->chars_vals[4]) && isset($specialist_item->chars_vals[4]['values']))
    {{implode(", ",$specialist_item->chars_vals[4]['values'])}}
@endif
@if(isset($specialist_item->chars_vals[2]) && isset($specialist_item->chars_vals[2]['values']))
    {{implode(",",$specialist_item->chars_vals[2]['values'])}}
@endif
@if($specialist_item->experiences->count())
    @foreach($specialist_item->experiences as $xp)
        @choice('main.xp',(date("Y")-$xp->start),["year" => (date("Y")-$xp->start)])
    @endforeach
@endif