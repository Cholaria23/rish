function initScrollbar() {
    $(".scroll-js").mCustomScrollbar({
        axis:"y",
        updateOnContentResize:true,
        documentTouchScroll: true,
    });
}

$(document).ready(function() {
    // CustomScrollbar
    if($('.scroll-js').length) {
        initScrollbar();
    }

    if($('.scroll-bnt-js').length) {
        $('.scroll-bnt-js').click( function(){
            var scroll_el = $(this).attr('data-id');
            $('html, body').animate({ scrollTop: $("."+scroll_el).offset().top - 30 }, 500);
        });
    }

    if($('.popup-gallery').length) {
        $('.popup-gallery').each(function() {
            $(this).magnificPopup({
                delegate: 'a',
                type: 'image',
                mainClass: 'mfp-img-mobile',
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    preload: [0,1]
                },
            });
        });
    }
    // position sticky
    if($('.sticky').length) {
        var elements = $('.sticky');
        Stickyfill.add(elements);
    }
    //   open search modal
    $('.header-search-btn').click(function() {
        var btn = $(this);
        if (btn.hasClass('active')) {
            btn.removeClass('active');
            $('.search-dropdown').slideUp(200);
            $('.overlay').removeClass('active');
            $('.overlay.active').unbind('click');
        } else {
            btn.addClass('active');
            $('.search-dropdown').slideDown(200);
            $('.overlay').addClass('active');
        }

        setTimeout(function(){
            $(".search-input").focus();

            $(".overlay.active").click(function(e) {
                var target = $(e.target);
                if (target.is(".overlay.active")) {
                    btn.removeClass('active');
                    $('.search-dropdown').slideUp(200);
                    $('.overlay').removeClass('active');
                    $('.overlay.active').unbind('click');
                }
            });
        }, 300);

        $(document).one('keydown', function(e) {
            if (e.keyCode == 27) {
                btn.removeClass('active');
                $('.search-dropdown').slideUp(200);
                $('.overlay').removeClass('active');
                $('.overlay.active').unbind('click');
            }
        });
    });

    // polifil object-fit
    if($('.object-fit-js').length) {
       var someImages = $('.object-fit-js');
       objectFitPolyfill(someImages);
    }

    // open all price
    if($('.all_price_js').length) {
        $('.all_price_js').click(function(e) {
            var price_list = $(this).prev();
            price_list.find('.price-item:not(.visible)').slideToggle(function() {
                price_list.find('li:not(.visible)').toggleClass('hide');
            });
            $(this).children('.visible-text').toggleClass('text-hide');
            $(this).children('.hide-text').toggleClass('text-hide');
        });
    }

    //  faq accordeon
    if($('.faq-question').length) {
        $('.faq-question').on('click', function(e) {
            var submenu = $(this).closest('.faq-item').find('.faq-answer');
            var icon =  $(this).closest('.faq-item').find('.faq-icon');
            $(this).toggleClass('active');
            if($(this).hasClass('active')) {
                icon.addClass('active');
                submenu.slideDown(200);
            } else {
                icon.removeClass('active');
                submenu.slideUp(200);
            }
        });
    }

});


$(window).on('load resize', function() {
    if (window.innerWidth < 1025) {
        if($('.unit-block-img').length) {
            var unitImg = $('.unit-block-img-wrap .unit-block-img');
            unitImg.insertAfter( $( ".unit-block-title-js" ) );
        }

        if($('.unit-page-aside-inner').length) {
            if ($('.unit-page-aside-inner').hasClass('scroll-js')) {
                $('.unit-page-aside-inner.scroll-js').mCustomScrollbar("destroy");
                // setTimeout(function(){
                // },100)
            }
        }
    } else {
        if($('.unit-block-img').length) {
            var unitImg = $('.unit-block-info .unit-block-img');
            unitImg.appendTo( $( ".sticky" ) );
        }

        // destroy custom scroll filter block
         if($('.unit-page-aside-inner').length) {
             if ($('.unit-page-aside-inner').hasClass('scroll-js')) {
                 initScrollbar();
             }
         }
    }
    if (window.innerWidth < 767) {
        if($('.main-section-title-wrap .btn-arrow').length) {
            var moreLink = $('.main-section-title-wrap .btn-arrow');
            $(moreLink).each(function() {
                var location = $(this).closest('.main-section').find('.btn-wrap');
                location.append($(this));
            })
        }
    } else {
        if($('.btn-wrap .btn-arrow').length) {
            var moreLink = $('.btn-wrap .btn-arrow');
            $(moreLink).each(function() {
                var location = $(this).closest('.main-section').find('.main-section-title-wrap');
                location.append($(this));
            })
        }
    }
});
