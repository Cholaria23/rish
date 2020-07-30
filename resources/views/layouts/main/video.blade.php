@if($video->lang->description_1 != '' || $video->lang->description_2 != '')
    <div class="description-wrap">
        @if($video->lang->description_1 != '')
            <div class="description">
                <p>
                    {!! $video->lang->description_1 !!}
                </p>
            </div>
        @endif
        @if($video->lang->description_2 != '')
            <div class="description">
                <p>
                    {!! $video->lang->description_2 !!}
                </p>
            </div>
        @endif
    </div>
@endif
@if ($video->video_id != null)
    <div class="iframe-wrap">
        <iframe src="https://www.youtube.com/embed/{{ $video->video_id }}{{ ($video->is_controls == 0) ? "?controls=0" : "" }}" frameborder="0" allow="{{ ($video->is_autoplay == 1) ? "autoplay;" : "" }} encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
@elseif($video->video_src != null)
    <div class="video-wrap">
        <video preload="auto" muted="muted"
            {{ ($video->is_autoplay == 1) ? 'autoplay=autoplay' : '' }}
            {{ ($video->is_loop == 1) ? 'loop=loop' : '' }}
            {{ ($video->is_controls == 1) ? 'controls=controls' : '' }}
            {{ ($video->poster_src != '') ? 'poster='.asset("storage/units/video_posters/".$video->poster_src) : '' }} >
            <source src="{{ asset("storage/units/video/".$video->video_src) }}">
        </video>
    </div>
@endif
