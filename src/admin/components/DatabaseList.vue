<template>
	<div>
		<h3 style="text-align:center;">Database</h3>
		<v-card style="width:60%; margin: 0 auto;">
			<v-card-text>
				<v-list>
					<v-subheader>Data Tables</v-subheader>
					<div v-if="loading">
						<v-icon>fas fa-spinner fa-spin</v-icon>
					</div>
					<v-list-item-group v-model="selectedItem" color="primary" v-else>
						<v-list-item
							v-for="(table, index) in datatables"
							:key="index"
							@click="openTableDialog(table[0])"
						>
							<v-list-item-content>
								<v-list-item-title>
									{{ table[0] }}
								</v-list-item-title>
							</v-list-item-content>
						</v-list-item>
					</v-list-item-group>
				</v-list>
			</v-card-text>
		</v-card>
		<TableDialog
			:dialogOpen="tableDialogOpen"
			:activeTable="activeTable"
			@closeTableDialog="closeTableDialog"
		/>
	</div>
</template>
<script>
import axios from "axios";
import TableDialog from "../components/TableDialog.vue";
export default {
	name: "DatabaseList",
	components: {
		TableDialog
	},
	props: ["parentsActiveItem"],
	data() {
		return {
			loading: false,
			tableDialogOpen: false,
			datatables: [],
			selectedItem: undefined,
			activeTable: ""
		};
	},
	created() {
		if (this.parentsActiveItem === this.$options.name) {
			this.getDataTables();
		}
	},
	watch: {
		parentsActiveItem(newVal, oldVal) {
			console.log(newVal);
			if (newVal === this.$options.name && oldVal !== this.$options.name) {
				this.getDataTables();
			}
		}
	},
	methods: {
		getDataTables() {
			const d = {
				n: ["data", "database"],
				v: "getDatabaseTables"
			};
			this.loading = true;
			axios
				.post(this.$store.getters.host + "api/", { data: d })
				.catch(error => {
					console.error(error);
				})
				.then(response => {
					console.log(response.data);
					this.datatables = response.data;
					this.loading = false;
				});
		},
		openTableDialog(tableName) {
			this.activeTable = tableName;
			this.tableDialogOpen = true;
		},
		closeTableDialog() {
			this.activeTable = "";
			this.selectedItem = undefined;
			this.tableDialogOpen = false;
		}
	}
};
</script>
