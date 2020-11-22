<template>
	<div>
		<v-card>
			<v-container class="pb-0">
				<v-row>
					<v-col class="pt-0 pl-1 pr-1 pb-0">
						<v-container class="pa-0">
							<v-row>
								<v-col cols="10" class="pt-0 pb-0">
									<v-text-field
										v-model="listSearchTerm"
										outlined
										rounded
										placeholder="Search"
										prepend-inner-icon="mdi-text-search"
									></v-text-field>
								</v-col>
								<v-col cols="2" class="pa-0 pt-2" align="left">
									<v-btn
										fab
										small
										dark
										color="success"
										@click="openCreateActivityDialog"
									>
										<v-icon dark>mdi-plus</v-icon>
									</v-btn>
								</v-col>
							</v-row>
						</v-container>
					</v-col>
				</v-row>
			</v-container>
		</v-card>
		<CreateActivityDialog
			:dialogOpen="createActivityDialogOpen"
			@closeDialog="closeCreateActivityDialog"
		/>
	</div>
</template>
<script>
import CreateActivityDialog from "./CreateActivityDialog.vue";
export default {
	name: "ActivityList",
	components: {
		CreateActivityDialog
	},
	data() {
		return {
			createActivityDialogOpen: false,
			listSearchTerm: ""
		};
	},
	methods: {
		openCreateActivityDialog() {
			this.createActivityDialogOpen = true;
		},
		closeCreateActivityDialog() {
			this.createActivityDialogOpen = false;
		}
	}
};
</script>
