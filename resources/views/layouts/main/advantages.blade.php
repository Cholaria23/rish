@if(isset($advantages) && $advantages)
    {{$advantages[0]->category->lang->name}}
    @foreach ($advantages as $unit_item)
        {{$unit_item->lang->name}}
        @if($unit_item->lang->short_desc_1 != '')
            {!!$unit_item->lang->short_desc_1!!}
        @endif
        @if($unit_item->lang->short_desc_2 != '')
            {!!$unit_item->lang->short_desc_2!!}
        @endif
    @endforeach
@endif