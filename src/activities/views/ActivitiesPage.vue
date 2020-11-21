<template>
	<div>
		<v-container>
			<v-overlay :absolute="true" :value="helpOverlayOpen">
				<v-card class="ml-2 mr-2 pa-5">
					<v-row class="ml-3 mr-3">
						<p>
							You can use <strong>Activities</strong> to keep track of the stuff
							you do and record how well you did them.
						</p>
						<p>Start by creating a new Activity (... more coming soon)</p>
					</v-row>
					<v-row>
						<v-col cols="6" align="right">
							<v-btn color="success" @click="closeHelpOverlay">
								Ok, got it!
							</v-btn>
						</v-col>
						<v-col cols="6" class="pt-4">
							<router-link to="/help/activities">
								Read more...
							</router-link>
						</v-col>
					</v-row>
				</v-card>
			</v-overlay>
			<v-row>
				<v-col cols="10">
					<h1>Activites</h1>
				</v-col>
				<v-col cols="2">
					<v-tooltip bottom>
						<template v-slot:activator="{ on, attrs }">
							<v-icon
								class="mt-3"
								v-on="on"
								v-bind="attrs"
								@click="openHelpOverlay"
							>
								mdi-help-circle-outline
							</v-icon>
						</template>
						<span>Help</span>
					</v-tooltip>
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
										<v-col offset-md="2" md="8" cols="12">
											<div
												style="border: 0.1em solid grey; border-radius:4px; text-align:center;"
											>
												<ActivityList />
											</div>
										</v-col>
										<!--
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
										-->
									</v-row>
								</v-container>
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
//import ActivityPrototype0 from "../components/ActivityPrototype0.vue";
import ActivityList from "../components/ActivityList.vue";
import NotLoggedIn from "../../app/views/NotLoggedIn.vue";
import NewActivityDialog from "../components/NewActivityDialog.vue";
export default {
	name: "ActivitesPage",
	components: {
		NotLoggedIn,
		NewActivityDialog,
		ActivityList
		//ActivityPrototype0
	},
	data() {
		return {
			helpOverlayOpen: false,
			newActivityDialogOpen: false
		};
	},
	computed: {
		userLoginStatus() {
			return this.$store.getters.loginStatus;
		}
	},
	methods: {
		openHelpOverlay() {
			this.helpOverlayOpen = true;
		},
		closeHelpOverlay() {
			this.helpOverlayOpen = false;
		},
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
