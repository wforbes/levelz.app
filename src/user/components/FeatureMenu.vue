<template>
	<v-container class="ma-0 pa-0">
		<v-row class="ma-0 pa-0">
			<v-col class="pa-1" cols="4" v-for="(item, i) in featureMenuItems" :key="i">
				<v-card
					ripple
					rounded="xl"
					width="100%"
					class="pa-0 ma-0 elevation-5"
					align="center"
					color="primary"
				>
					<div
						style="padding-top:0.5em; padding-bottom:0.5em; border-radius:1em;"
					>
						<v-container class="ma-0 pa-0">
							<v-row class="ma-0 pa-0">
								<v-col cols="12" class="ma-0 pa-0">
									<v-icon size="72" color="white">
										{{ item.icon }}
									</v-icon>
								</v-col>
								<v-col cols="12" class="ma-0 pa-0">
									<span style="color:white" class="text-subtitle-1">
										{{ item.text }}
									</span>
								</v-col>
							</v-row>
						</v-container>
					</div>
				</v-card>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
export default {
	name: "FeatureMenu",
	data() {
		return {
			featureMenuItems: [
				{
					icon: "mdi-weight-lifter",
					text: "Activities"
				},
				{
					icon: "mdi-clipboard-list-outline",
					text: "Tasks"
				},
				{
					icon: "mdi-script-outline",
					text: "Quests"
				},
				{
					icon: "mdi-compass-rose",
					text: "Travel"
				},
				{
					icon: "mdi-bag-personal-outline",
					text: "Inventory"
				},
				{
					icon: "mdi-cash-multiple",
					text: "Financials"
				}
			]
		};
	}
};
</script>
