export default {
	state: {
		LOGIN_STATES: {
			IN: "in",
			OUT: "out",
			LOADING: "loading"
		},
		loginStatus: false
	},
	getters: {
		LOGIN_STATES: state => {
			return state.LOGIN_STATES;
		},
		loginStatus: state => {
			return state.loginStatus;
		},
		isLoggedIn: state => {
			return state.loginStatus === state.LOGIN_STATES.IN;
		},
		loginIsLoading: state => {
			return state.loginStatus === state.LOGIN_STATES.LOADING;
		}
	},
	actions: {
		async submitSignup({ rootState, dispatch }, { signupData }) {
			return rootState.da.submitSignup(signupData).then(response => {
				if (response.data.success) {
					const data = response.data["success"];
					dispatch({
						type: "loginUser",
						userId: data["userId"],
						username: data["username"],
						userEmail: data["userEmail"],
						userProfileId: data["userProfileId"]
					});
					return Promise.resolve();
				} else {
					return Promise.resolve(response.data.errors);
				}
			});
		},
		async submitLogin({ rootState }, { loginData }) {
			return await rootState.da.submitLogin(loginData);
		},
		//userIsLoggedIn({})
		initSession({ dispatch, getters, rootState }) {
			rootState.da.checkSession().then(response => {
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
						status: getters.LOGIN_STATES.OUT
					});
				}
			});
		},
		loginUser(
			{ commit, dispatch, getters },
			{ userId, username, userEmail, userProfileId }
		) {
			commit("setUserId", userId);
			commit("setUsername", username);
			commit("setUserEmail", userEmail);
			dispatch({
				type: "loadUserProfile",
				userProfileId: userProfileId
			});
			commit("setLoginStatus", getters.LOGIN_STATES.IN);
		},
		logoutUser({ commit, dispatch, getters, rootState }) {
			rootState.da.logout().then(response => {
				if (response.data["success"]) {
					dispatch("clearUserData");
					commit("setLoginStatus", getters.LOGIN_STATES.OUT);
				}
			});
		},
		setLoginStatus({ commit }, { status }) {
			commit("setLoginStatus", status);
		}
		/*
		checkPermission({ rootState }, { permission }) {
			rootState.da.checkPermission(permission).then(response => {
				console.log(response);
			});
		}*/
	},
	mutations: {
		setLoginStatus(state, status) {
			state.loginStatus = status;
		}
	}
};
