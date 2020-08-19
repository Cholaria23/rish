$(document).ready(function() {
    $(function () {
    	$('.popup-js').magnificPopup({
    		fixedContentPos: true,
    	});

    	$(document).on('click', '.popup-close-js', function (e) {
    		e.preventDefault();
    		$.magnificPopup.close();
    	});
    });
})
