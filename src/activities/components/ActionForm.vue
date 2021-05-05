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
											:rules="[rules.required]"
											validate-on-blur
										></v-text-field>
									</v-col>
								</v-row>
								<v-row>
									<v-col class="pt-0 pb-0 mt-0">
										<v-textarea
											v-model="newAction.description"
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
											@click="createAction"
											>Create</v-btn
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
export default {
	name: "ActionForm",
	props: ["stepperState"],
	data() {
		return {
			mode: "",
			createFormValid: false,
			newAction: {
				id: "",
				name: "",
				description: "",
				types: []
			},
			emptyAction: {
				id: "",
				name: "",
				description: "",
				types: []
			},
			rules: {
				required: value => !!value || "This can't be blank."
				//TODO: check description upper bound length
			}
		};
	},
	watch: {
		async stepperState(n, o) {
			//await this.loadActions();
			if (n === 3 && o === 2) {
				//component opened
				this.mode = this.$store.getters.actionFormMode;
			}
			if (n !== 3 && o === 3) {
				this.closeForm();
			}
		}
	},
	methods: {
		async createAction() {
			console.log("createAction");
			if (this.mode !== "create" || this.createFormValid === false) {
				return;
			}
			await this.$store.dispatch({
				type: "createNewAction",
				action: this.newAction
			});
			this.closeForm();
		},
		closeForm() {
			if (this.mode === "create") {
				this.closeCreateForm();
			}
			this.$emit("closeActionForm");
		},
		closeCreateForm() {
			this.checkForUnsavedChanges();
			this.$refs.newActionForm.reset();
		},
		checkForUnsavedChanges() {
			//show dialog confirming unsaved changes will be deleted
			// - allow confirmation and clear current mode's obj and mode
			this.newAction = Object.assign({}, this.emptyAction);
			this.mode = "";
			// - allow returning to the form to complete
		}
	}
};
</script>
