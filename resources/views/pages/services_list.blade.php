@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
    <div class="page">
        @include('layouts.main.breadcrumbs')
        <section class="page-section">
            <div class="container-small">
                @if($cat->lang->h1 != '')
                    <div class="page-section-top-title">
                        {{$cat->lang->h1}}
                    </div>
                @else
                    <div class="page-section-top-title">
                        {{$cat->lang->name}}
                    </div>
                @endif
                @if($cat->lang->pre_info != '')
                    <div class="page-section-top-subtitle description">
                        {!! $cat->lang->pre_info !!}
                    </div>
                @endif
            </div>
        </section>
        @if($cat->children->count())
            @foreach ($cat->children as $firsc_child)
                <section class="page-section">
                    <div class="container">
                        <div class="page-section-title">
                            {{$firsc_child->lang->name}}
                        </div>
                        @if($firsc_child->children->count())
                            <div class="servises-block">
                                @foreach ($firsc_child->children as $key => $second_child)
                                    <a class="servises-item" href="{{route('first_url',$second_child->alias)}}">
                                        @if(in_array(($key+1),[1,2,3,4,5,6,7,8,9]) )
                                            <span class="servises-item-count">
                                                0{{$key+1}}
                                            </span>
                                        @else
                                            <span class="servises-item-count">
                                                {{$key+1}}
                                            </span>
                                        @endif
                                        <span class="servises-item-name">
                                            {{$second_child->lang->name}}
                                        </span>
                                        <span class="servises-item-icon">
                                            <svg width="17" height="14">
    											<use xlink:href="#icon-right-arrow-green"></use>
    										</svg>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        @elseif($firsc_child->units->count())
                            <div class="servises-block">
                                @foreach ($firsc_child->units as $key => $unit_item)
                                    <a class="servises-item" href="{{build_unit_route($unit_item)}}">
                                        @if(in_array(($key+1),[1,2,3,4,5,6,7,8,9]) )
                                            <span class="servises-item-count">
                                                0{{$key+1}}
                                            </span>
                                        @else
                                            <span class="servises-item-count">
                                                {{$key+1}}
                                            </span>
                                        @endif
                                        <span class="servises-item-name">
                                            {{$unit_item->lang->name}}
                                        </span>
                                        <span class="servises-item-icon">
                                            <svg width="17" height="14">
    											<use xlink:href="#icon-right-arrow-green"></use>
    										</svg>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>
            @endforeach
        @endif
        @if($cat->lang->post_info != '')
            <section class="page-section">
                <div class="container">
                    <div class="description text-center">
                        {!! $cat->lang->post_info !!}
                    </div>
                </div>
            </section>
        @endif
    </div>
@stop
@section('scripts')
@stop
