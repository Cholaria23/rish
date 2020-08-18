$(document).ready(function() {
    $(".reviews-slider").slick({
        // dots: true,
        arrows: false,
        fade: true,
        asNavFor: $(".counter-slider"),
        responsive: [
         {
           breakpoint: 1025,
           settings: {
               adaptiveHeight: true,
           }
         }
       ]
    });

    $(".counter-slider").slick({
        arrows: false,
        dots: true,
        fade: true,
        asNavFor: $(".reviews-slider"),
    });

});


$(window).on('load resize', function () {
    if($('.special-actions-wrap.slider').length) {
        $('.special-actions-wrap.slider').each(function() {
            if (window.innerWidth < 767) {
                if (!$(this).hasClass('slick-slider')) {
                    $(this).slick({
                        arrows: false,
                        dots: true,
                        infinite: true,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        responsive: [
                            {
                                breakpoint: 401,
                                settings: {
                                    slidesToShow: 1,
                                }
                            }
                        ]
                    });
                }
            } else {
                if ($(this).hasClass('slick-slider')) {
                    $(this).slick('destroy');
                }
            }
        })
    }


    if($('.mobile-slider-js').length) {
        $('.mobile-slider-js').each(function() {
            if (window.innerWidth < 401) {
                if (!$(this).hasClass('slick-slider')) {
                    $(this).slick({
                        arrows: true,
                        infinite: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        prevArrow: '<div class="mobile-slider-arrow prev"></div>',
                        nextArrow: '<div class="mobile-slider-arrow next"></div>',
                    });
                }
            } else {
                if ($(this).hasClass('slick-slider')) {
                    $(this).slick('destroy');
                }
            }
        })
    }
});
