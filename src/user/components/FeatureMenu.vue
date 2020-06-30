<template>
	<v-container class="ma-0 pa-0">
		<v-row class="ma-0 pa-0">
			<v-col
				class="pa-1"
				cols="4"
				v-for="(item, i) in featureMenuItems"
				:key="i"
			>
				<v-card
					ripple
					rounded="xl"
					width="100%"
					class="pa-0 ma-0 elevation-5"
					color="primary"
					@click="navigateToPath(item.pathName)"
				>
					<div
						style="padding-top:0.5em; padding-bottom:0.5em; border-radius:1em;"
					>
						<v-container class="ma-0 pa-0">
							<v-row class="ma-0 pa-0">
								<v-col cols="12" class="ma-0 pa-0" align="center">
									<v-icon size="72" color="white">
										{{ item.icon }}
									</v-icon>
								</v-col>
								<v-col cols="12" class="ma-0 pa-0" align="center">
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
					text: "Activities",
					pathName: "activities"
				},
				{
					icon: "mdi-clipboard-list-outline",
					text: "Tasks",
					pathName: "tasks"
				},
				{
					icon: "mdi-script-outline",
					text: "Quests",
					pathName: "quests"
				},
				{
					icon: "mdi-compass-rose",
					text: "Travel",
					pathName: "travel"
				},
				{
					icon: "mdi-bag-personal-outline",
					text: "Inventory",
					pathName: "inventory"
				},
				{
					icon: "mdi-cash-multiple",
					text: "Financials",
					pathName: "financials"
				}
			]
		};
	},
	methods: {
		navigateToPath(pathName) {
			if (
				this.$router.resolve({ path: pathName }).resolved.matched.length > 0
			) {
				this.$router.push(pathName);
			}
		}
	}
};
</script>
