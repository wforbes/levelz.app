<template>
	<div>
		<v-dialog v-model="dialogOpen" fullscreen hide-overlay>
			<v-card>
				<v-toolbar dark dense flat>
					<v-toolbar-title>{{ toolbarTitle }}</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-btn @click="closeDialog" icon>
						<v-icon>mdi-close</v-icon>
					</v-btn>
				</v-toolbar>
			</v-card>
		</v-dialog>
	</div>
</template>

<script>
export default {
	name: "CreateActivityDialog",
	props: ["dialogOpen"],
	data() {
		return {
			toolbarTitle: "Create Activity"
		};
	},
	methods: {
		closeDialog() {
			this.$emit("closeDialog");
		}
	}
};
</script>
