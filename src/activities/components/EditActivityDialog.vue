<template>
	<div>
		<v-dialog
			v-model="dialogOpen"
			transition="slide-x-transition"
			fullscreen
			hide-overlay
		>
			<v-card>
				<v-toolbar dark dense flat elevation="5" height="64px">
					<v-container>
						<v-row>
							<v-col
								offset-md="1"
								offset-lg="2"
								offset-xl="3"
								cols="1"
								class="pa-0"
							>
								<v-btn @click="closeDialog" icon>
									<v-icon>mdi-arrow-left</v-icon>
								</v-btn>
							</v-col>
							<v-col cols="6">
								<v-toolbar-title>{{ toolbarTitle }}</v-toolbar-title>
							</v-col>
						</v-row>
					</v-container>
				</v-toolbar>
				<v-container>
					<v-row>
						<v-col cols="12" md="6" class="pt-0 pb-0">
							<v-form ref="editActivityForm">
								<v-container>
									<v-row>
										<v-col class="pb-0">
											<v-row>
												<v-col>
													<transition name="fade" mode="out-in">
														<v-row>
															<v-col cols="10" class="pa-0">
																<div style="padding: 0.5em;">
																	<v-text-field
																		v-model="activity.name"
																		outlined
																		label="Activity Name"
																		:rules="[rules.required, rules.nameLength]"
																	></v-text-field>
																</div>
															</v-col>
															<v-col cols="2" class="pt-4">
																<transition name="fade" mode="out-in">
																	<v-btn
																		fab
																		x-small
																		color="success"
																		:disabled="!thisWasEdited('name')"
																		v-if="!fieldsLoading['name']"
																		@click="saveFieldEdit('name')"
																	>
																		<v-icon>
																			mdi-check-bold
																		</v-icon>
																	</v-btn>
																	<v-btn
																		v-else
																		fab
																		x-small
																		loading
																		color="primary"
																	></v-btn>
																</transition>
															</v-col>
														</v-row>
													</transition>
												</v-col>
											</v-row>
										</v-col>
									</v-row>
									<v-row>
										<v-col class="pt-0 pb-0 mt-0">
											<v-textarea
												ref="descriptionField"
												v-model="activity.description"
												outlined
												label="Activity Description (Optional)"
												height="150"
											></v-textarea>
										</v-col>
									</v-row>
									<v-row>
										<v-col class="pt-0">
											<v-expansion-panels>
												<v-expansion-panel class="pa-0">
													<v-expansion-panel-header>
														Actions
													</v-expansion-panel-header>
													<v-expansion-panel-content>
														<v-container>
															<v-row>
																<v-col class="pa-0">
																	<CreateActionDialog
																		:dialogOpen="createActionDialogOpen"
																		@closeDialog="closeCreateActionDialog"
																	/>
																	<br />
																	<v-list>
																		<v-list-item
																			v-for="action of activity.actions"
																			:key="action.id"
																			style="border-radius:4px; height:4em;cursor:pointer;"
																			class="elevation-5 mb-2 ml-0 mr-0"
																		>
																			<v-col cols="10">
																				{{ action.name }}
																			</v-col>
																			<v-col cols="2">
																				<v-icon>mdi-pencil</v-icon>
																			</v-col>
																		</v-list-item>
																	</v-list>
																</v-col>
															</v-row>
														</v-container>
													</v-expansion-panel-content>
												</v-expansion-panel>
											</v-expansion-panels>
										</v-col>
									</v-row>
								</v-container>
							</v-form>
						</v-col>
					</v-row>
				</v-container>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
import { util } from "@/mixins/util.js";
import CreateActionDialog from "./CreateActionDialog.vue";
export default {
	name: "EditActivityDialog",
	props: ["dialogOpen"],
	mixins: [util],
	components: {
		CreateActionDialog
	},
	data() {
		return {
			toolbarTitle: "Edit Activity",
			createActionDialogOpen: false,
			fields: ["name", "description"],
			editField: "",
			fieldsLoading: {},
			activity: {
				id: "",
				name: "",
				description: "",
				actions: []
			},
			emptyActivity: {
				id: "",
				name: "",
				description: "",
				actions: []
			},
			rules: {
				required: value => !!value || "This can't be blank.",
				nameAlreadyExists: value =>
					(value && !this.activityNameExists(value)) || this.nameExistsMsg,
				nameLength: value =>
					(value && value.length >= 3 && value.length <= 70) ||
					"Must be between 3 and 70 characters."
				//TODO: check description upper bound length
			},
			nameExistsMsg: "You already have an Activity by that name!"
		};
	},
	created() {
		//console.log(this.rules.alreadyExists("test"));
	},
	watch: {
		async dialogOpen(newVal, oldVal) {
			if (newVal && !oldVal) {
				this.activity = Object.assign({}, this.detailActivity);
			}
		}
	},
	computed: {
		detailActivity() {
			return this.$store.getters.detailActivity;
		},
		activities() {
			return this.$store.getters.activities;
		}
	},
	methods: {
		async closeDialog() {
			/*
			if (this.$refs.newActivityForm.validate()) {
				await this.saveActivity();
			}
			this.$refs.newActivityForm.reset();
			this.activity = Object.assign(this.activity, this.emptyActivity);
			*/
			this.$emit("closeDialog");
		},
		activityNameExists(name) {
			return this.activities.filter(a => a.name === name).length > 0;
		},
		thisWasEdited(field) {
			return this.detailActivity[field] !== this.activity[field];
		},
		async saveFieldEdit(field) {
			this.fieldsLoading[field] = true;
			await this.$store
				.dispatch({
					type: "updateActivityField",
					activityId: this.detailActivity.id,
					fieldName: field,
					newValue: this.activity[field]
				})
				.then(saveSuccessful => {
					if (saveSuccessful) {
						this.$store.dispatch({
							type: "showSnackBar",
							text: "Activity change was saved!"
						});
						this.$store.dispatch({
							type: "updateActivityOnList",
							activity: this.activity
						});
						this.$store.dispatch({
							type: "setDetailActivity",
							activity: this.activity
						});
					} else {
						this.$store.dispatch({
							type: "showSnackBar",
							text: "Error: Problem saving Activity change!"
						});
					}
					this.fieldsLoading[field] = false;
				});
		},
		editing(field) {
			return this.editField === field;
		},
		editThis(field) {
			console.log(field + "Field");
			console.log(this.$refs.editActivityForm);
			console.log(this.$refs[field + "Field"]);
			this.editField = field;
		},
		async updateActivity() {
			return this.$store
				.dispatch({
					type: "updateActivity",
					newActivity: this.activity
				})
				.then(response => {
					let notification = "";
					if (response.data.success === true) {
						this.$store.dispatch({
							type: "addActivityToList",
							activity: response.data.newActivity
						});
						notification = "Your Activity Was Saved!";
					} else {
						notification = "Your Activity Couldn't Be Saved...";
					}
					this.$store.dispatch({
						type: "showSnackBar",
						text:
							"message" in response.data ? response.data.message : notification
					});
					return Promise.resolve();
				});
		},
		openCreateActionDialog() {
			this.createActionDialogOpen = true;
		},
		closeCreateActionDialog() {
			this.createActionDialogOpen = false;
		}
	}
};
</script>
