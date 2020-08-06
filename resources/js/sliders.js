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
