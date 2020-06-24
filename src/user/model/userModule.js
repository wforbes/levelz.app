import axios from "axios";
//import U from "../../lib/util/U.js";

export default {
	state: {
		loginStatus: "loading",
		userId: "",
		username: "",
		userEmail: "",
		userProfile: {}
	},
	getters: {
		userId: state => {
			return state.userId;
		},
		loginStatus: state => {
			return state.loginStatus;
		},
		username: state => {
			return state.username;
		},
		userProfile: state => {
			return state.userProfile;
		}
	},
	actions: {
		initSession({ dispatch, rootState }) {
			axios
				.post(rootState.host + "api/", {
					data: {
						n: "auth",
						v: "checkSession"
					}
				})
				.then(response => {
					if (response.data["sessionData"]) {
						dispatch({
							type: "loginUser",
							userId: response.data["sessionData"]["userId"],
							username: response.data["sessionData"]["username"],
							userEmail: response.data["sessionData"]["userEmail"],
							userProfileId: response.data["sessionData"]["userProfileId"]
						});
					} else {
						dispatch({
							type: "setLoginStatus",
							status: "loggedOut"
						});
					}
				});
		},
		loadUserProfile({ commit, rootState }, { userProfileId }) {
			axios
				.post(rootState.host + "api/", {
					data: {
						n: ["user", "UserProfile"],
						v: "getProfileById",
						userProfileId: userProfileId
					}
				})
				.then(response => {
					if (response.data[0]) {
						commit("setUserProfile", response.data[0]);
					}
				});
		},
		setLoginStatus({ commit }, { status }) {
			commit("setLoginStatus", status);
		},
		loginUser(
			{ commit, dispatch },
			{ userId, username, userEmail, userProfileId }
		) {
			commit("setUserId", userId);
			commit("setUsername", username);
			commit("setUserEmail", userEmail);
			dispatch({
				type: "loadUserProfile",
				userProfileId: userProfileId
			});
			commit("setLoginStatus", "loggedIn");
		},
		logoutUser({ commit, dispatch, rootState }) {
			axios
				.post(rootState.host + "api/", {
					data: {
						n: "auth",
						v: "logout"
					}
				})
				.then(response => {
					if (response.data["success"]) {
						dispatch("clearUserData");
						commit("setLoginStatus", "loggedOut");
					}
				});
		},
		clearUserData({ commit }) {
			commit("clearUserId");
			commit("clearUsername");
			commit("clearUserEmail");
			commit("clearUserProfile");
		}
	},
	mutations: {
		clearUserId(state) {
			state.userId = "";
		},
		clearUsername(state) {
			state.username = "";
		},
		clearUserEmail(state) {
			state.userEmail = "";
		},
		clearUserProfile(state) {
			state.userProfile = {};
		},
		setUserId(state, userId) {
			state.userId = userId;
		},
		setUsername(state, username) {
			state.username = username;
		},
		setUserEmail(state, userEmail) {
			state.userEmail = userEmail;
		},
		setLoginStatus(state, status) {
			state.loginStatus = status;
		},
		setUserProfile(state, profile) {
			state.userProfile = Object.assign({}, profile);
		}
	}
};
