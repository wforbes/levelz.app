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
						class="pa-0 mx-auto"
					>
						<router-view></router-view>
					</v-col>
				</v-row>
			</v-container>
		</v-main>
		<Footer />
	</v-app>
</template>

<script>
import axios from "axios";

import AppBar from "../components/AppBar.vue";
import Footer from "../components/Footer.vue";
export default {
	name: "App",
	components: {
		AppBar,
		Footer
	},
	data() {
		return {
			localhost: "localhost:8080"
		};
	},
	async created() {
		axios.defaults.withCredentials = true;
		this.setupStore();
		this.$store.dispatch("initSession");
	},
	methods: {
		setupStore() {
			this.$store.dispatch({
				type: "setVue",
				vue: this
			});
			this.$store.dispatch("setDataAccess");
			this.$store.dispatch({
				type: "setHost",
				host:
					window.location.host === this.localhost
						? "http://localhost/levelz.app/"
						: ""
			});
		}
	}
};
</script>
