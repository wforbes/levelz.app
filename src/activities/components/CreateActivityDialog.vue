<template>
	<div>
		<v-dialog
			v-model="dialogOpen"
			class="ma-5"
			transition="slide-x-transition"
			fullscreen
			hide-overlay
		>
			<v-card>
				<v-toolbar dark dense flat elevation="5" height="56px">
					<v-btn @click="closeDialog" icon>
						<v-icon>mdi-arrow-left</v-icon>
					</v-btn>
					<v-toolbar-title>{{ toolbarTitle }}</v-toolbar-title>
					<v-spacer></v-spacer>
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
												:rules="[rules.required]"
												validate-on-blur
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
import U from "../../lib/util/U.js";
import CreateActionDialog from "./CreateActionDialog.vue";
export default {
	name: "CreateActivityDialog",
	props: ["dialogOpen"],
	components: {
		CreateActionDialog
	},
	data() {
		return {
			toolbarTitle: "Create Activity",
			isLoaded: false,
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
				required: value => !!value || "This can't be blank."
				//TODO: check description upper bound length
			}
		};
	},
	created() {},
	watch: {
		isLoaded(nV, oV) {
			if (nV && !oV) {
				console.log("isLoaded");
			}
		},
		async dialogOpen(newVal, oldVal) {
			if (newVal && !oldVal) {
				await this.$store.dispatch("loadActivitySuggestions");
				await this.$store.dispatch("loadMyActivities");
				this.setRandomSuggestion();
			}
		}
	},
	computed: {
		newActivitySuggestion() {
			if (U.isEmpty(this.randomSuggestion)) {
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
		closeDialog() {
			this.saveActivity();
			this.$refs.newActivityForm.reset();
			this.$emit("closeDialog");
		},
		saveActivity() {
			if (this.activity.name !== "") {
				console.log(this.activity.name);
				this.$store.dispatch({
					type: "showSnackBar",
					text: "Your Activity Was Saved!"
				});
			}
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
			let suggestionIndex = U.getRandomInt(suggestions.length);
			let lastSuggestionIndex;
			for (let i = 0; i < suggestions.length; i++) {
				if (this.randomSuggestion.includes(suggestions[i])) {
					lastSuggestionIndex = i;
					break;
				}
			}
			while (suggestionIndex === lastSuggestionIndex) {
				suggestionIndex = U.getRandomInt(suggestions.length);
			}
			return suggestionIndex;
		}
	}
};
</script>
