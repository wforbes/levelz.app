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
		localhostAddr: "localhost:8080",
		da: undefined,
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
		localhostAddr: state => {
			return state.localhostAddr;
		},
		host: state => {
			return state.host;
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
		setHost({ commit, getters }) {
			commit(
				"setHost",
				window.location.host === getters.localhostAddr ||
					window.location.host.href === getters.vue.localhostAddr
					? "https://levelz.app.local/"
					: ""
			);
		},
		initDB({ getters }) {
			return getters.da.init();
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
		showSnackBar(state, text) {
			state.snackBarSignal = true;
			state.snackBarText = text;
		},
		resetSnackBarSignal(state) {
			state.snackBarSignal = false;
		}
	}
});
