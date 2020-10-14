// jQuery
// require('jquery/dist/jquery.min');
// window.$ = window.jQuery = require('jquery');
import $ from 'jquery';
window.$ = window.jQuery = $;
// form Stickyfill
// import Stickyfill from "stickyfilljs/dist/stickyfill.min.js";
window.Stickyfill = require('stickyfilljs');
// object-fit-images
import objectFitPolyfill from 'objectFitPolyfill';
// slick
import slick from "slick-carousel/slick/slick.min.js";
// input mask
import Inputmask from "inputmask";
// eventstouch
// var loadTouchEvents = require('jquery-touch-events');
// loadTouchEvents($);
// malihu_scrollbar
// import mCustomScrollbar from "malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js";
// simplebar
import 'simplebar';
// lazysizes
import 'lazysizes';
// magnific_popup
import magnificPopup from "magnific-popup/dist/jquery.magnific-popup.min.js";
// selectric
import selectric from "selectric";
// matchHeight
import 'jquery-match-height';
// jquery-touchswipe
require('jquery-touchswipe/jquery.touchSwipe.min.js');
// import validate from "jquery-validation";
require("jquery-validation");


// sliders
require('./sliders');
// popup
require('./popup');
// form
require('./form');
// air-datepicker
require('./air-datepicker');

// main
require('./main');

// перенес в cabinet
// require("bootstrap");
// require('x-editable/dist/bootstrap3-editable/js/bootstrap-editable');
// require('bootstrap-switch');
// require('pgenerator');
