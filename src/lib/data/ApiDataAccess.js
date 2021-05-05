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

	uploadFormData(noun, verb, formData) {
		return new Promise((resolve, reject) => {
			const data = {
				n: noun,
				v: verb
			};
			formData.append("data", JSON.stringify(data));
			axios
				.post(this.vue.$store.getters.host + "api/", formData)
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
		return this.callAPI(
			["Auth", "SignupController"],
			"submitSignup",
			signupData
		);
	}

	verifyEmailAddress(verifyData) {
		return this.callAPI(
			["Auth", "SignupController"],
			"verifyEmailAddress",
			verifyData
		).then(response => {
			return Promise.resolve(response.data);
		});
	}

	submitLogin(loginData) {
		return this.callAPI(["Auth", "LoginController"], "submitLogin", loginData);
	}

	checkSession() {
		//return this.callAPI("auth", "checkSession");
		return this.callAPI(["Auth", "SessionController"], "checkSession");
	}

	getUserProfileById(userProfileId) {
		return this.callAPI(["User", "UserProfile"], "getUserProfileById", {
			userProfileId: userProfileId
		});
	}

	submitUserProfilePicture(formData) {
		return this.uploadFormData(
			["User", "UserProfile"],
			"submitUserProfilePicture",
			formData
		);
	}

	getUserProfilePicUrlByUserId(userId) {
		return this.callAPI(
			["User", "UserProfile"],
			"getUserProfilePicUrlByUserId",
			{ userId: userId }
		);
	}

	getAllUserProfilePictures() {
		return this.callAPI(["User", "UserProfile"], "getAllUserProfilePictures");
	}

	updateDefaultUserProfilePic(fileName) {
		return this.callAPI(
			["User", "UserProfile"],
			"updateDefaultUserProfilePic",
			{
				fileName: fileName
			}
		);
	}

	logout() {
		//return this.callAPI("auth", "logout");
		return this.callAPI(["Auth", "SessionController"], "logout");
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

	userHasPermission(data) {
		return this.callAPI("User", "userHasPermission", data);
	}

	getActionsByActivityId(activityData) {
		return this.callAPI("Action", "getActionsByActivityId", activityData);
	}

	createNewAction(actionData) {
		return this.callAPI("Action", "createNewAction", actionData);
	}

	updateAction(actionData) {
		return this.callAPI("Action", "updateAction", actionData);
	}

	completeActionById(actionData) {
		return this.callAPI("Action", "completeActionById", actionData);
	}
}
