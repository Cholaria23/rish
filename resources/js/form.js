$(document).ready( function() {
    // Inputmask
    Inputmask({
        mask: '+38 (999) 999-99-99',
        clearMaskOnLostFocus: true,
        clearIncomplete: true,
        showMaskOnHover: false,
    }).mask('input[type=tel]');

    // validate form review start
    $('.input-file').change(function(e) {
        $('.error-file-info').hide();
        $('.max-size').hide();
        var maxFileSize = 5 * 1024 * 1024;
        var fileInputSize = e.target.files[0].size;
        var fileInput = $(this).closest('.input-file-inner-wrap').find('.input-file');
        var labelText = $(this).closest('.input-file-inner-wrap').find('.label-text');
        var labelRemove = $(this).closest('.input-file-inner-wrap').find('.label-remove');
        var parent = $(this).closest('.input-file-inner-wrap');
        if ($(this).val() != '') {
            if (fileInputSize > maxFileSize) {
                $('.error-file-info').show();
                $('.max-size').show();
                fileInput.val('');
            } else {
                var fileName = e.target.files[0].name;
                labelText.text(fileName);
                labelRemove.show();
                parent.next('.input-file-inner-wrap').css('display', 'flex');
            }
        } else {
            if ($('html').attr('lang')=='ru') {
                labelText.text('Выберите файлы');
                labelRemove.hide();
            } else {
                labelText.text('Виберіть файли');
                labelRemove.hide();
            }
        }
    });

    $('.label-remove').click(function(e) {
        var labelText = $(this).closest('.input-file-inner-wrap').find('.label-text');
        var labelRemove = $(this).closest('.input-file-inner-wrap').find('.label-remove');
        var input = $(this).closest('.input-file-inner-wrap').find('.input-file');
        if ($('html').attr('lang')=='ru') {
            labelText.text('Выберите файлы');
        } else {
            labelText.text('Виберіть файли');
        }
        labelRemove.hide();
        input.val('');
        if(!$(this).parent().next('.input-file-inner-wrap').find('.input-file').val() ) {
            $(this).parent().next('.input-file-inner-wrap').css('display', 'none');
        }
    })


    var item = $('.review_form');
    function sendTextFields(item, formdata, file = '') {
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var dataForm;
        if (file != '') {
            dataForm = {
                data: formdata,
                file: file,
                _token : csrf_token,
                subj: 'review',
            }
        } else {
            dataForm = {
                data: formdata,
                _token : csrf_token,
                subj: 'review',
            };
        };
        $.ajax({
            url: routes.postSend,
            type: 'POST',
            data: dataForm,
            success: function(data) {
                $(item)[0].reset();
                if ($('html').attr('lang')=='ru') {
                    $('.label-text').text('Выберите файлы');
                } else if ($('html').attr('lang')=='uk') {
                    $('.label-text').text('Виберіть файли');
                } else {
                    $('.label-text').text('Select files');
                }
                $('.input-file-inner-wrap').not(':eq(0)').css('display', 'none');
                $('.label-remove').hide();
                $('.form-thanks').show();
                function showForm(){
                    $('.form-thanks').hide();
                }
                setTimeout( showForm ,5000);
            }
        })
    };

    function formReviewValidate(form) {
        form.validate({
            submitHandler: function(form) {
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                var formdata = $(form).serialize();
                if (document.getElementById('input-file-1').files.length || document.getElementById('input-file-2').files.length) {
                    var inputs = $('.input-file');
                    let $data = {};
                    for (let i = 0; i < inputs.length; i++) {
                        let element = inputs[i];
                        let next_el = (inputs[i + 1]) ? (inputs[i + 1]) : null;
                        if (element != null && element.files.length) {
                            let reader = new FileReader();
                            reader.onload = function () {
                                let key = 'file_' + i;
                                let value = reader.result;
                                $data[key] = value;
                                if (next_el == null || !next_el.files.length) {
                                    setTimeout(function () {
                                        $.ajax({
                                            type: 'POST',
                                            url: routes.postLoadFile,
                                            data: {
                                                "_token": csrf_token,
                                                "data": $data,
                                            },
                                            success: function (response) {
                                                var uploadedFile = response.file_name;
                                                sendTextFields(item, formdata, uploadedFile);
                                            },
                                            error: function (response) {},
                                        });
                                    }, 100);
                                }
                            };
                            reader.readAsDataURL(inputs[i].files[0]);
                        }
                    }
                } else {
                    sendTextFields(item, formdata);
                }
            }
        });
    }

    $(".do_review_form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();

        var formVal = $(this).closest('.review_form');
        formReviewValidate(formVal);
        formVal.submit();
    });

    // validate form review end

});
