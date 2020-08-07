<a class="specialists-item" href="{{build_expert_route($specialist_item->alias)}}">
    <span class="specialists-img-wrap">
        <img class="specialists-img lazyload" data-src="{{specialist_cover('small', $specialist_item->img_1)}}" alt="{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}" title="{{$specialist_item->lang->last_name}} {{$specialist_item->lang->first_name}} {{$specialist_item->lang->father_name}}">
    </span>
    <span class="specialists-info">
        <span class="specialists-name">
            {{$specialist_item->lang->last_name}}
            {{$specialist_item->lang->first_name}}
            {{$specialist_item->lang->father_name}}
        </span>
        @if(isset($specialist_item->chars_vals[4]) && isset($specialist_item->chars_vals[4]['values']))
            <span class="specialists-position">
                {{implode(", ",$specialist_item->chars_vals[4]['values'])}}
            </span>
        @endif
        @if($specialist_item->lang->short_desc_1 != '')
            <span class="specialists-desc">
                {{$specialist_item->lang->short_desc_1}}
            </span>
        @endif
    </span>
    <span class="specialists-experience">
        @if(isset($specialist_item->chars_vals[2]) && isset($specialist_item->chars_vals[2]['values']))
            <span class="specialists-experience-item">
                {{implode(",",$specialist_item->chars_vals[2]['values'])}}
            </span>
        @endif
        @if($specialist_item->experiences->count())
            @foreach($specialist_item->experiences as $xp)
                <span class="specialists-experience-item">
                    @choice('main.xp',(date("Y")-$xp->start),["year" => (date("Y")-$xp->start)])
                </span>
            @endforeach
        @endif
    </span>
</a>
