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
					<v-data-table
						:headers="headers"
						:items="dataItems"
						:items-per-page="10"
						class="elevation-1"
					>
					</v-data-table>
				</v-card>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
import axios from "axios";
import { util } from "@/mixins/util.js";
export default {
	name: "TableDialog",
	props: ["dialogOpen", "activeTable"],
	mixins: [util],
	data() {
		return {
			headers: [],
			dataItems: []
		};
	},
	watch: {
		dialogOpen(newVal, oldVal) {
			if (newVal && !oldVal) {
				this.getAllTableData(this.activeTable);
			}
		}
	},
	methods: {
		closeDialog() {
			this.headers = [];
			this.$emit("closeTableDialog");
		},
		getAllTableData(tableName) {
			const d = {
				n: ["data", "database"],
				v: "getAllTableData",
				tableName: tableName
			};
			axios
				.post(this.$store.getters.host + "api/", { data: d })
				.catch(error => {
					console.error(error);
				})
				.then(response => {
					console.log(response.data);
					for (let prop in response.data[0]) {
						if (Object.prototype.hasOwnProperty.call(response.data[0], prop)) {
							let itemHeader = {
								text: this.ucFirst(prop),
								align: 'start',
								sortable: true,
								value: prop
							};
							this.headers.push(itemHeader);
						}
					}
					this.dataItems = response.data;
				});
		}
	}
};
</script>
