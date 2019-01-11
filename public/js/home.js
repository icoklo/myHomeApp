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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 39);
/******/ })
/************************************************************************/
/******/ ({

/***/ 39:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(40);


/***/ }),

/***/ 40:
/***/ (function(module, exports) {

var city = $('div#vrijeme').data('city');
var interval = $('div#vrijeme').data('interval');
var intervalCurrency = $('div#tecajna_lista').data('interval');
var intervalDate = $('div#datum').data('interval');
var base_url = 'http://my-home-app.loc';

function weather() {

    $.ajax({
        method: "GET",
        url: base_url + "/weather",
        cache: false,
        dataType: "json",
        crossDomain: true,
        data: { q: city },
        error: function error() {
            console.log("Greska 1001");
        },
        success: function success(response) {
            //alert("Radi");
            var text = response.name + ', ' + response.weather[0].description + ', ';
            text += response.main.temp + ' °C';
            $('div#vrijeme').html(text);
        }
    });

    // interval * 1000 because interval needs to be in miliseconds
    setTimeout(weather, interval * 1000);
}

function currencyList() {

    $.ajax({
        method: "GET",
        url: base_url + "/currency-list",
        cache: false,
        dataType: "json",
        crossDomain: true,
        error: function error() {
            console.log("Greska 1002");
        },
        success: function success(response) {
            //alert("Radi");
            $('div#tecajna_lista').html(response.rates.HRK);
        }
    });

    // interval * 1000 because interval needs to be in miliseconds
    setTimeout(currencyList, intervalCurrency * 1000);
}

function date() {

    $.ajax({
        method: "GET",
        url: base_url + "/date",
        cache: false,
        dataType: "json",
        crossDomain: true,
        error: function error() {
            console.log("Greska 1003");
        },
        success: function success(response) {
            //alert("Radi");
            $('div#datum').html(response.date);
        }
    });

    // interval * 1000 because interval needs to be in miliseconds
    setTimeout(date, intervalDate * 1000);
}

$(document).ready(function () {

    console.log("home.js");

    if (typeof intervalCurrency !== 'undefined') {
        currencyList();
    }
    if (typeof city !== 'undefined' && typeof interval !== 'undefined') {
        weather();
    }
    if (typeof intervalDate !== 'undefined') {
        date();
    }
});

/***/ })

/******/ });