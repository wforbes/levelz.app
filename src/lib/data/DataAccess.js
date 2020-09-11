import ApiDataAccess from "./ApiDataAccess.js";

export default class DataAccess {
	host;
	dataContext;
	constructor(vue) {
		this.dataContext = new ApiDataAccess(vue);
	}

	submitSignup(signupData) {
		return this.dataContext.submitSignup(signupData);
	}

	submitLogin(loginData) {
		return this.dataContext.submitLogin(loginData);
	}

	checkSession() {
		return this.dataContext.checkSession();
	}

	getProfileById(userProfileId) {
		return this.dataContext.getProfileById(userProfileId);
	}

	logout() {
		return this.dataContext.logout();
	}

	getActivitySuggestions() {
		return this.dataContext.getActivitySuggestions();
	}

	createNewActivity(activityData) {
		return this.dataContext.createNewActivity(activityData);
	}

	getAllMyActivities() {
		return this.dataContext.getAllMyActivities();
	}

	saveActivityChanges(activityData) {
		return this.dataContext.saveActivityChanges(activityData);
	}
}
