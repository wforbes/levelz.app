<template>
	<div>
		<v-dialog
			v-model="dialogOpen"
			ref="permissionDialog"
			persistent
			max-width="800"
		>
			<v-card class="elevation-12">
				<v-toolbar dark dense flat>
					<v-toolbar-title v-if="editPermission.id === ''">{{
						"Add New Permission"
					}}</v-toolbar-title>
					<v-toolbar-title v-else>{{ "Edit Permission" }}</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-btn @click="closeDialog" icon>
						<v-icon>mdi-close</v-icon>
					</v-btn>
				</v-toolbar>
				<v-card min-height="500">
					<v-form class="pa-4" ref="permissionForm">
						<v-layout row>
							<v-col cols="2">
								<v-text-field
									v-model="editPermission.ordinal"
									label="Ordinal"
									:rules="[rules.mustBeNumber, rules.ordinalMaxLength]"
								></v-text-field>
							</v-col>
							<v-col cols="10">
								<v-text-field
									v-model="editPermission.name"
									label="Permission Name"
									:rules="[
										rules.required,
										rules.nameMinLength,
										rules.nameMaxLength
									]"
								></v-text-field>
							</v-col>
						</v-layout>
						<v-layout row>
							<v-col>
								<v-textarea
									v-model="editPermission.description"
									label="Permission Description"
									:rules="[rules.descriptionMaxLength]"
									height="85"
								></v-textarea>
							</v-col>
						</v-layout>
						<v-layout row>
							<v-col style="text-align:right;">
								<v-btn color="success" @click="savePermission">Save</v-btn>
							</v-col>
							<v-col>
								<v-btn @click="closeDialog">Close</v-btn>
							</v-col>
						</v-layout>
					</v-form>
				</v-card>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
import { util } from "@/mixins/util.js";
import axios from "axios";
export default {
	name: "PermissionDialog",
	props: ["dialogOpen", "permissionToEdit"],
	mixins: [util],
	data() {
		return {
			editPermission: {},
			rules: {
				required: v => (v && !!v) || "This can't be blank.",
				mustBeNumber: v => (v && !isNaN(v)) || "This must be a number.",
				ordinalMaxLength: v =>
					(v && v.length <= 2) || "This must be 2 digits or smaller",
				nameMinLength: v =>
					(v && v.length > 2) || "This must be longer than 2 characters",
				nameMaxLength: v =>
					(v && v.length < 64) || "This must be shorter than 64 characters",
				descriptionMaxLength: v =>
					(v && v.length < 250) || "This must be shorter than 250 characters."
			}
		};
	},
	watch: {
		dialogOpen(newVal, oldVal) {
			if (newVal && !oldVal) {
				if (this.$refs.permissionForm !== undefined) {
					this.$refs.permissionForm.reset();
				}
				this.editPermission = this.cloneDeep(this.permissionToEdit);
			}
		}
	},
	methods: {
		savePermission() {
			let d = {
				n: ["admin", "permission"],
				ordinal: this.editPermission.ordinal,
				name: this.editPermission.name,
				description: this.editPermission.description
			};
			console.log(this.editPermission.id);
			if (
				this.editPermission.id === "" ||
				this.editPermission.id === undefined
			) {
				d.v = "createNewPermission";
			} else {
				d.id = this.editPermission.id;
				d.v = "updatePermission";
			}

			axios
				.post(this.$store.getters.host + "api/", { data: d })
				.catch(error => {
					console.error(error);
				})
				.then(response => {
					console.log(response.data);
					this.closeDialog();
				});
		},
		closeDialog() {
			this.editPermission = {};
			this.$refs.permissionForm.resetValidation();
			this.$emit("closePermissionDialog");
		}
	}
};
</script>
