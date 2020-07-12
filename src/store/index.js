import Vue from "vue";
import Vuex from "vuex";
import User from "../user/model/userModule.js";
import Activity from "../activities/models/activityModule.js";

Vue.use(Vuex);

export default new Vuex.Store({
	modules: {
		User,
		Activity
	},
	state: {
		host: "",
		authDialogOpen: false
	},
	getters: {
		da: state => {
			return state.da;
		},
		host: state => {
			return state.host;
		},
		authDialogOpen: state => {
			return state.authDialogOpen;
		}
	},
	actions: {
		setHost({ commit }, { host }) {
			commit("setHost", host);
		},
		openAuthDialog({ commit }) {
			commit("setAuthDialogOpen", true);
		},
		closeAuthDialog({ commit }) {
			commit("setAuthDialogOpen", false);
		}
	},
	mutations: {
		setHost(state, host) {
			state.host = host;
		},
		setAuthDialogOpen(state, setting) {
			state.authDialogOpen = setting;
		}
	}
});
