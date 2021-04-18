import Vue from "vue";
import Vuex from "vuex";
import DataAccess from "../lib/data/DataAccess.js";
import Auth from "../auth/model/authModule.js";
import User from "../user/model/userModule.js";
import Activity from "../activities/models/activityModule.js";

Vue.use(Vuex);

export default new Vuex.Store({
	modules: {
		Auth,
		User,
		Activity
	},
	state: {
		vue: undefined,
		host: "",
		da: undefined,
		authDialogOpen: false,
		snackBarSignal: false,
		snackBarText: ""
	},
	getters: {
		vue: state => {
			return state.vue;
		},
		da: state => {
			return state.da;
		},
		host: state => {
			return state.host;
		},
		authDialogOpen: state => {
			return state.authDialogOpen;
		},
		snackBarOpen: state => {
			return state.snackBarOpen;
		},
		snackBarSignal: state => {
			return state.snackBarSignal;
		},
		snackBarText: state => {
			return state.snackBarText;
		}
	},
	actions: {
		setupStore({ dispatch }, { vue }) {
			dispatch({
				type: "setVue",
				vue: vue
			});
			dispatch("setDataAccess");
			dispatch("initModels");
			dispatch("setHost");
			dispatch("initSession");
		},
		setVue({ commit }, { vue }) {
			commit("setVue", vue);
		},
		setDataAccess({ commit }) {
			commit("setDataAccess", new DataAccess(this.getters.vue));
			//commit("setDataAccess", new DataAccess());
		},
		initModels({ dispatch }) {
			dispatch("initActivityModel");
		},
		setHost({ commit }) {
			commit(
				"setHost",
				window.location.host === this.getters.vue.localhost ||
					window.location.host.href === this.getters.vue.localhost
					? "https://levelz.app.local/"
					: ""
			);
		},
		initDB({ getters }) {
			return getters.da.init();
		},
		openAuthDialog({ commit }) {
			commit("setAuthDialogOpen", true);
		},
		closeAuthDialog({ commit }) {
			commit("setAuthDialogOpen", false);
		},
		showSnackBar({ commit }, { text }) {
			commit("showSnackBar", text);
		},
		resetSnackBarSignal({ commit }) {
			commit("resetSnackBarSignal");
		}
	},
	mutations: {
		setVue(state, vue) {
			state.vue = vue;
		},
		setDataAccess(state, da) {
			state.da = da;
		},
		setHost(state, host) {
			state.host = host;
		},
		setAuthDialogOpen(state, setting) {
			state.authDialogOpen = setting;
		},
		showSnackBar(state, text) {
			state.snackBarSignal = true;
			state.snackBarText = text;
		},
		resetSnackBarSignal(state) {
			state.snackBarSignal = false;
		}
	}
});
