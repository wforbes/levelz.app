import Vue from "vue";
import Vuex from "vuex";
import User from "../user/model/userModule.js";

Vue.use(Vuex);

export default new Vuex.Store({
	modules: {
		User
	},
	state: {
		authDialogOpen: false
	},
	getters: {
		authDialogOpen: state => {
			return state.authDialogOpen;
		}
	},
	actions: {
		openAuthDialog({ commit }) {
			commit("setAuthDialogOpen", true);
		},
		closeAuthDialog({ commit }) {
			commit("setAuthDialogOpen", false);
		}
	},
	mutations: {
		setAuthDialogOpen(state, setting) {
			state.authDialogOpen = setting;
		}
	}
});
