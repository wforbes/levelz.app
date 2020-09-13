<template>
	<div>
		<v-dialog v-model="dialogOpen" ref="tableDialog" persistent max-width="800">
			<v-card class="elevation-12">
				<v-toolbar dark dense flat>
					<v-toolbar-title>{{
						ucFirst(activeTable) + " Table"
					}}</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-btn @click="closeDialog" icon>
						<v-icon>mdi-close</v-icon>
					</v-btn>
				</v-toolbar>
				<v-card height="500">
					<p>Test</p>
				</v-card>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
import { util } from "@/mixins/util.js";
export default {
	name: "TableDialog",
	props: ["dialogOpen", "activeTable"],
	mixins: [util],
	data() {
		return {};
	},
	methods: {
		closeDialog() {
			this.$emit("closeTableDialog");
		}
	}
};
</script>
