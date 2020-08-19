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
                    <div class="description">
                        {!! $cat->lang->pre_info !!}
                    </div>
                @endif
            </div>
        </section>
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
