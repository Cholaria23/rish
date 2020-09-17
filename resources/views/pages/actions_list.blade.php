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
                        {{$cat->lang->h1}}
                    </h1>
                @else
                    <h1 class="page-section-top-title">
                        {{$cat->lang->name}}
                    </h1>
                @endif
            </div>
        </section>
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
                                @include('layouts.tiles.actions')
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
