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
		loadActivitySuggestions({ state, commit }) {
			return state.activityModel.getActivitySuggestions().then(suggestions => {
				commit("setActivitySuggestions", suggestions);
			});
		},
		createNewActivity({ state }, { newActivity }) {
			const activityData = {
				name: newActivity.name
			};
			return state.activityModel.createNewActivity(activityData);
		},
		async loadMyActivities({ state, commit }) {
			const activities = await state.activityModel.getAllMyActivities();
			commit("setActivities", activities);
		}
	},
	mutations: {
		setActivitySuggestions(state, suggestions) {
			state.activitySuggestions = suggestions;
		},
		setActivities(state, activities) {
			state.activities = activities;
		}
	}
};
