export default {
	state: {
		userDialogOpen: false,
		userId: "",
		username: "",
		userEmail: "",
		userProfile: {}
	},
	getters: {
		userId: state => {
			return state.userId;
		},
		username: state => {
			return state.username;
		},
		userProfile: state => {
			return state.userProfile;
		},
		userDialogOpen: state => {
			return state.userDialogOpen;
		}
	},
	actions: {
		loadUserProfile({ commit, rootState }, { userProfileId }) {
			rootState.da.getProfileById({ userProfileId }).then(response => {
				if (response.data[0]) {
					commit("setUserProfile", response.data[0]);
				}
			});
		},
		clearUserData({ commit }) {
			commit("clearUserId");
			commit("clearUsername");
			commit("clearUserEmail");
			commit("clearUserProfile");
		},
		openUserDialog({ commit }) {
			commit("setUserDialogOpen", true);
		},
		closeUserDialog({ commit }) {
			commit("setUserDialogOpen", false);
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
		setUserProfile(state, profile) {
			state.userProfile = Object.assign({}, profile);
		},
		setUserDialogOpen(state, setting) {
			state.userDialogOpen = setting;
		}
	}
};
