import ActivityModel from "./ActivityModel.js";

export default {
	state: {
		activityModel: undefined,
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
		initActivityModel({ commit, rootState }) {
			commit("initActivityModel", new ActivityModel(rootState.da));
		},
		loadActivitySuggestions({ state, commit }) {
			return state.activityModel.getActivitySuggestions().then(response => {
				if (response.data["success"]) {
					commit("setActivitySuggestions", response.data["success"]);
				}
			});
		},
		activityNameExists({ state }, { name }) {
			return state.activityModel.activityNameExists(name);
		},
		createNewActivity({ state }, { newActivity }) {
			const activityData = {
				name: newActivity.name,
				description: newActivity.description
			};
			return state.activityModel.createNewActivity(activityData);
		},
		addActivityToList({ commit }, { activity }) {
			commit("addActivityToList", activity);
		},
		async loadMyActivities({ state, commit }) {
			const response = await state.activityModel.getAllMyActivities();
			commit("setActivities", response.data["success"]);
			return Promise.resolve();
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
		initActivityModel(state, newActivityModel) {
			state.activityModel = newActivityModel;
		},
		setActivitySuggestions(state, suggestions) {
			state.activitySuggestions = suggestions;
		},
		setActivities(state, activities) {
			state.activities = [...activities];
		},
		addActivityToList(state, activity) {
			state.activities.unshift(activity);
		},
		updateActivityOnList(state, updated) {
			const index = state.activities.findIndex(a => a.id === updated.id);
			state.activities.splice(index, 1, updated);
		}
	}
};
