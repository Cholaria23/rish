@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
    <div class="page blog">
        <section class="page-section section-with-breadcrumbs">
            <div class="container">
                @include('layouts.main.breadcrumbs')
                @if($cat->lang->h1 != '')
                    <h1 class="page-section-top-title">
                        {{$cat->lang->h1}} {{Request::has('page') && Request::get('page') ? Lang::get('main.page').' - '.Request::get('page') : ''}}
                    </h1>
                @else
                    <h1 class="page-section-top-title">
                        {{$cat->lang->name}} {{Request::has('page') && Request::get('page') ? Lang::get('main.page').' - '.Request::get('page') : ''}}
                    </h1>
                @endif
            </div>
        </section>
        {{-- <div class="page-section turquoise-section">
            <div class="container">
                @if(isset($cat->popular_units) && $cat->popular_units && $cat->popular_units->count())
                    <div class="page-section-title-bold">
                        @lang('main.popular_units')
                    </div>
                    <div class="special-actions-wrap slider">
                        @foreach ($cat->popular_units as $unit_item)
                            <div class="special-action-holder">
                                @include('layouts.tiles.news')
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div> --}}
        @if($cat->lang->pre_info != '')
            <section class="page-section">
                <div class="container">
                    <div class="description">
                        {!! $cat->lang->pre_info !!}
                    </div>
                </div>
            </section>
        @endif
        @if($cat->units->count())
            <section class="main-section">
                <div class="container">
                    <div class="special-actions-wrap">
                        @foreach ($cat->units as $unit_item)
                            <div class="special-action-holder">
                                @include('layouts.tiles.news')
                            </div>
                        @endforeach
                    </div>
                    {{$cat->units->links('layouts.main.custom_paginate')}}
                </div>
            </section>
        @else
            <section class="main-section">
                <div class="container">
                    @lang('main.empty_cat')
                </div>
            </section>
        @endif
        @if($cat->lang->post_info != '')
            <section class="page-section">
                <div class="container">
                    <div class="description">
                        {!! $cat->lang->post_info !!}
                    </div>
                </div>
            </section>
        @endif
    </div>
@stop
@section('scripts')
@stop
