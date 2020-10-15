$(document).ready(function() {
    $(function () {
    	$('.popup-js').magnificPopup({
    		fixedContentPos: true,
    	});
    });

    $('.popup-js').not('.appointment-online-btn').click(function () {
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

    $('.landing-question-js').click(function () {
        var text = $(this).attr('data-subtitle');
        $('#landing-question').find('.popup-sub-name').text(text);
        $('#landing-question').find('input[name=landing_question_id]').val(text);
    });

    $(document).on('change', '.select-appointment-specialist', function(e) {
        var selectAppointmentSpecialist = $(".select-appointment-specialist option:selected").text();
        $('#appointment').find('input[name=specialist]').val(selectAppointmentSpecialist);
    });

    $(document).on('change', '.select-question-services', function(e) {
        var selectLandingQuestionServices = $(".select-question-services option:selected").text();
        $('#question-services').find('input[name=services_id]').val(selectLandingQuestionServices);
    });

    $(document).on('change', '.select-appointment-services', function(e) {
        var selectLandingAppointmentServices = $(".select-appointment-services option:selected").text();
        $('#appointment-services').find('input[name=appointment_services_id]').val(selectLandingAppointmentServices);
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
