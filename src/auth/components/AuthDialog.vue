<template>
	<div>
		<v-dialog v-model="dialogOpen" persistent max-width="800">
			<v-toolbar dark dense flat>
				<v-toolbar-title>{{ toolbarTitle }}</v-toolbar-title>
				<v-spacer></v-spacer>
				<v-btn @click="closeDialog" icon>
					<v-icon>mdi-close</v-icon>
				</v-btn>
			</v-toolbar>
			<v-card class="elevation-12">
				<v-tabs
					v-model="tabsKey"
					background-color="primary"
					dark
					fixed-tabs
					icons-and-text
				>
					<v-tab :key="0">
						Signup
						<v-icon>mdi-account-plus</v-icon>
					</v-tab>
					<v-tab-item :key="0">
						<SignupForm />
					</v-tab-item>
					<v-tab :key="1">
						Log In
						<v-icon>mdi-login</v-icon>
					</v-tab>
					<v-tab-item :key="1">
						<LoginForm @closeDialog="closeDialog" />
					</v-tab-item>
				</v-tabs>
			</v-card>
		</v-dialog>
	</div>
</template>
<script>
import SignupForm from "./SignupForm.vue";
import LoginForm from "./LoginForm.vue";
export default {
	name: "AuthDialog",
	props: ["dialogOpen"],
	components: {
		SignupForm,
		LoginForm
	},
	data() {
		return {
			host: "",
			tabsKey: 0,
			moreInfoOpen: false,
			x: ""
		};
	},
	created() {},
	computed: {
		toolbarTitle() {
			return this.tabsKey ? "Log In To Lvlz" : "Create Your Lvlz Account";
		}
	},
	methods: {
		closeDialog() {
			this.$emit("closeDialog");
		}
	}
};
</script>
