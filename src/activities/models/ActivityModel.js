import DataAccess from "../../lib/data/DataAccess.js";
class ActivityModel {
	da;

	constructor() {
		this.da = new DataAccess();
	}

	getActivitySuggestions() {
		return this.da.getActivitySuggestions();
	}

	createNewActivity(activityData) {
		return this.da.createNewActivity(activityData);
	}

	getAllMyActivities() {
		return this.da.getAllMyActivities();
	}
}
export default ActivityModel;
