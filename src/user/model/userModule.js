export default {
	state: {
		userDialogOpen: false,
		userId: "",
		username: "",
		userEmail: "",
		userProfile: {},
		defaultUserProfilePicUrl: "storage/ProfilePictures/default/default.png",
		userProfilePicUrl: "",
		userProfilePicUrlList: []
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
		},
		userProfilePicUrlList: state => {
			return state.userProfilePicUrlList;
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
			//console.log(getters.userId);
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
		loadAllUserProfilePictures({ rootState, rootGetters, commit }) {
			return rootState.da.getAllUserProfilePictures().then(response => {
				if ("success" in response.data) {
					//console.log(response.data["success"]);
					commit("clearUserProfilePicUrlList");
					for (let i = 0; i < response.data["success"].length; i++) {
						//console.log("pushing url");
						commit(
							"addUserProfilePicUrlToList",
							rootGetters.host + "api/" + response.data["success"][i]
						);
					}
				}
				return Promise.resolve();
			});
		},
		updateDefaultUserProfilePic(
			{ rootState, commit, rootGetters },
			{ fileName }
		) {
			rootState.da.updateDefaultUserProfilePic(fileName).then(response => {
				if ("success" in response.data) {
					//console.log(response.data["success"]["newDefaultPath"]);
					commit(
						"setUserProfilePicUrl",
						rootGetters.host +
							"api/" +
							response.data["success"]["newDefaultPath"]
					);
					//TODO: implement snackbar or some notification for successful change
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
		clearUserProfilePicUrlList(state) {
			state.userProfilePicUrlList = [];
		},
		addUserProfilePicUrlToList(state, url) {
			state.userProfilePicUrlList.push(url);
		},
		setUserDialogOpen(state, setting) {
			state.userDialogOpen = setting;
		}
	}
};
