<template>
	<div id="activity-detailer">
		<v-card>
			<v-container class="pa-0 pt-4">
				<v-row class="ma-0 pa-0">
					<v-col class="pt-0 pb-0">
						<v-container class="pa-0">
							<v-row>
								<v-col cols="2" class="pa-0 pt-2 pl-5" align="left">
									<v-btn fab small @click="openEditActivityForm">
										<v-icon dark>mdi-cog</v-icon>
									</v-btn>
								</v-col>
								<v-col cols="8" class="pt-0 pb-0 mb-0">
									<!--
									<v-text-field
										v-model="listSearchTerm"
										outlined
										rounded
										placeholder="Search"
										prepend-inner-icon="mdi-text-search"
									></v-text-field>
									-->
								</v-col>
								<v-col cols="2" class="pa-0 pt-2 pr-5" align="right">
									<v-btn
										fab
										small
										dark
										color="success"
										@click="openCreateActionForm"
									>
										<v-icon dark>mdi-plus</v-icon>
									</v-btn>
								</v-col>
							</v-row>
							<!--
							<v-row>
								<v-col>
									<v-card
										v-if="true /*listSearchTerm !== ''*/"
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
								</v-col>
							</v-row>-->
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
										v-if="actionArray.length > 0 && !listIsLoading"
										class="pa-1 overflow-y-auto"
										style="border-radius:0.3em"
										max-height="63vh"
									>
										<v-list-item
											v-for="action in actionArray"
											:key="action.id"
											style="border-radius:4px; height:5em;cursor:pointer;"
											class="elevation-5 mb-2"
										>
											<v-list-item-action>
												<v-btn
													fab
													small
													ripple
													@click="openEditActionForm(action)"
												>
													<v-icon dark>mdi-pencil</v-icon>
												</v-btn>
											</v-list-item-action>
											<v-list-item-content
												ripple
												@click="openActionDetailer(action)"
											>
												<v-list-item-title
													v-html="action.name"
													:class="{
														struck:
															action.repeatable == 0 && action.complete === true
													}"
												></v-list-item-title>
												<v-list-item-subtitle
													v-html="action.description"
												></v-list-item-subtitle>
											</v-list-item-content>
											<v-list-item-action>
												<v-btn
													v-if="action.repeatable == 1"
													fab
													small
													@click="completeAction(action)"
												>
													<v-icon dark color="success">
														mdi-check-decagram
													</v-icon>
												</v-btn>
												<v-btn
													v-else
													fab
													small
													:disabled="action.complete === true"
													@click="completeAction(action)"
												>
													<v-icon dark color="success">
														mdi-check-decagram-outline
													</v-icon>
												</v-btn>
											</v-list-item-action>
										</v-list-item>
									</v-list>
									<v-card
										v-if="!listIsLoading && actionArray.length === 0"
										width="100%"
										height="100%"
										elevation="5"
										class="mb-4"
									>
										<v-row>
											<v-col>
												<h3>
													This Activity doesn't have any Actions!
												</h3>
												<br />
												<p>
													Click the
													<v-btn
														fab
														x-small
														dark
														color="success"
														@click="openCreateActionForm"
													>
														<v-icon dark>mdi-plus</v-icon>
													</v-btn>
													button to begin adding Actions.
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
									</v-card>
									<!--
									<v-card
										v-if="
											listSearchTerm !== '' &&
												filteredActions.length === 0 &&
												actionArray.length > 0
										"
										width="100%"
										height="100%"
										elevation="5"
									>
										<v-container>
											<v-row>
												<v-col>
													<h3>
														Sorry, no Actions contain '{{ listSearchTerm }}'.
													</h3>
													<v-btn @click="listSearchTerm = ''">
														Reset Search
													</v-btn>
												</v-col>
											</v-row>
										</v-container>
									</v-card>
									-->
								</v-col>
							</v-row>
						</v-container>
					</v-col>
				</v-row>
			</v-container>
		</v-card>
	</div>
</template>
<style scoped>
.struck {
	text-decoration: line-through;
}
</style>
<script>
import { util } from "@/mixins/util.js";
export default {
	name: "ActivityDetail",
	mixins: [util],
	data() {
		return {
			showComponent: false,
			listIsLoading: true,
			listSearchTerm: "",
			editActivityDialogOpen: false
		};
	},
	async created() {
		console.log("ActivityDetailer created");
		if (this.isEmpty(this.detailActivity)) {
			// returning to detailer after activity was deleted on form
			this.$store.dispatch("popStepState");
		} else {
			await this.loadActions();
		}
		this.listIsLoading = false;
	},
	computed: {
		detailActivity() {
			return this.$store.getters.detailActivity;
		},
		actionArray() {
			return this.$store.getters.actionList;
		},
		filteredActions() {
			return this.orderBy(
				this.actionArray.filter(action => {
					if (!this.listSearchTerm) return this.actionArray;
					return (
						action.name
							.toLowerCase()
							.includes(this.listSearchTerm.toLowerCase()) ||
						action.description
							.toLowerCase()
							.includes(this.listSearchTerm.toLowerCase())
					);
				}),
				"name"
			);
		}
	},
	methods: {
		closeThisView() {
			this.$store.dispatch("clearDetailActivity");
			this.$emit("closeActivityDetail");
		},
		openHelpOverlay() {
			this.$emit("openHelpOverlay");
		},
		loadActions() {
			console.log("loadActions");
			return this.$store.dispatch("loadDetailActivityActions");
		},
		async completeAction(action) {
			await this.$store.dispatch({
				type: "completeActionById",
				actionData: {
					actionId: action.id
				}
			});
		},
		openEditActivityForm() {
			this.$store.dispatch("openEditActivityForm");
		},
		openEditActionForm(action) {
			this.$store.dispatch({
				type: "openEditActionForm",
				action: action
			});
		},
		openCreateActionForm() {
			this.$store.dispatch("openCreateActionForm");
		},
		openActionDetailer(action) {
			this.$store.dispatch({
				type: "openActionDetailer",
				detailAction: action
			});
		},
		openEditActivityDialog() {
			console.log("openEditActivityDialog");
			this.editActivity = this.cloneDeep(this.detailActivity);
			this.editActivityDialogOpen = true;
		},
		closeEditActivityDialog() {
			console.log("closeEditActivityDialog");
			this.editActivityDialogOpen = false;
		}
	}
};
</script>
