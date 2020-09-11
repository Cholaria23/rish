@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
     <div class="page">
        <section class="page-section section-with-breadcrumbs">
            <div class="container-small">
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
            <section class="main-section">
                <div class="container-small">
                    <div class="description">
                        {!! $cat->lang->pre_info !!}
                    </div>
                </div>
           </section>
        @endif
        @if($cat->units->count())
            <section class="main-section">
                <div class="container-small">
                    <div class="page-section-title-bold">
                        @lang('main.equipment')
                    </div>
                    <ul class="equipment-list">
                        @foreach ($cat->units as $unit_item)
                            <li class="equipment-item">
                                @include('layouts.tiles.equipment')
                            </li>
                        @endforeach
                    </ul>
               </div>
           </section>
        @else
            @lang('main.empty_cat')
    	@endif
        @if($cat->lang->post_info != '')
            <section class="page-section">
                <div class="container-small">
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
