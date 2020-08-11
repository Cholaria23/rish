$(document).ready(function() {
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

})
