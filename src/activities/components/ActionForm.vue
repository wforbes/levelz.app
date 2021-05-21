<template>
	<div id="action-form">
		<v-card v-if="mode !== '' && !isLoading">
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
									<v-col class="pt-0 pb-0 mt-0" md="3" cols="12">
										<v-checkbox
											v-model="newAction.repeatable"
											label="Repeatable"
										>
										</v-checkbox>
									</v-col>
									<div v-if="newAction.repeatable">
										<v-col class="pt-0 pb-0 mt-0" cols="12">
											<v-checkbox
												v-model="newAction.repeatedRegularly"
												label="Schedule Regularly?"
											>
											</v-checkbox>
										</v-col>
									</div>
									<div v-if="newAction.repeatedRegularly">
										<v-col class="pt-0 pb-0 mt-0" cols="12">
											<v-select
												v-model="newAction.repeatIntervalId"
												:items="repeatIntervals"
												item-text="name"
												item-value="id"
												label="How Often?"
											></v-select>
										</v-col>
									</div>
								</v-row>
								<!--
								<v-row>
									<v-col cols="12" style="text-align:left" class="pt-0 pb-0">
										<h3>Action Types</h3>
									</v-col>
									<v-col class="pt-0 pb-0">
										<v-select
											v-model="newAction.types"
											:items="typeOptions"
											outlined
											placeholder="Choose Type(s)"
											chips
											multiple
										></v-select>
									</v-col>
								</v-row>
								<v-row v-if="newAction.types.length > 0">
									<v-col>
										<v-row v-if="newAction.types.includes('Gradable')">
											<v-col>
												Check
											</v-col>
										</v-row>
									</v-col>
								</v-row>
								-->
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
									<v-col class="pt-0 pb-0 mt-0" cols="3">
										<v-checkbox
											v-model="editAction.repeatable"
											label="Repeatable"
										>
										</v-checkbox>
									</v-col>
								</v-row>
								<v-row>
									<v-col class="pt-0 pb-0 mt-0">
										<h3>Action Options</h3>
									</v-col>
								</v-row>
								<v-row
									style="border:0.1em solid grey; border-radius: 0.25em; margin: 0.8em 0.01em"
									class="pt-4"
								>
									<v-col class="pt-0 pb-0 mt-0">
										<v-btn
											:style="
												$vuetify.breakpoint.mdAndUp ? '' : 'margin-top:25%;'
											"
											color="error"
											@click="openDeleteActionDialog()"
										>
											delete
										</v-btn>
									</v-col>
									<v-col class="pt-0 pb-0 mt-0">
										<p>
											<strong>Delete Action</strong>: Remove this action and
											it's associated data.
										</p>
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
		<div v-else-if="isLoading">
			<LoadingCard />
		</div>
		<DeleteActionDialog
			:dialogOpen="deleteActionDialogOpen"
			:action="editAction"
			@closeDialog="closeDeleteActionDialog"
		/>
	</div>
</template>
<script>
import { util } from "@/mixins/util.js";
import LoadingCard from "@/app/components/LoadingCard.vue";
import DeleteActionDialog from "@/activities/components/DeleteActionDialog.vue";
export default {
	name: "ActionForm",
	mixins: [util],
	components: {
		LoadingCard,
		DeleteActionDialog
	},
	data() {
		return {
			isLoading: false,
			createFormValid: false,
			editFormValid: false,
			deleteActionDialogOpen: false,
			//typeOptions: ["Gradable"],
			emptyAction: {
				id: "",
				name: "",
				description: "",
				repeatable: false,
				types: []
			},
			newAction: {
				id: "",
				name: "",
				description: "",
				repeatable: false,
				repeatedRegularly: false,
				repeatIntervalId: "",
				types: []
			},
			editAction: {
				id: "",
				name: "",
				description: "",
				repeatable: false,
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
		},
		repeatIntervals() {
			//TODO: move this to configurable list in options
			return this.$store.getters.repeatIntervals;
		},
		repeatedRegularly() {
			return this.newAction.repeatedRegularly;
		}
	},
	watch: {
		repeatedRegularly(newVal, oldVal) {
			console.log("watch hit");
			if (!newVal && oldVal) {
				console.log("watch block hit");
				this.newAction.repeatIntervalId = "";
			}
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
		},
		openDeleteActionDialog() {
			this.deleteActionDialogOpen = true;
		},
		async closeDeleteActionDialog(confirm) {
			this.deleteActionDialogOpen = false;
			if (confirm === true) {
				this.isLoading = true;
				await this.$store.dispatch({
					type: "deleteActionById",
					actionId: this.editAction.id
				});
				this.isLoading = false;
				this.closeForm();
			}
		}
	}
};
</script>
