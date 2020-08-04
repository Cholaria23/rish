@extends('layouts.main.wrapper')
@section('links')
@stop
@section('page')
    @include('layouts.main.breadcrumbs')
    @if($cat->lang->h1 != '')
		<h1>
			{{$cat->lang->h1}}
		</h1>
	@else
		<h1>
			{{$cat->lang->name}}
		</h1>
    @endif
    @if($cat->lang->pre_info != '')
        {!! $cat->lang->pre_info !!}
    @endif
    @if($cat->children->count())
        @foreach ($cat->children as $firsc_child)
            <a href="{{route('first_url',$firsc_child->alias)}}">
                {{$firsc_child->lang->name}}
            </a>
            @if($firsc_child->children->count())
                @foreach ($firsc_child->children as $key => $second_child)
                    <a href="{{route('first_url',$second_child->alias)}}">
                        @if(in_array(($key+1),[1,2,3,4,5,6,7,8,9]) )
                            0{{$key+1}}
                        @else
                            {{$key+1}}
                        @endif
                        {{$second_child->lang->name}}
                    </a>
                    
                @endforeach
            @elseif($firsc_child->units->count())
                @foreach ($firsc_child->units as $key => $unit_item)
                    <a href="{{build_unit_route($unit_item)}}">
                        @if(in_array(($key+1),[1,2,3,4,5,6,7,8,9]) )
                            0{{$key+1}}
                        @else
                            {{$key+1}}
                        @endif
                        {{$unit_item->lang->name}}
                    </a>
                @endforeach
            @endif
            <hr>
        @endforeach
    @endif
    @if($cat->lang->post_info != '')
        {!! $cat->lang->post_info !!}
    @endif
@stop
@section('scripts')
@stop