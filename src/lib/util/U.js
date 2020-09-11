/* eslint-disable no-prototype-builtins */
"use strict";
import _ from "lodash";

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
	static cloneDeep(o) {
		return _.cloneDeep(o);
	}
	static isEqual(o) {
		return _.isEqual(o);
	}
}

export default U;
