<template>
	<v-app>
		<AppBar ref="appBar" />
		<v-main>
			<v-container>
				<v-row>
					<v-col
						offset-md="1"
						md="10"
						offset-lg="2"
						lg="8"
						offset-xl="3"
						xl="6"
						cols="12"
						class="pa-0 mx-auto mt-5"
					>
						<router-view></router-view>
					</v-col>
				</v-row>
			</v-container>
		</v-main>
		<Footer />
		<SnackBar />
	</v-app>
</template>

<script>
//import axios from "axios";

import AppBar from "../components/AppBar.vue";
import Footer from "../components/Footer.vue";
import SnackBar from "../components/SnackBar.vue";
export default {
	name: "App",
	components: {
		AppBar,
		Footer,
		SnackBar
	},
	data() {
		return {
			localhost: "localhost:8080"
		};
	},
	async created() {
		//axios.defaults.withCredentials = true;
		this.$store.dispatch({ type: "setupStore", vue: this });
		let resp = await this.$store.dispatch("initDB");
		console.log(resp);
	},
	methods: {}
};
</script>
