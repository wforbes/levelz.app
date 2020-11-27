class ActivityModel {
	da;

	constructor(da) {
		this.da = da;
	}

	getActivitySuggestions() {
		return this.da.getActivitySuggestions();
	}

	activityNameExists(name) {
		return this.da.activityNameExists(name);
	}

	createNewActivity(activityData) {
		return this.da.createNewActivity(activityData);
	}

	getAllMyActivities() {
		return this.da.getAllMyActivities();
	}

	saveActivityChanges(activityData) {
		return this.da.saveActivityChanges(activityData);
	}

	updateActivityField(activityData) {
		return this.da.updateActivityField(activityData);
	}
}
export default ActivityModel;
