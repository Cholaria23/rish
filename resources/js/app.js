// jQuery
require('jquery/dist/jquery.min');
window.$ = window.jQuery = require('jquery');
// form Stickyfill
import Stickyfill from "stickyfilljs/dist/stickyfill.min";
window.Stickyfill = require('stickyfilljs');
// object-fit-images
import objectFitPolyfill from 'objectFitPolyfill';
// import validate from "jquery-validation";
require("jquery-validation");
// slick
import slick from "slick-carousel/slick/slick.min.js";
// input mask
import Inputmask from "inputmask";
// eventstouch
var loadTouchEvents = require('jquery-touch-events');
loadTouchEvents($);
// malihu_scrollbar
import mCustomScrollbar from "malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js";
// lazysizes
import 'lazysizes';
// magnific_popup
import magnificPopup from "magnific-popup/dist/jquery.magnific-popup.min.js";
// sliders
require('./sliders');
// popup
require('./popup');
// form
require('./form');
// main
require('./main');
