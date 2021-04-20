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

	static getEmailRegex() {
		// eslint-disable-next-line no-control-regex
		return /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
	}

	static getNoSpecialCharRegex() {
		return /^[a-zA-Z\d._]+$/;
	}

	static getBeginsWithNumberRegex() {
		return /^[\d]+$/;
	}

	static getContainsSpecialCharRegex() {
		return /[!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]/g;
	}
}

export default U;
