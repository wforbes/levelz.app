<template>
	<div>
		<v-dialog
			v-model="dialogOpen"
			ref="deleteActionDialog"
			persistent
			max-width="800"
		>
			<v-card class="elevation-12">
				<v-toolbar dark dense flat>
					<v-toolbar-title>
						Confirm Delete: Action
					</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-btn @click="closeDialog(false)" icon>
						<v-icon>mdi-close</v-icon>
					</v-btn>
				</v-toolbar>
				<v-card class="pa-3">
					<v-row>
						<v-col>
							<h2>Are you sure?</h2>
							<p>
								Deleting the <strong>"{{ actionName }}"</strong> Action means it
								will be permanently removed along with any associated
								information connected to it!
							</p>
							<v-checkbox
								v-model="confirmCheck"
								label="Yes, I'm totally ok with that."
							></v-checkbox>
						</v-col>
					</v-row>
					<v-row>
						<v-col>
							<v-btn
								color="error"
								:disabled="!confirmCheck"
								@click="closeDialog(true)"
								>Delete</v-btn
							>
						</v-col>
						<v-col>
							<v-btn @click="closeDialog(false)">No, nevermind!</v-btn>
						</v-col>
					</v-row>
				</v-card>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
export default {
	name: "DeleteActionDialog",
	props: ["action", "dialogOpen"],
	data() {
		return {
			confirmCheck: false
		};
	},
	computed: {
		actionName() {
			return this.action.name;
		}
	},
	methods: {
		closeDialog(confirm) {
			this.confirmCheck = false;
			this.$emit("closeDialog", confirm);
		}
	}
};
</script>
