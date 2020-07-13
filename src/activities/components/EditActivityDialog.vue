<template>
	<v-dialog v-model="dialogOpen" max-width="800">
		<v-card class="elevation-12">
			<v-toolbar dark dense flat>
				<v-toolbar-title>{{ toolbarTitle }}</v-toolbar-title>
				<v-spacer></v-spacer>
				<v-btn @click="closeDialog" icon>
					<v-icon>mdi-close</v-icon>
				</v-btn>
			</v-toolbar>
			<v-card>
				<v-container>
					<v-row>
						<v-col cols="12" sm="6">
							<v-form>
								<v-container>
									<v-row>
										<v-col>
											<v-text-field
												v-model="editActivity.name"
												outlined
												:placeholder="newActivitySuggestion"
												label="Activity Name"
												:rules="[rules.required]"
												validate-on-blur
											></v-text-field>
										</v-col>
									</v-row>
									<v-row>
										<v-col>
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
											<v-form-actions>
												<v-container class="pa-0">
													<v-row>
														<v-col cols="9" class="pa-0">
															<v-btn class="mr-3" color="success">Save</v-btn>
															<v-btn @click="closeDialog">Cancel</v-btn>
														</v-col>
														<v-col cols="3" class="pa-0" align="right">
															<v-btn fab medium>
																<v-icon>
																	mdi-cog
																</v-icon>
															</v-btn>
														</v-col>
													</v-row>
												</v-container>
											</v-form-actions>
										</v-col>
									</v-row>
								</v-container>
							</v-form>
						</v-col>
						<v-col cols="12" sm="6">
							<h3>Actions</h3>
							<v-list>
								<v-list-item>
									(Action Placeholder 1)
								</v-list-item>
								<v-list-item>
									(Action Placeholder 2)
								</v-list-item>
								<v-list-item>
									(Action Placeholder 3)
								</v-list-item>
							</v-list>
						</v-col>
					</v-row>
				</v-container>
			</v-card>
		</v-card>
	</v-dialog>
</template>

<script>
export default {
	name: "EditActivityDialog",
	props: ["dialogOpen", "editActivity", "newActivitySuggestion"],
	data() {
		return {
			toolbarTitle: "Edit Activity",
			rules: {
				required: value => !!value || "This can't be blank."
			}
		};
	},
	methods: {
		closeDialog() {
			this.$emit("closeDialog");
		}
	}
};
</script>
