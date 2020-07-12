import ActivityModel from "./ActivityModel.js";

export default {
	state: {
		activityModel: new ActivityModel(),
		activitySuggestions: []
	},
	getters: {
		activitySuggestions: state => {
			return state.activitySuggestions;
		}
	},
	actions: {
		loadActivitySuggestions({ state, commit }) {
			return state.activityModel.getActivitySuggestions().then(suggestions => {
				commit("setActivitySuggestions", suggestions);
			});
		}
	},
	mutations: {
		setActivitySuggestions(state, suggestions) {
			state.activitySuggestions = suggestions;
		}
	}
};
