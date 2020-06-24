<template>
	<div>
		<v-container>
			<v-row>
				<v-col>
					<h1>Dashboard</h1>
				</v-col>
				<v-col v-if="userLoginStatus === 'loggedIn'" align="right">
					<div class="pr-5">
						<v-btn @click="logout">Logout</v-btn>
					</div>
				</v-col>
			</v-row>
			<v-row>
				<v-col>
					<div v-if="userLoginStatus === 'loggedOut'">
						<NotLoggedIn />
					</div>
					<div v-if="userLoginStatus === 'loggedIn'">
						<v-card class="pa-0" height="100">
							<v-container>
								<v-row>
									<v-col cols="6" class="pa-0">
										<v-card class="ma-0">
											
										</v-card>
									</v-col>
								</v-row>
							</v-container>
						</v-card>
					</div>
					<div v-if="userLoginStatus === 'loading'"></div>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>
<script>
import NotLoggedIn from "../../app/views/NotLoggedIn.vue";
export default {
	name: "UserDashboard",
	components: {
		NotLoggedIn
	},
	data() {
		return {};
	},
	created() {
		//console.log("UserDashboard created");
	},
	computed: {
		userLoginStatus() {
			return this.$store.getters.loginStatus;
		}
	},
	methods: {
		logout() {
			this.$store.dispatch("logoutUser");
		}
	}
};
</script>
