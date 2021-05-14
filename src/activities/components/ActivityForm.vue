<template>
	<div id="activity-form">
		<v-card v-if="mode !== '' && !isLoading">
			<v-container class="pa-0 pt-4 pb-4">
				<v-row class="ma-0 pa-0">
					<v-col class="pt-0 pb-0">
						<v-container class="pa-0">
							<v-form
								v-if="mode === 'create'"
								v-model="createFormValid"
								ref="newActivityForm"
							>
								<v-row>
									<v-col class="pb-0">
										<v-text-field
											v-model="newActivity.name"
											outlined
											label="Activity Name"
											:rules="[
												rules.required,
												rules.nameAlreadyExists,
												rules.nameLength
											]"
										></v-text-field>
									</v-col>
								</v-row>
								<v-row>
									<v-col class="pt-0 pb-0 mt-0">
										<v-textarea
											v-model="newActivity.description"
											outlined
											label="Activity Description (Optional)"
											height="150"
										></v-textarea>
									</v-col>
								</v-row>
								<v-row>
									<v-col>
										<v-btn
											color="success"
											:disabled="!createFormValid"
											@click="createActivity"
											>Create</v-btn
										>
									</v-col>
									<v-col>
										<v-btn @click="closeForm">Cancel</v-btn>
									</v-col>
								</v-row>
							</v-form>
							<v-form
								v-else-if="mode === 'edit'"
								v-model="editFormValid"
								ref="editActivityForm"
							>
								<v-row>
									<v-col class="pt-0 pb-0 mt-0">
										<h3>Activity Details</h3>
									</v-col>
								</v-row>
								<v-row>
									<v-col class="pb-0">
										<v-text-field
											v-model="editActivity.name"
											outlined
											label="Activity Name"
											:rules="[rules.required, rules.nameLength]"
										></v-text-field>
									</v-col>
								</v-row>
								<v-row>
									<v-col class="pt-0 pb-0 mt-0">
										<v-textarea
											v-model="editActivity.description"
											outlined
											label="Activity Description (Optional)"
											height="150"
										></v-textarea>
									</v-col>
								</v-row>
								<v-row>
									<v-col class="pt-0 pb-0 mt-0">
										<h3>Activity Options</h3>
									</v-col>
								</v-row>
								<v-row
									style="border:0.1em solid grey; border-radius: 0.25em; margin: 0.8em 0.01em"
									class="pa-3"
								>
									<v-col class="pt-0 pb-0 mt-0">
										<p>
											<strong>Delete Activity</strong>: Remove this activity and
											all it's actions from your lists.
										</p>
									</v-col>
									<v-col class="pt-0 pb-0 mt-0">
										<v-btn
											style="margin-top:25%;"
											color="error"
											@click="openDeleteActivityDialog()"
										>
											delete
										</v-btn>
									</v-col>
								</v-row>
								<v-row>
									<v-col>
										<v-btn
											color="success"
											:disabled="!editFormValid || !activityWasChanged"
											@click="updateActivity"
											>Save</v-btn
										>
									</v-col>
									<v-col>
										<v-btn @click="closeForm">Cancel</v-btn>
									</v-col>
								</v-row>
							</v-form>
						</v-container>
					</v-col>
				</v-row>
			</v-container>
		</v-card>
		<div v-else-if="isLoading">
			<LoadingCard />
		</div>
		<DeleteActivityDialog
			:dialogOpen="deleteActivityDialogOpen"
			:activity="editActivity"
			@closeDialog="closeDeleteActivityDialog"
		/>
	</div>
</template>
<script>
import { util } from "@/mixins/util.js";
import LoadingCard from "@/app/components/LoadingCard.vue";
import DeleteActivityDialog from "@/activities/components/DeleteActivityDialog.vue";
export default {
	name: "ActivityForm",
	mixins: [util],
	components: {
		LoadingCard,
		DeleteActivityDialog
	},
	data() {
		return {
			isLoading: false,
			createFormValid: false,
			editFormValid: false,
			deleteActivityDialogOpen: false,
			emptyActivity: {
				id: "",
				name: "",
				description: "",
				types: []
			},
			newActivity: {
				id: "",
				name: "",
				description: "",
				types: []
			},
			editActivity: {
				id: "",
				name: "",
				description: "",
				types: []
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
	computed: {
		mode() {
			return this.$store.getters.activityFormMode;
		},
		activities() {
			return this.$store.getters.activities;
		},
		activityWasChanged() {
			return !this.isEqual(
				this.editActivity,
				this.$store.getters.detailActivity
			);
		}
	},
	created() {
		if (this.mode === "edit") {
			this.editActivity = this.cloneDeep(this.$store.getters.detailActivity);
		}
	},
	methods: {
		closeForm() {
			this.editActivity = this.cloneDeep(this.emptyActivity);
			this.$store.dispatch("closeActivityForm");
		},
		activityNameExists(name) {
			return (
				this.activities.filter(a => a.name.toLowerCase() === name.toLowerCase())
					.length > 0
			);
		},
		async createActivity() {
			if (!this.createFormValid) return;
			this.isLoading = true;
			await this.$store
				.dispatch({
					type: "createNewActivity",
					newActivity: this.newActivity
				})
				.then(response => {
					console.log("created activity:");
					console.log(response);
				});
			this.isLoading = false;
			this.closeForm();
		},
		async updateActivity() {
			if (!this.editFormValid) return;
			this.isLoading = true;
			await this.$store.dispatch({
				type: "updateActivity",
				activity: this.editActivity
			});
			this.isLoading = false;
			this.closeForm();
		},
		openDeleteActivityDialog() {
			this.deleteActivityDialogOpen = true;
		},
		async closeDeleteActivityDialog(confirm) {
			this.deleteActivityDialogOpen = false;
			if (confirm === true) {
				this.isLoading = true;
				/*
				await this.$store.dispatch({
					type: "deleteActivityById",
					activityId: this.editActivity.id
				});*/
				this.isLoading = false;
				this.closeForm();
			}
		}
	}
};
</script>
