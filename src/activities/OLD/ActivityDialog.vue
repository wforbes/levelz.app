<template>
	<div>
		<v-dialog
			v-model="dialogOpen"
			transition="slide-x-transition"
			fullscreen
			hide-overlay
		>
			<v-card>
				<v-toolbar dark dense flat elevation="5" height="64px">
					<v-btn @click="closeDialog" icon>
						<v-icon>mdi-arrow-left</v-icon>
					</v-btn>
					<v-toolbar-title>{{ toolbarTitle }}</v-toolbar-title>
					<v-spacer></v-spacer>
				</v-toolbar>
				<v-stepper v-model="stepView" style="min-height:calc(100vh - 64px);">
					<v-stepper-items>
						<v-stepper-content step="0">
							<v-container>
								<v-row>
									<v-col cols="12">
										
									</v-col>
								</v-row>
							</v-container>
						</v-stepper-content>
						<v-stepper-content step="1">
							<v-container class="">
								<v-row>
									<v-col cols="12" sm="6"></v-col>
								</v-row>
							</v-container>
						</v-stepper-content>
					</v-stepper-items>
				</v-stepper>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
export default {
	name: "ActivityDialog",
	props: ["dialogOpen", "focusActivity"],
	data() {
		return {
			stepView: 0,
			activity: {
				id: "",
				name: "",
				description: "",
				actions: []
			},
			emptyActivity: {
				id: "",
				name: "",
				description: "",
				actions: []
			},
			rules: {
				required: value => !!value || "This can't be blank."
				//TODO: check description upper bound length
			}
		};
	},
	watch: {
		dialogOpen(newVal, oldVal) {
			if (newVal && !oldVal) {
				this.activity = Object.assign(this.focusActivity, {});
			}
		}
	},
	computed: {
		toolbarTitle() {
			return "'" + this.activity.name + "' Activity";
		}
	},
	methods: {
		closeDialog() {
			this.activity = Object.assign({}, this.emptyActivity);
			this.$emit("closeDialog");
		},
		openEditActivity() {}
	}
};
</script>
