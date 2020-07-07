<template>
	<v-dialog v-model="dialogOpen">
		<v-card class="elevation-12">
			<v-toolbar dark dense flat>
				<v-toolbar-title>{{ toolbarTitle }}</v-toolbar-title>
				<v-spacer></v-spacer>
				<v-btn @click="closeDialog" icon>
					<v-icon>mdi-close</v-icon>
				</v-btn>
			</v-toolbar>
			<v-card height="400"></v-card>
		</v-card>
	</v-dialog>
</template>

<script>
export default {
	name: "EditActivityDialog",
	props: ["dialogOpen", "editActivity"],
	data() {
		return {
			toolbarTitle: "Edit Activity"
		};
	},
	methods: {
		closeDialog() {
			this.$emit("closeDialog");
		}
	}
};
</script>
