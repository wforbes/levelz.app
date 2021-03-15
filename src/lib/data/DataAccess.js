//import ApiDataAccess from "./ApiDataAccess.js";
import LocalDataAccess from "./LocalDataAccess.js";

export default class DataAccess {
	host;
	dataContext;
	constructor(/*vue*/) {
		this.dataContext = new LocalDataAccess();
		//this.dataContext = new ApiDataAccess(vue);
	}

	init() {
		console.log(this.dataContext);
		return this.dataContext.init();
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

	activityNameExists(name) {
		return this.dataContext.activityNameExists(name);
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

	updateActivityField(activityData) {
		return this.dataContext.updateActivityField(activityData);
	}
	/*
	checkPermission(data) {
		return this.dataContext.checkPermission(data);
	}*/
}
