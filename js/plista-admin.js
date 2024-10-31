/*global document, window*/

var plistaadmin = {
	init: function () {
		"use strict";
		var pdesign = document.getElementById('plistadesignbox'),
			pmdesign = document.getElementById('plistamobiledesignbox'),
			pmcheckdesign = document.getElementById('plista_mobile_editcss'),
			pcheckdesign = document.getElementById('plista_editcss');

		if (!pdesign && !pmdesign && !pmcheckdesign && !pcheckdesign) {
			return;
		}

		pdesign.className = pmdesign.className = 'plistahide';

		if (pcheckdesign.checked === true) {
			pdesign.className = 'plistashow';
		}

		pcheckdesign.onclick = function () {
			if (pcheckdesign.checked === true) {
				pdesign.className = 'plistashow';
			} else {
				pdesign.className = 'plistahide';
			}
		};

		if (pmcheckdesign.checked === true) {
			pmdesign.className = 'plistashow';
		}

		pmcheckdesign.onclick = function () {
			if (pmcheckdesign.checked === true) {
				pmdesign.className = 'plistashow';
			} else {
				pmdesign.className = 'plistahide';
			}
		};
	}
};

if (typeof (window.addEventListener) !== 'undefined') {
	window.addEventListener("load", plistaadmin.init, false);
} else if (typeof (window.attachEvent) !== 'undefined') {
	window.attachEvent("onload", plistaadmin.init);
}
