import moment from "moment";
import _ from "lodash";
export const util = {
	methods: {
		formatDate(date, type = "long") {
			if (type === "short") {
				return moment(Date.parse(date)).format("MM/DD/YYYY");
			} else if (type === "long") {
				return moment(Date.parse(date)).format("MMMM Do YYYY, (h:mm:ss a)");
			} else {
				return date;
			}
		},
		ucFirst(s) {
			if (typeof s === "string") {
				return s.charAt(0).toUpperCase() + s.slice(1);
			}
		},
		cloneDeep(o) {
			return _.cloneDeep(o);
		}
	}
};
