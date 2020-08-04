// jQuery
require('jquery/dist/jquery.min');
window.$ = window.jQuery = require('jquery');
// import validate from "jquery-validation";
require("jquery-validation");
// slick
import slick from "slick-carousel/slick/slick.min.js";
// input mask
import Inputmask from "inputmask";
// eventstouch
var loadTouchEvents = require('jquery-touch-events');
loadTouchEvents($);
// lazysizes
import 'lazysizes';
// magnific_popup
import magnificPopup from "magnific-popup/dist/jquery.magnific-popup.min.js";
// popup
require('./popup');
// main
require('./main');
