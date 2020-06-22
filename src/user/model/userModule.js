import axios from "axios";

export default {
	state: {
		userId: "",
		userProfileId: ""
	},
	getters: {
		userId: state => {
			return state.userId;
		},
		userProfileId: state => {
			return state.userProfileId;
		}
	},
	actions: {
		loginUser({ commit }, { userId, userProfileId }) {
			commit("setUserId", userId);
			commit("setUserProfileId", userProfileId);
		},
		async logoutUser({ commit, rootState }) {
			await axios
				.post(rootState.host + "api/", {
					data: {
						n: "auth",
						v: "logout"
					}
				})
				.then(response => {
					if (response.data["success"]) {
						commit("clearUserId");
						commit("clearUserProfileId");
					}
				});
		}
	},
	mutations: {
		clearUserId(state) {
			state.userId = "";
		},
		clearUserProfileId(state) {
			state.userProfileId = "";
		},
		setUserId(state, userId) {
			state.userId = userId;
		},
		setUserProfileId(state, userProfileId) {
			state.userProfileId = userProfileId;
		}
	}
};
