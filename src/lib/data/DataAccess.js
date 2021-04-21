import ApiDataAccess from "./ApiDataAccess.js";
//import LocalDataAccess from "./LocalDataAccess.js";

export default class DataAccess {
	host;
	dataContext;
	constructor(vue) {
		//this.dataContext = new LocalDataAccess();
		this.dataContext = new ApiDataAccess(vue);
	}

	init() {
		console.log(this.dataContext);
		return this.dataContext.init();
	}

	checkSession() {
		return this.dataContext.checkSession();
	}

	submitSignup(signupData) {
		return this.dataContext.submitSignup(signupData);
	}

	verifyEmailAddress(verifyData) {
		return this.dataContext.verifyEmailAddress(verifyData);
	}

	submitLogin(loginData) {
		return this.dataContext.submitLogin(loginData);
	}

	logout() {
		return this.dataContext.logout();
	}

	//TODO: rename this to getUserProfile...
	getProfileById(userProfileId) {
		return this.dataContext.getProfileById(userProfileId);
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
