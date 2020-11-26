<template>
	<v-card>
		<v-container class="pa-0 pt-4">
			<v-row class="ma-0 pa-0">
				<v-col class="pt-0 pb-0">
					<v-container class="pa-0">
						<v-row>
							<v-col cols="10" class="pt-0 pb-0 mb-0">
								<v-text-field
									v-model="listSearchTerm"
									outlined
									rounded
									placeholder="Search"
									prepend-inner-icon="mdi-text-search"
								></v-text-field>
								<v-card
									v-if="listSearchTerm !== ''"
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
							<v-col cols="2" class="pa-0 pt-2" align="left">
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
									v-if="filteredActions.length > 0 && !listIsLoading"
									class="pa-1 overflow-y-auto"
									style="border: 0.1em solid grey; border-radius:0.3em"
									max-height="52vh"
								>
									<v-list-item
										v-for="action in filteredActions"
										:key="action.id"
										style="border-radius:4px; height:5em;cursor:pointer;"
										class="elevation-5 mb-2"
										ripple
										@click="openActionForm(action)"
									>
										<v-list-item-content>
											<v-list-item-title
												v-html="action.name"
											></v-list-item-title>
											<v-list-item-subtitle
												v-html="action.description"
											></v-list-item-subtitle>
										</v-list-item-content>
									</v-list-item>
								</v-list>
								<v-card
									v-if="!listIsLoading && actions.length === 0"
									width="100%"
									height="100%"
									elevation="5"
								>
									<v-container>
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
									</v-container>
								</v-card>
								<v-card
									v-if="
										listSearchTerm !== '' &&
											filteredActions.length === 0 &&
											actions.length > 0
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
							</v-col>
						</v-row>
					</v-container>
				</v-col>
			</v-row>
		</v-container>
	</v-card>
</template>

<script>
import { util } from "@/mixins/util.js";
export default {
	name: "ActivityDetail",
	props: ["stepperState"],
	mixins: [util],
	data() {
		return {
			showComponent: false,
			listIsLoading: true,
			listSearchTerm: "",
			focusActivity: {}
		};
	},
	created() {
		console.log("ActivityDetailer created");
	},
	watch: {
		stepperState(n, o) {
			//activity detailer was just opened
			if (n === 2 && o === 1) {
				this.showComponent = true;
			}
		}
	},
	computed: {
		actions() {
			//return this.$store.getters.actions;
			return [
				{
					id: 0,
					name: "Test Action 1",
					desc: "Test Action 1's Description!"
				},
				{
					id: 1,
					name: "Test Action 2",
					desc: "Test Action 2's Description!"
				}
			];
		},
		filteredActions() {
			return this.orderBy(
				this.actions.filter(actions => {
					if (!this.listSearchTerm) return this.actions;
					return (
						actions.name
							.toLowerCase()
							.includes(this.listSearchTerm.toLowerCase()) ||
						actions.description
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
		openCreateActionForm() {
			console.log("openCreateActionForm");
		}
	}
};
</script>
