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
}
