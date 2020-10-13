/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/adminpanel/js/preloader.js":
/*!**********************************************!*\
  !*** ./resources/adminpanel/js/preloader.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// function fadeOutEffect(el) {
//     let fadeTarget = el;
//     let	setEffect = setTimeout(function () {
//         setInterval(function () {
//             if (!fadeTarget.style.opacity) {
//                 fadeTarget.style.opacity = 1;
//                 console.log(1);
//             }
//             if (fadeTarget.style.opacity > 0) {
//                 fadeTarget.style.opacity -= 0.1;
//                 console.log(2);
//             } else {
//                 fadeTarget.style.visibility = 'hidden';
//                 clearInterval(setEffect);
//                 console.log(3);
//                 return false
//             }
//         },5);
//     },10);
// }
var $el = document.querySelector('#preloader');
document.addEventListener("DOMContentLoaded", function (event) {
  console.log('DOMContentLoaded => загружен DOM без стилей и скриптов'); // fadeOutEffect($el)
  // document.querySelector('#preloader').style.visibility = 'hidden';

  window.onload = function (event) {
    document.querySelector('#preloader').style.visibility = 'hidden';
    console.log('window.onload => страница полностью загружена');
    var inputF = $('.input__field');
    inputF.each(function () {
      var inputF = $(this),
          inputR = inputF.closest('.input__row');

      if (inputF.is(':focus') || inputF.val() != '' && inputF.is(':input')) {
        inputR.addClass('is_focus');
      }

      if (inputF.is(':disabled')) {
        inputR.addClass('is_disabled');
      }
    }); // fadeOutEffect($el)
  };
});

/***/ }),

/***/ "./resources/adminpanel/sass/login.scss":
/*!**********************************************!*\
  !*** ./resources/adminpanel/sass/login.scss ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/sass/master.scss":
/*!***********************************************!*\
  !*** ./resources/adminpanel/sass/master.scss ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/sass/preloader.scss":
/*!**************************************************!*\
  !*** ./resources/adminpanel/sass/preloader.scss ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-anim/master.scss":
/*!**************************************************************!*\
  !*** ./resources/adminpanel/themes/default-anim/master.scss ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-anim/preloader.scss":
/*!*****************************************************************!*\
  !*** ./resources/adminpanel/themes/default-anim/preloader.scss ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-black/master.scss":
/*!***************************************************************!*\
  !*** ./resources/adminpanel/themes/default-black/master.scss ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-black/preloader.scss":
/*!******************************************************************!*\
  !*** ./resources/adminpanel/themes/default-black/preloader.scss ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-green/master.scss":
/*!***************************************************************!*\
  !*** ./resources/adminpanel/themes/default-green/master.scss ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-green/preloader.scss":
/*!******************************************************************!*\
  !*** ./resources/adminpanel/themes/default-green/preloader.scss ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-salat/master.scss":
/*!***************************************************************!*\
  !*** ./resources/adminpanel/themes/default-salat/master.scss ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-salat/preloader.scss":
/*!******************************************************************!*\
  !*** ./resources/adminpanel/themes/default-salat/preloader.scss ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-sky/master.scss":
/*!*************************************************************!*\
  !*** ./resources/adminpanel/themes/default-sky/master.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-sky/preloader.scss":
/*!****************************************************************!*\
  !*** ./resources/adminpanel/themes/default-sky/preloader.scss ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-turquoise/master.scss":
/*!*******************************************************************!*\
  !*** ./resources/adminpanel/themes/default-turquoise/master.scss ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-turquoise/preloader.scss":
/*!**********************************************************************!*\
  !*** ./resources/adminpanel/themes/default-turquoise/preloader.scss ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-yellow/master.scss":
/*!****************************************************************!*\
  !*** ./resources/adminpanel/themes/default-yellow/master.scss ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/adminpanel/themes/default-yellow/preloader.scss":
/*!*******************************************************************!*\
  !*** ./resources/adminpanel/themes/default-yellow/preloader.scss ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/adminpanel/js/preloader.js ./resources/adminpanel/sass/master.scss ./resources/adminpanel/sass/preloader.scss ./resources/adminpanel/themes/default-anim/master.scss ./resources/adminpanel/themes/default-anim/preloader.scss ./resources/adminpanel/themes/default-black/master.scss ./resources/adminpanel/themes/default-black/preloader.scss ./resources/adminpanel/themes/default-yellow/master.scss ./resources/adminpanel/themes/default-yellow/preloader.scss ./resources/adminpanel/themes/default-turquoise/master.scss ./resources/adminpanel/themes/default-turquoise/preloader.scss ./resources/adminpanel/themes/default-salat/master.scss ./resources/adminpanel/themes/default-salat/preloader.scss ./resources/adminpanel/themes/default-green/master.scss ./resources/adminpanel/themes/default-green/preloader.scss ./resources/adminpanel/themes/default-sky/master.scss ./resources/adminpanel/themes/default-sky/preloader.scss ./resources/adminpanel/sass/login.scss ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/js/preloader.js */"./resources/adminpanel/js/preloader.js");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/sass/master.scss */"./resources/adminpanel/sass/master.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/sass/preloader.scss */"./resources/adminpanel/sass/preloader.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-anim/master.scss */"./resources/adminpanel/themes/default-anim/master.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-anim/preloader.scss */"./resources/adminpanel/themes/default-anim/preloader.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-black/master.scss */"./resources/adminpanel/themes/default-black/master.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-black/preloader.scss */"./resources/adminpanel/themes/default-black/preloader.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-yellow/master.scss */"./resources/adminpanel/themes/default-yellow/master.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-yellow/preloader.scss */"./resources/adminpanel/themes/default-yellow/preloader.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-turquoise/master.scss */"./resources/adminpanel/themes/default-turquoise/master.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-turquoise/preloader.scss */"./resources/adminpanel/themes/default-turquoise/preloader.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-salat/master.scss */"./resources/adminpanel/themes/default-salat/master.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-salat/preloader.scss */"./resources/adminpanel/themes/default-salat/preloader.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-green/master.scss */"./resources/adminpanel/themes/default-green/master.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-green/preloader.scss */"./resources/adminpanel/themes/default-green/preloader.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-sky/master.scss */"./resources/adminpanel/themes/default-sky/master.scss");
__webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/themes/default-sky/preloader.scss */"./resources/adminpanel/themes/default-sky/preloader.scss");
module.exports = __webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/sass/login.scss */"./resources/adminpanel/sass/login.scss");


/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2FkbWlucGFuZWwvanMvcHJlbG9hZGVyLmpzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hZG1pbnBhbmVsL3Nhc3MvbG9naW4uc2Nzcz9lZGU0Iiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hZG1pbnBhbmVsL3Nhc3MvbWFzdGVyLnNjc3M/ZGEyMCIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYWRtaW5wYW5lbC9zYXNzL3ByZWxvYWRlci5zY3NzPzE5MDYiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2FkbWlucGFuZWwvdGhlbWVzL2RlZmF1bHQtYW5pbS9tYXN0ZXIuc2Nzcz9lNTZmIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hZG1pbnBhbmVsL3RoZW1lcy9kZWZhdWx0LWFuaW0vcHJlbG9hZGVyLnNjc3M/YzAzZiIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYWRtaW5wYW5lbC90aGVtZXMvZGVmYXVsdC1ibGFjay9tYXN0ZXIuc2Nzcz9mZWUzIiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hZG1pbnBhbmVsL3RoZW1lcy9kZWZhdWx0LWJsYWNrL3ByZWxvYWRlci5zY3NzPzBlOTciLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2FkbWlucGFuZWwvdGhlbWVzL2RlZmF1bHQtZ3JlZW4vbWFzdGVyLnNjc3M/ODYxMiIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYWRtaW5wYW5lbC90aGVtZXMvZGVmYXVsdC1ncmVlbi9wcmVsb2FkZXIuc2Nzcz8zN2M5Iiwid2VicGFjazovLy8uL3Jlc291cmNlcy9hZG1pbnBhbmVsL3RoZW1lcy9kZWZhdWx0LXNhbGF0L21hc3Rlci5zY3NzP2Q5YmIiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2FkbWlucGFuZWwvdGhlbWVzL2RlZmF1bHQtc2FsYXQvcHJlbG9hZGVyLnNjc3M/ODA1ZSIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYWRtaW5wYW5lbC90aGVtZXMvZGVmYXVsdC1za3kvbWFzdGVyLnNjc3M/YTYzNCIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYWRtaW5wYW5lbC90aGVtZXMvZGVmYXVsdC1za3kvcHJlbG9hZGVyLnNjc3M/NmRjYiIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYWRtaW5wYW5lbC90aGVtZXMvZGVmYXVsdC10dXJxdW9pc2UvbWFzdGVyLnNjc3M/ZGMwYiIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYWRtaW5wYW5lbC90aGVtZXMvZGVmYXVsdC10dXJxdW9pc2UvcHJlbG9hZGVyLnNjc3M/NDJjYiIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYWRtaW5wYW5lbC90aGVtZXMvZGVmYXVsdC15ZWxsb3cvbWFzdGVyLnNjc3M/ZGI3ZSIsIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvYWRtaW5wYW5lbC90aGVtZXMvZGVmYXVsdC15ZWxsb3cvcHJlbG9hZGVyLnNjc3M/YmJjMyJdLCJuYW1lcyI6WyIkZWwiLCJkb2N1bWVudCIsInF1ZXJ5U2VsZWN0b3IiLCJhZGRFdmVudExpc3RlbmVyIiwiZXZlbnQiLCJjb25zb2xlIiwibG9nIiwid2luZG93Iiwib25sb2FkIiwic3R5bGUiLCJ2aXNpYmlsaXR5IiwiaW5wdXRGIiwiJCIsImVhY2giLCJpbnB1dFIiLCJjbG9zZXN0IiwiaXMiLCJ2YWwiLCJhZGRDbGFzcyJdLCJtYXBwaW5ncyI6IjtRQUFBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBOzs7UUFHQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0EsMENBQTBDLGdDQUFnQztRQUMxRTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBLHdEQUF3RCxrQkFBa0I7UUFDMUU7UUFDQSxpREFBaUQsY0FBYztRQUMvRDs7UUFFQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0EseUNBQXlDLGlDQUFpQztRQUMxRSxnSEFBZ0gsbUJBQW1CLEVBQUU7UUFDckk7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQSwyQkFBMkIsMEJBQTBCLEVBQUU7UUFDdkQsaUNBQWlDLGVBQWU7UUFDaEQ7UUFDQTtRQUNBOztRQUVBO1FBQ0Esc0RBQXNELCtEQUErRDs7UUFFckg7UUFDQTs7O1FBR0E7UUFDQTs7Ozs7Ozs7Ozs7O0FDbEZBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQSxJQUFJQSxHQUFHLEdBQUdDLFFBQVEsQ0FBQ0MsYUFBVCxDQUF1QixZQUF2QixDQUFWO0FBQ0FELFFBQVEsQ0FBQ0UsZ0JBQVQsQ0FBMEIsa0JBQTFCLEVBQThDLFVBQUNDLEtBQUQsRUFBVztBQUNyREMsU0FBTyxDQUFDQyxHQUFSLENBQVksd0RBQVosRUFEcUQsQ0FFckQ7QUFDQTs7QUFDQUMsUUFBTSxDQUFDQyxNQUFQLEdBQWdCLFVBQUNKLEtBQUQsRUFBVztBQUN2QkgsWUFBUSxDQUFDQyxhQUFULENBQXVCLFlBQXZCLEVBQXFDTyxLQUFyQyxDQUEyQ0MsVUFBM0MsR0FBd0QsUUFBeEQ7QUFDQUwsV0FBTyxDQUFDQyxHQUFSLENBQVksK0NBQVo7QUFFQSxRQUFJSyxNQUFNLEdBQUdDLENBQUMsQ0FBQyxlQUFELENBQWQ7QUFDQUQsVUFBTSxDQUFDRSxJQUFQLENBQVksWUFBWTtBQUNwQixVQUFJRixNQUFNLEdBQUdDLENBQUMsQ0FBQyxJQUFELENBQWQ7QUFBQSxVQUNJRSxNQUFNLEdBQUdILE1BQU0sQ0FBQ0ksT0FBUCxDQUFlLGFBQWYsQ0FEYjs7QUFFQSxVQUFJSixNQUFNLENBQUNLLEVBQVAsQ0FBVSxRQUFWLEtBQXdCTCxNQUFNLENBQUNNLEdBQVAsTUFBZ0IsRUFBaEIsSUFBc0JOLE1BQU0sQ0FBQ0ssRUFBUCxDQUFVLFFBQVYsQ0FBbEQsRUFBd0U7QUFDcEVGLGNBQU0sQ0FBQ0ksUUFBUCxDQUFnQixVQUFoQjtBQUNIOztBQUNELFVBQUlQLE1BQU0sQ0FBQ0ssRUFBUCxDQUFVLFdBQVYsQ0FBSixFQUE0QjtBQUN4QkYsY0FBTSxDQUFDSSxRQUFQLENBQWdCLGFBQWhCO0FBQ0g7QUFDSixLQVRELEVBTHVCLENBZXZCO0FBQ0gsR0FoQkQ7QUFpQkgsQ0FyQkQsRTs7Ozs7Ozs7Ozs7QUNyQkEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUM7Ozs7Ozs7Ozs7O0FDQUEseUMiLCJmaWxlIjoiL2RlbW9zL0FkbWluUGFuZWwvanMvcHJlbG9hZGVyLmpzIiwic291cmNlc0NvbnRlbnQiOlsiIFx0Ly8gVGhlIG1vZHVsZSBjYWNoZVxuIFx0dmFyIGluc3RhbGxlZE1vZHVsZXMgPSB7fTtcblxuIFx0Ly8gVGhlIHJlcXVpcmUgZnVuY3Rpb25cbiBcdGZ1bmN0aW9uIF9fd2VicGFja19yZXF1aXJlX18obW9kdWxlSWQpIHtcblxuIFx0XHQvLyBDaGVjayBpZiBtb2R1bGUgaXMgaW4gY2FjaGVcbiBcdFx0aWYoaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0pIHtcbiBcdFx0XHRyZXR1cm4gaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0uZXhwb3J0cztcbiBcdFx0fVxuIFx0XHQvLyBDcmVhdGUgYSBuZXcgbW9kdWxlIChhbmQgcHV0IGl0IGludG8gdGhlIGNhY2hlKVxuIFx0XHR2YXIgbW9kdWxlID0gaW5zdGFsbGVkTW9kdWxlc1ttb2R1bGVJZF0gPSB7XG4gXHRcdFx0aTogbW9kdWxlSWQsXG4gXHRcdFx0bDogZmFsc2UsXG4gXHRcdFx0ZXhwb3J0czoge31cbiBcdFx0fTtcblxuIFx0XHQvLyBFeGVjdXRlIHRoZSBtb2R1bGUgZnVuY3Rpb25cbiBcdFx0bW9kdWxlc1ttb2R1bGVJZF0uY2FsbChtb2R1bGUuZXhwb3J0cywgbW9kdWxlLCBtb2R1bGUuZXhwb3J0cywgX193ZWJwYWNrX3JlcXVpcmVfXyk7XG5cbiBcdFx0Ly8gRmxhZyB0aGUgbW9kdWxlIGFzIGxvYWRlZFxuIFx0XHRtb2R1bGUubCA9IHRydWU7XG5cbiBcdFx0Ly8gUmV0dXJuIHRoZSBleHBvcnRzIG9mIHRoZSBtb2R1bGVcbiBcdFx0cmV0dXJuIG1vZHVsZS5leHBvcnRzO1xuIFx0fVxuXG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlcyBvYmplY3QgKF9fd2VicGFja19tb2R1bGVzX18pXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm0gPSBtb2R1bGVzO1xuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZSBjYWNoZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5jID0gaW5zdGFsbGVkTW9kdWxlcztcblxuIFx0Ly8gZGVmaW5lIGdldHRlciBmdW5jdGlvbiBmb3IgaGFybW9ueSBleHBvcnRzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQgPSBmdW5jdGlvbihleHBvcnRzLCBuYW1lLCBnZXR0ZXIpIHtcbiBcdFx0aWYoIV9fd2VicGFja19yZXF1aXJlX18ubyhleHBvcnRzLCBuYW1lKSkge1xuIFx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBuYW1lLCB7IGVudW1lcmFibGU6IHRydWUsIGdldDogZ2V0dGVyIH0pO1xuIFx0XHR9XG4gXHR9O1xuXG4gXHQvLyBkZWZpbmUgX19lc01vZHVsZSBvbiBleHBvcnRzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnIgPSBmdW5jdGlvbihleHBvcnRzKSB7XG4gXHRcdGlmKHR5cGVvZiBTeW1ib2wgIT09ICd1bmRlZmluZWQnICYmIFN5bWJvbC50b1N0cmluZ1RhZykge1xuIFx0XHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCBTeW1ib2wudG9TdHJpbmdUYWcsIHsgdmFsdWU6ICdNb2R1bGUnIH0pO1xuIFx0XHR9XG4gXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShleHBvcnRzLCAnX19lc01vZHVsZScsIHsgdmFsdWU6IHRydWUgfSk7XG4gXHR9O1xuXG4gXHQvLyBjcmVhdGUgYSBmYWtlIG5hbWVzcGFjZSBvYmplY3RcbiBcdC8vIG1vZGUgJiAxOiB2YWx1ZSBpcyBhIG1vZHVsZSBpZCwgcmVxdWlyZSBpdFxuIFx0Ly8gbW9kZSAmIDI6IG1lcmdlIGFsbCBwcm9wZXJ0aWVzIG9mIHZhbHVlIGludG8gdGhlIG5zXG4gXHQvLyBtb2RlICYgNDogcmV0dXJuIHZhbHVlIHdoZW4gYWxyZWFkeSBucyBvYmplY3RcbiBcdC8vIG1vZGUgJiA4fDE6IGJlaGF2ZSBsaWtlIHJlcXVpcmVcbiBcdF9fd2VicGFja19yZXF1aXJlX18udCA9IGZ1bmN0aW9uKHZhbHVlLCBtb2RlKSB7XG4gXHRcdGlmKG1vZGUgJiAxKSB2YWx1ZSA9IF9fd2VicGFja19yZXF1aXJlX18odmFsdWUpO1xuIFx0XHRpZihtb2RlICYgOCkgcmV0dXJuIHZhbHVlO1xuIFx0XHRpZigobW9kZSAmIDQpICYmIHR5cGVvZiB2YWx1ZSA9PT0gJ29iamVjdCcgJiYgdmFsdWUgJiYgdmFsdWUuX19lc01vZHVsZSkgcmV0dXJuIHZhbHVlO1xuIFx0XHR2YXIgbnMgPSBPYmplY3QuY3JlYXRlKG51bGwpO1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLnIobnMpO1xuIFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkobnMsICdkZWZhdWx0JywgeyBlbnVtZXJhYmxlOiB0cnVlLCB2YWx1ZTogdmFsdWUgfSk7XG4gXHRcdGlmKG1vZGUgJiAyICYmIHR5cGVvZiB2YWx1ZSAhPSAnc3RyaW5nJykgZm9yKHZhciBrZXkgaW4gdmFsdWUpIF9fd2VicGFja19yZXF1aXJlX18uZChucywga2V5LCBmdW5jdGlvbihrZXkpIHsgcmV0dXJuIHZhbHVlW2tleV07IH0uYmluZChudWxsLCBrZXkpKTtcbiBcdFx0cmV0dXJuIG5zO1xuIFx0fTtcblxuIFx0Ly8gZ2V0RGVmYXVsdEV4cG9ydCBmdW5jdGlvbiBmb3IgY29tcGF0aWJpbGl0eSB3aXRoIG5vbi1oYXJtb255IG1vZHVsZXNcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubiA9IGZ1bmN0aW9uKG1vZHVsZSkge1xuIFx0XHR2YXIgZ2V0dGVyID0gbW9kdWxlICYmIG1vZHVsZS5fX2VzTW9kdWxlID9cbiBcdFx0XHRmdW5jdGlvbiBnZXREZWZhdWx0KCkgeyByZXR1cm4gbW9kdWxlWydkZWZhdWx0J107IH0gOlxuIFx0XHRcdGZ1bmN0aW9uIGdldE1vZHVsZUV4cG9ydHMoKSB7IHJldHVybiBtb2R1bGU7IH07XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18uZChnZXR0ZXIsICdhJywgZ2V0dGVyKTtcbiBcdFx0cmV0dXJuIGdldHRlcjtcbiBcdH07XG5cbiBcdC8vIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbFxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5vID0gZnVuY3Rpb24ob2JqZWN0LCBwcm9wZXJ0eSkgeyByZXR1cm4gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsKG9iamVjdCwgcHJvcGVydHkpOyB9O1xuXG4gXHQvLyBfX3dlYnBhY2tfcHVibGljX3BhdGhfX1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5wID0gXCIvXCI7XG5cblxuIFx0Ly8gTG9hZCBlbnRyeSBtb2R1bGUgYW5kIHJldHVybiBleHBvcnRzXG4gXHRyZXR1cm4gX193ZWJwYWNrX3JlcXVpcmVfXyhfX3dlYnBhY2tfcmVxdWlyZV9fLnMgPSAwKTtcbiIsIi8vIGZ1bmN0aW9uIGZhZGVPdXRFZmZlY3QoZWwpIHtcbi8vICAgICBsZXQgZmFkZVRhcmdldCA9IGVsO1xuLy8gICAgIGxldFx0c2V0RWZmZWN0ID0gc2V0VGltZW91dChmdW5jdGlvbiAoKSB7XG4vLyAgICAgICAgIHNldEludGVydmFsKGZ1bmN0aW9uICgpIHtcbi8vICAgICAgICAgICAgIGlmICghZmFkZVRhcmdldC5zdHlsZS5vcGFjaXR5KSB7XG4vLyAgICAgICAgICAgICAgICAgZmFkZVRhcmdldC5zdHlsZS5vcGFjaXR5ID0gMTtcbi8vICAgICAgICAgICAgICAgICBjb25zb2xlLmxvZygxKTtcbi8vICAgICAgICAgICAgIH1cbi8vICAgICAgICAgICAgIGlmIChmYWRlVGFyZ2V0LnN0eWxlLm9wYWNpdHkgPiAwKSB7XG4vLyAgICAgICAgICAgICAgICAgZmFkZVRhcmdldC5zdHlsZS5vcGFjaXR5IC09IDAuMTtcbi8vICAgICAgICAgICAgICAgICBjb25zb2xlLmxvZygyKTtcbi8vICAgICAgICAgICAgIH0gZWxzZSB7XG4vLyAgICAgICAgICAgICAgICAgZmFkZVRhcmdldC5zdHlsZS52aXNpYmlsaXR5ID0gJ2hpZGRlbic7XG4vLyAgICAgICAgICAgICAgICAgY2xlYXJJbnRlcnZhbChzZXRFZmZlY3QpO1xuLy8gICAgICAgICAgICAgICAgIGNvbnNvbGUubG9nKDMpO1xuLy8gICAgICAgICAgICAgICAgIHJldHVybiBmYWxzZVxuLy8gICAgICAgICAgICAgfVxuLy8gICAgICAgICB9LDUpO1xuLy8gICAgIH0sMTApO1xuLy8gfVxubGV0ICRlbCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNwcmVsb2FkZXInKTtcbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsIChldmVudCkgPT4ge1xuICAgIGNvbnNvbGUubG9nKCdET01Db250ZW50TG9hZGVkID0+INC30LDQs9GA0YPQttC10L0gRE9NINCx0LXQtyDRgdGC0LjQu9C10Lkg0Lgg0YHQutGA0LjQv9GC0L7QsicpO1xuICAgIC8vIGZhZGVPdXRFZmZlY3QoJGVsKVxuICAgIC8vIGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNwcmVsb2FkZXInKS5zdHlsZS52aXNpYmlsaXR5ID0gJ2hpZGRlbic7XG4gICAgd2luZG93Lm9ubG9hZCA9IChldmVudCkgPT4ge1xuICAgICAgICBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcjcHJlbG9hZGVyJykuc3R5bGUudmlzaWJpbGl0eSA9ICdoaWRkZW4nO1xuICAgICAgICBjb25zb2xlLmxvZygnd2luZG93Lm9ubG9hZCA9PiDRgdGC0YDQsNC90LjRhtCwINC/0L7Qu9C90L7RgdGC0YzRjiDQt9Cw0LPRgNGD0LbQtdC90LAnKTtcblxuICAgICAgICBsZXQgaW5wdXRGID0gJCgnLmlucHV0X19maWVsZCcpO1xuICAgICAgICBpbnB1dEYuZWFjaChmdW5jdGlvbiAoKSB7XG4gICAgICAgICAgICBsZXQgaW5wdXRGID0gJCh0aGlzKSxcbiAgICAgICAgICAgICAgICBpbnB1dFIgPSBpbnB1dEYuY2xvc2VzdCgnLmlucHV0X19yb3cnKTtcbiAgICAgICAgICAgIGlmIChpbnB1dEYuaXMoJzpmb2N1cycpIHx8IChpbnB1dEYudmFsKCkgIT0gJycgJiYgaW5wdXRGLmlzKCc6aW5wdXQnKSkpIHtcbiAgICAgICAgICAgICAgICBpbnB1dFIuYWRkQ2xhc3MoJ2lzX2ZvY3VzJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBpZiAoaW5wdXRGLmlzKCc6ZGlzYWJsZWQnKSkge1xuICAgICAgICAgICAgICAgIGlucHV0Ui5hZGRDbGFzcygnaXNfZGlzYWJsZWQnKTtcbiAgICAgICAgICAgIH1cbiAgICAgICAgfSkgICAgICAgICAgICBcbiAgICAgICAgLy8gZmFkZU91dEVmZmVjdCgkZWwpXG4gICAgfTtcbn0pO1xuIiwiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW4iLCIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpbiIsIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luIiwiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW4iLCIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpbiIsIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luIiwiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW4iLCIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpbiIsIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luIiwiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW4iLCIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpbiIsIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luIiwiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW4iLCIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpbiIsIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luIiwiLy8gcmVtb3ZlZCBieSBleHRyYWN0LXRleHQtd2VicGFjay1wbHVnaW4iLCIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpbiJdLCJzb3VyY2VSb290IjoiIn0=