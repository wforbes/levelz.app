<template>
	<v-app>
		<AppBar />
		<v-main>
			<router-view></router-view>
		</v-main>
		<Footer />
	</v-app>
</template>

<script>
import AppBar from "../components/AppBar.vue";
import Footer from "../components/Footer.vue";
export default {
	name: 'App',
	components: {
		AppBar, Footer
	},
	data(){
		return {

		};
	},
};
</script>
