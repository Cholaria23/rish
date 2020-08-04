@extends('layouts.main.wrapper')
@section('page')
    <div class="page_section section-mistake">
        <div class="section-mistake-wrap">
            <div class="container">
                <h1 class="title-mistake">
                    500
                </h1>
                <h2 class="subtitle-mistake">
                    @lang('main.not_page')
                </h2>
                <a class="big-ligth-btn" href="{{ URL::to("/") }}">
                    @lang('main.back_to_main')
                </a>
            </div>
        </div>
    </div>
@stop
