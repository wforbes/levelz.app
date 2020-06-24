import axios from "axios";
//import U from "../../lib/util/U.js";

export default {
	state: {
		loginStatus: "loading",
		userId: "",
		userProfile: Object
	},
	getters: {
		userId: state => {
			return state.userId;
		},
		loginStatus: state => {
			return state.loginStatus;
		}
	},
	actions: {
		loadUserProfile({ commit, rootState }, { userId }) {
			axios
				.post(rootState.host + "api/", {
					data: {
						n: ["user", "UserProfile"],
						v: "getProfileByUserId",
						userId: userId
					}
				})
				.then(response => {
					if (response.data["success"]) {
						commit("setUserProfile", response);
					}
				});
		},
		setLoginStatus({ commit }, { status }) {
			commit("setLoginStatus", status);
		},
		loginUser({ commit }, { userId }) {
			commit("setUserId", userId);
			commit("setLoginStatus", "loggedIn");
		},
		logoutUser({ commit, rootState }) {
			axios
				.post(rootState.host + "api/", {
					data: {
						n: "auth",
						v: "logout"
					}
				})
				.then(response => {
					if (response.data["success"]) {
						commit("clearUserId");
						commit("setLoginStatus", "loggedOut");
					}
				});
		}
	},
	mutations: {
		clearUserId(state) {
			state.userId = "";
		},
		setUserId(state, userId) {
			state.userId = userId;
		},
		setLoginStatus(state, status) {
			state.loginStatus = status;
		},
		setUserProfileData(state, response) {
			console.log(response);
			state.userProfile = {};
		}
	}
};
