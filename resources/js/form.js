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
                labelText.text('Загрузить фото');
                labelRemove.hide();
            } else if ($('html').attr('lang')=='uk') {
                labelText.text('Завантажити фото');
                labelRemove.hide();
            } else {
                labelText.text('Upload a photo');
                labelRemove.hide();
            }
        }
    });

    $('.label-remove').click(function(e) {
        var labelText = $(this).closest('.input-file-inner-wrap').find('.label-text');
        var labelRemove = $(this).closest('.input-file-inner-wrap').find('.label-remove');
        var input = $(this).closest('.input-file-inner-wrap').find('.input-file');
        if ($('html').attr('lang')=='ru') {
            labelText.text('Загрузить фото');
        } else if ($('html').attr('lang')=='uk') {
            labelText.text('Завантажити фото');
        } else {
            labelText.text('Upload a photo');
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
                    $('.label-text').text('Загрузить фото');
                } else if ($('html').attr('lang')=='uk') {
                    $('.label-text').text('Завантажити фото');
                } else {
                    $('.label-text').text('Upload a photo');
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

    // validate form callback
    $(".do_callback_form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.callback_form');
        formCallbackValidate(formVal);
        formVal.submit();
    });
    function formCallbackValidate(form) {
        form.validate({
            submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $(form).serialize();
              $(form)[0].reset();
              $.ajax({
                url: routes.postSend,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                    "subj": "callback"
                },
                success: function(data) {
                    $(form).hide();
                    $(form).next('.form-thanks').show();
                    function hidePopup(){
                        $.magnificPopup.close();
                    }
                    function showForm(){
                        $(form).next('.form-thanks').hide();
                        $(form).show();
                    }
                    setTimeout( hidePopup ,5000);
                    setTimeout( showForm ,5000);
                }
              });
            }
        });
    }

    // validate form feedback
    $(".do_feedback_form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.feedback_form');
        formFeedbackValidate(formVal);
        formVal.submit();
    });
    function formFeedbackValidate(form) {
        form.validate({
            submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $(form).serialize();
              $(form)[0].reset();
              $.ajax({
                url: routes.postSend,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                    "subj": "feedback"
                },
                success: function(data) {
                    $(form).hide();
                    $(form).next('.form-thanks').show();
                    function showForm(){
                        $(form).next('.form-thanks').hide();
                        $(form).show();
                    }
                    setTimeout( showForm ,5000);
                }
              });
            }
        });
    }

    // new-post-form start
    function formValidateNewPost(form) {
        form.validate({
            submitHandler: function(form) {
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                var formdata = $(form).serialize();
                $(form)[0].reset();
                $.ajax({
                    url: routes.postSend,
                    type: 'POST',
                    data: {
                        "_token" : csrf_token,
                        "data": formdata,
                        "subj": "subscription"
                    },
                    success: function(data) {
                        $(form).hide();
                        $(form).next('.form-thanks').show();
                        function showForm(){
                            $(form).next('.form-thanks').hide();
                            $(form).show();
                        }
                        setTimeout( showForm ,5000);
                    }
                })
            }
        });
    };
    $(".do-new-post-form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.new-post-form');
        formValidateNewPost(formVal);
        formVal.submit();
    });
    // new-post-form end

    // Registration for a service
    $(".do_appointment_form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.appointment_form');
        formAppointmentValidate(formVal);
        formVal.submit();
    });
    function formAppointmentValidate(form) {
        form.validate({
            submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $(form).serialize();
              $(form)[0].reset();
              $.ajax({
                url: routes.postSend,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                    "subj": "appointment"
                },
                success: function(data) {
                    $(form).hide();
                    $(form).next('.form-thanks').show();
                    function hidePopup(){
                        $.magnificPopup.close();
                    }
                    function showForm(){
                        $(form).next('.form-thanks').hide();
                        $(form).show();
                    }
                    setTimeout( hidePopup ,5000);
                    setTimeout( showForm ,5000);
                }
              });
            }
        });
    };

    // Registration for a service
    $(".do_registration_form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.registration_form');
        formRegistrationValidate(formVal);
        formVal.submit();
    });
    function formRegistrationValidate(form) {
        form.validate({
            submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $(form).serialize();
              $(form)[0].reset();
              $.ajax({
                url: routes.postSend,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                    "subj": "appointment"
                },
                success: function(data) {
                    $('#appointment').find('.popup-sub-name').text();
                    $('#appointment').find('input[name=appointment]').val('');
                    $('#appointment').find('input[name=specialist]').val('');
                    $('.select-appointment-specialist').prop('selectedIndex', 0).selectric('refresh');
                    $(form).hide();
                    $(form).next('.form-thanks').show();
                    function hidePopup(){
                        $.magnificPopup.close();
                    }
                    function showForm(){
                        $(form).next('.form-thanks').hide();
                        $(form).show();
                    }
                    setTimeout( hidePopup ,5000);
                    setTimeout( showForm ,5000);
                }
              });
            }
        });
    };



    // Registration for specialist
    $(".do_specialist_form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.specialist_form');
        formRegistrationSpecialistValidate(formVal);
        formVal.submit();
    });
    function formRegistrationSpecialistValidate(form) {
        form.validate({
            submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $(form).serialize();
              $(form)[0].reset();
              $.ajax({
                url: routes.postSend,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                    "subj": "specialist"
                },
                success: function(data) {
                    $(form).hide();
                    $(form).next('.form-thanks').show();
                    function hidePopup(){
                        $.magnificPopup.close();
                    }
                    function showForm(){
                        $(form).next('.form-thanks').hide();
                        $(form).show();
                    }
                    setTimeout( hidePopup ,5000);
                    setTimeout( showForm ,5000);
                }
              });
            }
        });
    };

    // validate question_service_form
    $(".do_question_form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.question_form');
        formQuestionServiceValidate(formVal);
        formVal.submit();
    });
    function formQuestionServiceValidate(form) {
        form.validate({
            submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $(form).serialize();
              $(form)[0].reset();
              $.ajax({
                url: routes.postSend,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                    "subj": "question"
                },
                success: function(data) {
                    $('#question').find('.popup-sub-name').text();
                    $('#question').find('input[name=appointment]').val('');
                    $('.select-question').prop('selectedIndex', 0).selectric('refresh');
                    $(form).hide();
                    $(form).next('.form-thanks').show();
                    function hidePopup(){
                        $.magnificPopup.close();
                    }
                    function showForm(){
                        $(form).next('.form-thanks').hide();
                        $(form).show();
                    }
                    setTimeout( hidePopup ,5000);
                    setTimeout( showForm ,5000);
                }
              });
            }
        });
    }

    $(".do_chekup_form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.chekup_form');
        formChekupValidate(formVal);
        formVal.submit();
    });
    function formChekupValidate(form) {
        form.validate({
            submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $(form).serialize();
              $(form)[0].reset();
              $.ajax({
                url: routes.postSend,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                    "subj": "chekup"
                },
                success: function(data) {
                    $(form).hide();
                    $(form).next('.form-thanks').show();
                    function hidePopup(){
                        $.magnificPopup.close();
                    }
                    function showForm(){
                        $(form).next('.form-thanks').hide();
                        $(form).show();
                    }
                    setTimeout( hidePopup ,5000);
                    setTimeout( showForm ,5000);
                }
              });
            }
        });
    };

    $(".do_consultation_form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.consultation_form');
        formConsultationValidate(formVal);
        formVal.submit();
    });
    function formConsultationValidate(form) {
        form.validate({
            submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $(form).serialize();
              $(form)[0].reset();
              $.ajax({
                url: routes.postSend,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                    "subj": "consultation"
                },
                success: function(data) {
                    $(form).hide();
                    $(form).next('.form-thanks').show();
                    function hidePopup(){
                        $.magnificPopup.close();
                    }
                    function showForm(){
                        $(form).next('.form-thanks').hide();
                        $(form).show();
                    }
                    setTimeout( hidePopup ,5000);
                    setTimeout( showForm ,5000);
                }
              });
            }
        });
    };



    $('.online-consultation-form').validate({
        submitHandler: function(form) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var formdata = $('.online-consultation-form').serialize();
            $('.online-consultation-form')[0].reset();
            $.ajax({
                url: routes.postSend,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                    "subj": "onlinereview"
                },
                success: function(data) {
                    $('.online-consultation-form').hide();
                    $('.online-consultation-form').next('.form-thanks').show();
                    function showForm(){
                        $('.online-consultation-form').next('.form-thanks').hide();
                        $('.online-consultation-form').show();
                    }
                    setTimeout( showForm ,5000);
                }
            })
        }
    });

    $(".do-online-consultation").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.online-consultation-form');
        formValidateNewPost(formVal);
        formVal.submit();
    });

    // cabinet
    $(".registration-form").validate({
          submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $(".registration-form").serialize();
              $.ajax({
                  url: routes.postRegister,
                  type: 'POST',
                  data: {
                      "_token" : csrf_token,
                      "data": formdata,
                  },
                  success: function(data) {
                      switch (data) {
                        case "email":
                            $(".registration-form .auth-error").slideDown(200);
                            break;
                        case "deleted":
                            $(".registration-form .auth-del").slideDown(200);
                            break;
                        case "success":
                            window.location.href = window.location.origin + "/cabinet/";
                            break
                      }
                  }
              })
          }
    });
    $('.do_registration-form').click(function(e) {
        e.preventDefault();
        $(".registration-form").submit()
    });

    $(".reset-form").validate({
        submitHandler: function(form) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var formdata = $(".reset-form").serialize();
            $.ajax({
                url: routes.postPassword,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                },
                success: function(data) {
                    switch (data) {
                        case "no_email":
                            $(".reset-form .auth-error").slideDown(200);
                            $(".reset-form .auth-restored").slideUp(200);
                            break;
                        case "success":
                            $(".reset-form .auth-restored").slideDown(200);
                            $(".reset-form.auth-error").slideUp(200);
                            break
                    }
                }
            });
        }
    });
    $(".do_reset-form").click(function(e) {
        e.preventDefault();
        $(".reset-form").submit()
    });


    $(".login-form").validate({
        submitHandler: function(form) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var formdata = $(".login-form").serialize();
            $.ajax({
                url: routes.postLogin,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                },
                success: function(data) {
                    switch (data) {
                        case "wrong_pass":
                            $(".login-form .auth-error").slideDown(200);
                            break;
                        case "success":
                            window.location.reload(true);
                            break
                    }
                }
            });
        }
    });

    $(".do_login-form").click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        $(".login-form").submit();
    });

    $(".a-logout").click(function(e) {
      e.stopPropagation();
      e.preventDefault();
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
          url: routes.postLogout,
          type: 'POST',
          data: {
              "_token" : csrf_token,
          },
          success: function(data) {
              switch (data) {
                  case "success":
                    var href = window.location.href;
                    var return_href = href.split('#')[0];

                      window.location.href = return_href;
                      break
              }
          }
      });
    });


    // Registration for Test
    $(".do_appointment_test").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.appointment_test');
        formAppointmentTestValidate(formVal);
        formVal.submit();
    });
    function formAppointmentTestValidate(form) {
        form.validate({
            submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $(form).serialize();
              $(form)[0].reset();
              $.ajax({
                url: routes.postSend,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                    "subj": "test"
                },
                success: function(data) {
                    $(form).hide();
                    $(form).next('.form-thanks').show();
                    function hidePopup(){
                        $.magnificPopup.close();
                    }
                    function showForm(){
                        $(form).next('.form-thanks').hide();
                        $(form).show();
                    }
                    setTimeout( hidePopup ,5000);
                    setTimeout( showForm ,5000);
                }
              });
            }
        });
    };

    // Registration for vaccination
    $(".do_vaccination_form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        var formVal = $(this).closest('.vaccination_form');
        formAppointmentVaccinationValidate(formVal);
        formVal.submit();
    });
    function formAppointmentVaccinationValidate(form) {
        form.validate({
            submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $(form).serialize();
              $(form)[0].reset();
              $.ajax({
                url: routes.postSend,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    "data": formdata,
                    "subj": "vaccination"
                },
                success: function(data) {
                    $(form).hide();
                    $(form).next('.form-thanks').show();
                    function hidePopup(){
                        $.magnificPopup.close();
                    }
                    function showForm(){
                        $(form).next('.form-thanks').hide();
                        $(form).show();
                    }
                    setTimeout( hidePopup ,5000);
                    setTimeout( showForm ,5000);
                }
              });
            }
        });
    };

    // corporate_form
    $(".do_corporate_form").click(function(e) {
        e.stopPropagation();
        e.preventDefault();
        $(".corporate_form").submit();
    });
    $(".corporate_form").validate({
        submitHandler: function(form) {
          var csrf_token = $('meta[name="csrf-token"]').attr('content');
          var formdata = $(form).serialize();
          $(form)[0].reset();
          $.ajax({
            url: routes.postSend,
            type: 'POST',
            data: {
                "_token" : csrf_token,
                "data": formdata,
                "subj": "corporate"
            },
            success: function(data) {
                $(form).hide();
                $(form).next('.form-thanks').show();
                function showForm(){
                    $(form).next('.form-thanks').hide();
                    $(form).show();
                }
                setTimeout( showForm ,5000);
            }
          });
        }
    });

});


// for landing

// question a service
$(".do_question_services").click(function(e) {
    e.stopPropagation();
    e.preventDefault();
    $(".question_services_form").submit();
});

$(".question_services_form").validate({
    submitHandler: function(form) {
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      var formdata = $(form).serialize();
      $(form)[0].reset();
      $.ajax({
        url: routes.postSend,
        type: 'POST',
        data: {
            "_token" : csrf_token,
            "data": formdata,
            "subj": "landing_question_services"
        },
        success: function(data) {
            $('#question-services').find('input[name=services_id]').val('');
            $('.select-question-services').prop('selectedIndex', 0).selectric('refresh');
            $(form).hide();
            $(form).next('.form-thanks').show();
            function hidePopup(){
                $.magnificPopup.close();
            }
            function showForm(){
                $(form).next('.form-thanks').hide();
                $(form).show();
            }
            setTimeout( hidePopup ,5000);
            setTimeout( showForm ,5000);
        }
      });
    }
});


$(".do_appointment_services").click(function(e) {
    e.stopPropagation();
    e.preventDefault();
    $(".appointment_services_form").submit();
});

$(".appointment_services_form").validate({
    submitHandler: function(form) {
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      var formdata = $(form).serialize();
      $(form)[0].reset();
      $.ajax({
        url: routes.postSend,
        type: 'POST',
        data: {
            "_token" : csrf_token,
            "data": formdata,
            "subj": "landing_appointment_services"
        },
        success: function(data) {
            $('#appointment-services').find('input[name=appointment_services_id]').val('');
            $('.select-appointment-services').prop('selectedIndex', 0).selectric('refresh');
            $(form).hide();
            $(form).next('.form-thanks').show();
            function hidePopup(){
                $.magnificPopup.close();
            }
            function showForm(){
                $(form).next('.form-thanks').hide();
                $(form).show();
            }
            setTimeout( hidePopup ,5000);
            setTimeout( showForm ,5000);
        }
      });
    }
});

$(".do_personal_ranslator").click(function(e) {
    e.stopPropagation();
    e.preventDefault();
    $(".personal_ranslator_form").submit();
});

$(".personal_ranslator_form").validate({
    submitHandler: function(form) {
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      var formdata = $(form).serialize();
      $(form)[0].reset();
      $.ajax({
        url: routes.postSend,
        type: 'POST',
        data: {
            "_token" : csrf_token,
            "data": formdata,
            "subj": "landing_personal_ranslator"
        },
        success: function(data) {
            $(form).hide();
            $(form).next('.form-thanks').show();
            function hidePopup(){
                $.magnificPopup.close();
            }
            function showForm(){
                $(form).next('.form-thanks').hide();
                $(form).show();
            }
            setTimeout( hidePopup ,5000);
            setTimeout( showForm ,5000);
        }
      });
    }
});


$(".do_landing_question").click(function(e) {
    e.stopPropagation();
    e.preventDefault();
    $(".landing_question_form").submit();
});

$(".landing_question_form").validate({
    submitHandler: function(form) {
      var csrf_token = $('meta[name="csrf-token"]').attr('content');
      var formdata = $(form).serialize();
      $(form)[0].reset();
      $.ajax({
        url: routes.postSend,
        type: 'POST',
        data: {
            "_token" : csrf_token,
            "data": formdata,
            "subj": "landing_question"
        },
        success: function(data) {
            $('#landing-question').find('.popup-sub-name').text();
            $('#landing-question').find('input[name=landing_question_id]').val('');
            $(form).hide();
            $(form).next('.form-thanks').show();
            function hidePopup(){
                $.magnificPopup.close();
            }
            function showForm(){
                $(form).next('.form-thanks').hide();
                $(form).show();
            }
            setTimeout( hidePopup ,5000);
            setTimeout( showForm ,5000);
        }
      });
    }
});
