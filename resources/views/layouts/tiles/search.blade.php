<div class="search-item-holder">
    <a class="search-item-link" href="{{$unit_item['href']}}" {{$unit_item['is_outer_href'] == 1 ? 'target="_blank"' : "" }}>
        <img class="search-item-img lazyload" data-src="{{$unit_item['cover']['path_to_folder']}}/{{$unit_item['cover']['filename']}}" alt="{!!$unit_item['name']!!}" title="{!!$unit_item['name']!!}">
        <span class="search-item-name">
            {!!$unit_item['name']!!}
        </span>
    </a>
</div>
