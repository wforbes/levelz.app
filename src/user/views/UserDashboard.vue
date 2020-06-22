<template>
	<div>
		<v-container>
			<v-row>
				<v-col>
					<h1>User Dashboard</h1>
				</v-col>
			</v-row>
			<v-row>
				<v-col>
					<div v-show="!userIsLoggedIn">
						<NotLoggedIn />
					</div>
					<div v-show="userIsLoggedIn">
						<v-btn @click="logout">Logout</v-btn>
						<v-container>
							<v-row>
								<v-col>
									<v-card class="pa-5" height="100">
										The user dashboard page isn't finished yet, check back in a few days!
									</v-card>
								</v-col>
							</v-row>
						</v-container>
					</div>
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
	created() {},
	computed: {
		userIsLoggedIn() {
			return this.$store.getters.userId !== "";
		}
	},
	methods: {
		async logout() {
			await this.$store.dispatch("logoutUser");
		}
	}
};
</script>
