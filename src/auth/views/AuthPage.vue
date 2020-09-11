<template>
	<div>
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
				<LoginForm />
			</v-tab-item>
		</v-tabs>
	</div>
</template>
<script>
import SignupForm from "../components/SignupForm.vue";
import LoginForm from "../components/LoginForm.vue";
export default {
	name: "AuthPage",
	components: {
		SignupForm,
		LoginForm
	},
	data() {
		return {
			tabsKey: 0
		};
	}
};
</script>
