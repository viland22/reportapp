(function webpackUniversalModuleDefinition(root, factory) {
	if(typeof exports === 'object' && typeof module === 'object')
		module.exports = factory(require("jQuery"));
	else if(typeof define === 'function' && define.amd)
		define(["jQuery"], factory);
	else {
		var a = typeof exports === 'object' ? factory(require("jQuery")) : factory(root["jQuery"]);
		for(var i in a) (typeof exports === 'object' ? exports : root)[i] = a[i];
	}
})(self, function(__WEBPACK_EXTERNAL_MODULE_jquery__) {
return /******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/vendor/js/dataTables.bootstrap5.js":
/*!*************************************************************!*\
  !*** ./resources/assets/vendor/js/dataTables.bootstrap5.js ***!
  \*************************************************************/
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
/*! DataTables Bootstrap 5 integration
 * 2020 SpryMedia Ltd - datatables.net/license
 */

(function (factory) {
  if (true) {
    // AMD
    !(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(/*! jquery */ "jquery"), Object(function webpackMissingModule() { var e = new Error("Cannot find module 'datatables.net'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())], __WEBPACK_AMD_DEFINE_RESULT__ = (function ($) {
      return factory($, window, document);
    }).apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
  } else { var cjsRequires, jq; }
})(function ($, window, document) {
  'use strict';

  var DataTable = $.fn.dataTable;

  /**
   * DataTables integration for Bootstrap 5. This requires Bootstrap 5 and
   * DataTables 2 or newer.
   *
   * This file sets the defaults and adds options to DataTables to style its
   * controls using Bootstrap. See https://datatables.net/manual/styling/bootstrap
   * for further information.
   */

  /* Set the defaults for DataTables initialisation */
  $.extend(true, DataTable.defaults, {
    renderer: 'bootstrap'
  });

  /* Default class modification */
  $.extend(true, DataTable.ext.classes, {
    container: "dt-container dt-bootstrap5",
    search: {
      input: "form-control form-control-sm"
    },
    length: {
      select: "form-select form-select-sm"
    },
    processing: {
      container: "dt-processing card"
    }
  });

  /* Bootstrap paging button renderer */
  DataTable.ext.renderer.pagingButton.bootstrap = function (settings, buttonType, content, active, disabled) {
    var btnClasses = ['dt-paging-button', 'page-item'];
    if (active) {
      btnClasses.push('active');
    }
    if (disabled) {
      btnClasses.push('disabled');
    }
    var li = $('<li>').addClass(btnClasses.join(' '));
    var a = $('<a>', {
      'href': disabled ? null : '#',
      'class': 'page-link'
    }).html(content).appendTo(li);
    return {
      display: li,
      clicker: a
    };
  };
  DataTable.ext.renderer.pagingContainer.bootstrap = function (settings, buttonEls) {
    return $('<ul/>').addClass('pagination').append(buttonEls);
  };
  DataTable.ext.renderer.layout.bootstrap = function (settings, container, items) {
    var row = $('<div/>', {
      "class": items.full ? 'row mt-2 justify-content-md-center' : 'row mt-2 justify-content-between'
    }).appendTo(container);
    $.each(items, function (key, val) {
      var klass;

      // Apply start / end (left / right when ltr) margins
      if (val.table) {
        klass = 'col-12';
      } else if (key === 'start') {
        klass = 'col-md-auto me-auto';
      } else if (key === 'end') {
        klass = 'col-md-auto ms-auto';
      } else {
        klass = 'col-md';
      }
      $('<div/>', {
        id: val.id || null,
        "class": klass + ' ' + (val.className || '')
      }).append(val.contents).appendTo(row);
    });
  };
  return DataTable;
});

/***/ }),

/***/ "jquery":
/*!*************************!*\
  !*** external "jQuery" ***!
  \*************************/
/***/ (function(module) {

"use strict";
module.exports = __WEBPACK_EXTERNAL_MODULE_jquery__;

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module used 'module' so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/assets/vendor/js/dataTables.bootstrap5.js");
/******/ 	
/******/ 	return __webpack_exports__;
/******/ })()
;
});