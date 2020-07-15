<template>
	<v-container>
		<v-row>
			<v-col offset-sm="2" offset="1">
				<br />
				<v-btn large to="/">&lt; Return to the Home page</v-btn>
				<br />
			</v-col>
		</v-row>
		<v-row>
			<v-col align="center">
				<h1>Error 404: Page Not Found</h1>
			</v-col>
		</v-row>
		<v-row>
			<v-col offset-sm="4" sm="4" offset="2" cols="8">
				<!--<img src="../../assets/platypus_404error.jpg" />-->
				<Error404Graphic />
			</v-col>
		</v-row>
		<v-row>
			<v-col align="center">
				<h1>Uh oh, you've confused our platypus...</h1>
			</v-col>
		</v-row>
	</v-container>
</template>

<script>
import Error404Graphic from "../components/Error404Graphic.vue";
export default {
	name: "Error404",
	components: {
		Error404Graphic
	},
	data() {
		return {};
	}
};
</script>
