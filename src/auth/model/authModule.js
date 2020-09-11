export default {
	state: {},
	getters: {},
	actions: {
		async submitSignup({ rootState }, { signupData }) {
			return await rootState.da.submitSignup(signupData);
		},
		async submitLogin({ rootState }, { loginData }) {
			return await rootState.da.submitLogin(loginData);
		},
		initSession({ dispatch, rootState }) {
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
						status: "loggedOut"
					});
				}
			});
		}
	},
	mutations: {}
};
