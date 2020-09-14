<template>
	<div>
		<h3 style="text-align:center;">Permissions</h3>
		<v-card style="width:60%; margin: 0 auto;">
			<v-card-text>
				<div>
					<v-btn @click="openPermissionDialog()">
						<v-icon>mdi-plus</v-icon>
					</v-btn>
				</div>
				<v-list>
					<v-list-item-group v-model="selectedItem" color="primary">
						<v-list-item
							v-for="(permission, index) in permissions"
							:key="index"
							@click="openPermissionDialog(permission.name)"
						>
							<v-list-item-content>
								<v-list-item-title>
									{{ permission.name }}
								</v-list-item-title>
							</v-list-item-content>
						</v-list-item>
					</v-list-item-group>
				</v-list>
			</v-card-text>
		</v-card>
		<PermissionDialog
			:dialogOpen="permissionDialogOpen"
			:permissionToEdit="permissionToEdit"
			@closePermissionDialog="closePermissionDialog"
		/>
	</div>
</template>
<script>
import axios from "axios";
import { util } from "@/mixins/util.js";
import PermissionDialog from "./PermissionDialog.vue";
export default {
	name: "PermissionList",
	components: {
		PermissionDialog
	},
	mixins: [util],
	data() {
		return {
			permissionDialogOpen: false,
			permissions: [],
			selectedItem: undefined,
			permissionToEdit: {},
			emptyPermission: {
				id: "",
				ordinal: 0,
				name: "",
				description: ""
			},
			activeItemName: ""
		};
	},
	created() {
		if (this.parentsActiveItem === this.$options.name) {
			this.getPermissions();
		}
	},
	methods: {
		openPermissionDialog(permission = this.cloneDeep(this.emptyPermission)) {
			this.permissionToEdit = permission;
			this.permissionDialogOpen = true;
		},
		closePermissionDialog() {
			this.permissionDialogOpen = false;
			this.selectedItem = undefined;
			this.activeItemName = "";
		},
		getDataTables() {
			const d = {
				n: "permission",
				v: "getAllPermissions"
			};
			axios
				.post(this.$store.getters.host + "api/", { data: d })
				.catch(error => {
					console.error(error);
				})
				.then(response => {
					console.log(response.data);
					this.permissions = response.data;
				});
		}
	}
};
</script>
