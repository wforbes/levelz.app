<template>
	<div>
		<v-card>
			<v-container>
				<v-row>
					<v-col class="pt-0 pl-1 pr-1 pb-0">
						<v-container class="pt-5">
							<v-row>
								<v-col cols="2" class="pa-0 pt-2 ma-0">
									<v-btn
										fab
										small
										dark
										color="primary"
										@click="toggleSearchField"
									>
										<v-icon>mdi-text-search</v-icon>
									</v-btn>
								</v-col>
								<v-col cols="8" class="pt-2 pb-0 mb-0">
									<v-scroll-x-transition>
										<v-text-field
											v-model="listSearchTerm"
											v-if="showSearchField"
											clearable
											outlined
											rounded
											dense
											hide-details="true"
											placeholder="Search"
											prepend-inner-icon="mdi-text-search"
										></v-text-field>
									</v-scroll-x-transition>
									<!--
										<v-card
											v-show="listSearchTerm !== ''"
											style="margin-top:-1.2em;"
											min-height="2em"
											class="pa-1"
											align="left"
										>
											<v-row>
												<v-col cols="10">
													<div style="overflow-y:auto;">
														Filtering list by:
														<strong>{{ listSearchTerm }}</strong>
													</div>
												</v-col>
												<v-col cols="2" align="right" class="pt-1">
													<v-btn
														fab
														small
														dark
														color="error"
														@click="listSearchTerm = ''"
													>
														<v-icon dark>
															mdi-close
														</v-icon>
													</v-btn>
												</v-col>
											</v-row>
										</v-card>
										-->
								</v-col>
								<v-col cols="2" class="pa-0 pt-2" align="left">
									<v-btn
										fab
										small
										dark
										color="success"
										@click="openCreateActivityForm"
									>
										<v-icon dark>mdi-plus</v-icon>
									</v-btn>
								</v-col>
							</v-row>
							<v-row>
								<v-col>
									<div v-if="listIsLoading">
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
									<v-list
										v-if="filteredActivities.length > 0 && !listIsLoading"
										class="pa-1 overflow-y-auto"
										style=""
										max-height="52vh"
									>
										<v-list-item
											v-for="activity in filteredActivities"
											:key="activity.id"
											style="border-radius:4px; height:5em;cursor:pointer;"
											class="elevation-5 mb-2"
											ripple
											@click="openActivityDetailer(activity)"
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
									<v-card
										v-if="!listIsLoading && activities.length === 0"
										width="100%"
										height="100%"
										elevation="5"
									>
										<v-container>
											<v-row>
												<v-col>
													<h3>
														You don't have any Activities!
													</h3>
													<br />
													<p>
														Click the
														<v-btn
															fab
															x-small
															dark
															color="success"
															@click="openCreateActivityDialog"
														>
															<v-icon dark>mdi-plus</v-icon>
														</v-btn>
														button to begin adding an Activity.
													</p>
													<p>
														Click the
														<v-icon @click="openHelpOverlay">
															mdi-help-circle-outline
														</v-icon>
														for more information.
													</p>
												</v-col>
											</v-row>
										</v-container>
									</v-card>
									<v-card
										v-if="
											listSearchTerm !== '' &&
												filteredActivities.length === 0 &&
												activities.length > 0
										"
										width="100%"
										height="100%"
										elevation="5"
									>
										<v-container>
											<v-row>
												<v-col>
													<h3>
														Sorry, no Activities contain '{{ listSearchTerm }}'.
													</h3>
													<v-btn @click="listSearchTerm = ''">
														Reset Search
													</v-btn>
												</v-col>
											</v-row>
										</v-container>
									</v-card>
								</v-col>
							</v-row>
						</v-container>
					</v-col>
				</v-row>
			</v-container>
		</v-card>
	</div>
</template>
<style>
.v-dialog.v-dialog--fullscreen {
	margin: 64px 0 0;
}
</style>
<script>
import { util } from "@/mixins/util.js";
export default {
	name: "ActivityList",
	mixins: [util],
	components: {},
	data() {
		return {
			showComponent: false,
			listIsLoading: true,
			showSearchField: false,
			listSearchTerm: "",
			createActivityDialogOpen: false,
			activityDialogOpen: false
		};
	},
	computed: {
		activities() {
			return this.$store.getters.activities;
		},
		detailActivity() {
			return this.$store.getters.detailActivity;
		},
		filteredActivities() {
			return this.orderBy(
				this.activities.filter(activity => {
					if (!this.listSearchTerm) return this.activities;
					return (
						activity.name
							.toLowerCase()
							.includes(this.listSearchTerm.toLowerCase()) ||
						activity.description
							.toLowerCase()
							.includes(this.listSearchTerm.toLowerCase())
					);
				}),
				"name"
			);
		}
	},
	async created() {
		this.showComponent = true;
		this.listIsLoading = true;
		await this.$store.dispatch("loadActivities").then(() => {
			this.listIsLoading = false;
		});
	},
	methods: {
		openCreateActivityForm() {
			this.$store.dispatch("openCreateActivityForm");
		},
		openCreateActivityDialog() {
			this.createActivityDialogOpen = true;
		},
		closeCreateActivityDialog() {
			this.createActivityDialogOpen = false;
		},
		toggleSearchField() {
			this.showSearchField = !this.showSearchField;
		},
		openActivityDetailer(activity) {
			//this.showComponent = false;
			this.$store.dispatch({
				type: "openActivityDetailer",
				detailActivity: activity
			});
		},
		openHelpOverlay() {
			this.$emit("openHelpOverlay");
		}
	}
};
</script>
