<template>
	<div id="action-detailer">
		<v-card>
			<v-container class="pa-0 pt-4 pb-4">
				<v-row class="ma-0 pa-0">
					<v-col class="pt-0 pb-0">
						<v-container class="pa-0">
							<v-row class="pa-0">
								<v-col>
									<h2>{{ detailAction.name }}</h2>
								</v-col>
							</v-row>
							<v-row class="pa-0" v-if="detailAction.description !== ''">
								<v-col>
									{{ detailAction.description }}
								</v-col>
							</v-row>
							<v-row>
								<v-col>
									<v-btn @click="completeAction()" color="success">
										Complete Action
									</v-btn>
								</v-col>
							</v-row>
							<v-row>
								<v-col>
									<div v-if="detailActionCompletions.length > 0">
										<h4>History</h4>
										<v-list
											max-height="370"
											class="pl-2 pr-2"
											style="overflow-y:scroll; border: 0.1em solid grey; border-radius: 0.25em;"
										>
											<v-list-item
												v-for="completion of detailActionCompletions"
												:key="completion.id"
												style="border-radius:4px; height:5em;cursor:pointer;"
												class="elevation-5 mb-2"
											>
												{{ formatDate(completion.created_ts) }}
											</v-list-item>
										</v-list>
									</div>
									<div v-else>
										<h4>You haven't completed this Action yet</h4>
									</div>
								</v-col>
							</v-row>
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
	name: "ActionDetailer",
	mixins: [util],
	data() {
		return {};
	},
	computed: {
		detailAction() {
			return this.$store.getters.detailAction;
		},
		detailActionCompletions() {
			return this.$store.getters.detailActionCompletionList;
		}
	},
	methods: {
		async completeAction() {
			await this.$store.dispatch({
				type: "completeActionById",
				actionData: {
					actionId: this.detailAction.id
				}
			});
		}
	}
};
</script>
