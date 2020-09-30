@if(isset($unit_item['cat_id']) && in_array($unit_item['cat_id'], $services_cats))
<a class="servises-item" href="{{$unit_item['href']}}" {{$unit_item['is_outer_href'] == 1 ? 'target="_blank"' : "" }}>
    <span class="servises-item-count">
        <svg>
            <use xlink:href="#rishon-icon"></use>
        </svg>
    </span>
    <span class="servises-item-name">
        {!!$unit_item['name']!!}
    </span>
</a>
@else
    <div class="search-item-holder">
        <a class="search-item-link" href="{{$unit_item['href']}}" {{$unit_item['is_outer_href'] == 1 ? 'target="_blank"' : "" }}>
            <div class="search-item-img-wrap">
                <img class="search-item-img lazyload" data-src="{{$unit_item['cover']['path_to_folder']}}/{{$unit_item['cover']['filename']}}" alt="{!!$unit_item['name']!!}" title="{!!$unit_item['name']!!}">
            </div>
            <span class="search-item-name">
                {!!$unit_item['name']!!}
            </span>
        </a>
    </div>
@endif