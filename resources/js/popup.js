$(document).ready(function() {

    $(function () {
    	$('.popup-modal').magnificPopup({
    		fixedContentPos: true,
    	});

    	$(document).on('click', '.popup-modal-close', function (e) {
    		e.preventDefault();
    		$.magnificPopup.close();
    	});
    });
})
