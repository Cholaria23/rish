<div class="reviews-item">
    @if($lead_item->user_first_name != '' || $lead_item->user_last_name != '')
        <div class="reviews-name-wrap">
            <div class="reviews-name">
                @if($lead_item->user_first_name != '')
                    <span>
                        {{$lead_item->user_first_name}}
                    </span>
                @endif
                @if($lead_item->user_last_name != '')
                    <span>
                        {{$lead_item->user_last_name}}
                    </span>
                @endif
            </div>
            @if($lead_item->updated_at != '')
				<div class="reviews-date">
					{{$lead_item->updated_at->format('d.m.Y')}}
				</div>
			@endif
        </div>
    @endif
    @if($lead_item->content != '')
        <div class="reviews-text">
            {!! $lead_item->content !!}
        </div>
    @endif
</div>
