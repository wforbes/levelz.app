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
						<v-col cols="12" md="6">
							<v-form ref="newActivityForm">
								<v-container>
									<v-row>
										<v-col class="pb-0">
											<v-text-field
												v-model="activity.name"
												outlined
												:placeholder="newActivitySuggestion"
												label="Activity Name"
												:rules="[rules.required, rules.nameLength]"
											></v-text-field>
										</v-col>
									</v-row>
									<v-row>
										<v-col class="pt-0 pb-0 mt-0">
											<v-textarea
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
			randomSuggestion: "",
			createActionDialogOpen: false,
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
				await this.$store.dispatch("loadActivitySuggestions");
				await this.$store.dispatch("loadMyActivities");
				this.setRandomSuggestion();
			}
		}
	},
	computed: {
		detailActivity() {
			return this.$store.getters.detailActivity;
		},
		newActivitySuggestion() {
			if (this.isEmpty(this.randomSuggestion)) {
				return "";
			} else {
				return "[Like: " + this.randomSuggestion + " ]";
			}
		},
		activitySuggestions() {
			return this.$store.getters.activitySuggestions;
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
		},
		setRandomSuggestion() {
			const index = this.getNonRepeatedSuggestion(this.activitySuggestions);
			this.randomSuggestion = "'" + this.activitySuggestions[index] + "'";
		},
		getNonRepeatedSuggestion(suggestions) {
			let suggestionIndex = this.getRandomInt(suggestions.length);
			let lastSuggestionIndex;
			for (let i = 0; i < suggestions.length; i++) {
				if (this.randomSuggestion.includes(suggestions[i])) {
					lastSuggestionIndex = i;
					break;
				}
			}
			while (suggestionIndex === lastSuggestionIndex) {
				suggestionIndex = this.getRandomInt(suggestions.length);
			}
			return suggestionIndex;
		}
	}
};
</script>
