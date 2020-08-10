<a class="services-item" href="{{route('first_url',$cat_item->alias)}}">
    <span class="services-item-svg">
        {!!$cat_item->cover_svg!!}
    </span>
    <span class="services-item-name">
        {{$cat_item->lang->name}}
    </span>
</a>
