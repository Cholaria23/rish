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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/adminpanel/js/navbar-style.js":
/*!*************************************************!*\
  !*** ./resources/adminpanel/js/navbar-style.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var localStorage = window.localStorage;

function positionNavbar() {
  var stateMenu = localStorage.getItem('stateMenu');

  if (document.querySelector('[data-menu-click]')) {
    var click = document.querySelector('[data-menu-click]'),
        clickOpen = click.getAttribute('data-menu-click'),
        clickParent = document.querySelector('.js_menu_parent'),
        openBlock = document.querySelector('[data-menu="' + clickOpen + '"]');

    if (stateMenu !== null) {
      click.classList.add('is_active');
      openBlock.classList.add('is_active');
      clickParent.classList.add('navbar_close');
    } else {
      if (window.innerWidth > 1025) {
        click.classList.remove('is_active');
        openBlock.classList.remove('is_active');
        clickParent.classList.remove('navbar_close');
      } else {
        click.classList.add('is_active');
        openBlock.classList.add('is_active');
        clickParent.classList.add('navbar_close');
      }
    }
  }
}

function bgNavbar() {
  var bg = localStorage.getItem('bg'),
      nav = document.getElementById('main_nav');

  if (bg !== null) {
    nav.style.background = "url('" + bg + "') center center/cover no-repeat";
  } else {
    nav.removeAttribute('style');
  }
} // document.addEventListener("DOMContentLoaded", bgNavbar());
// document.addEventListener("DOMContentLoaded", positionNavbar());


document.addEventListener("DOMContentLoaded", function () {
  // bgNavbar();
  positionNavbar();
});
window.onresize = positionNavbar;

/***/ }),

/***/ 1:
/*!*******************************************************!*\
  !*** multi ./resources/adminpanel/js/navbar-style.js ***!
  \*******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/natali/www/adminpanel.loc/resources/adminpanel/js/navbar-style.js */"./resources/adminpanel/js/navbar-style.js");


/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vcmVzb3VyY2VzL2FkbWlucGFuZWwvanMvbmF2YmFyLXN0eWxlLmpzIl0sIm5hbWVzIjpbImxvY2FsU3RvcmFnZSIsIndpbmRvdyIsInBvc2l0aW9uTmF2YmFyIiwic3RhdGVNZW51IiwiZ2V0SXRlbSIsImRvY3VtZW50IiwicXVlcnlTZWxlY3RvciIsImNsaWNrIiwiY2xpY2tPcGVuIiwiZ2V0QXR0cmlidXRlIiwiY2xpY2tQYXJlbnQiLCJvcGVuQmxvY2siLCJjbGFzc0xpc3QiLCJhZGQiLCJpbm5lcldpZHRoIiwicmVtb3ZlIiwiYmdOYXZiYXIiLCJiZyIsIm5hdiIsImdldEVsZW1lbnRCeUlkIiwic3R5bGUiLCJiYWNrZ3JvdW5kIiwicmVtb3ZlQXR0cmlidXRlIiwiYWRkRXZlbnRMaXN0ZW5lciIsIm9ucmVzaXplIl0sIm1hcHBpbmdzIjoiO1FBQUE7UUFDQTs7UUFFQTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBOztRQUVBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7OztRQUdBO1FBQ0E7O1FBRUE7UUFDQTs7UUFFQTtRQUNBO1FBQ0E7UUFDQSwwQ0FBMEMsZ0NBQWdDO1FBQzFFO1FBQ0E7O1FBRUE7UUFDQTtRQUNBO1FBQ0Esd0RBQXdELGtCQUFrQjtRQUMxRTtRQUNBLGlEQUFpRCxjQUFjO1FBQy9EOztRQUVBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQTtRQUNBO1FBQ0E7UUFDQSx5Q0FBeUMsaUNBQWlDO1FBQzFFLGdIQUFnSCxtQkFBbUIsRUFBRTtRQUNySTtRQUNBOztRQUVBO1FBQ0E7UUFDQTtRQUNBLDJCQUEyQiwwQkFBMEIsRUFBRTtRQUN2RCxpQ0FBaUMsZUFBZTtRQUNoRDtRQUNBO1FBQ0E7O1FBRUE7UUFDQSxzREFBc0QsK0RBQStEOztRQUVySDtRQUNBOzs7UUFHQTtRQUNBOzs7Ozs7Ozs7Ozs7QUNsRkEsSUFBSUEsWUFBWSxHQUFHQyxNQUFNLENBQUNELFlBQTFCOztBQUNBLFNBQVNFLGNBQVQsR0FBMEI7QUFDdEIsTUFBSUMsU0FBUyxHQUFHSCxZQUFZLENBQUNJLE9BQWIsQ0FBcUIsV0FBckIsQ0FBaEI7O0FBQ0EsTUFBSUMsUUFBUSxDQUFDQyxhQUFULENBQXVCLG1CQUF2QixDQUFKLEVBQWlEO0FBQzdDLFFBQUlDLEtBQUssR0FBR0YsUUFBUSxDQUFDQyxhQUFULENBQXVCLG1CQUF2QixDQUFaO0FBQUEsUUFDSUUsU0FBUyxHQUFHRCxLQUFLLENBQUNFLFlBQU4sQ0FBbUIsaUJBQW5CLENBRGhCO0FBQUEsUUFFSUMsV0FBVyxHQUFHTCxRQUFRLENBQUNDLGFBQVQsQ0FBdUIsaUJBQXZCLENBRmxCO0FBQUEsUUFHSUssU0FBUyxHQUFHTixRQUFRLENBQUNDLGFBQVQsQ0FBdUIsaUJBQWdCRSxTQUFoQixHQUEyQixJQUFsRCxDQUhoQjs7QUFJQSxRQUFJTCxTQUFTLEtBQUssSUFBbEIsRUFBd0I7QUFDcEJJLFdBQUssQ0FBQ0ssU0FBTixDQUFnQkMsR0FBaEIsQ0FBb0IsV0FBcEI7QUFDQUYsZUFBUyxDQUFDQyxTQUFWLENBQW9CQyxHQUFwQixDQUF3QixXQUF4QjtBQUNBSCxpQkFBVyxDQUFDRSxTQUFaLENBQXNCQyxHQUF0QixDQUEwQixjQUExQjtBQUNILEtBSkQsTUFJTztBQUNILFVBQUdaLE1BQU0sQ0FBQ2EsVUFBUCxHQUFvQixJQUF2QixFQUE2QjtBQUN6QlAsYUFBSyxDQUFDSyxTQUFOLENBQWdCRyxNQUFoQixDQUF1QixXQUF2QjtBQUNBSixpQkFBUyxDQUFDQyxTQUFWLENBQW9CRyxNQUFwQixDQUEyQixXQUEzQjtBQUNBTCxtQkFBVyxDQUFDRSxTQUFaLENBQXNCRyxNQUF0QixDQUE2QixjQUE3QjtBQUNILE9BSkQsTUFJTztBQUNIUixhQUFLLENBQUNLLFNBQU4sQ0FBZ0JDLEdBQWhCLENBQW9CLFdBQXBCO0FBQ0FGLGlCQUFTLENBQUNDLFNBQVYsQ0FBb0JDLEdBQXBCLENBQXdCLFdBQXhCO0FBQ0FILG1CQUFXLENBQUNFLFNBQVosQ0FBc0JDLEdBQXRCLENBQTBCLGNBQTFCO0FBQ0g7QUFDSjtBQUNKO0FBQ0o7O0FBRUQsU0FBU0csUUFBVCxHQUFvQjtBQUNoQixNQUFJQyxFQUFFLEdBQUdqQixZQUFZLENBQUNJLE9BQWIsQ0FBcUIsSUFBckIsQ0FBVDtBQUFBLE1BQ0ljLEdBQUcsR0FBR2IsUUFBUSxDQUFDYyxjQUFULENBQXdCLFVBQXhCLENBRFY7O0FBR0EsTUFBSUYsRUFBRSxLQUFLLElBQVgsRUFBaUI7QUFDYkMsT0FBRyxDQUFDRSxLQUFKLENBQVVDLFVBQVYsR0FBdUIsVUFBUUosRUFBUixHQUFXLGtDQUFsQztBQUNILEdBRkQsTUFFTztBQUNIQyxPQUFHLENBQUNJLGVBQUosQ0FBb0IsT0FBcEI7QUFDSDtBQUNKLEMsQ0FDRDtBQUNBOzs7QUFDQWpCLFFBQVEsQ0FBQ2tCLGdCQUFULENBQTBCLGtCQUExQixFQUE4QyxZQUFZO0FBQ3REO0FBQ0FyQixnQkFBYztBQUNqQixDQUhEO0FBS0FELE1BQU0sQ0FBQ3VCLFFBQVAsR0FBa0J0QixjQUFsQixDIiwiZmlsZSI6Ii9kZW1vcy9BZG1pblBhbmVsL2pzL25hdmJhci1zdHlsZS5qcyIsInNvdXJjZXNDb250ZW50IjpbIiBcdC8vIFRoZSBtb2R1bGUgY2FjaGVcbiBcdHZhciBpbnN0YWxsZWRNb2R1bGVzID0ge307XG5cbiBcdC8vIFRoZSByZXF1aXJlIGZ1bmN0aW9uXG4gXHRmdW5jdGlvbiBfX3dlYnBhY2tfcmVxdWlyZV9fKG1vZHVsZUlkKSB7XG5cbiBcdFx0Ly8gQ2hlY2sgaWYgbW9kdWxlIGlzIGluIGNhY2hlXG4gXHRcdGlmKGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdKSB7XG4gXHRcdFx0cmV0dXJuIGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdLmV4cG9ydHM7XG4gXHRcdH1cbiBcdFx0Ly8gQ3JlYXRlIGEgbmV3IG1vZHVsZSAoYW5kIHB1dCBpdCBpbnRvIHRoZSBjYWNoZSlcbiBcdFx0dmFyIG1vZHVsZSA9IGluc3RhbGxlZE1vZHVsZXNbbW9kdWxlSWRdID0ge1xuIFx0XHRcdGk6IG1vZHVsZUlkLFxuIFx0XHRcdGw6IGZhbHNlLFxuIFx0XHRcdGV4cG9ydHM6IHt9XG4gXHRcdH07XG5cbiBcdFx0Ly8gRXhlY3V0ZSB0aGUgbW9kdWxlIGZ1bmN0aW9uXG4gXHRcdG1vZHVsZXNbbW9kdWxlSWRdLmNhbGwobW9kdWxlLmV4cG9ydHMsIG1vZHVsZSwgbW9kdWxlLmV4cG9ydHMsIF9fd2VicGFja19yZXF1aXJlX18pO1xuXG4gXHRcdC8vIEZsYWcgdGhlIG1vZHVsZSBhcyBsb2FkZWRcbiBcdFx0bW9kdWxlLmwgPSB0cnVlO1xuXG4gXHRcdC8vIFJldHVybiB0aGUgZXhwb3J0cyBvZiB0aGUgbW9kdWxlXG4gXHRcdHJldHVybiBtb2R1bGUuZXhwb3J0cztcbiBcdH1cblxuXG4gXHQvLyBleHBvc2UgdGhlIG1vZHVsZXMgb2JqZWN0IChfX3dlYnBhY2tfbW9kdWxlc19fKVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5tID0gbW9kdWxlcztcblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGUgY2FjaGVcbiBcdF9fd2VicGFja19yZXF1aXJlX18uYyA9IGluc3RhbGxlZE1vZHVsZXM7XG5cbiBcdC8vIGRlZmluZSBnZXR0ZXIgZnVuY3Rpb24gZm9yIGhhcm1vbnkgZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kID0gZnVuY3Rpb24oZXhwb3J0cywgbmFtZSwgZ2V0dGVyKSB7XG4gXHRcdGlmKCFfX3dlYnBhY2tfcmVxdWlyZV9fLm8oZXhwb3J0cywgbmFtZSkpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgbmFtZSwgeyBlbnVtZXJhYmxlOiB0cnVlLCBnZXQ6IGdldHRlciB9KTtcbiBcdFx0fVxuIFx0fTtcblxuIFx0Ly8gZGVmaW5lIF9fZXNNb2R1bGUgb24gZXhwb3J0c1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yID0gZnVuY3Rpb24oZXhwb3J0cykge1xuIFx0XHRpZih0eXBlb2YgU3ltYm9sICE9PSAndW5kZWZpbmVkJyAmJiBTeW1ib2wudG9TdHJpbmdUYWcpIHtcbiBcdFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgU3ltYm9sLnRvU3RyaW5nVGFnLCB7IHZhbHVlOiAnTW9kdWxlJyB9KTtcbiBcdFx0fVxuIFx0XHRPYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgJ19fZXNNb2R1bGUnLCB7IHZhbHVlOiB0cnVlIH0pO1xuIFx0fTtcblxuIFx0Ly8gY3JlYXRlIGEgZmFrZSBuYW1lc3BhY2Ugb2JqZWN0XG4gXHQvLyBtb2RlICYgMTogdmFsdWUgaXMgYSBtb2R1bGUgaWQsIHJlcXVpcmUgaXRcbiBcdC8vIG1vZGUgJiAyOiBtZXJnZSBhbGwgcHJvcGVydGllcyBvZiB2YWx1ZSBpbnRvIHRoZSBuc1xuIFx0Ly8gbW9kZSAmIDQ6IHJldHVybiB2YWx1ZSB3aGVuIGFscmVhZHkgbnMgb2JqZWN0XG4gXHQvLyBtb2RlICYgOHwxOiBiZWhhdmUgbGlrZSByZXF1aXJlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnQgPSBmdW5jdGlvbih2YWx1ZSwgbW9kZSkge1xuIFx0XHRpZihtb2RlICYgMSkgdmFsdWUgPSBfX3dlYnBhY2tfcmVxdWlyZV9fKHZhbHVlKTtcbiBcdFx0aWYobW9kZSAmIDgpIHJldHVybiB2YWx1ZTtcbiBcdFx0aWYoKG1vZGUgJiA0KSAmJiB0eXBlb2YgdmFsdWUgPT09ICdvYmplY3QnICYmIHZhbHVlICYmIHZhbHVlLl9fZXNNb2R1bGUpIHJldHVybiB2YWx1ZTtcbiBcdFx0dmFyIG5zID0gT2JqZWN0LmNyZWF0ZShudWxsKTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5yKG5zKTtcbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KG5zLCAnZGVmYXVsdCcsIHsgZW51bWVyYWJsZTogdHJ1ZSwgdmFsdWU6IHZhbHVlIH0pO1xuIFx0XHRpZihtb2RlICYgMiAmJiB0eXBlb2YgdmFsdWUgIT0gJ3N0cmluZycpIGZvcih2YXIga2V5IGluIHZhbHVlKSBfX3dlYnBhY2tfcmVxdWlyZV9fLmQobnMsIGtleSwgZnVuY3Rpb24oa2V5KSB7IHJldHVybiB2YWx1ZVtrZXldOyB9LmJpbmQobnVsbCwga2V5KSk7XG4gXHRcdHJldHVybiBucztcbiBcdH07XG5cbiBcdC8vIGdldERlZmF1bHRFeHBvcnQgZnVuY3Rpb24gZm9yIGNvbXBhdGliaWxpdHkgd2l0aCBub24taGFybW9ueSBtb2R1bGVzXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm4gPSBmdW5jdGlvbihtb2R1bGUpIHtcbiBcdFx0dmFyIGdldHRlciA9IG1vZHVsZSAmJiBtb2R1bGUuX19lc01vZHVsZSA/XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0RGVmYXVsdCgpIHsgcmV0dXJuIG1vZHVsZVsnZGVmYXVsdCddOyB9IDpcbiBcdFx0XHRmdW5jdGlvbiBnZXRNb2R1bGVFeHBvcnRzKCkgeyByZXR1cm4gbW9kdWxlOyB9O1xuIFx0XHRfX3dlYnBhY2tfcmVxdWlyZV9fLmQoZ2V0dGVyLCAnYScsIGdldHRlcik7XG4gXHRcdHJldHVybiBnZXR0ZXI7XG4gXHR9O1xuXG4gXHQvLyBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGxcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubyA9IGZ1bmN0aW9uKG9iamVjdCwgcHJvcGVydHkpIHsgcmV0dXJuIE9iamVjdC5wcm90b3R5cGUuaGFzT3duUHJvcGVydHkuY2FsbChvYmplY3QsIHByb3BlcnR5KTsgfTtcblxuIFx0Ly8gX193ZWJwYWNrX3B1YmxpY19wYXRoX19cbiBcdF9fd2VicGFja19yZXF1aXJlX18ucCA9IFwiL1wiO1xuXG5cbiBcdC8vIExvYWQgZW50cnkgbW9kdWxlIGFuZCByZXR1cm4gZXhwb3J0c1xuIFx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oX193ZWJwYWNrX3JlcXVpcmVfXy5zID0gMSk7XG4iLCJsZXQgbG9jYWxTdG9yYWdlID0gd2luZG93LmxvY2FsU3RvcmFnZTtcbmZ1bmN0aW9uIHBvc2l0aW9uTmF2YmFyKCkge1xuICAgIGxldCBzdGF0ZU1lbnUgPSBsb2NhbFN0b3JhZ2UuZ2V0SXRlbSgnc3RhdGVNZW51Jyk7XG4gICAgaWYgKGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJ1tkYXRhLW1lbnUtY2xpY2tdJykpIHtcbiAgICAgICAgbGV0IGNsaWNrID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignW2RhdGEtbWVudS1jbGlja10nKSxcbiAgICAgICAgICAgIGNsaWNrT3BlbiA9IGNsaWNrLmdldEF0dHJpYnV0ZSgnZGF0YS1tZW51LWNsaWNrJyksXG4gICAgICAgICAgICBjbGlja1BhcmVudCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJy5qc19tZW51X3BhcmVudCcpLFxuICAgICAgICAgICAgb3BlbkJsb2NrID0gZG9jdW1lbnQucXVlcnlTZWxlY3RvcignW2RhdGEtbWVudT1cIicrIGNsaWNrT3BlbiArJ1wiXScpO1xuICAgICAgICBpZiAoc3RhdGVNZW51ICE9PSBudWxsKSB7XG4gICAgICAgICAgICBjbGljay5jbGFzc0xpc3QuYWRkKCdpc19hY3RpdmUnKTtcbiAgICAgICAgICAgIG9wZW5CbG9jay5jbGFzc0xpc3QuYWRkKCdpc19hY3RpdmUnKTtcbiAgICAgICAgICAgIGNsaWNrUGFyZW50LmNsYXNzTGlzdC5hZGQoJ25hdmJhcl9jbG9zZScpO1xuICAgICAgICB9IGVsc2Uge1xuICAgICAgICAgICAgaWYod2luZG93LmlubmVyV2lkdGggPiAxMDI1KSB7XG4gICAgICAgICAgICAgICAgY2xpY2suY2xhc3NMaXN0LnJlbW92ZSgnaXNfYWN0aXZlJyk7XG4gICAgICAgICAgICAgICAgb3BlbkJsb2NrLmNsYXNzTGlzdC5yZW1vdmUoJ2lzX2FjdGl2ZScpO1xuICAgICAgICAgICAgICAgIGNsaWNrUGFyZW50LmNsYXNzTGlzdC5yZW1vdmUoJ25hdmJhcl9jbG9zZScpO1xuICAgICAgICAgICAgfSBlbHNlIHtcbiAgICAgICAgICAgICAgICBjbGljay5jbGFzc0xpc3QuYWRkKCdpc19hY3RpdmUnKTtcbiAgICAgICAgICAgICAgICBvcGVuQmxvY2suY2xhc3NMaXN0LmFkZCgnaXNfYWN0aXZlJyk7XG4gICAgICAgICAgICAgICAgY2xpY2tQYXJlbnQuY2xhc3NMaXN0LmFkZCgnbmF2YmFyX2Nsb3NlJyk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH1cbiAgICB9XG59XG5cbmZ1bmN0aW9uIGJnTmF2YmFyKCkge1xuICAgIGxldCBiZyA9IGxvY2FsU3RvcmFnZS5nZXRJdGVtKCdiZycpLFxuICAgICAgICBuYXYgPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnbWFpbl9uYXYnKTtcblxuICAgIGlmIChiZyAhPT0gbnVsbCkge1xuICAgICAgICBuYXYuc3R5bGUuYmFja2dyb3VuZCA9IFwidXJsKCdcIitiZytcIicpIGNlbnRlciBjZW50ZXIvY292ZXIgbm8tcmVwZWF0XCI7XG4gICAgfSBlbHNlIHtcbiAgICAgICAgbmF2LnJlbW92ZUF0dHJpYnV0ZSgnc3R5bGUnKTtcbiAgICB9XG59XG4vLyBkb2N1bWVudC5hZGRFdmVudExpc3RlbmVyKFwiRE9NQ29udGVudExvYWRlZFwiLCBiZ05hdmJhcigpKTtcbi8vIGRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsIHBvc2l0aW9uTmF2YmFyKCkpO1xuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcihcIkRPTUNvbnRlbnRMb2FkZWRcIiwgZnVuY3Rpb24gKCkge1xuICAgIC8vIGJnTmF2YmFyKCk7XG4gICAgcG9zaXRpb25OYXZiYXIoKTtcbn0pO1xuXG53aW5kb3cub25yZXNpemUgPSBwb3NpdGlvbk5hdmJhcjtcbiJdLCJzb3VyY2VSb290IjoiIn0=