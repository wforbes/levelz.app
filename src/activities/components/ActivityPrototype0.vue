<template>
	<div>
		<v-card>
			<v-container class="pb-0">
				<v-row>
					<v-col class="pt-0 pl-1 pr-1">
						<v-text-field
							v-model="newActivity.name"
							:placeholder="newActivitySuggestion"
							label="New Activity"
							outlined
							@keypress.enter="addNewActivity"
						></v-text-field>
					</v-col>
				</v-row>
				<v-row>
					<v-col class="pa-0">
						<v-list v-if="activities.length > 0" class="pa-1">
							<div v-for="activity in activities" :key="activity.id">
								<div v-if="activity.actions.length > 0">
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
										ripple
									>
										<v-col
											class="pa-0"
											cols="10"
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
										<v-col class="pa-0" cols="2" align="center">
											<v-list-item-action class="ma-0 pa-0">
												<v-checkbox
													v-model="activity.completed"
													color="success"
												></v-checkbox>
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
			@closeDialog="closeEditActivityDialog"
		/>
	</div>
</template>

<script>
import Guid from "../../lib/util/Guid.js";
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
			newActivity: {
				id: "",
				name: "",
				desc: "",
				complete: false,
				actions: []
			},
			activities: [],
			emptyActivity: {
				id: "",
				name: "",
				desc: "",
				complete: false,
				actions: []
			},
			editActivity: {},
			editActivityDialogOpen: false
		};
	},
	created() {
		this.setRandomSuggestion();
	},
	computed: {
		newActivitySuggestion() {
			return "[Like: " + this.randomSuggestion + " ]";
		}
	},
	methods: {
		setRandomSuggestion() {
			const suggestions = [
				"Go Hiking",
				"Clean the House",
				"Practice Singing",
				"Do Math Homework",
				"Read a Book",
				"Meditate For 10 Mins",
				"Write in Journal",
				"Practice Coding",
				"Study Some History",
				"Do the Dishes",
				"Do the Laundry",
				"Mow the Lawn"
			]; //TODO: Get a dynamic list of these from the database
			const suggestionIndex = this.getNonRepeatedSuggestion(suggestions);
			this.randomSuggestion = "'" + suggestions[suggestionIndex] + "'";
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
			this.newActivity.id = Guid.v4();
			const createdActivity = Object.assign({}, this.newActivity);
			this.newActivity = Object.assign({}, this.emptyActivity);
			this.activities.push(createdActivity);
			this.setRandomSuggestion();
		},
		openEditActivityDialog(id) {
			this.editActivity = this.activities.find(activity => {
				return activity.id === id;
			});
			this.editActivityDialogOpen = true;
		},
		closeEditActivityDialog() {
			this.editActivity = this.emptyActivity;
			this.editActivityDialogOpen = false;
		}
	}
};
</script>
