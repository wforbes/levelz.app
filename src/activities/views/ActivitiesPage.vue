<template>
	<div>
		<v-container>
			<v-row>
				<v-col>
					<h1>Activites</h1>
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
								<v-container>
									<v-row>
										<v-col sm="6" cols="12">
											<div
												style="border: 0.1em solid grey; border-radius:4px; text-align:center; padding-bottom:0.6em;"
											>
												<p>Prototype Idea #1: Complex Activity Creation</p>
												<v-btn @click="openNewActivityDialog">
													Create New Activity
												</v-btn>
											</div>
										</v-col>
										<v-col sm="6" cols="12">
											<div
												style="border: 0.1em solid grey; border-radius:4px; text-align:center;"
											>
												<p>Prototype Idea #0: Simple Activity Creation</p>
												<ActivityPrototype0 />
											</div>
										</v-col>
									</v-row>
								</v-container>
							</v-row>
							<v-row>
								<v-col>
									<p>
										You can use <strong>Activities</strong> to keep track of the
										stuff you do.
									</p>
									<p>
										When you complete
										<strong>Activities</strong> you'll be awarded bonuses like
										<strong>Experience Points</strong> to help you
										<strong>Level Up</strong>!
									</p>
								</v-col>
							</v-row>
						</v-container>
						<!-- <v-row>
								<v-col cols="12" sm="6">
									<v-btn @click="openNewActivityDialog">
										Create New Activity
									</v-btn>
								</v-col>
							</v-row> -->
						<!--<v-card class="pa-2" min-height="420"></v-card>-->
					</div>
				</v-col>
			</v-row>
		</v-container>
		<NewActivityDialog
			:newActivityDialogOpen="newActivityDialogOpen"
			@saveNewActivity="saveNewActivity"
			@closeNewActivityDialog="closeNewActivityDialog"
		/>
	</div>
</template>

<script>
import ActivityPrototype0 from "../components/ActivityPrototype0.vue";
import NotLoggedIn from "../../app/views/NotLoggedIn.vue";
import NewActivityDialog from "../components/NewActivityDialog.vue";
export default {
	name: "ActivitesPage",
	components: {
		NotLoggedIn,
		NewActivityDialog,
		ActivityPrototype0
	},
	data() {
		return {
			newActivityDialogOpen: false
		};
	},
	computed: {
		userLoginStatus() {
			return this.$store.getters.loginStatus;
		}
	},
	methods: {
		openNewActivityDialog() {
			this.newActivityDialogOpen = true;
		},
		saveNewActivity(newActivity) {
			console.log(newActivity);
			this.newActivityDialogOpen = false;
		},
		closeNewActivityDialog() {
			this.newActivityDialogOpen = false;
		},
		//TODO: add this to MIXIN
		logout() {
			this.$store.dispatch("logoutUser");
		}
	}
};
</script>
