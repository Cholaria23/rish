$(document).ready(function() {
    $(function () {
    	$('.popup-js').magnificPopup({
    		fixedContentPos: true,
    	});
    });

    $('.popup-js').click(function () {
        var popup = $(this).attr('href');
        setTimeout(function() {
            $(popup).find(".input-form")[0].focus();
        }, 300)
    });

    $('.appointment-btn-js').click(function () {
        var text = $(this).attr('data-subtitle');
        $('#appointment').find('.popup-sub-name').text(text);
        $('#appointment').find('input[name=appointment]').val(text);
    });

    $(document).on('change', '.select-appointment-specialist', function(e) {
        var selectAppointmentSpecialist = $(".select-appointment-specialist option:selected").text();
        $('#appointment').find('input[name=specialist]').val(selectAppointmentSpecialist);
    });

    $('.specialist-btn-js').click(function () {
        var text = $(this).attr('data-subtitle');
        $('#specialist').find('.popup-sub-name').text(text);
        $('#specialist').find('input[name=appointment]').val(text);
    });

    $('.question-btn-js').click(function () {
        var text = $(this).attr('data-subtitle');
        $('#question').find('.popup-sub-name').text(text);
        $('#question').find('input[name=appointment]').val(text);
    });

    $(document).on('change', '.select-question', function(e) {
        var selectQuestionText = $(".select-question option:selected").text();
        $('#question').find('input[name=appointment]').val(selectQuestionText);
    });

})
