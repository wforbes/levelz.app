<template>
	<div>
		<v-container>
			<v-overlay :absolute="true" :value="helpOverlayOpen">
				<v-card class="ml-2 mr-2 pa-5">
					<v-row class="ml-3 mr-3">
						<v-col>
							<p>
								You can use <strong>Activities</strong> to keep track of the
								stuff you do and record how well you did them.
							</p>
							<p>Start by creating a new Activity (... more coming soon)</p>
						</v-col>
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
				<v-col cols="9" class="pa-0 pl-5">
					<h1>Activites</h1>
				</v-col>
				<v-col cols="2" align="right" class="pa-0">
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
				<v-col class="pa-0">
					<div v-if="userLoginStatus === 'loggedOut'">
						<NotLoggedIn />
					</div>
					<div v-if="userLoginStatus === 'loggedIn'">
						<v-stepper v-model="stepper" class="elevation-0 pa-0 ma-0">
							<v-stepper-items>
								<v-stepper-content step="0" class="pa-0 ma-0">
									<v-container>
										<v-row>
											<v-container>
												<v-row>
													<v-col cols="12">
														<div
															style="border: 0.1em solid grey; border-radius:4px; text-align:center;"
														>
															<ActivityList
																@openHelpOverlay="openHelpOverlay"
															/>
														</div>
													</v-col>
												</v-row>
											</v-container>
										</v-row>
									</v-container>
								</v-stepper-content>
							</v-stepper-items>
							<v-stepper-items>
								<v-stepper-content step="1" class="pa-0 ma-0">
									<v-container>
										<v-row>
											<v-container>
												<v-row>
													<v-col cols="12">
														<div
															style="border: 0.1em solid grey; border-radius:4px; text-align:center;"
														></div>
													</v-col>
												</v-row>
											</v-container>
										</v-row>
									</v-container>
								</v-stepper-content>
							</v-stepper-items>
						</v-stepper>
					</div>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>

<script>
import ActivityList from "../components/ActivityList.vue";
import NotLoggedIn from "../../app/views/NotLoggedIn.vue";
export default {
	name: "ActivitesPage",
	components: {
		NotLoggedIn,
		ActivityList
	},
	data() {
		return {
			helpOverlayOpen: false,
			stepper: 0,
			createActivityDialogOpen: false
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
		//TODO: add this to MIXIN
		logout() {
			this.$store.dispatch("logoutUser");
		}
	}
};
</script>
