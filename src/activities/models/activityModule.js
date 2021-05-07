import ActivityModel from "./ActivityModel.js";
//update this to remove the use of activityModel
export default {
	state: {
		stepStates: [],
		activityFormMode: "",
		activityModel: undefined,
		activitySuggestions: [],
		activities: [],
		actionList: [],
		detailActivity: {},
		actionFormMode: "",
		editAction: {}
	},
	getters: {
		stepStates: state => {
			return state.stepStates;
		},
		activityFormMode: state => {
			return state.activityFormMode;
		},
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
		pushStepState({ commit }, { stepState }) {
			commit("pushStepState", stepState);
		},
		popStepState({ commit }) {
			commit("popStepState");
		},
		openCreateActivityForm({ dispatch }) {
			dispatch({
				type: "setActivityFormMode",
				mode: "create"
			});
			dispatch({
				type: "pushStepState",
				stepState: {
					step: 2,
					component: "ActivityForm",
					name: "Create Activity",
					hasBackBtn: false
				}
			});
		},
		closeActivityForm({ dispatch, commit }) {
			dispatch({
				type: "setActivityFormMode",
				mode: ""
			});
			commit("popStepState");
		},
		setActivityFormMode({ commit }, { mode }) {
			commit("setActivityFormMode", mode);
		},
		activityNameExists({ state }, { name }) {
			return state.activityModel.activityNameExists(name);
		},
		createNewActivity({ rootState, commit }, { newActivity }) {
			return rootState.da.createNewActivity(newActivity).then(response => {
				if (response.data["success"] === true) {
					commit("addActivityToList", response.data["newActivity"]);
					return Promise.resolve(response.data["newActivity"]);
				} else {
					return Promise.resolve(response.data["message"]);
				}
			});
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
		updateActivity({ rootState, commit, dispatch, getters }, { activity }) {
			return rootState.da.updateActivity(activity).then(response => {
				console.log(response);
				if (response.data["success"] === true) {
					commit("updateActivityOnList", activity);
					if (getters.detailActivity.name !== activity.name) {
						dispatch({
							type: "replaceStepStateActivityName",
							oldName: getters.detailActivity.name,
							newName: activity.name
						});
					}
					dispatch({
						type: "setDetailActivity",
						activity: Object.assign({}, activity)
					});
				} else {
					//TODO: show error if unsuccessful
				}
			});
		},
		replaceStepStateActivityName({ commit }, { oldName, newName }) {
			commit("replaceStepStateName", {
				old: oldName,
				new: newName
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
		openActivityDetailer({ dispatch }, { detailActivity }) {
			dispatch({
				type: "setDetailActivity",
				activity: Object.assign({}, detailActivity)
			});
			dispatch({
				type: "pushStepState",
				stepState: {
					step: 2,
					component: "ActivityDetailer",
					name: detailActivity.name,
					hasBackBtn: true
				}
			});
		},
		setDetailActivity({ commit }, { activity }) {
			commit("setDetailActivity", activity);
		},
		openEditActivityForm({ dispatch }) {
			dispatch({
				type: "setActivityFormMode",
				mode: "edit"
			});
			dispatch({
				type: "pushStepState",
				stepState: {
					step: 2,
					component: "ActivityForm",
					name: "Edit Activity",
					hasBackBtn: false
				}
			});
		},
		loadDetailActivityActions({ getters, rootState, commit }) {
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
					//return Promise.resolve();
				});
		},
		clearDetailActivity({ commit }) {
			commit("clearDetailActivity");
		},
		openCreateActionForm({ dispatch }) {
			dispatch({ type: "setActionFormMode", mode: "create" });
			dispatch({
				type: "pushStepState",
				stepState: {
					step: 3,
					component: "ActionForm",
					name: "Create Action",
					hasBackBtn: false
				}
			});
		},
		setActionFormMode({ commit }, { mode }) {
			commit("setActionFormMode", mode);
		},
		closeActionForm({ dispatch, commit }) {
			dispatch({
				type: "setActionFormMode",
				mode: ""
			});
			commit("popStepState");
		},
		createNewAction({ getters, rootState, commit }, { action }) {
			action.activityId = getters.detailActivity.id;
			return rootState.da.createNewAction(action).then(response => {
				if (response.data["success"] === true) {
					commit("addActionToList", response.data["newAction"]);
					return Promise.resolve(response.data["newAction"]);
				} else {
					return Promise.resolve(response.data["message"]);
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
				console.log(response);
				if (response.data["success"] === true) {
					commit("updateActionOnList", action);
					return Promise.resolve(response.data["updatedAction"]);
				} else {
					return Promise.resolve(response.data["message"]);
				}
			});
		},
		completeActionById({ rootState, commit }, { actionId }) {
			let actionData = {
				id: actionId
			};
			return rootState.da.completeActionById(actionData).then(response => {
				console.log(response);
				if (response.data["success"] === true) {
					console.log("response success true");
					commit("setActionAsCompleteById", actionId);
				} else {
					//TODO: display error message?
				}
			});
		},
		clearEditAction({ commit }) {
			commit("setEditAction", {});
		}
	},
	mutations: {
		setActivityFormMode(state, mode) {
			state.activityFormMode = mode;
		},
		pushStepState(state, stepState) {
			state.stepStates.push(stepState);
		},
		popStepState(state) {
			state.stepStates.pop();
		},
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
		replaceStepStateName(state, names) {
			for (let step of state.stepStates) {
				if (step.name === names.old) {
					step.name = names.new;
				}
			}
		},
		setDetailActivity(state, activity) {
			state.detailActivity = activity;
		},
		clearDetailActivity(state) {
			state.detailActivity = {};
		},
		addActionToList(state, action) {
			console.log("addActionToList");
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
			state.actionList.splice(index, 1, action);
		},
		setActionAsCompleteById(state, actionId) {
			console.log("setActionAsCompleteById");
			const index = state.actionList.findIndex(a => a.id === actionId);
			state.actionList[index].complete = true;
		}
	}
};
