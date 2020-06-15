<template>
	<div>
		<v-app-bar
			app
			dark
		>
			<v-hover
				v-slot:default="{ hover }"
			>
				<v-card :elevation="hover ? 12 : 2">
					<router-link to="/">
						<v-img src="../../assets/logo-icon.png" max-width="42" />
					</router-link>
				</v-card>
			</v-hover>
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