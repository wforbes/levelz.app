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
						</v-container>
					</v-col>
				</v-row>
			</v-container>
		</v-card>
	</div>
</template>
<script>
export default {
	name: "ActionDetailer",
	data() {
		return {};
	},
	computed: {
		detailAction() {
			return this.$store.getters.detailAction;
		}
	},
	methods: {
		async completeAction() {
			await this.$store.dispatch({
				type: "completeActionById",
				actionId: this.detailAction.id
			});
		}
	}
};
</script>
