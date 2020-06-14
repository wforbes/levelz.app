<template>
	<div>
		<v-app-bar
			app
			dark
		>
			<v-img src="../../assets/logo-icon.png" max-width="42" />
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