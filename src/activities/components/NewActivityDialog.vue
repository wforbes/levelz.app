<template>
	<div>
		<v-dialog v-model="newActivityDialogOpen" persistent fullscreen>
			<v-card class="elevation-12">
				<v-toolbar dark dense flat>
					<v-toolbar-title>{{ toolbarTitle }}</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-btn @click="closeNewActivityDialog" icon>
						<v-icon>mdi-close</v-icon>
					</v-btn>
				</v-toolbar>
				<v-stepper v-model="stepProgress">
					<v-stepper-header>
						<v-stepper-step :complete="stepProgress > 1" step="1">
							Instructions
						</v-stepper-step>
						<v-divider></v-divider>
						<v-stepper-step editable :complete="stepProgress > 2" step="2">
							Basic Info
						</v-stepper-step>
						<v-divider></v-divider>
						<v-stepper-step step="3">
							Add Actions
						</v-stepper-step>
						<v-divider></v-divider>
						<v-stepper-step step="4">
							Add Bonuses
						</v-stepper-step>
						<v-divider></v-divider>
						<v-stepper-step step="5">
							Attach To Task
						</v-stepper-step>
						<v-divider></v-divider>
						<v-stepper-step step="6">
							Confirm Details
						</v-stepper-step>
					</v-stepper-header>
					<div class="v-stepper-full-height">
						<v-stepper-items style="margin:0;">
							<v-stepper-content step="1">
								<v-container>
									<v-row>
										<v-col cols="12">
											<!--<v-card class="pa-5 mb-5" color="white">-->
											<h3>Activity Creation Directions:</h3>
											<p>
												First, you'll give your new Activity a Name and an
												optional Description.
											</p>
											<p>
												Then, you'll add one or more Actions to your new
												Activity to help track your progress while completing
												your new Activity.
											</p>
											<p>
												Next, you'll add some bonuses that completing this
												Activity will grant you.
											</p>
											<p>
												Finally, you'll be able to attach your new Activity to a
												Task so that when you complete it, you'll earn progress
												toward your larger goals.
											</p>
											<p>
												OK! Let's get started, click 'Start Creating' to move
												on.
											</p>
											<v-btn color="primary" @click="stepProgress = 2">
												Start Creating
											</v-btn>
											<v-btn text @click="closeNewActivityDialog">Cancel</v-btn>
										</v-col>
									</v-row>
								</v-container>
							</v-stepper-content>
							<v-stepper-content step="2">
								<v-container>
									<v-row>
										<v-col cols="12">
											<v-form>
												<v-text-field
													outlined
													label="Activity Name"
													v-model="newActivity.name"
												></v-text-field>
												<v-textarea
													outlined
													label="Activity Description"
													v-model="newActivity.description"
												></v-textarea>
											</v-form>
											<v-container class="pa-0">
												<v-row>
													<v-col>
														<v-btn color="secondary" @click="stepProgress = 1">
															&lt; Previous
														</v-btn>
													</v-col>
													<v-col align="right">
														<v-btn color="primary" @click="stepProgress = 3">
															Continue &gt;
														</v-btn>
													</v-col>
												</v-row>
											</v-container>
										</v-col>
									</v-row>
								</v-container>
							</v-stepper-content>
							<v-stepper-content step="3">
								<v-container>
									<v-row>
										<v-col cols="12">
											<v-card>
												Add Actions.. (work in progress 7/1/2020 )
											</v-card>
											<v-container class="pa-0">
												<v-row>
													<v-col>
														<v-btn color="secondary" @click="stepProgress = 3">
															&lt; Previous
														</v-btn>
													</v-col>
													<v-col align="right">
														<v-btn color="primary" @click="stepProgress = 4">
															Continue &gt;
														</v-btn>
													</v-col>
												</v-row>
											</v-container>
										</v-col>
									</v-row>
								</v-container>
							</v-stepper-content>
						</v-stepper-items>
					</div>
				</v-stepper>
			</v-card>
		</v-dialog>
	</div>
</template>
<style>
.v-stepper__content {
	margin: 0;
	padding: 0;
}
.v-stepper-full-height {
	height: calc(100vh - 120px);
}
</style>
<script>
export default {
	name: "NewActivityDialog",
	props: ["newActivityDialogOpen"],
	data() {
		return {
			toolbarTitle: "Create New Activity",
			stepProgress: 1,
			newActivity: {
				name: "",
				description: "",
				actions: []
			},
			actionOptions: {
				type: ["simple", "gradable"],
				grades: ["failed", "poor", "average", "good", "excellent", "perfect"]
			},
			newAction: {
				name: "",
				type: ""
			}
		};
	},
	methods: {
		closeNewActivityDialog() {
			this.$emit("closeNewActivityDialog");
		}
	}
};
</script>
