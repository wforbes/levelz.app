<template>
	<div>
		<v-card>
			<v-container class="pb-0">
				<v-row>
					<v-col class="pt-0 pl-1 pr-1">
						<v-form v-model="simpleActivityValid" ref="simpleActivityForm">
							<v-container class="pa-0">
								<v-row>
									<v-col cols="10" class="pr-0 pt-0 pb-0">
										<v-text-field
											v-model="newActivity.name"
											outlined
											:placeholder="newActivitySuggestion"
											label="New Activity"
											:rules="[rules.required]"
											validate-on-blur
											@keydown.enter.prevent="addNewActivity"
										></v-text-field>
									</v-col>
									<v-col cols="2" class="ma-0 pa-0 pt-2 pr-3 pb-3">
										<v-btn
											fab
											align="center"
											justify="center"
											small
											color="success"
											dark
											@click="addNewActivity"
										>
											<v-icon>mdi-plus</v-icon>
										</v-btn>
									</v-col>
								</v-row>
							</v-container>
						</v-form>
					</v-col>
				</v-row>
				<v-row>
					<v-col class="pa-0">
						<v-list v-if="activities.length > 0" class="pa-1">
							<div v-for="activity in activities" :key="activity.id">
								<div v-if="hasActions(activity)">
									<v-list-item
										style="border-radius:4px; height:5em;"
										class="elevation-5 mb-2"
									>
										<!-- TODO:if actions exist, markup for list item have an item group with children for actions -->
										<v-list-item-content
											@click="openEditActivityDialog(activity.id)"
										>
											<v-list-item-title
												v-html="activity.name"
											></v-list-item-title>
											<v-list-item-subtitle
												v-html="activity.desc"
											></v-list-item-subtitle>
										</v-list-item-content>
										<v-list-item-icon>
											<v-icon>mdi-check</v-icon>
										</v-list-item-icon>
									</v-list-item>
								</div>
								<div v-else>
									<v-list-item
										style="border-radius:4px; height:5em;cursor:pointer;"
										class="elevation-5 mb-2"
									>
										<v-col
											class="pa-0"
											cols="9"
											@click="openEditActivityDialog(activity.id)"
										>
											<v-list-item-content>
												<v-list-item-title
													v-html="activity.name"
												></v-list-item-title>
												<v-list-item-subtitle
													v-html="activity.desc"
												></v-list-item-subtitle>
											</v-list-item-content>
										</v-col>
										<v-col class="pa-0" cols="3" align="center">
											<v-list-item-action class="mr-0">
												<v-btn dark fab small color="success">
													<v-icon>
														mdi-check
													</v-icon>
												</v-btn>
											</v-list-item-action>
										</v-col>
									</v-list-item>
								</div>
							</div>
						</v-list>
					</v-col>
				</v-row>
			</v-container>
		</v-card>
		<EditActivityDialog
			:dialogOpen="editActivityDialogOpen"
			:editActivity="editActivity"
			:newActivitySuggestion="newActivitySuggestion"
			@closeDialog="closeEditActivityDialog"
		/>
	</div>
</template>

<script>
//import Guid from "../../lib/util/Guid.js";
import U from "../../lib/util/U.js";
import EditActivityDialog from "../components/EditActivityDialog.vue";
export default {
	name: "ActivityPrototype0",
	components: {
		EditActivityDialog
	},
	data() {
		return {
			randomSuggestion: "",
			simpleActivityValid: true,
			rules: {
				required: value => !!value || "This can't be blank."
			},
			newActivity: {
				id: "",
				name: "",
				desc: "",
				actions: []
			},
			emptyActivity: {
				id: "",
				name: "",
				desc: "",
				actions: []
			},
			editActivity: {},
			editActivityDialogOpen: false
		};
	},
	async created() {
		await this.$store.dispatch("loadActivitySuggestions");
		await this.$store.dispatch("loadMyActivities");
		this.setRandomSuggestion();
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
		},
		addNewActivity() {
			if (this.$refs.simpleActivityForm.validate()) {
				this.$store.dispatch({
					type: "createNewActivity",
					newActivity: this.newActivity
				});
				const createdActivity = Object.assign({}, this.newActivity);
				this.newActivity = Object.assign({}, this.emptyActivity);
				this.activities.push(createdActivity);
				this.setRandomSuggestion();
			}
		},
		openEditActivityDialog(id) {
			this.setRandomSuggestion();
			this.editActivity = this.activities.find(activity => {
				return activity.id === id;
			});
			this.editActivityDialogOpen = true;
		},
		closeEditActivityDialog() {
			this.editActivity = this.emptyActivity;
			this.editActivityDialogOpen = false;
		},
		hasActions(activity) {
			return !U.isEmpty(activity.actions) && activity.actions.length > 0;
		}
	}
};
</script>
