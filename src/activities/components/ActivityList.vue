<template>
	<div>
		<v-card>
			<v-container class="pb-0">
				<v-row>
					<v-col class="pt-0 pl-1 pr-1 pb-0">
						<v-container class="pa-0">
							<v-row>
								<v-col class="pt-0 pb-0">
									<v-text-field
										v-model="listSearchTerm"
										outlined
										placeholder="Search"
										prepend-inner-icon="mdi-text-search"
									></v-text-field>
								</v-col>
								<v-col cols="4" class="pt-0 pb-0">
									<v-btn fab dark color="success">
										<v-icon dark>mdi-plus</v-icon>
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
	name: "ActivityList",
	data() {
		return {
			listSearchTerm: ""
		};
	}
};
</script>
