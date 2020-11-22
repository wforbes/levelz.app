<template>
	<div>
		<v-btn color="success" width="100%" @click="dialogOpen = true">
			Add New Action
		</v-btn>
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
							<v-form ref="newActionForm">
								<v-container>
									<v-row>
										<v-col class="pb-0">
											<v-text-field
												v-model="action.name"
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
												v-model="action.description"
												outlined
												label="Activity Description (Optional)"
												height="150"
											></v-textarea>
										</v-col>
									</v-row>
									<v-row>
										<v-col class="pt-0 pb-0 mt-0">
											<v-select
												v-model="action.types"
												:items="types"
												label="Action Types"
												item-text="name"
												return-object
												multiple
												chips
											>
											</v-select>
										</v-col>
									</v-row>
									<v-row>
										<v-col>
											<v-list>
												<v-list-item
													v-for="type of action.types"
													:key="type.id"
													style="border-radius:4px; height:5em;cursor:pointer;"
													class="elevation-5 mb-2"
													@click="openConfigureActionTypeDialog(type)"
												>
													<v-row>
														<!-- TODO: SET COLORS TO RED IF NOT CONFIGURED UP YET -->
														<v-col cols="10">
															{{ type.name }}
														</v-col>
														<v-col cols="2">
															<v-icon>mdi-pencil</v-icon>
														</v-col>
													</v-row>
												</v-list-item>
											</v-list>
										</v-col>
									</v-row>
									<v-row>
										<v-col align="right">
											<v-btn>Done</v-btn>
										</v-col>
									</v-row>
								</v-container>
							</v-form>
						</v-col>
					</v-row>
				</v-container>
			</v-card>
		</v-dialog>
		<ConfigureActionTypeDialog
			:dialogOpen="configureActionTypeDialogOpen"
			:type="typeToConfigure"
			@closeDialog="closeConfigureActionTypeDialog"
		/>
	</div>
</template>
<script>
import ConfigureActionTypeDialog from "./ConfigureActionTypeDialog.vue";
export default {
	name: "CreateAction",
	components: {
		ConfigureActionTypeDialog
	},
	data() {
		return {
			toolbarTitle: "Create Action",
			isLoaded: false,
			dialogOpen: false,
			action: {
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
			types: [
				{
					id: "1",
					name: "Graded"
				},
				{
					id: "2",
					name: "Timed"
				},
				{
					id: "3",
					name: "Progress"
				}
			],
			typeToConfigure: {},
			configureActionTypeDialogOpen: false,
			rules: {
				required: value => !!value || "This can't be blank."
				//TODO: check description upper bound length
			}
		};
	},
	methods: {
		closeDialog() {
			this.$refs.newActionForm.reset();
			this.dialogOpen = false;
		},
		openConfigureActionTypeDialog(type) {
			this.typeToConfigure = type;
			this.configureActionTypeDialogOpen = true;
		},
		closeConfigureActionTypeDialog() {
			this.typeToConfigure = Object.assign({}, this.typeToConfigure);
			this.configureActionTypeDialogOpen = false;
		}
	}
};
</script>
