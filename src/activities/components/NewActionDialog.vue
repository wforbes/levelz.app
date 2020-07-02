<template>
	<div>
		<v-dialog v-model="newActionDialogOpen" persistent>
			<v-card class="elevation-12">
				<v-toolbar dark dense flat>
					<v-toolbar-title>Create New Action</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-btn @click="closeNewActionDialog" icon>
						<v-icon>mdi-close</v-icon>
					</v-btn>
				</v-toolbar>
				<v-card class="pa-5">
					<!-- TODO: move these property descriptions into pop-up help dialogs -->
					<p>
						<strong>Action Name:</strong> How your action will be identified and
						displayed in other pages on Lvlz.
					</p>
					<v-combobox
						solo
						v-model="newAction.name"
						:items="savedActions"
						item-value="id"
						item-text="name"
						placeholder="Action Name"
						ref="actionNameComboBox"
					>
					</v-combobox>
					<p>
						<strong>Action Type:</strong> Gives options in how this action can
						be completed. Select an action type for more info.
					</p>
					<v-select
						solo
						v-model="newAction.type"
						:items="actionOptions.types"
						item-text="name"
						return-object
						label="Action Type"
					>
					</v-select>
					<div v-if="newAction.type !== {}">
						<p>{{ newAction.type.desc }}</p>
					</div>
					<div v-if="newAction.type.name === 'Gradable'">
						<h4>Select The Grade Type</h4>
						<v-list>
							<v-list-item-group
								v-model="newAction.type.gradeType"
								color="primary"
							>
								<v-list-item
									v-for="gradeType in actionOptions.gradeTypes"
									:key="gradeType.id"
									:value="gradeType"
									style="margin-bottom:0.5em"
									class="elevation-5"
								>
									{{ ucFirst(gradeType.name) }}
								</v-list-item>
							</v-list-item-group>
						</v-list>
						<div v-if="!isEmpty(newAction.type.gradeType)">
							<h5>
								Grade Qualities For '{{
									ucFirst(newAction.type.gradeType.name)
								}}':
							</h5>
							<p>
								<span
									v-for="(quality, index) in newAction.type.gradeType.qualities"
									:key="quality.id"
								>
									{{ ucFirst(quality.name) }} ({{ quality.scale }})<span
										v-if="
											newAction.type.gradeType.qualities.length > 1 &&
												index !== newAction.type.gradeType.qualities.length - 1
										"
										>,&nbsp;</span
									>
								</span>
							</p>
							<!--
							<v-list>
								<v-list-item
									v-for="quality in newAction.type.gradeType.qualities"
									:key="quality.id"
								>
									{{ quality.scale }} - {{ ucFirst(quality.name) }}
								</v-list-item>
							</v-list>
							-->
						</div>
					</div>
				</v-card>
				<v-container>
					<v-row>
						<v-col>
							<v-btn color="error" @click="closeNewActionDialog">
								Cancel
							</v-btn>
						</v-col>
						<v-col align="right">
							<v-btn color="success" @click="saveNewAction">
								Save
							</v-btn>
						</v-col>
					</v-row>
				</v-container>
			</v-card>
		</v-dialog>
	</div>
</template>
<style>
.v-dialog {
	margin-right: 0;
	margin-left: 0;
}
</style>
<script>
import U from "../../lib/util/U.js";
export default {
	name: "NewActionDialog",
	props: ["newActionDialogOpen"],
	data() {
		return {
			actionOptions: {
				types: [
					{
						id: 0,
						name: "Simple",
						desc:
							"Simple actions are simply marked as completed when done, " +
							" and there's no need to keep track of any other details about them."
					},
					{
						id: 1,
						name: "Gradable",
						desc:
							"Gradable actions can be given a quality grade " +
							"that describes how well they were done. Best for when " +
							"you'd like to perfect your abilities!",
						gradeType: {}
					},
					{
						id: 2,
						name: "Timed",
						desc:
							"Timed actions are for keeping track of how quickly " +
							" you can do something. Best for when you'd like to improve " +
							" your endurance or speed!"
					}
				],
				gradeTypes: [
					{
						id: 3,
						name: "basic",
						qualities: [
							{
								scale: 0,
								name: "fail"
							},
							{
								scale: 1,
								name: "poor"
							},
							{
								scale: 2,
								name: "average"
							},
							{
								scale: 3,
								name: "good"
							},
							{
								scale: 4,
								name: "excellent"
							},
							{
								scale: 5,
								name: "perfect"
							}
						]
					},
					{
						id: 4,
						name: "skateboarding",
						qualities: [
							{
								scale: 0,
								name: "slam"
							},
							{
								scale: 1,
								name: "fail"
							},
							{
								scale: 2,
								name: "sloppy"
							},
							{
								scale: 3,
								name: "average"
							},
							{
								scale: 4,
								name: "good"
							},
							{
								scale: 5,
								name: "clean"
							},
							{
								scale: 6,
								name: "perfect"
							}
						]
					}
				]
			},
			newAction: {
				name: "",
				type: {
					gradeType: {}
				}
			},
			savedActions: []
		};
	},
	methods: {
		saveNewAction() {
			this.$emit("saveNewAction", this.newAction);
		},
		closeNewActionDialog() {
			this.$emit("closeNewActionDialog");
		},
		//TODO: add this to MIXIN
		ucFirst(s) {
			return U.ucFirst(s);
		},
		isEmpty(v) {
			return U.isEmpty(v);
		}
	}
};
</script>
