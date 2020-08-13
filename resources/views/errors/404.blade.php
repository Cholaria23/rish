@extends('layouts.main.wrapper')
@section('page')
    <div class="page_section section-mistake">
        <div class="section-mistake-wrap">
            <div class="container">
                <div class="title-mistake">
                    404
                </div>
                <div class="subtitle-mistake">
                    @lang('main.not_page')
                </div>
                <a class="big-ligth-btn" href="{{ URL::to("/") }}">
                    @lang('main.back_to_main')
                </a>
            </div>
        </div>
    </div>
@stop
