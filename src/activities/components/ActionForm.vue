<template>
	<div id="action-form">
		<v-card>
			<v-container class="pa-0 pt-4 pb-4">
				<v-row class="ma-0 pa-0">
					<v-col class="pt-0 pb-0">
						<v-container class="pa-0">
							<v-form
								v-if="mode === 'create'"
								v-model="createFormValid"
								ref="newActionForm"
							>
								<v-row>
									<v-col class="pb-0">
										<v-text-field
											v-model="newAction.name"
											outlined
											label="Action Name"
											:rules="[rules.required, rules.nameLength]"
										></v-text-field>
									</v-col>
								</v-row>
								<v-row>
									<v-col class="pt-0 pb-0 mt-0">
										<v-textarea
											v-model="newAction.description"
											outlined
											label="Action Description (Optional)"
											height="150"
										></v-textarea>
									</v-col>
								</v-row>
								<v-row>
									<v-col>
										<v-btn
											color="success"
											:disabled="!createFormValid"
											@click="createAction"
											>Save</v-btn
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
								ref="editActionForm"
							>
								<v-row>
									<v-col class="pb-0">
										<v-text-field
											v-model="editAction.name"
											outlined
											label="Action Name"
											:rules="[rules.required]"
											validate-on-blur
										></v-text-field>
									</v-col>
								</v-row>
								<v-row>
									<v-col class="pt-0 pb-0 mt-0">
										<v-textarea
											v-model="editAction.description"
											outlined
											label="Action Description (Optional)"
											height="150"
										></v-textarea>
									</v-col>
								</v-row>
								<v-row>
									<v-col>
										<v-btn
											color="success"
											:disabled="!editFormValid || !actionWasChanged"
											@click="updateAction"
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
	</div>
</template>
<script>
import { util } from "@/mixins/util.js";
export default {
	name: "ActionForm",
	props: ["stepperState"],
	mixins: [util],
	data() {
		return {
			isLoading: false,
			createFormValid: false,
			editFormValid: false,
			emptyAction: {
				id: "",
				name: "",
				description: "",
				types: []
			},
			newAction: {
				id: "",
				name: "",
				description: "",
				types: []
			},
			editAction: {
				id: "",
				name: "",
				description: "",
				types: []
			},
			rules: {
				required: value => !!value || "This can't be blank.",
				nameAlreadyExists: value =>
					(value && !this.actionNameExists(value)) || this.nameExistsMsg,
				nameLength: value =>
					(value && value.length >= 3 && value.length <= 70) ||
					"Must be between 3 and 70 characters."
				//TODO: check description upper bound length
			},
			nameExistsMsg: "You already have an Action by that name!"
		};
	},
	computed: {
		mode() {
			return this.$store.getters.actionFormMode;
		},
		actionWasChanged() {
			return !this.isEqual(this.editAction, this.$store.getters.editAction);
		}
	},
	created() {
		if (this.mode === "edit") {
			this.editAction = this.cloneDeep(this.$store.getters.editAction);
		}
	},
	methods: {
		async createAction() {
			console.log("createAction");
			if (this.mode !== "create" || this.createFormValid === false) {
				return; //sanity check
			}
			await this.$store.dispatch({
				type: "createNewAction",
				action: this.newAction
			});
			this.closeForm();
		},
		async updateAction() {
			console.log("updateAction");
			if (this.mode !== "edit" || this.editFormValid === false) {
				return; //sanity check
			}
			await this.$store.dispatch({
				type: "updateAction",
				action: this.editAction
			});
			this.closeForm();
		},
		closeForm() {
			if (this.mode === "create") {
				this.newActivity = this.cloneDeep(this.emptyAction);
			}
			if (this.mode === "edit") {
				this.editAction = this.cloneDeep(this.emptyAction);
			}
			this.$store.dispatch("closeActionForm");
		},
		checkForUnsavedChanges() {
			//if create mode, check if newAction was changed
			//if edit mode, check if editAction was changed
			//show dialog confirming unsaved changes will be deleted
			// - allow confirmation and clear current mode's obj and mode
			// - allow returning to the form to complete
		}
	}
};
</script>
