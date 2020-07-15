import axios from "axios";
import U from "../util/U.js";

export default class ApiDataAccess {
	host;
	constructor() {
		this.host =
			window.location.host === "localhost:8080"
				? "http://localhost/levelz.app/"
				: "";
	}

	callAPI(noun, verb, extra = {}) {
		return new Promise((resolve, reject) => {
			let d = {
				data: {
					n: noun,
					v: verb
				}
			};
			if (!U.isEmpty(extra)) {
				d.data = Object.assign(d.data, extra);
			}
			axios
				.post(this.host + "api/", d)
				.catch(error => {
					console.log(error);
					reject();
				})
				.then(response => {
					resolve(response.data["success"]);
				});
		});
	}

	getActivitySuggestions() {
		return this.callAPI("activity", "getActivitySuggestions");
	}

	createNewActivity(activityData) {
		return this.callAPI("activity", "createNewActivity", activityData);
	}

	getAllMyActivities() {
		return this.callAPI("activity", "getAllMyActivities");
	}

	saveActivityChanges(activityData) {
		return this.callAPI("activity", "saveActivityChanges", activityData);
	}
}
