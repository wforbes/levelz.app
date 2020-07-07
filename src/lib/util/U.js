/* eslint-disable no-prototype-builtins */
"use strict";

class U {
	static isEmpty(v) {
		return (
			typeof v === "undefined" ||
			v === null ||
			(v.hasOwnProperty("length") && v.length === 0) ||
			(v.constructor === Object && Object.keys(v).length === 0)
		);
	}
	static ucFirst(s) {
		if (typeof s === "string") {
			return s.charAt(0).toUpperCase() + s.slice(1);
		}
	}
	static getRandomInt(max) {
		return Math.floor(Math.random() * Math.floor(max));
	}
}

export default U;
