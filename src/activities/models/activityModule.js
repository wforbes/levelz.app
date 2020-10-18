import ActivityModel from "./ActivityModel.js";

export default {
	state: {
		activityModel: new ActivityModel(),
		activitySuggestions: [],
		activities: []
	},
	getters: {
		activitySuggestions: state => {
			return state.activitySuggestions;
		},
		activities: state => {
			return state.activities;
		}
	},
	actions: {
		loadActivitySuggestions({ rootState, commit }) {
			return rootState.da.getActivitySuggestions().then(response => {
				if (response.data["success"]) {
					commit("setActivitySuggestions", response.data["success"]);
				}
			});
		},
		async createNewActivity({ rootState }, { newActivity }) {
			const activityData = {
				name: newActivity.name,
				description: newActivity.description
			};
			return await rootState.da.createNewActivity(activityData);
		},
		async loadMyActivities({ rootState, commit }) {
			const response = await rootState.da.getAllMyActivities();
			commit("setActivities", response.data["success"]);
		},
		async saveActivityChanges({ state, commit }, { activityData }) {
			return state.activityModel
				.saveActivityChanges(activityData)
				.then(activity => {
					commit("updateActivityOnList", activity);
				});
		}
	},
	mutations: {
		setActivitySuggestions(state, suggestions) {
			state.activitySuggestions = suggestions;
		},
		setActivities(state, activities) {
			state.activities = [...activities];
		},
		updateActivityOnList(state, updated) {
			const index = state.activities.findIndex(a => a.id === updated.id);
			state.activities.splice(index, 1, updated);
		}
	}
};
