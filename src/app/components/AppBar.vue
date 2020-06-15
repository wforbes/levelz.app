<template>
	<div>
		<v-app-bar
			app
			dark
		>
			<router-link to="/">
				<v-img src="../../assets/logo-icon.png" width="42" />
			</router-link>
			<v-spacer></v-spacer>
			<v-btn icon class="mr-3">
				<v-icon>mdi-key</v-icon>
			</v-btn>
		</v-app-bar>
	</div>
</template>

<script>
export default {
	name: "AppBar",
	data() {
		return {};
	},
}
</script>