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
}

export default U;
