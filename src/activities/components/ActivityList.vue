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
							<v-row>
								<v-col>
									<div v-if="showListSkeleton === true">
										<v-skeleton-loader
											height="5em"
											class="elevation-5 mb-2"
											type="list-item-two-line"
										></v-skeleton-loader>
										<v-skeleton-loader
											height="5em"
											class="elevation-5 mb-2"
											type="list-item-two-line"
										></v-skeleton-loader>
									</div>
									<v-list v-if="activities.length > 0" class="pa-1">
										<v-list-item
											v-for="activity in activities"
											:key="activity.id"
											style="border-radius:4px; height:5em;cursor:pointer;"
											class="elevation-5 mb-2"
											ripple
											@click="openActivityDialog(activity)"
										>
											<v-list-item-content>
												<v-list-item-title
													v-html="activity.name"
												></v-list-item-title>
												<v-list-item-subtitle
													v-html="activity.description"
												></v-list-item-subtitle>
											</v-list-item-content>
										</v-list-item>
									</v-list>
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
		<ActivityDialog
			:dialogOpen="activityDialogOpen"
			:focusActivity="focusActivity"
			@closeDialog="closeActivityDialog"
		/>
	</div>
</template>
<script>
import CreateActivityDialog from "./CreateActivityDialog.vue";
import ActivityDialog from "./ActivityDialog.vue";
export default {
	name: "ActivityList",
	components: {
		CreateActivityDialog,
		ActivityDialog
	},
	data() {
		return {
			showListSkeleton: true,
			listSearchTerm: "",
			createActivityDialogOpen: false,
			focusActivity: {},
			activityDialogOpen: false
		};
	},
	async created() {
		this.showListSkeleton = true;
		await this.$store.dispatch("loadMyActivities").then(() => {
			this.showListSkeleton = false;
		});
	},
	computed: {
		activities() {
			return this.$store.getters.activities;
		}
	},
	methods: {
		openCreateActivityDialog() {
			this.createActivityDialogOpen = true;
		},
		closeCreateActivityDialog() {
			this.createActivityDialogOpen = false;
		},
		openActivityDialog(activity) {
			this.focusActivity = activity;
			this.activityDialogOpen = true;
		},
		closeActivityDialog() {
			this.activityDialogOpen = false;
		}
	}
};
</script>
