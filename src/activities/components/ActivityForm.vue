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
									<v-col class="pb-0">
										<v-text-field
											v-model="editActivity.name"
											outlined
											label="Activity Name"
											:rules="[rules.required]"
											validate-on-blur
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
									<v-col>
										<v-btn
											color="success"
											:disabled="!editFormValid || !actionWasChanged"
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
	</div>
</template>
<script>
import { util } from "@/mixins/util.js";
import LoadingCard from "@/app/components/LoadingCard.vue";
export default {
	name: "ActivityForm",
	props: ["stepperState"],
	mixins: [util],
	components: {
		LoadingCard
	},
	data() {
		return {
			isLoading: false,
			createFormValid: false,
			editFormValid: false,
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
		}
	},
	methods: {
		closeForm() {
			this.$store.dispatch("closeCreateActivityForm");
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
		}
	}
};
</script>
