import ApiDataAccess from "./ApiDataAccess.js";

export default class DataAccess {
	host;
	dataContext;
	constructor() {
		this.dataContext = new ApiDataAccess();
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
