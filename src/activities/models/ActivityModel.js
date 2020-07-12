import DataAccess from "../../lib/data/DataAccess.js";
class ActivityModel {
	da;

	constructor() {
		this.da = new DataAccess();
	}

	getActivitySuggestions() {
		return this.da.getActivitySuggestions();
	}
}
export default ActivityModel;
