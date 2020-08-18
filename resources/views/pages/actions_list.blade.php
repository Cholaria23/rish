@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
    <div class="page blog">
        @include('layouts.main.breadcrumbs')
        @if($cat->lang->h1 != '')
            <div class="main-section-title">
                <div class="container">
                    {{$cat->lang->h1}}
                </div>
            </div>
        @else
            <div class="main-section-title">
                <div class="container">
                    {{$cat->lang->name}}
                </div>
            </div>
        @endif
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
                    {{$cat->units->links()}}
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
