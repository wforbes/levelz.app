<template>
	<div>
		<v-card>
			<v-container class="pb-0">
				<v-row>
					<v-col class="pt-0 pl-1 pr-1 pb-0">
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
								<v-list-item
									style="border-radius:4px; height:5em;cursor:pointer;"
									class="elevation-5 mb-2"
									ripple
									@click="openActivityDialog(activity)"
								>
									<v-col class="pa-0">
										<v-list-item-content>
											<v-list-item-title
												v-html="activity.name"
											></v-list-item-title>
											<v-list-item-subtitle
												v-html="activity.description"
											></v-list-item-subtitle>
										</v-list-item-content>
									</v-col>
								</v-list-item>
							</div>
						</v-list>
					</v-col>
				</v-row>
			</v-container>
		</v-card>
		<ActivityDialog
			:dialogOpen="activityDialogOpen"
			:focusActivity="focusActivity"
			@closeDialog="closeActivityDialog"
		/>
	</div>
</template>
<script>
import U from "../../lib/util/U.js";
import ActivityDialog from "../components/ActivityDialog.vue";
export default {
	name: "ActivityList",
	components: {
		ActivityDialog
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
				description: "",
				actions: []
			},
			emptyActivity: {
				id: "",
				name: "",
				description: "",
				actions: []
			},
			editActivity: {},
			editActivityDialogOpen: false,
			focusActivity: {},
			activityDialogOpen: false
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
		async addNewActivity() {
			if (this.$refs.simpleActivityForm.validate()) {
				await this.$store.dispatch({
					type: "createNewActivity",
					newActivity: this.newActivity
				});
				const createdActivity = Object.assign({}, this.newActivity);
				this.newActivity = Object.assign({}, this.emptyActivity);
				this.activities.push(createdActivity);
				this.setRandomSuggestion();
			}
		},
		openEditActivityDialog(activity) {
			this.setRandomSuggestion();
			this.editActivity = Object.assign({}, activity);
			/*
			this.editActivity = this.activities.find(activity => {
				return activity.id === id;
			});
			*/
			this.editActivityDialogOpen = true;
		},
		closeEditActivityDialog() {
			this.editActivity = Object.assign({}, this.emptyActivity);
			this.editActivityDialogOpen = false;
		},
		hasActions(activity) {
			return !U.isEmpty(activity.actions) && activity.actions.length > 0;
		},
		openActivityDialog(activity) {
			this.focusActivity = Object.assign({}, activity);
			this.activityDialogOpen = true;
		},
		closeActivityDialog() {
			this.focusActivity = Object.assign({}, this.focusActivity);
			this.activityDialogOpen = false;
		}
	}
};
</script>
