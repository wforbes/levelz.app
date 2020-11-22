<template>
	<v-form ref="configureTypeForm">
		<v-container>
			<v-row>
				<v-col>
					<v-form ref="configureTypeForm">
						<v-container>
							<v-row>
								<v-col>
									Test
								</v-col>
							</v-row>
						</v-container>
					</v-form>
				</v-col>
			</v-row>
		</v-container>
	</v-form>
</template>
<script>
export default {
	name: "ConfigureActionTypeForm",
	props: ["dialogOpen"],
	data() {
		return {};
	},
	watch: {
		dialogClose(n, o) {
			if (o && !n) {
				this.$refs.configureTypeForm.reset();
			}
		}
	}
};
</script>
