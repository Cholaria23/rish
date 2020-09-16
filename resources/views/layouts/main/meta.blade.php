@section('meta')
    @if(isset($meta_type) && $meta_type == 'unit')
        <title>{{ $unit->lang->meta_title != '' ? html_entity_decode($unit->lang->meta_title) : htmlspecialchars($page_title) }} </title>
        <meta name="description" content="{{ htmlspecialchars($unit->lang->meta_desc) }}">
        <meta name="keywords" content="{{ htmlspecialchars($unit->lang->meta_key) }}">
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ $unit->lang->meta_title != '' ? htmlspecialchars($unit->lang->meta_title) : htmlspecialchars($page_title) }} " />
        <meta property="og:description" content="{{ htmlspecialchars($unit->lang->meta_desc) }}" />
        <meta property="og:image" content="{{ (isset($unit) && $unit->img_1 != '') ? unit_img('small', $unit->img_1) : asset('storage/logo/'.app('seo')['logo_img_4']) }}" />
        @php
            if(isset($unit) && $unit->img_1 != '' && file_exists(unit_img('small', $unit->img_1))){
                $img_size = getimagesize(unit_img('small', $unit->img_1));
            }else{
                if(file_exists('storage/logo/'.app('seo')['logo_img_4'])){
                    $img_size = getimagesize(asset('storage/logo/'.app('seo')['logo_img_4']));
                }
            }
        @endphp
    @elseif(isset($meta_type) && $meta_type == 'cat_unit')
        <title>{{ $cat->lang->meta_title != '' ? htmlspecialchars($cat->lang->meta_title) : htmlspecialchars($page_title) }} {{Request::has('page') ? Lang::get('main.page').' - '.Request::get('page') : ''}} </title>
        <meta name="description" content="{{ htmlspecialchars($cat->lang->meta_desc) }}">
        <meta name="keywords" content="{{ htmlspecialchars($cat->lang->meta_key) }}">
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ $cat->lang->meta_title != '' ? htmlspecialchars($cat->lang->meta_title) : htmlspecialchars($page_title) }} {{Request::has('page') ? Lang::get('main.page').' - '.Request::get('page') : ''}} " />
        <meta property="og:description" content="{{ htmlspecialchars($cat->lang->meta_desc) }}" />
        <meta property="og:image" content="{{ (isset($cat) && $cat->cover_1_img != '') ? cat_img('small', $cat->cover_1_img) : asset('storage/logo/'.app('seo')['logo_img_4']) }}" />
        @php
            if(isset($cat) && $cat->cover_1_img != ''  && file_exists(cat_img('small', $cat->cover_1_img))){
                $img_size = getimagesize(cat_img('small', $cat->cover_1_img));
            }else{
                if(file_exists('storage/logo/'.app('seo')['logo_img_4'])){
                    $img_size = getimagesize(asset('storage/logo/'.app('seo')['logo_img_4']));
                }
            }
        @endphp
    @elseif(isset($meta_type) && $meta_type == 'cat_good')
        <title>{{ $cat->lang->meta_title != '' ? htmlspecialchars($cat->lang->meta_title) : htmlspecialchars($page_title) }} {{Request::get('page') ? Lang::get('main.page').' - '.Request::get('page') : ''}} </title>
        <meta name="description" content="{{ htmlspecialchars($cat->lang->meta_desc) }}">
        <meta name="keywords" content="{{ htmlspecialchars($cat->lang->meta_key) }}">
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ $cat->lang->meta_title != '' ? htmlspecialchars($cat->lang->meta_title) : htmlspecialchars($page_title) }} {{Request::get('page') ? Lang::get('main.page').' - '.Request::get('page') : ''}} " />
        <meta property="og:description" content="{{ htmlspecialchars($cat->lang->meta_desc) }}" />
        <meta property="og:image" content="{{ (isset($cat) && $cat->cover_1_img != '') ? market_cat_img('small', $cat->cover_1_img) : asset('storage/logo/'.app('seo')['logo_img_4']) }}" />
        @php
            if(isset($cat) && $cat->cover_1_img != ''  && file_exists(market_cat_img('small', $cat->cover_1_img))){
                $img_size = getimagesize(market_cat_img('small', $cat->cover_1_img));
            }else{
                if(file_exists('storage/logo/'.app('seo')['logo_img_4'])){
                    $img_size = getimagesize(asset('storage/logo/'.app('seo')['logo_img_4']));
                }
            }
        @endphp
    @elseif(isset($meta_type) && $meta_type == 'good')
        <title>{{ $good->lang->meta_title != '' ? htmlspecialchars($good->lang->meta_title) : htmlspecialchars($page_title) }} {{Request::get('tag') ? ' - '.Request::get('tag') : ''}} {{Request::get('page') ? Lang::get('main.page').' - '.Request::get('page') : ''}} </title>
        <meta name="description" content="{{ htmlspecialchars($good->lang->meta_desc) }}">
        <meta name="keywords" content="{{ htmlspecialchars($good->lang->meta_key) }}">
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ $good->lang->meta_title != '' ? htmlspecialchars($good->lang->meta_title) : htmlspecialchars($page_title) }} {{Request::get('tag') ? ' - '.Request::get('tag') : ''}} {{Request::get('page') ? Lang::get('main.page').' - '.Request::get('page') : ''}} " />
        <meta property="og:description" content="{{ htmlspecialchars($good->lang->meta_desc) }}" />
        <meta property="og:image" content="{{ (isset($good) && $good->img_1 != '') ? good_img('small', $good->img_1) : asset('storage/logo/'.app('seo')['logo_img_4']) }}" />
        @php
            if(isset($good) && $good->img_1 != ''  && file_exists(good_img('small', $good->img_1))){
                $img_size = getimagesize(good_img('small', $good->img_1));
            }else{
                if(file_exists('storage/logo/'.app('seo')['logo_img_4'])){
                    $img_size = getimagesize(asset('storage/logo/'.app('seo')['logo_img_4']));
                }
            }
        @endphp
    @elseif(isset($meta_type) && $meta_type == 'brand')
        <title>{{ $brand->lang->meta_title != '' ? htmlspecialchars($brand->lang->meta_title) : htmlspecialchars($page_title) }} {{Request::get('tag') ? ' - '.Request::get('tag') : ''}} {{Request::get('page') ? Lang::get('main.page').' - '.Request::get('page') : ''}} </title>
        <meta name="description" content="{{ htmlspecialchars($brand->lang->meta_desc) }}">
        <meta name="keywords" content="{{ htmlspecialchars($brand->lang->meta_key) }}">
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ $brand->lang->meta_title != '' ? htmlspecialchars($brand->lang->meta_title) : htmlspecialchars($page_title) }} {{Request::get('tag') ? ' - '.Request::get('tag') : ''}} {{Request::get('page') ? Lang::get('main.page').' - '.Request::get('page') : ''}} " />
        <meta property="og:description" content="{{ htmlspecialchars($brand->lang->meta_desc) }}" />
        <meta property="og:image" content="{{ (isset($brand) && $brand->logo != '') ? market_brand_logo($brand->logo) : asset('storage/logo/'.app('seo')['logo_img_4']) }}" />
        @php
            if(isset($brand) && $brand->logo != ''  && file_exists(market_brand_logo($brand->logo))){
                $img_size = getimagesize(market_brand_logo($brand->logo));
            }else{
                if(file_exists('storage/logo/'.app('seo')['logo_img_4'])){
                    $img_size = getimagesize(asset('storage/logo/'.app('seo')['logo_img_4']));
                }
            }
        @endphp
    @elseif(isset($meta_type) && $meta_type == 'expert')
        <title>{{ $expert->lang->meta_title != '' ? htmlspecialchars($expert->lang->meta_title) : htmlspecialchars($page_title) }} </title>
        <meta name="description" content="{{ htmlspecialchars($expert->lang->meta_desc) }}">
        <meta name="keywords" content="{{ htmlspecialchars($expert->lang->meta_key) }}">
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ $expert->lang->meta_title != '' ? htmlspecialchars($expert->lang->meta_title) : htmlspecialchars($page_title) }} " />
        <meta property="og:description" content="{{ htmlspecialchars($expert->lang->meta_desc) }}" />
        <meta property="og:image" content="{{ (isset($expert) && $expert->img_1 != '') ? specialist_cover('small', $expert->img_1) : asset('storage/logo/'.app('seo')['logo_img_4']) }}" />
        @php
            if(isset($expert) && $expert->img_1 != '' && file_exists(specialist_cover('small', $expert->img_1))){
                $img_size = getimagesize(specialist_cover('small', $expert->img_1));
            }else{
                if(file_exists('storage/logo/'.app('seo')['logo_img_4'])){
                    $img_size = getimagesize(asset('storage/logo/'.app('seo')['logo_img_4']));
                }
            }
        @endphp
    @else
        <title>@if(isset($meta_title) && $meta_title != ''){{htmlspecialchars($meta_title)}}@elseif(isset($page_title) && $page_title != ''){{htmlspecialchars($page_title)}}@else 404 @endif</title>
        <meta property="og:type" content="website" />
        <meta property="og:title" content="@if(isset($meta_title) && $meta_title != ''){{htmlspecialchars($meta_title)}}@elseif(isset($page_title) && $page_title != ''){{htmlspecialchars($page_title)}}@else 404 @endif" />
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:image" content="{{ asset('storage/logo/'.app('seo')['logo_img_4']) }}" />
        @php
            if(file_exists('storage/logo/'.app('seo')['logo_img_4'])){
                $img_size = getimagesize(asset('storage/logo/'.app('seo')['logo_img_4']));
            }
        @endphp
    @endif
    @if(isset($img_size))
        @if(isset($img_size['mime']) && $img_size['mime'] != null)
            <meta property="og:image:type" content="{{$img_size['mime']}}" />
        @endif
        @if(isset($img_size[0]) && $img_size[0] != null)
            <meta property="og:image:width" content="{{$img_size[0]}}" />
        @endif
        @if(isset($img_size[1]) && $img_size[1] != null)
            <meta property="og:image:height" content="{{$img_size[1]}}" />
        @endif
    @endif
    @if (class_exists('LaravelLocalization'))
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            {{-- @if ($localeCode != App::getLocale()) --}}
                <link rel="alternate" hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode) }}/" />
            {{-- @endif --}}
        @endforeach
    @endif
@show
