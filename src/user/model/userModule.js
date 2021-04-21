export default {
	state: {
		userDialogOpen: false,
		userId: "",
		username: "",
		userEmail: "",
		userProfile: {},
		defaultUserProfilePicUrl: "storage/ProfilePictures/default/default.png",
		userProfilePicUrl: ""
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
		},
		defaultUserProfilePicUrl: state => {
			return state.defaultUserProfilePicUrl;
		},
		userProfilePicUrl: state => {
			return state.userProfilePicUrl;
		}
	},
	actions: {
		submitUserProfilePicture({ rootState }, { formData }) {
			return rootState.da.submitUserProfilePicture(formData);
		},
		loadUserProfile(
			{ rootState, commit, dispatch, rootGetters, getters },
			{ userProfileId }
		) {
			rootState.da.getUserProfileById(userProfileId).then(response => {
				console.log(response);
				if (response.data[0]) {
					commit("setUserProfile", response.data[0]);
					if (response.data[0].profilePicSrc !== "") {
						dispatch("loadUserProfilePicUrl");
					} else {
						commit(
							"setUserProfilePicUrl",
							rootGetters.host + "api/" + getters.defaultUserProfilePicUrl
						);
					}
				}
			});
		},
		loadUserProfilePicUrl({ rootState, getters, commit, rootGetters }) {
			console.log(getters.userId);
			rootState.da
				.getUserProfilePicUrlByUserId(getters.userId)
				.then(response => {
					if (response.data[0]) {
						commit(
							"setUserProfilePicUrl",
							rootGetters.host + "api/" + response.data[0]
						);
					} else {
						commit(
							"setUserProfilePicUrl",
							rootGetters.host + "api/" + getters.defaultUserProfilePicUrl
						);
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
		setUserProfilePicUrl(state, url) {
			state.userProfilePicUrl = url;
		},
		setUserDialogOpen(state, setting) {
			state.userDialogOpen = setting;
		}
	}
};
