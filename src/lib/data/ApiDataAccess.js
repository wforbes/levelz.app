import axios from "axios";
import U from "../util/U.js";

export default class ApiDataAccess {
	host;
	constructor(vue) {
		this.vue = vue;
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
				.post(this.vue.$store.getters.host + "api/", d)
				.catch(error => {
					console.error(error);
					reject();
				})
				.then(response => {
					resolve(response);
				});
		});
	}

	submitSignup(signupData) {
		return this.callAPI("auth", "signup", signupData);
	}

	submitLogin(loginData) {
		return this.callAPI("auth", "login", loginData);
	}

	checkSession() {
		return this.callAPI("auth", "checkSession");
	}

	getProfileById(userProfileId) {
		return this.callAPI(["user", "UserProfile"], "getProfileById", {
			userProfileId: userProfileId
		});
	}

	logout() {
		return this.callAPI("auth", "logout");
	}

	//TODO: rework to accomodate callAPI resolving the whole response object
	getActivitySuggestions() {
		return this.callAPI("activity", "getActivitySuggestions");
	}

	activityNameExists(name) {
		return this.callAPI("activity", "activityNameExists", { name: name });
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

	updateActivityField(data) {
		return this.callAPI("activity", "updateActivityField", data);
	}
	/*
	checkPermission(data) {
		return this.callAPI("auth", "checkPermission", data);
	}*/
}
