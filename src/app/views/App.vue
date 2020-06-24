<template>
	<v-app>
		<AppBar ref="appBar" />
		<v-main>
			<v-container>
				<v-row>
					<v-col
						offset-md="1"
						md="10"
						offset-lg="2"
						lg="8"
						offset-xl="3"
						xl="6"
						cols="12"
					>
						<router-view></router-view>
					</v-col>
				</v-row>
			</v-container>
		</v-main>
		<Footer />
	</v-app>
</template>

<script>
import axios from "axios";

import AppBar from "../components/AppBar.vue";
import Footer from "../components/Footer.vue";
export default {
	name: "App",
	components: {
		AppBar,
		Footer
	},
	data() {
		return {
			host: ""
		};
	},
	async created() {
		//console.log("App created");
		axios.defaults.withCredentials = true;
		this.setEnvironment();
		const session = await this.getUserData();
		this.setUserData(session);
	},
	methods: {
		setUserData(session) {
			if (session.data["userId"]) {
				this.$store.dispatch({
					type: "loginUser",
					userId: session.data["userId"]
				});
				this.$store.dispatch({
					type: "loadUserProfile",
					userId: session.data["userId"]
				});
			} else {
				this.$store.dispatch({
					type: "setLoginStatus",
					status: "loggedOut"
				});
			}
		},
		async getUserData() {
			return axios.post(this.host + "api/", {
				data: {
					n: "auth",
					v: "checkSession"
				}
			});
		},
		setEnvironment() {
			this.host =
				window.location.host === "localhost:8080"
					? "http://localhost/levelz.app/"
					: "";
			this.$store.dispatch({
				type: "setHost",
				host: this.host
			});
		}
	}
};
</script>
