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
			<HeaderControls
				:stepperState="stepperState"
				@openHelpOverlay="openHelpOverlay"
				@backStep="backStep"
			/>
			<v-row>
				<v-col class="pa-0">
					<div v-if="userLoginStatus === 'loggedOut'">
						<NotLoggedIn />
					</div>
					<div v-if="userLoginStatus === 'loggedIn'">
						<v-stepper v-model="stepperState" class="elevation-0 pa-0 ma-0">
							<v-stepper-items>
								<v-stepper-content step="1" class="pa-0 ma-0">
									<v-container>
										<v-row>
											<v-col cols="12">
												<div
													style="border: 0.1em solid grey; border-radius:4px; text-align:center;"
												>
													<ActivityList
														:stepperState="stepperState"
														@openHelpOverlay="openHelpOverlay"
														@openActivityDetailer="openActivityDetailer"
													/>
												</div>
											</v-col>
										</v-row>
									</v-container>
								</v-stepper-content>
								<v-stepper-content step="2" class="pa-0 ma-0">
									<v-container>
										<v-row>
											<v-col cols="12">
												<div
													style="border: 0.1em solid grey; border-radius:4px; text-align:center;"
												>
													<ActivityDetailer :stepperState="stepperState" />
												</div>
											</v-col>
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
<style>
.no-transition .stepper__content {
	transition: none;
}
</style>
<script>
import HeaderControls from "../components/HeaderControls.vue";
import NotLoggedIn from "../../app/views/NotLoggedIn.vue";
import ActivityList from "../components/ActivityList.vue";
import ActivityDetailer from "../components/ActivityDetailer.vue";

export default {
	name: "ActivitesPage",
	components: {
		HeaderControls,
		NotLoggedIn,
		ActivityList,
		ActivityDetailer
	},
	data() {
		return {
			helpOverlayOpen: false,
			stepperState: 1,
			createActivityDialogOpen: false
		};
	},
	computed: {
		userLoginStatus() {
			return this.$store.getters.loginStatus;
		}
	},
	methods: {
		openActivityDetailer() {
			console.log("openActivityDetailer");
			this.stepperState = 2;
			//this.activityDetailDialogOpen = true;
		},
		backStep() {
			console.log("backStep on page");
			this.stepperState = this.stepperState - 1;
		},
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
