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
			<HeaderControls />
			<v-row>
				<v-col class="pa-0">
					<div v-if="isLoggedIn">
						<v-stepper v-model="stepState" class="elevation-0 pa-0 ma-0">
							<v-stepper-items>
								<v-stepper-content step="1" class="pa-0 ma-0">
									<v-container>
										<v-row>
											<v-col cols="12">
												<div style="text-align:center;">
													<ActivityList @openHelpOverlay="openHelpOverlay" />
												</div>
											</v-col>
										</v-row>
									</v-container>
								</v-stepper-content>
								<v-stepper-content step="2" class="pa-0 ma-0">
									<v-container>
										<v-row>
											<v-col cols="12">
												<div style="text-align:center;">
													<ActivityForm
														v-if="currentStepState.component === 'ActivityForm'"
													/>
													<ActivityDetailer
														v-if="
															currentStepState.component === 'ActivityDetailer'
														"
													/>
												</div>
											</v-col>
										</v-row>
									</v-container>
								</v-stepper-content>
								<v-stepper-content step="3" class="pa-0 ma-0">
									<v-container>
										<v-row>
											<v-col cols="12">
												<div style="text-align:center;">
													<ActionForm />
													<ActionDetailer />
												</div>
											</v-col>
										</v-row>
									</v-container>
								</v-stepper-content>
							</v-stepper-items>
						</v-stepper>
					</div>
					<div v-else>
						<NotLoggedIn />
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
import ActivityForm from "../components/ActivityForm.vue";
import ActivityDetailer from "../components/ActivityDetailer.vue";
import ActionForm from "../components/ActionForm.vue";
import ActionDetailer from "../components/ActionDetailer.vue";

export default {
	name: "ActivitesPage",
	components: {
		HeaderControls,
		NotLoggedIn,
		ActivityList,
		ActivityForm,
		ActivityDetailer,
		ActionForm,
		ActionDetailer
	},
	data() {
		return {
			helpOverlayOpen: false
		};
	},
	computed: {
		isLoggedIn() {
			return this.$store.getters.isLoggedIn;
		},
		stepState() {
			//console.log(this.$store.getters.stepStates);
			let len = this.$store.getters.stepStates.length;
			return len > 0 ? this.$store.getters.stepStates[len - 1].step : 1;
		},
		currentStepState() {
			let len = this.$store.getters.stepStates.length;
			return len > 0
				? this.$store.getters.stepStates[len - 1]
				: { name: "", component: "", step: 1 };
		}
	},
	methods: {
		openActivityDetailer() {
			console.log("openActivityDetailer");
			//this.stepperState = 2;
			this.stepperState++;
			//this.activityDetailDialogOpen = true;
		},
		openActionForm() {
			console.log("openActionForm");
			//this.stepperState = 3;
			this.stepperState++;
		},
		closeActionForm() {
			console.log("closeActionForm");
			//this.stepperState = 2;
			this.stepperState--;
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
