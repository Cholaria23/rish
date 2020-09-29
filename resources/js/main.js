function initScrollbar() {
    $(".scroll-js").mCustomScrollbar({
        axis:"y",
        updateOnContentResize:true,
        documentTouchScroll: true,
    });
}

function initPriceTabs() {
	$(document).on('click', '.tab-link', function(e) {
        var hTopTitle = $('.main-section-title').offset().top;
        var selectTab = $(this).attr('data-tab');
        var parent = $(this).closest('.tabs-container');
        if( selectTab == 'all' ) {
            parent.find('.tab-link').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').fadeIn();
            if ($(window).scrollTop() > hTopTitle) {
                $('html, body').animate({ scrollTop: $('.main-section-title').offset().top - 40 }, 500);
            }
        } else {
            parent.find('.tab-link').removeClass('active');
            $(this).addClass('active');
            parent.find('.tab-content').hide();
            $('#'+selectTab).fadeIn();
            if ($('#'+selectTab).length != 0 && $(window).scrollTop() > hTopTitle) {
                $('html, body').animate({ scrollTop: $('.main-section-title').offset().top - 40 }, 500);
            }
        }
    });

    $(document).on('click', '.tab-mobile-link', function(e) {
        var selectTab = $(this).attr('data-tab');
        var parent = $(this).closest('.tabs-container');
        if( selectTab == 'all' ) {
            parent.find('.tab-mobile-link').removeClass('active');
            $(this).addClass('active');
            parent.find('.tab-content').fadeIn();
            $(".active-tab-mobile-text").html($('.tab-mobile-link.active').text());
            $('.active-tab-mobile').toggleClass("active");
            $(".tabs").slideToggle();
        } else {
            parent.find('.tab-mobile-link').removeClass('active');
            $(this).addClass('active');
            parent.find('.tab-content').hide();
            $('#'+selectTab).fadeIn();
            $(".active-tab-mobile-text").html($('.tab-mobile-link.active').text());
            $('.active-tab-mobile').toggleClass("active");
            $(".tabs").slideToggle();
        }
    });
}

function initSearchTabs() {
    var active_tab = $('.tabs li').first();
	var tabs_container = $(this).closest('.tabs-container');
    var selectTab = active_tab.attr('data-tab');
	active_tab.addClass('active');
	tabs_container.find('.tab-content').hide();
    $('#'+selectTab).fadeIn();
    if ($('#'+selectTab).find('.mobile-slider-js').is('.slick-slider') == true) {
        $(".mobile-slider-js").slick('destroy');
        $(".mobile-slider-js").slick('refresh');
    }
	$(document).on('click', '.tab-link', function(e) {
        var selectTab = $(this).attr('data-tab');
        var parent = $(this).closest('.tabs-container');
        parent.find('.tab-link').removeClass('active');
        $(this).addClass('active');
        parent.find('.tab-content').hide();
        $('#'+selectTab).fadeIn();
    });

    $(document).on('click', '.tab-mobile-link', function(e) {
        var selectTab = $(this).attr('data-tab');
        var parent = $(this).closest('.tabs-container');
            parent.find('.tab-mobile-link').removeClass('active');
            $(this).addClass('active');
            parent.find('.tab-content').hide();
            $('#'+selectTab).fadeIn();
            if ($('#'+selectTab).find('.mobile-slider-js').is('.slick-slider') == true) {
                $(".mobile-slider-js").slick('destroy');
                $(".mobile-slider-js").slick('refresh');
            }
            $(".active-tab-mobile-text").html($('.tab-mobile-link.active').text());
            $('.active-tab-mobile').toggleClass("active");
            $(".tabs").slideToggle();
    });
}

$(document).ready(function() {
    // Добавление онлайн записи в модалку
    $('.appointment-online-inner').append('<iframe class="appointment-online" src="https://booking.lakmus.org/?client=rishon&defaultAppointmentType=appointment&defaultPaymentSource=inclinic" frameborder="0" allowtransparency="true" width="100%" height="100%" style="display: block;"></iframe>');
    // отображение кнопки после добавления онлай записи в модалку
    $('.appointment-online-btn').addClass('visible');

    if($('.hirurgiya-page').length) {
        setTimeout(function(){
          $.magnificPopup.open({items: {src: '#popup-info'},type: 'inline'}, 0);
        }, 2000);
    }

    // swipe for magnific-popup
    if($('.popup-gallery').length) {
        $("body").swipe({
            swipeLeft: function(event, direction, distance, duration, fingerCount) {
                $(".mfp-arrow-right").magnificPopup("next");
            },
            swipeRight: function() {
                $(".mfp-arrow-left").magnificPopup("prev");
            },
            threshold: 50
        });
    }


    if($('.specialists-experience').length) {
        $('.specialists-experience').matchHeight({
            byRow: false,
        });
    }

    // scrollTop
    $('.up_button').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
    });

    $('.burger-menu').on('click', function() {
       $('.menu__icon').toggleClass('open');
       $('.header-menu').toggleClass('open');
       $('body').toggleClass('overflow');
       $('html').toggleClass('not-overflow');
   });

   $(document).on('click', '.header-menu.open', function() {
       $('.menu__icon').removeClass('open');
       $('.header-menu').removeClass('open');
       $('body').removeClass('overflow');
       $('html').removeClass('not-overflow');
   });

   $('.header-menu-wrap').on('click', function(e) {
       e.stopPropagation();
   })

    ///admin img
    var adminImg = document.querySelectorAll(".description");
    if (adminImg) {
        Array.prototype.forEach.call(adminImg, function (wrapper, i) {
            var images = wrapper.querySelectorAll("img");
            if (images) {
                Array.prototype.forEach.call(images, function (img, i) {
                    const float = img.style.float;
                    if (float == "left") img.classList.add("margin-left-none");
                    else if (float == "right") img.classList.add("margin-right-none");
                });
            }
        });
    };

    // tabs
    if ($('.price-page').length) {
        initPriceTabs();
    }

    if ($('.search_page').length || $('.offers-tab').length) {
        initSearchTabs();
    }

    $(".active-tab-mobile").click(function (e) {
        $(this).toggleClass("active");
        $(".tabs").slideToggle();
    })

    // selectric init
    if($('.selectric').length) {
        $('.selectric').selectric({
            disableOnMobile: false,
            nativeOnMobile: false,
        })
    }

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

    // open all diploms
    if($('.all_diploms_js').length) {
        $('.all_diploms_js').click(function(e) {
            var diploms_list = $(this).prev();
            diploms_list.find('.gallery-item:not(.visible)').slideToggle(function() {
                diploms_list.find('a:not(.visible)').toggleClass('hide');
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

    //  description spoiler
    if($('.spoiler').length) {
        $('.spoiler').on('click', function(e) {
            var submenu = $(this).find('.spoiler-content');
            var icon =  $(this).find('.spoiler-toggle');
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
        // for header submenu services
        if(!$('.has-submenu-services .header-menu-link').hasClass('header-menu-link-js')) {
            $('.has-submenu-services .header-menu-link').addClass('header-menu-link-js');

            $('.header-menu-link-js').on('click', function(e) {
                e.stopPropagation();
                e.preventDefault();
                var submenu = $(this).closest('.has-submenu-services').find('.header-submenu-services-wrap');
                 if(!$(this).hasClass('active')) {
                     $(this).addClass('active');
                     submenu.slideDown(200);
                 } else {
                     $(this).removeClass('active');
                     submenu.slideUp(200);
                 }
            });
        }

        if(!$('.header-submenu-services-title').hasClass('submenu-services-js')) {
            $('.header-submenu-services-title').addClass('submenu-services-js');

            $('.submenu-services-js').on('click', function(e) {
                var submenu = $(this).closest('.header-submenu-services-item').find('.header-submenu-services-list');
                $(this).toggleClass('active');
                if($(this).hasClass('active')) {
                    submenu.slideDown(200);
                } else {
                    submenu.slideUp(200);
                }
            })
        }


        // remove position sticky with overflow hidden
        if($('.sticky-with-hiden').length) {
            var elements = $('.sticky-with-hiden');
            Stickyfill.remove(elements);
        }

        if($('.unit-block-img').length) {
            var unitImg = $('.unit-block-img-wrap .unit-block-img');
            unitImg.insertAfter( $( ".unit-block-title-js" ) );
        }

        if($('.scroll-js').length) {
            if ($('.scroll-js').hasClass('mCustomScrollbar')) {
                $('.scroll-js').mCustomScrollbar("destroy");
            }
        }

        if($('.tabs').length) {
            $('.tabs').each(function() {
                var li = $(this).find('li').removeClass('tab-link').addClass('tab-mobile-link');
                if (li.hasClass('active')) {

                } else {
                    var active_tab = $(this).find('.tab-mobile-link').first();
                    var tabs_container = $(this).closest('.tabs-container');
                    var selectTab = active_tab.attr('data-tab');
                    active_tab.addClass('active');
                }
            });
            $(".active-tab-mobile-text").html($('.tab-mobile-link.active').text());
        }


    } else {
        // for header submenu services
        if($('.has-submenu-services .header-menu-link').hasClass('header-menu-link-js')) {
            $('.header-menu-link-js').unbind('click');
            $('.has-submenu-services .header-menu-link').removeClass('header-menu-link-js active');
            $('.header-submenu-services-wrap').css('display', '');
        }

        if($('.header-submenu-services-title').hasClass('submenu-services-js')) {
            $('.submenu-services-js').unbind('click');
            $('.header-submenu-services-title').removeClass('submenu-services-js');
            $('.header-submenu-services-list').css('display', '');
        }

        $('.header-submenu-services-title').unbind('click');

        // position sticky with overflow hidden
        if($('.sticky-with-hiden').length) {
            Stickyfill.forceSticky();
            var elements = $('.sticky-with-hiden');
            Stickyfill.add(elements);
        }

        if($('.unit-block-img').length) {
            var unitImg = $('.unit-block-info .unit-block-img');
            unitImg.appendTo( $( ".sticky" ) );
        }

        // destroy custom scroll filter block

         if($('.scroll-js').length) {
             if ($('.scroll-js').hasClass('mCS_destroyed')) {
                 initScrollbar();
             }
         }

         if($('.tabs').length) {
             $('.tabs').css('display', '');
             $('.tabs').each(function() {
                 var li = $(this).find('li').removeClass('tab-mobile-link').addClass('tab-link');
                 if (li.hasClass('active')) {

                 } else {
                     var active_tab = $(this).find('.tab-link').first();
                     var tabs_container = $(this).closest('.tabs-container');
                     var selectTab = active_tab.attr('data-tab');
                     active_tab.addClass('active');
                 }
             });
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

    if (window.innerWidth < 401) {
        // отключение расчета выстоты
        if ($('.special-action-info').length) {
            $('.special-action-info').matchHeight({ remove: true });
        }
    } else {
        // Расчет выстоты
        if ($('.special-action-info').length && !$('.special-action-info').attr('style')) {
            $('.special-action-info').matchHeight();
        }
    }
});


// scroll-btn
$(window).on('load scroll', function(){
    if ($(this).scrollTop() > 100) {
         $('.up_button').addClass("visible").fadeIn();
    } else {
         $('.up_button').removeClass("visible").fadeOut();
    };
});
