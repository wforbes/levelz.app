import ActivityModel from "./ActivityModel.js";

export default {
	state: {
		activityModel: undefined,
		activitySuggestions: [],
		activities: [],
		actionList: [],
		detailActivity: {},
		actionFormMode: "",
		editAction: {}
	},
	getters: {
		activitySuggestions: state => {
			return state.activitySuggestions;
		},
		activities: state => {
			return state.activities;
		},
		detailActivity: state => {
			return state.detailActivity;
		},
		actionList: state => {
			return state.actionList;
		},
		actionFormMode: state => {
			return state.actionFormMode;
		},
		editAction: state => {
			return state.editAction;
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
		},
		async updateActivityField({ state }, { activityId, fieldName, newValue }) {
			console.log(fieldName);
			console.log(newValue);
			const activityData = {
				id: activityId,
				fieldName: fieldName,
				newValue: newValue
			};
			return state.activityModel
				.updateActivityField(activityData)
				.then(response => {
					return Promise.resolve(response.data.success);
				});
		},
		updateActivityOnList({ commit }, { activity }) {
			commit("updateActivityOnList", activity);
		},
		setDetailActivity({ commit }, { activity }) {
			commit("setDetailActivity", activity);
		},
		loadDetailActivityActions({ commit, rootState, getters }) {
			let activityData = {
				activityId: getters.detailActivity.id
			};
			commit("clearActionList");
			return rootState.da
				.getActionsByActivityId(activityData)
				.then(response => {
					if (response.data["success"] === true) {
						for (let action of response.data["actions"]) {
							commit("addActionToList", action);
						}
					}
					return Promise.resolve();
				});
		},
		clearDetailActivity({ commit }) {
			commit("clearDetailActivity");
		},
		setActionFormMode({ commit }, { mode }) {
			commit("setActionFormMode", mode);
		},
		createNewAction({ getters, rootState, commit }, { action }) {
			action.activityId = getters.detailActivity.id;
			return rootState.da.createNewAction(action).then(response => {
				if (response.success === true) {
					commit("addActionToList", response.newAction);
					return Promise.resolve(response.newAction);
				} else {
					return Promise.resolve(response.message);
				}
			});
		},
		clearActionFormMode({ commit }) {
			commit("setActionFormMode", "");
		},
		setEditAction({ commit }, { action }) {
			commit("setEditAction", action);
		},
		updateAction({ rootState, commit }, { action }) {
			return rootState.da.updateAction(action).then(response => {
				if (response.success === true) {
					commit("updateActionOnList", action);
					return Promise.resolve(response.updatedAction);
				} else {
					return Promise.resolve(response.message);
				}
			});
		},
		clearEditAction({ commit }) {
			commit("setEditAction", {});
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
		},
		setDetailActivity(state, activity) {
			state.detailActivity = activity;
		},
		clearDetailActivity(state) {
			state.detailActivity = {};
		},
		addActionToList(state, action) {
			state.actionList.push(action);
		},
		clearActionList(state) {
			state.actionList = [];
		},
		setActionFormMode(state, mode) {
			state.actionFormMode = mode;
		},
		setEditAction(state, action) {
			state.editAction = action;
		},
		updateActionOnList(state, action) {
			const index = state.actionList.findIndex(a => a.id === action.id);
			state.organizationList.splice(index, 1, action);
		}
	}
};
