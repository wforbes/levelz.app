<template>
	<div>
		<v-dialog v-model="newActivityDialogOpen" persistent fullscreen>
			<v-card class="elevation-12">
				<v-toolbar dark dense flat>
					<v-toolbar-title v-if="stepProgress <= 1">
						Create New Activity
					</v-toolbar-title>
					<v-toolbar-title v-if="stepProgress > 1 && newActivity.name === ''">
						Creating A New Activity
					</v-toolbar-title>
					<v-toolbar-title v-if="newActivity.name !== ''">
						Creating The "{{ newActivity.name }}" Activity
					</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-btn @click="closeNewActivityDialog" icon>
						<v-icon>mdi-close</v-icon>
					</v-btn>
				</v-toolbar>
				<v-stepper v-model="stepProgress">
					<!-- <v-stepper-header>
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
					</v-stepper-header> -->
					<div class="v-stepper-full-height">
						<v-stepper-items style="margin: 0 auto; max-width: 600px;">
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
												Then, you'll add one or more Actions to help track your
												progress while completing your new Activity.
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
											<h3>Basic Activity Info</h3>
											<v-card class="pa-5 mt-5 mb-5">
												<v-form v-model="basicInfoFormValid">
													<v-text-field
														outlined
														label="Activity Name"
														v-model="newActivity.name"
														:rules="[rules.required]"
													></v-text-field>
													<v-textarea
														outlined
														label="Activity Description (Optional)"
														v-model="newActivity.description"
													></v-textarea>
												</v-form>
											</v-card>
											<v-container class="pa-0">
												<v-row>
													<v-col>
														<v-btn color="secondary" @click="stepProgress = 1">
															&lt; Previous
														</v-btn>
													</v-col>
													<v-col align="right">
														<v-btn
															color="primary"
															:disabled="!basicInfoFormValid"
															@click="stepProgress = 3"
														>
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
											<h3>Add Actions</h3>
											<v-container>
												<v-row>
													<v-col>
														<p>Click 'Add Action' to get started!</p>
														<v-btn @click="openNewActionDialog">
															Add Action
														</v-btn>
													</v-col>
												</v-row>
											</v-container>
											<v-card
												v-if="newActivity.actions.length > 0"
												class="px-3"
											>
												<v-card-title>
													Activity Actions
												</v-card-title>
												<v-list>
													<v-list-item
														v-for="action in newActivity.actions"
														:key="action.id"
														style="margin-bottom:0.5em"
														class="elevation-5"
													>
														<v-list-item-content>
															{{ action.name }}
														</v-list-item-content>
													</v-list-item>
												</v-list>
											</v-card>
											<v-container class="pa-0">
												<v-row>
													<v-col>
														<v-btn color="secondary" @click="stepProgress = 2">
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
							<v-stepper-content step="4">
								<v-container>
									<v-row>
										<v-col cols="12">
											<h3>Add Bonuses</h3>
											<v-container>
												<v-row>
													<v-col>
														<p>Click 'Add Completion Bonus' to get started!</p>
														<v-btn @click="openNewBonusDialog">
															Add Completion Bonus
														</v-btn>
													</v-col>
												</v-row>
											</v-container>
											<v-card v-if="newActivity.bonuses.length > 0">
												<v-card-title>
													Activity Bonuses
												</v-card-title>
												<v-list>
													<v-list-tile
														v-for="bonus in newActivity.bonuses"
														:key="bonus.id"
													>
														<v-list-tile-content> </v-list-tile-content>
													</v-list-tile>
												</v-list>
											</v-card>
											<v-container class="pa-0">
												<v-row>
													<v-col>
														<v-btn color="secondary" @click="stepProgress = 3">
															&lt; Previous
														</v-btn>
													</v-col>
													<v-col align="right">
														<v-btn color="primary" @click="stepProgress = 5">
															Continue &gt;
														</v-btn>
													</v-col>
												</v-row>
											</v-container>
										</v-col>
									</v-row>
								</v-container>
							</v-stepper-content>
							<v-stepper-content step="5">
								<v-container>
									<v-row>
										<v-col cols="12">
											<h3>Add To Task</h3>
											<v-container>
												<v-row>
													<v-col>
														<p>
															Click 'Create New Task' to add this Activity to a
															new Task, select a Task from the list, or skip
															this step!
														</p>
														<v-btn @click="openNewTaskDialog">
															Create New Task
														</v-btn>
													</v-col>
												</v-row>
											</v-container>
											<v-card v-if="tasks.length > 0">
												<v-card-title>
													Tasks
												</v-card-title>
												<v-list>
													<v-list-tile v-for="task in task" :key="task.id">
														<v-list-tile-content> </v-list-tile-content>
													</v-list-tile>
												</v-list>
											</v-card>
											<v-container class="pa-0">
												<v-row>
													<v-col>
														<v-btn color="secondary" @click="stepProgress = 4">
															&lt; Previous
														</v-btn>
													</v-col>
													<v-col align="right">
														<v-btn color="primary" @click="stepProgress = 6">
															Continue &gt;
														</v-btn>
													</v-col>
												</v-row>
											</v-container>
										</v-col>
									</v-row>
								</v-container>
							</v-stepper-content>
							<v-stepper-content step="6">
								<v-container>
									<v-row>
										<v-col cols="12">
											<v-container>
												<v-row>
													<v-col>
														<h3>Ok, we're all set. Does this look right?</h3>
													</v-col>
												</v-row>
											</v-container>
											<v-card>
												<v-card-title>
													<strong>{{ newActivity.name }}</strong>
												</v-card-title>
												<v-card-text>
													{{ newActivity.description }}
												</v-card-text>
												<v-card-title>
													<span>Actions:</span>
												</v-card-title>
												<v-list>
													<v-list-item
														v-for="action in newActivity.actions"
														:key="action.id"
														style="margin-bottom:0.5em"
														class="elevation-5 mx-5"
													>
														<!-- TODO: Move to ActionTile component? -->
														<v-list-item-content>
															<span>
																Name: <strong>{{ action.name }}</strong>
															</span>
															<br />
															<span>
																Type:
																<strong>{{ action.type.name }}</strong>
															</span>
															<br />
															<br />
															<div v-if="action.type.gradeType !== undefined">
																<span
																	v-for="(quality, index) in action.type
																		.gradeType.qualities"
																	:key="quality.scale"
																>
																	{{ quality.name }} ({{ quality.scale }})<span
																		v-if="
																			action.type.gradeType.qualities.length >
																				1 &&
																				index !==
																					action.type.gradeType.qualities
																						.length -
																						1
																		"
																		>,&nbsp;</span
																	> </span
																><br />
															</div>
															<div v-if="action.bonuses.length > 0">
																<v-card-title>
																	<span>Bonuses:</span>
																</v-card-title>
																<v-list>
																	<v-list-item
																		v-for="bonus in newActivity.bonuses"
																		:key="bonus.id"
																	>
																		<v-list-item-content></v-list-item-content>
																	</v-list-item>
																</v-list>
															</div>
														</v-list-item-content>
													</v-list-item>
												</v-list>
											</v-card>
											<v-container class="pa-0">
												<v-row>
													<v-col>
														<v-btn color="secondary" @click="stepProgress = 5">
															&lt; Previous
														</v-btn>
													</v-col>
													<v-col align="right">
														<v-btn color="success" @click="saveNewActivity">
															Save Activity
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
		<NewActionDialog
			:newActionDialogOpen="newActionDialogOpen"
			@saveNewAction="saveNewAction"
			@closeNewActionDialog="closeNewActionDialog"
		/>
	</div>
</template>
<style>
.v-stepper__content {
	margin: 0;
	padding: 0;
}
.v-stepper-full-height {
	/* height: calc(100vh - 120px); --if using stepper header */
	height: calc(100vh - 48px);
}
</style>
<script>
import NewActionDialog from "../components/NewActionDialog.vue";
export default {
	name: "NewActivityDialog",
	props: ["newActivityDialogOpen"],
	components: {
		NewActionDialog
	},
	data() {
		return {
			stepProgress: 1,
			rules: {
				required: value => !!value || "This can't be blank."
			},
			basicInfoFormValid: true,
			newActionDialogOpen: false,
			newBonusDialogOpen: false,
			newActivity: {
				name: "",
				description: "",
				actions: [],
				bonuses: []
			},
			tasks: []
		};
	},
	methods: {
		saveNewActivity() {
			this.$emit("saveNewActivity", this.newActivity);
		},
		closeNewActivityDialog() {
			this.$emit("closeNewActivityDialog");
		},
		openNewActionDialog() {
			this.newActionDialogOpen = true;
		},
		saveNewAction(newAction) {
			const action = newAction;
			this.newActivity.actions.push(action);
			this.newActionDialogOpen = false;
		},
		closeNewActionDialog() {
			this.newActionDialogOpen = false;
		},
		openNewBonusDialog() {
			this.newBonusDialogOpen = true;
		},
		closeNewBonusDialog() {
			this.newBonusDialogOpen = false;
		},
		openNewTaskDialog() {
			this.newTaskDialogOpen = true;
		},
		closeNewTaskDialog() {
			this.newTaskDialogOpen = false;
		}
	}
};
</script>
