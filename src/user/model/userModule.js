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
