(window.webpackJsonp=window.webpackJsonp||[]).push([[0],{0:function(e,t,i){i("bUC5"),i("pyCd"),e.exports=i("fBjA")},"8yrV":function(e,t){function i(){$(".scroll-js").mCustomScrollbar({axis:"y",updateOnContentResize:!0,documentTouchScroll:!0})}$(document).ready((function(){$(".landing-page").length&&$(".header-scroll-js").on("click",(function(){var e=$(this).attr("data-scroll");$(".header-menu").hasClass("open")?($(".menu__icon").toggleClass("open"),$(".header-menu").toggleClass("open"),$("body").toggleClass("overflow"),$("html").toggleClass("not-overflow"),"home"===e?$("html, body").animate({scrollTop:0},1e3):$("html, body").animate({scrollTop:$("."+e).offset().top},1e3)):"home"===(e=$(this).attr("data-scroll"))?$("html, body").animate({scrollTop:0},1e3):$("html, body").animate({scrollTop:$("."+e).offset().top},1e3)})),$(".hirurgiya-page").length&&setTimeout((function(){$.magnificPopup.open({items:{src:"#popup-info"},type:"inline"},0)}),2e3),$(".popup-gallery").length&&$("body").swipe({swipeLeft:function(e,t,i,n,s){$(".mfp-arrow-right").magnificPopup("next")},swipeRight:function(){$(".mfp-arrow-left").magnificPopup("prev")},threshold:50}),$(".specialists-experience").length&&$(".specialists-experience").matchHeight({byRow:!1}),$(".up_button").on("click",(function(){return $("html, body").animate({scrollTop:0},1e3),!1})),$(".burger-menu").on("click",(function(){$(".menu__icon").toggleClass("open"),$(".header-menu").toggleClass("open"),$("body").toggleClass("overflow"),$("html").toggleClass("not-overflow")})),$(document).on("click",".header-menu.open",(function(){$(".menu__icon").removeClass("open"),$(".header-menu").removeClass("open"),$("body").removeClass("overflow"),$("html").removeClass("not-overflow")})),$(".header-menu-wrap").on("click",(function(e){e.stopPropagation()}));var e=document.querySelectorAll(".description");if(e&&Array.prototype.forEach.call(e,(function(e,t){var i=e.querySelectorAll("img");i&&Array.prototype.forEach.call(i,(function(e,t){var i=e.style.float;"left"==i?e.classList.add("margin-left-none"):"right"==i&&e.classList.add("margin-right-none")}))})),$(".price-page").length&&($(document).on("click",".tab-link",(function(e){var t=$(".main-section-title").offset().top,i=$(this).attr("data-tab"),n=$(this).closest(".tabs-container");"all"==i?(n.find(".tab-link").removeClass("active"),$(this).addClass("active"),$(".tab-content").fadeIn(),$(window).scrollTop()>t&&$("html, body").animate({scrollTop:$(".main-section-title").offset().top-40},500)):(n.find(".tab-link").removeClass("active"),$(this).addClass("active"),n.find(".tab-content").hide(),$("#"+i).fadeIn(),0!=$("#"+i).length&&$(window).scrollTop()>t&&$("html, body").animate({scrollTop:$(".main-section-title").offset().top-40},500))})),$(document).on("click",".tab-mobile-link",(function(e){var t=$(this).attr("data-tab"),i=$(this).closest(".tabs-container");"all"==t?(i.find(".tab-mobile-link").removeClass("active"),$(this).addClass("active"),i.find(".tab-content").fadeIn(),$(".active-tab-mobile-text").html($(".tab-mobile-link.active").text()),$(".active-tab-mobile").toggleClass("active"),$(".tabs").slideToggle()):(i.find(".tab-mobile-link").removeClass("active"),$(this).addClass("active"),i.find(".tab-content").hide(),$("#"+t).fadeIn(),$(".active-tab-mobile-text").html($(".tab-mobile-link.active").text()),$(".active-tab-mobile").toggleClass("active"),$(".tabs").slideToggle())}))),($(".search_page").length||$(".offers-tab").length)&&function(){var e=$(".tabs li").first(),t=$(this).closest(".tabs-container"),i=e.attr("data-tab");e.addClass("active"),t.find(".tab-content").hide(),$("#"+i).fadeIn(),1==$("#"+i).find(".mobile-slider-js").is(".slick-slider")&&($(".mobile-slider-js").slick("destroy"),$(".mobile-slider-js").slick("refresh")),$(document).on("click",".tab-link",(function(e){var t=$(this).attr("data-tab"),i=$(this).closest(".tabs-container");i.find(".tab-link").removeClass("active"),$(this).addClass("active"),i.find(".tab-content").hide(),$("#"+t).fadeIn()})),$(document).on("click",".tab-mobile-link",(function(e){var t=$(this).attr("data-tab"),i=$(this).closest(".tabs-container");i.find(".tab-mobile-link").removeClass("active"),$(this).addClass("active"),i.find(".tab-content").hide(),$("#"+t).fadeIn(),1==$("#"+t).find(".mobile-slider-js").is(".slick-slider")&&($(".mobile-slider-js").slick("destroy"),$(".mobile-slider-js").slick("refresh")),$(".active-tab-mobile-text").html($(".tab-mobile-link.active").text()),$(".active-tab-mobile").toggleClass("active"),$(".tabs").slideToggle()}))}(),$(".active-tab-mobile").click((function(e){$(this).toggleClass("active"),$(".tabs").slideToggle()})),$(".selectric").length&&$(".selectric").selectric({disableOnMobile:!1,nativeOnMobile:!1}),$(".scroll-js").length&&i(),$(".scroll-bnt-js").length&&$(".scroll-bnt-js").click((function(){var e=$(this).attr("data-id");$("html, body").animate({scrollTop:$("."+e).offset().top-30},500)})),$(".popup-gallery").length&&$(".popup-gallery").each((function(){$(this).magnificPopup({delegate:"a",type:"image",mainClass:"mfp-img-mobile",gallery:{enabled:!0,navigateByImgClick:!0,preload:[0,1]}})})),$(".sticky").length){var t=$(".sticky");Stickyfill.add(t)}if($(".header-search-btn").click((function(){var e=$(this);e.hasClass("active")?(e.removeClass("active"),$(".search-dropdown").slideUp(200),$(".overlay").removeClass("active"),$(".overlay.active").unbind("click")):(e.addClass("active"),$(".search-dropdown").slideDown(200),$(".overlay").addClass("active")),setTimeout((function(){$(".search-input").focus(),$(".overlay.active").click((function(t){$(t.target).is(".overlay.active")&&(e.removeClass("active"),$(".search-dropdown").slideUp(200),$(".overlay").removeClass("active"),$(".overlay.active").unbind("click"))}))}),300),$(document).one("keydown",(function(t){27==t.keyCode&&(e.removeClass("active"),$(".search-dropdown").slideUp(200),$(".overlay").removeClass("active"),$(".overlay.active").unbind("click"))}))})),$(".object-fit-js").length){var n=$(".object-fit-js");objectFitPolyfill(n)}$(".all_price_js").length&&$(".all_price_js").click((function(e){var t=$(this).prev();t.find(".price-item:not(.visible)").slideToggle((function(){t.find("li:not(.visible)").toggleClass("hide")})),$(this).children(".visible-text").toggleClass("text-hide"),$(this).children(".hide-text").toggleClass("text-hide")})),$(".all_diploms_js").length&&$(".all_diploms_js").click((function(e){var t=$(this).prev();t.find(".gallery-item:not(.visible)").slideToggle((function(){t.find("a:not(.visible)").toggleClass("hide")})),$(this).children(".visible-text").toggleClass("text-hide"),$(this).children(".hide-text").toggleClass("text-hide")})),$(".faq-question").length&&$(".faq-question").on("click",(function(e){var t=$(this).closest(".faq-item").find(".faq-answer"),i=$(this).closest(".faq-item").find(".faq-icon");$(this).toggleClass("active"),$(this).hasClass("active")?(i.addClass("active"),t.slideDown(200)):(i.removeClass("active"),t.slideUp(200))})),$(".spoiler").length&&$(".spoiler").on("click",(function(e){var t=$(this).find(".spoiler-content"),i=$(this).find(".spoiler-toggle");$(this).toggleClass("active"),$(this).hasClass("active")?(i.addClass("active"),t.slideDown(200)):(i.removeClass("active"),t.slideUp(200))}))})),$(window).on("load resize",(function(){if(window.innerWidth<1025){if($(".has-submenu-services .header-menu-link").hasClass("header-menu-link-js")||($(".has-submenu-services .header-menu-link").addClass("header-menu-link-js"),$(".header-menu-link-js").on("click",(function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".has-submenu-services").find(".header-submenu-services-wrap");$(this).hasClass("active")?($(this).removeClass("active"),t.slideUp(200)):($(this).addClass("active"),t.slideDown(200))}))),$(".header-submenu-services-title").hasClass("submenu-services-js")||($(".header-submenu-services-title").addClass("submenu-services-js"),$(".submenu-services-js").on("click",(function(e){var t=$(this).closest(".header-submenu-services-item").find(".header-submenu-services-list");$(this).toggleClass("active"),$(this).hasClass("active")?t.slideDown(200):t.slideUp(200)}))),$(".sticky-with-hiden").length){var e=$(".sticky-with-hiden");Stickyfill.remove(e)}if($(".unit-block-img").length)$(".unit-block-img-wrap .unit-block-img").insertAfter($(".unit-block-title-js"));$(".scroll-js").length&&$(".scroll-js").hasClass("mCustomScrollbar")&&$(".scroll-js").mCustomScrollbar("destroy"),$(".tabs").length&&($(".tabs").each((function(){if($(this).find("li").removeClass("tab-link").addClass("tab-mobile-link").hasClass("active"));else{var e=$(this).find(".tab-mobile-link").first();$(this).closest(".tabs-container"),e.attr("data-tab");e.addClass("active")}})),$(".active-tab-mobile-text").html($(".tab-mobile-link.active").text()))}else{if($(".has-submenu-services .header-menu-link").hasClass("header-menu-link-js")&&($(".header-menu-link-js").unbind("click"),$(".has-submenu-services .header-menu-link").removeClass("header-menu-link-js active"),$(".header-submenu-services-wrap").css("display","")),$(".header-submenu-services-title").hasClass("submenu-services-js")&&($(".submenu-services-js").unbind("click"),$(".header-submenu-services-title").removeClass("submenu-services-js"),$(".header-submenu-services-list").css("display","")),$(".header-submenu-services-title").unbind("click"),$(".sticky-with-hiden").length){Stickyfill.forceSticky();e=$(".sticky-with-hiden");Stickyfill.add(e)}if($(".unit-block-img").length)$(".unit-block-info .unit-block-img").appendTo($(".sticky"));$(".scroll-js").length&&$(".scroll-js").hasClass("mCS_destroyed")&&i(),$(".tabs").length&&($(".tabs").css("display",""),$(".tabs").each((function(){if($(this).find("li").removeClass("tab-mobile-link").addClass("tab-link").hasClass("active"));else{var e=$(this).find(".tab-link").first();$(this).closest(".tabs-container"),e.attr("data-tab");e.addClass("active")}})))}if(window.innerWidth<767){if($(".main-section-title-wrap .btn-arrow").length){var t=$(".main-section-title-wrap .btn-arrow");$(t).each((function(){$(this).closest(".main-section").find(".btn-wrap").append($(this))}))}}else if($(".btn-wrap .btn-arrow").length){t=$(".btn-wrap .btn-arrow");$(t).each((function(){$(this).closest(".main-section").find(".main-section-title-wrap").append($(this))}))}window.innerWidth<401?$(".special-action-info").length&&$(".special-action-info").matchHeight({remove:!0}):$(".special-action-info").length&&!$(".special-action-info").attr("style")&&$(".special-action-info").matchHeight()})),$(window).on("load scroll",(function(){$(this).scrollTop()>100?$(".up_button").addClass("visible").fadeIn():$(".up_button").removeClass("visible").fadeOut()}))},Nv4c:function(e,t){$(document).ready((function(){Inputmask({mask:"+38 (999) 999-99-99",clearMaskOnLostFocus:!0,clearIncomplete:!0,showMaskOnHover:!1}).mask("input[type=tel]"),$(".input-file").change((function(e){$(".error-file-info").hide(),$(".max-size").hide();var t=e.target.files[0].size,i=$(this).closest(".input-file-inner-wrap").find(".input-file"),n=$(this).closest(".input-file-inner-wrap").find(".label-text"),s=$(this).closest(".input-file-inner-wrap").find(".label-remove"),a=$(this).closest(".input-file-inner-wrap");if(""!=$(this).val())if(t>5242880)$(".error-file-info").show(),$(".max-size").show(),i.val("");else{var o=e.target.files[0].name;n.text(o),s.show(),a.next(".input-file-inner-wrap").css("display","flex")}else"ru"==$("html").attr("lang")?(n.text("Загрузить фото"),s.hide()):"uk"==$("html").attr("lang")?(n.text("Завантажити фото"),s.hide()):(n.text("Upload a photo"),s.hide())})),$(".label-remove").click((function(e){var t=$(this).closest(".input-file-inner-wrap").find(".label-text"),i=$(this).closest(".input-file-inner-wrap").find(".label-remove"),n=$(this).closest(".input-file-inner-wrap").find(".input-file");"ru"==$("html").attr("lang")?t.text("Загрузить фото"):"uk"==$("html").attr("lang")?t.text("Завантажити фото"):t.text("Upload a photo"),i.hide(),n.val(""),$(this).parent().next(".input-file-inner-wrap").find(".input-file").val()||$(this).parent().next(".input-file-inner-wrap").css("display","none")}));var e=$(".review_form");function t(e,t){var i,n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:"",s=$('meta[name="csrf-token"]').attr("content");i=""!=n?{data:t,file:n,_token:s,subj:"review"}:{data:t,_token:s,subj:"review"},$.ajax({url:routes.postSend,type:"POST",data:i,success:function(t){$(e)[0].reset(),"ru"==$("html").attr("lang")?$(".label-text").text("Загрузить фото"):"uk"==$("html").attr("lang")?$(".label-text").text("Завантажити фото"):$(".label-text").text("Upload a photo"),$(".input-file-inner-wrap").not(":eq(0)").css("display","none"),$(".label-remove").hide(),$(".form-thanks").show(),setTimeout((function(){$(".form-thanks").hide()}),5e3)}})}function i(e){e.validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"subscription"},success:function(t){$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}})}$(".do_review_form").click((function(i){i.stopPropagation(),i.preventDefault();var n=$(this).closest(".review_form");n.validate({submitHandler:function(i){var n,s=$('meta[name="csrf-token"]').attr("content"),a=$(i).serialize();document.getElementById("input-file-1").files.length||document.getElementById("input-file-2").files.length?function(){n=$(".input-file");for(var i={},o=function(o){var l=n[o],r=n[o+1]?n[o+1]:null;if(null!=l&&l.files.length){var c=new FileReader;c.onload=function(){var n="file_"+o,l=c.result;i[n]=l,null!=r&&r.files.length||setTimeout((function(){$.ajax({type:"POST",url:routes.postLoadFile,data:{_token:s,data:i},success:function(i){var n=i.file_name;t(e,a,n)},error:function(e){}})}),100)},c.readAsDataURL(n[o].files[0])}},l=0;l<n.length;l++)o(l)}():t(e,a)}}),n.submit()})),$(".do_callback_form").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".callback_form");t.validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"callback"},success:function(t){$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),t.submit()})),$(".do_feedback_form").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".feedback_form");t.validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"feedback"},success:function(t){$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),t.submit()})),$(".do-new-post-form").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".new-post-form");i(t),t.submit()})),$(".do_appointment_form").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".appointment_form");t.validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"appointment"},success:function(t){$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),t.submit()})),$(".do_registration_form").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".registration_form");t.validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"appointment"},success:function(t){$("#appointment").find(".popup-sub-name").text(),$("#appointment").find("input[name=appointment]").val(""),$("#appointment").find("input[name=specialist]").val(""),$(".select-appointment-specialist").prop("selectedIndex",0).selectric("refresh"),$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),t.submit()})),$(".do_specialist_form").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".specialist_form");t.validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"specialist"},success:function(t){$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),t.submit()})),$(".do_question_form").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".question_form");t.validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"question"},success:function(t){$("#question").find(".popup-sub-name").text(),$("#question").find("input[name=appointment]").val(""),$(".select-question").prop("selectedIndex",0).selectric("refresh"),$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),t.submit()})),$(".do_chekup_form").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".chekup_form");t.validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"chekup"},success:function(t){$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),t.submit()})),$(".do_consultation_form").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".consultation_form");t.validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"consultation"},success:function(t){$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),t.submit()})),$(".online-consultation-form").validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(".online-consultation-form").serialize();$(".online-consultation-form")[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"onlinereview"},success:function(e){$(".online-consultation-form").hide(),$(".online-consultation-form").next(".form-thanks").show(),setTimeout((function(){$(".online-consultation-form").next(".form-thanks").hide(),$(".online-consultation-form").show()}),5e3)}})}}),$(".do-online-consultation").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".online-consultation-form");i(t),t.submit()})),$(".registration-form").validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(".registration-form").serialize();$.ajax({url:routes.postRegister,type:"POST",data:{_token:t,data:i},success:function(e){switch(e){case"email":$(".registration-form .auth-error").slideDown(200);break;case"deleted":$(".registration-form .auth-del").slideDown(200);break;case"success":window.location.href=window.location.origin+"/cabinet/"}}})}}),$(".do_registration-form").click((function(e){e.preventDefault(),$(".registration-form").submit()})),$(".reset-form").validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(".reset-form").serialize();$.ajax({url:routes.postPassword,type:"POST",data:{_token:t,data:i},success:function(e){switch(e){case"no_email":$(".reset-form .auth-error").slideDown(200),$(".reset-form .auth-restored").slideUp(200);break;case"success":$(".reset-form .auth-restored").slideDown(200),$(".reset-form.auth-error").slideUp(200)}}})}}),$(".do_reset-form").click((function(e){e.preventDefault(),$(".reset-form").submit()})),$(".login-form").validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(".login-form").serialize();$.ajax({url:routes.postLogin,type:"POST",data:{_token:t,data:i},success:function(e){switch(e){case"wrong_pass":$(".login-form .auth-error").slideDown(200);break;case"success":window.location.reload(!0)}}})}}),$(".do_login-form").click((function(e){e.preventDefault(),e.stopPropagation(),$(".login-form").submit()})),$(".a-logout").click((function(e){e.stopPropagation(),e.preventDefault();var t=$('meta[name="csrf-token"]').attr("content");$.ajax({url:routes.postLogout,type:"POST",data:{_token:t},success:function(e){switch(e){case"success":var t=window.location.href.split("#")[0];window.location.href=t}}})})),$(".do_appointment_test").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".appointment_test");t.validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"test"},success:function(t){$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),t.submit()})),$(".do_vaccination_form").click((function(e){e.stopPropagation(),e.preventDefault();var t=$(this).closest(".vaccination_form");t.validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"vaccination"},success:function(t){$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),t.submit()})),$(".do_corporate_form").click((function(e){e.stopPropagation(),e.preventDefault(),$(".corporate_form").submit()})),$(".corporate_form").validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"corporate"},success:function(t){$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}})})),$(".do_question_services").click((function(e){e.stopPropagation(),e.preventDefault(),$(".question_services_form").submit()})),$(".question_services_form").validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"landing_question_services"},success:function(t){$("#question-services").find("input[name=services_id]").val(""),$(".select-question-services").prop("selectedIndex",0).selectric("refresh"),$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),$(".do_appointment_services").click((function(e){e.stopPropagation(),e.preventDefault(),$(".appointment_services_form").submit()})),$(".appointment_services_form").validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"landing_appointment_services"},success:function(t){$("#appointment-services").find("input[name=appointment_services_id]").val(""),$(".select-appointment-services").prop("selectedIndex",0).selectric("refresh"),$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),$(".do_personal_ranslator").click((function(e){e.stopPropagation(),e.preventDefault(),$(".personal_ranslator_form").submit()})),$(".personal_ranslator_form").validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"landing_personal_ranslator"},success:function(t){$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}}),$(".do_landing_question").click((function(e){e.stopPropagation(),e.preventDefault(),$(".landing_question_form").submit()})),$(".landing_question_form").validate({submitHandler:function(e){var t=$('meta[name="csrf-token"]').attr("content"),i=$(e).serialize();$(e)[0].reset(),$.ajax({url:routes.postSend,type:"POST",data:{_token:t,data:i,subj:"landing_question"},success:function(t){$("#landing-question").find(".popup-sub-name").text(),$("#landing-question").find("input[name=landing_question_id]").val(""),$(e).hide(),$(e).next(".form-thanks").show(),setTimeout((function(){$.magnificPopup.close()}),5e3),setTimeout((function(){$(e).next(".form-thanks").hide(),$(e).show()}),5e3)}})}})},bUC5:function(e,t,i){"use strict";i.r(t);var n=i("EVdn"),s=i.n(n);i("eCb9"),i("XMe9"),i("I9E9"),i("pvl8"),i("s+lh"),i("omkw"),i("fLsC"),i("BFHv");window.$=window.jQuery=s.a,window.Stickyfill=i("5nEI"),i("wlMK"),i("rIKr"),i("i2Oj"),i("hTGC"),i("Nv4c"),i("zANn"),i("8yrV")},fBjA:function(e,t){},hTGC:function(e,t){$(document).ready((function(){$((function(){$(".popup-js").magnificPopup({fixedContentPos:!0})})),$(".popup-js").not(".appointment-online-btn").click((function(){var e=$(this).attr("href");setTimeout((function(){$(e).find(".input-form")[0].focus()}),300)})),$(".appointment-btn-js").click((function(){var e=$(this).attr("data-subtitle");$("#appointment").find(".popup-sub-name").text(e),$("#appointment").find("input[name=appointment]").val(e)})),$(".landing-question-js").click((function(){var e=$(this).attr("data-subtitle");$("#landing-question").find(".popup-sub-name").text(e),$("#landing-question").find("input[name=landing_question_id]").val(e)})),$(document).on("change",".select-appointment-specialist",(function(e){var t=$(".select-appointment-specialist option:selected").text();$("#appointment").find("input[name=specialist]").val(t)})),$(document).on("change",".select-question-services",(function(e){var t=$(".select-question-services option:selected").text();$("#question-services").find("input[name=services_id]").val(t)})),$(document).on("change",".select-appointment-services",(function(e){var t=$(".select-appointment-services option:selected").text();$("#appointment-services").find("input[name=appointment_services_id]").val(t)})),$(".specialist-btn-js").click((function(){var e=$(this).attr("data-subtitle");$("#specialist").find(".popup-sub-name").text(e),$("#specialist").find("input[name=appointment]").val(e)})),$(".question-btn-js").click((function(){var e=$(this).attr("data-subtitle");$("#question").find(".popup-sub-name").text(e),$("#question").find("input[name=appointment]").val(e)})),$(document).on("change",".select-question",(function(e){var t=$(".select-question option:selected").text();$("#question").find("input[name=appointment]").val(t)}))}))},i2Oj:function(e,t){$(document).ready((function(){$(".reviews-slider").slick({arrows:!1,fade:!0,asNavFor:$(".counter-slider"),responsive:[{breakpoint:1025,settings:{adaptiveHeight:!0}}]}),$(".counter-slider").slick({arrows:!1,dots:!0,fade:!0,asNavFor:$(".reviews-slider")})})),$(window).on("load resize",(function(){$(".special-actions-wrap.slider").length&&$(".special-actions-wrap.slider").each((function(){window.innerWidth<767?$(this).hasClass("slick-slider")||$(this).slick({arrows:!1,dots:!0,infinite:!0,slidesToShow:2,slidesToScroll:1,responsive:[{breakpoint:401,settings:{slidesToShow:1}}]}):$(this).hasClass("slick-slider")&&$(this).slick("destroy")})),$(".mobile-slider-js").length&&$(".mobile-slider-js").each((function(){window.innerWidth<401?$(this).hasClass("slick-slider")||$(this).slick({arrows:!0,infinite:!0,slidesToShow:1,slidesToScroll:1,prevArrow:'<div class="mobile-slider-arrow prev"></div>',nextArrow:'<div class="mobile-slider-arrow next"></div>'}):$(this).hasClass("slick-slider")&&$(this).slick("destroy")})),$(".mobile-diplom-slider-js").length&&$(".mobile-diplom-slider-js").each((function(){window.innerWidth<1025?($(".gallery-item").each((function(){$(this).hasClass("hide")&&$(this).removeClass("hide")})),$(this).hasClass("slick-slider")||$(this).slick({arrows:!0,infinite:!0,slidesToShow:3,slidesToScroll:3,prevArrow:'<div class="mobile-slider-arrow prev"></div>',nextArrow:'<div class="mobile-slider-arrow next"></div>',responsive:[{breakpoint:769,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:401,settings:{slidesToShow:1,slidesToScroll:1}}]})):($(".gallery-item").each((function(){$(this).hasClass("visible")||$(this).addClass("hide")})),$(this).hasClass("slick-slider")&&$(this).slick("destroy"))}))}))},pyCd:function(e,t){},zANn:function(e,t,i){"use strict";i.r(t);i("/4UK");$(document).ready((function(){($(".datepicker-before-js").length||$(".datepicker-after-js").length)&&("en"==$("html").attr("lang")?($.fn.datepicker.language.en={days:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],daysShort:["Sun","Mon","Tues","Wed","Thurs","Fri","Sat"],daysMin:["Su","Mo","Tu","We","Th","Fr","Sa"],months:["January","February","March","April","May","June","July","August","September","October","November","December"],monthsShort:["Jan.","Feb.","Mar.","Apr.","May","Jun.","Jul.","Aug.","Sep.","Oct.","Nov.","Dec."],today:"Today",clear:"Clear",dateFormat:"dd.mm.yyyy",timeFormat:"hh:ii",firstDay:7},$(".datepicker-before-js").datepicker({language:"en",maxDate:new Date}),$(".datepicker-after-js").datepicker({language:"en",minDate:new Date})):"uk"==$("html").attr("lang")?($.fn.datepicker.language.uk={days:["Неділя","понеділок","вівторок","середа","четвер","п'ятницю"," суботу "],daysShort:["Вос","Пон","Вів","Сре","Чет","П'ят","Суб"],daysMin:["Нд","Пн","Вт","Ср","Чт","Пт","Сб"],months:["Січень","Лютий","Березень","Квітень","Травень","Червень","Липень","Серпень","Вересень","Жовтень","Листопад","Грудень"],monthsShort:["січень","лютий","березнь","квітень","травень","червень","липень","серпень","вересень","жовтень","листопад","грудень"],today:"Сегодня",clear:"Очистить",dateFormat:"dd.mm.yyyy",timeFormat:"hh:ii",firstDay:1},$(".datepicker-before-js").datepicker({language:"uk",maxDate:new Date}),$(".datepicker-after-js").datepicker({language:"uk",minDate:new Date})):($(".datepicker-before-js").datepicker({maxDate:new Date}),$(".datepicker-after-js").datepicker({minDate:new Date})))}))}},[[0,1,2]]]);
//# sourceMappingURL=app.js.map