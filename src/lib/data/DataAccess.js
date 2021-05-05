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
	getUserProfileById(userProfileId) {
		return this.dataContext.getUserProfileById(userProfileId);
	}

	submitUserProfilePicture(formData) {
		return this.dataContext.submitUserProfilePicture(formData);
	}

	getUserProfilePicUrlByUserId(userId) {
		return this.dataContext.getUserProfilePicUrlByUserId(userId);
	}

	getAllUserProfilePictures() {
		return this.dataContext.getAllUserProfilePictures();
	}
	updateDefaultUserProfilePic(fileName) {
		return this.dataContext.updateDefaultUserProfilePic(fileName);
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

	userHasPermission(permissionData) {
		return this.dataContext.userHasPermission(permissionData);
	}

	getActionsByActivityId(activityData) {
		return this.dataContext.getActionsByActivityId(activityData);
	}

	createNewAction(actionData) {
		return this.dataContext.createNewAction(actionData);
	}
}
