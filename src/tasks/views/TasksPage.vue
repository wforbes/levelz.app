<template>
	<div>
		<v-container>
			<v-row>
				<v-col cols="8">
					<h1>Tasks</h1>
				</v-col>
				<v-col v-if="userLoginStatus === 'loggedIn'" cols="4" align="right">
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
						<v-container>
							<v-row>
								<v-col cols="12" sm="6">
									<v-btn>New Task</v-btn>
								</v-col>
							</v-row>
						</v-container>
						<!--<v-card class="pa-2" min-height="420"></v-card>-->
					</div>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>

<script>
import NotLoggedIn from "../../app/views/NotLoggedIn.vue";
export default {
	name: "TasksPage",
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
