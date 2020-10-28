<li class="faq-item" itemscope itemtype="https://schema.org/Question" itemprop="mainEntity">
    <div class="faq-question">
        <span class="faq-question-name" itemprop="name">
            {{$faq_item->lang->question}}
        </span>
        <div class="faq-icon"></div>
    </div>
    @if($faq_item->lang->answer != '')
        <div class="faq-answer text" itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" itemscope>
            <span itemprop="text">
                {!!$faq_item->lang->answer!!}
            </span>
            @if($faq_item->lang->link != '')
                <div class="popup-btn-wrap">
                    <a class="btn-green-small" href="{{substr($faq_item->lang->link,0,4) != 'http' ? "http://".$faq_item->lang->link : $faq_item->lang->link}}">@lang('main.more_details')</a>
                </div>
            @endif
        </div>
    @endif
</li>