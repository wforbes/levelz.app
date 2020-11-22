<template>
	<div>
		<v-dialog
			v-model="dialogOpen"
			class="ma-5"
			transition="slide-x-transition"
			fullscreen
			hide-overlay
		>
			<v-card>
				<v-toolbar dark dense flat elevation="5" height="56px">
					<v-btn @click="closeDialog" icon>
						<v-icon>mdi-arrow-left</v-icon>
					</v-btn>
					<v-toolbar-title>{{ toolbarTitle }}</v-toolbar-title>
					<v-spacer></v-spacer>
				</v-toolbar>
				<v-container>
					<v-row>
						<v-col cols="12" md="6">
							<ConfigureActionTypeForm :type="type" />
						</v-col>
					</v-row>
				</v-container>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
import ConfigureActionTypeForm from "./ConfigureActionTypeForm.vue";
export default {
	name: "ConfigureActionTypeDialog",
	props: ["dialogOpen", "type"],
	components: {
		ConfigureActionTypeForm
	},
	data() {
		return {
			
		};
	},
	computed: {
		toolbarTitle() {
			return this.type.name + " Settings";
		}
	},
	methods: {
		closeDialog() {
			this.$refs.configureTypeForm.reset();
			this.$emit("closeDialog");
		}
	}
};
</script>
