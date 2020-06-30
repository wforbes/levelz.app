<template>
	<div>
		<v-container>
			<v-row>
				<v-col>
					<h1>Activites</h1>
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
						<v-card class="pa-2" min-height="420">
							<v-container>
								<v-row>
									<v-col cols="12" sm="6">
										Prototype Activity
									</v-col>
								</v-row>
							</v-container>
						</v-card>
					</div>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>

<script>
import NotLoggedIn from "../../app/views/NotLoggedIn.vue";
export default {
	name: "ActivitesPage",
	components: {
		NotLoggedIn
	},
	data() {
		return {};
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
