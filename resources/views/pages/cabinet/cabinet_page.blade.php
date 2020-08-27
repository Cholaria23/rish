@extends('layouts.main.wrapper')

@section('page')
    <div class="cabinet-page section-cabinet">
        @include('layouts.main.breadcrumbs')
        <div class="container">
            <div class="page-section-top-title">
                @lang('cabinet.page_title')
            </div>
            <section class="main-section">
                <div class="cabinet-tab-wrap">
                    <div class="tabs-container">
                        <ul id='myTab' class="cabinet-tabs">
                            <li class="tab_nav tab-link" data-tab="wish_lists">
                                <a data-section='wish_lists' class='tab_a' href='#tab_wish_lists'>
                                    @lang('cabinet.tab_menu.wish_lists')
                                    <span class='pull-right'></span>
                                </a>
                                <svg class="flex-svg" >
                                    <use xlink:href="#more-icon"></use>
                                </svg>
                            </li>
                            <li class="tab_nav tab-link" data-tab="personal_data">
                                <a data-section='personal_data' class='tab_a' href='#tab_personal_data'>
                                    @lang('cabinet.tab_menu.personal_data')
                                </a>
                                <svg class="flex-svg">
                                    <use xlink:href="#more-icon"></use>
                                </svg>
                            </li>
                            <li class="tab_logout">
                                <a href="" class="cabinet-link a-logout">
                                    @lang('cabinet.logout')
                                </a>
                            </li>
                        </ul>
                        <div class="tab_logout tab_logout--mobile">
                            <a href="" class="cabinet-link a-logout">
                                @lang('cabinet.logout')
                            </a>
                        </div>
                        <div class="tab-content-wrap">
                            <div class="accordion-link tab_nav" data-accord="personal_data">
                                <div data-section='personal_data' class='tab_a'>
                                    @lang('cabinet.tab_menu.personal_data')
                                    <svg class="flex-svg">
                                        <use xlink:href="#more-icon"></use>
                                    </svg>
                                </div>
                            </div>
                            <div class="tab-content" data-id="personal_data" >
                                {{-- Персональные данные  --}}
                                @include('pages.cabinet.personal_data')
                                {{--Персональные данные  --}}
                            </div>
                            <div class="accordion-link tab_nav" data-accord="wish_lists">
                                <div data-section='wish_lists' class='tab_a'>
                                    @lang('cabinet.tab_menu.wish_lists')
                                    <svg class="flex-svg">
                                        <use xlink:href="#more-icon"></use>
                                    </svg>
                                </div>
                            </div>
                            <div class="tab-content" data-id="wish_lists" >
                                {{--Список желаний --}}
                                @include('pages.cabinet.wish_list')
                                {{--Список желаний --}}
                            </div>
                            {{-- <div class="accordion-link tab_nav" data-accord="orders">
                            <div data-section='orders' class='tab_a'>
                            @lang('cabinet.tab_menu.my_orders')
                            <svg class="flex-svg">
                            <use xlink:href="#more-icon"></use>
                        </svg>
                        </div>
                        </div> --}}
                        <div class="tab-content" data-id="orders" >
                            {{-- Мои заказы --}}
                            @include('pages.cabinet.my_orders')
                            {{-- Мои заказы --}}
                        </div>
                        <!-- <div class="accordion-link tab_nav" data-accord="viewed_goods">
                        <div data-section='viewed_goods' class='tab_a'>
                        @lang('cabinet.tab_menu.viewed_two')
                        <svg class="flex-svg" width="19" height="19">
                        <use xlink:href="#more-icon"></use>
                        </svg>
                        </div>
                        </div>
                        <div class="tab-content" id="viewed_goods" >
                        {{--Просмотренные товары  --}}
                        {{--  @include('pages.cabinet.viewed_goods') --}}
                        {{--Просмотренные товары  --}}
                        </div> -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop
@section('links')
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />
  <link rel="stylesheet" type="text/css" href="css/alertify.core.css" />
  <link rel="stylesheet" type="text/css" href="css/alertify.default.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-editable.css" />
  <style type="text/css">
        .editable-empty { color: #999; }
        .editable-empty:hover { color: #666; }
    </style>
@stop
@section('scripts')
  <script src="js/alertify.min.js"></script>
    <script>
        $(window).on("load", function() {
          $(window).trigger('scroll');
        });

        function initTabs_to_accordeon() {
          if($('.cabinet-tabs').length) {
            $('.cabinet-tabs').each(function() {
              var active_tab = $(this).find('.tab-link').first();
              var tabs_container = $(this).closest('.tabs-container');
              var selectTab = active_tab.attr('data-tab');
              active_tab.addClass('active');
              tabs_container.find('.tab-content').hide();
              $("[data-id='"+selectTab+"']").show();
              $(".accordion-link[data-accord^='" + selectTab + "']").addClass("active");
            });

            $('.cabinet-tabs li').click(function(e) {
              var parent = $(this).closest('.tabs-container');
              var selectTab = $(this).attr('data-tab');
              parent.find('.cabinet-tabs li').removeClass('active');
              $(this).addClass('active');
              parent.find('.tab-content').hide();
              $("[data-id='"+selectTab+"']").show();
            });

            $(".accordion-link").on("click", function() {
              var d_activeTab = $(this).attr("data-accord");
              if($(this).hasClass('active')) {
                $("[data-id='"+d_activeTab+"']").slideUp(200);
                $(this).removeClass("active");
                return;
              };

              var topPosition = $('.tab-content-wrap').position().top;
              // $('html, body').animate({
              //     scrollTop: topPosition
              // }, 1000);
              $("[data-id='"+d_activeTab+"']").slideDown(200);
              $(".accordion-link").removeClass("active");
              $(this).addClass("active");
              $(".tab-link").removeClass("active");
              $(".tab-link[data-tab^='" + d_activeTab + "']").addClass("active");
            });
          }
        }

        $(document).ready(function(){
          //  tabs to accordeon
          initTabs_to_accordeon();

          $('#myTab a').click(function (e) {
            e.preventDefault();
          });

          $('.phone-editable').on('shown', function(e, editable) {
                var el = $(this).next('.popover').find('input');
                var new_id = 'contact_phone_'+$(this).attr('data-id');
                el.attr('id', new_id);
                Inputmask({ mask: "+38 (999) 999-99-99", placeholder:"_", clearMaskOnLostFocus: true, clearIncomplete: true}).mask('#'+new_id);
            });
          $(".bootstrap-switch").bootstrapSwitch({
                onText: '<span style="color: #FFF;" class="glyphicon glyphicon-ok"></span>',
                offText: '<span style="color: #FFF;" class="glyphicon glyphicon-remove"></span>',
                onColor: 'success',
                offColor: 'danger',
                size: 'small'
            });
          $(".user_radio").change(function (e) {
            if ($(this).is(":checked")) {
              var value = $(this).val(),
                field = $(this).attr('data-field');
              saveUser(field, value);
            }
          });
          $('#is_units_subscribe').on('change', function() {
            if ($(this).is(":checked")) {
              $('.more_subscribe_units').show(400);
            } else {
              $('.more_subscribe_units').hide(400);
            };
          });
          $('.user_checkbox').on('change', function() {
            var value = ($(this).is(":checked")) ? "1" : "0",
              field = $(this).attr('data-field');
            $.post(window.location.origin+"/service/edit-user-subscribe", { 'field' : field, 'value' : value }, function(data) {
                      alertify.success("@lang('cabinet.personal_data.saved')");
                });
          });
          $('.js-change-value').on('switchChange.bootstrapSwitch', function(event, state) {
            $.post(window.location.origin+"/service/edit-user-subscribe", { 'field' : 'is_active', 'value' : state == false ? 0 : 1 }, function(data) {
                    alertify.success("@lang('cabinet.personal_data.saved')");
                  if (state == true) {
                $('.more_subscribe').show(400);
                $('.subscr_lable').text("@lang('cabinet.personal_data.is_active')")
              } else {
                $('.more_subscribe').hide(400);
                $('.subscr_lable').text("@lang('cabinet.personal_data.is_not_active')")
              };
                });
          });
          var path = window.location.hash.substr(1);
          if (path) {
            $(".tab_nav").removeClass('active');
            $('.tab-content').removeClass('active').removeAttr('style');

            $(".tab_nav[data-tab='"+path+"']").addClass('active');
            $("[data-id='"+path+"']").addClass('active');
          } else {
            $(".tab_nav[data-tab='"+path+"']").removeClass('active');
            $("[data-id='"+path+"']").removeClass('active');
            $(".tab_a:first").addClass('selected');
            // $(".tab_a:first").tab('show');
            $("#tab_"+path).removeClass('active');
          }
          $('#myTab a').click(function (e) {
            e.preventDefault();
            window.location.hash = $(this).attr('data-section');
            // $(this).tab('show');
            // $('#myTab a').removeClass('selected');
            // $(this).addClass('selected');
            // $(window).trigger('scroll');
          });
          $(".editable").editable({
            send: "never",
          }).on('save', function(e, params) {
            var field = $(this).attr('data-field'),
              value = params.newValue;
            saveUser(field, value);
          });
          $(".editable_list").editable({
            send: "never",
          }).on('save', function(e, params) {
            var value = params.newValue;
            var id = $(this).attr('data-id');
            $.post("service/edit-wish-list", { 'id' : id, 'value' : value, 'field' : 'name' }, function(data) {
                    alertify.success("@lang('cabinet.personal_data.saved')");
                });
          });
          $("#user_lang").on('change', function() {
            saveUser("lang", $(this).children('option:selected').val());
          });
          $('.order_details').click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            $(this).closest('.order-item').next('.order-info').slideToggle(400);
            $(this).closest('.order-item').toggleClass('opened');
          });
          $('.order-item').click(function(e) {
            $(this).next('.order-info').slideToggle(400);
            $(this).toggleClass('opened');
          });
          $('.edit-field').click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            $(this).prev('a').click();
          });
          $('.order_details').click(function(e) {
            e.stopPropagation();
            e.preventDefault();
          });
          $('.order_cancel').click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            var id = $(this).attr('data-id');
            swal({
              title: "@lang('cabinet.personal_data.ask_delete')",
              text: "",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "@lang('cabinet.personal_data.yes_delete')",
              cancelButtonText: "@lang('cabinet.personal_data.no_keep')",
              closeOnConfirm: true,
              closeOnCancel: true
            },
            function(isConfirm){
              if (isConfirm) {
                $.post(window.location.origin+'/service/order-cancel', { 'id' : id }, function(data) {
                  if (data == 'ok') {
                    alertify.success("@lang('cabinet.personal_data.canceled')");
                    setTimeout(function() {
                      window.location.reload(true);
                    }, 1000);
                  }
                });
              }
            });
          });
          $('#generate_password').pGenerator({
            'bind': 'click',
            'passwordElement': '#password',
            'displayElement': '#password',
            'passwordLength': 8,
            'uppercase': true,
            'lowercase': false,
            'numbers':   true,
            'specialChars': false,
            'onPasswordGenerated': function(generatedPassword) {
              $("#password_again").val($("#password").val());
            }
          });
          $("#change_password_form").validate({
            rules: {
              password: "required",
              password_again: {
                required: true,
                equalTo: "#password"
              }
            },
            submitHandler: function(form) {
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var formdata = $("#change_password_form").serialize();
              $.ajax ({
                type:"POST",
                url:routes.postSaveUserPassword,
                data: {
                    "_token" : csrf_token,
                    "data": formdata
                },
                success: function(data) {
                  switch (data) {
                    case "wrong_password":
                      alertify.error("@lang('cabinet.personal_data.wrong_pass')");
                      break;
                    case "success":
                      alertify.success("@lang('cabinet.personal_data.saved')");
                      break
                  }
                }
              });
            }
          });
          $("#change_password").click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            $('#change_password_form').submit();
          });
          var path = $('.wish_a').attr('data-id');
          if (path) {
              $(".wish_a[data-id='"+path+"']").addClass('active');
              $(".wish_content[data-id='"+path+"']").addClass('active');
          } else {
              $(".wish_a:first").addClass('active');
              // $(".tab_a:first").tab('show');
              $(".wish_content:first").removeClass('active');
          }
          $('.wish_a').click(function (e) {
              e.preventDefault();
              var path = $(this).attr('data-id');
              $('.wish_list .wish_a').removeClass('active');
              $('.wish_inner .wish_content').removeClass('active');
              $(this).addClass('active');
              $(".wish_content[data-id='"+path+"']").addClass('active');
          });
          $(".remove_waiting_good").click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            var id = $(this).attr('data-id');
            var tr = $(this).closest('tr');
            $.post(window.location.origin+"/service/remove-waiting-good", { 'good_id' : id }, function(data) {
                    alertify.success("@lang('cabinet.personal_data.deleted')");
                    tr.remove();
                })
          });
          $(".remove_wish_good").click(function(e) {
            e.stopPropagation();
            e.preventDefault();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var good_id = $(this).attr('data-good_id');
            var list_id = $(this).attr('data-list_id');
            var tr = $(this).closest('.order-item');
            $.ajax({
                url: routes.postRemoveWishGood,
                type: 'POST',
                data: {
                    "_token" : csrf_token,
                    'good_id' : good_id,
                    'list_id' : list_id,
                },
                success: function(data) {
                    alertify.success("@lang('cabinet.wish_lists.deleted')");
                    tr.remove();
                }
            });
          });
          $(".delete-field").click(function(e) {
              e.stopPropagation();
              e.preventDefault();
              var csrf_token = $('meta[name="csrf-token"]').attr('content');
              var id = $(this).attr('data-id');
              var tab = $('.wish_a[data-id="'+id+'"]');
              var container = $('.wish_inner .wish_content[data-id="'+id+'"]');
              $.ajax({
                  url: routes.postRemoveWishList,
                  type: 'POST',
                  data: {
                      "_token" : csrf_token,
                      'id' : id
                  },
                  success: function(data) {
                      alertify.success("@lang('cabinet.wish_lists.deleted')");
                      tab.remove();
                      container.remove();
                      $('.wish_list .wish_a').removeClass('active');
                      $('.wish_inner .wish_content').removeClass('active');
                      $(".wish_a:first").addClass('active');
                      $(".wish_content:first").addClass('active');
                      $('.top-wishlist .user-nav__counter').hide();
                  }
              });

          });
        function saveUser(field, value) {
          var csrf_token = $('meta[name="csrf-token"]').attr('content');
          var data;
          data = {
            'field' : field,
            'value' : value
          };
          $.ajax({
              url: routes.postSaveUser,
              type: 'POST',
              data: {
                  "_token" : csrf_token,
                  "data" : data,
              },
              success: function (data) {
                if(data == 'email') {
                  alertify.error("@lang('cabinet.personal_data.email_check')");
                } else {
                  alertify.success("@lang('cabinet.personal_data.saved')");
                }
              }
          });
        }
    });
    </script>
@stop
