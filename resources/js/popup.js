$(document).ready(function() {
    $(function () {
    	$('.popup-js').magnificPopup({
    		fixedContentPos: true,
    	});

    	// $(document).on('click', '.popup-close-js', function () {
    	// 	$.magnificPopup.close();
    	// });
    });

    $('.popup-js').click(function () {
        var popup = $(this).attr('href');
        console.log(popup);
        setTimeout(function() {
            $(popup).find(".input-form")[0].focus();
        }, 300)
    })

    $('.appointment-btn-js').click(function () {
        var text = $(this).attr('data-subtitle');
        $('#appointment').find('.popup-sub-name').text(text);
        $('#appointment').find('input[name=appointment]').val(text);
    })
})
