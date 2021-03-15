<template>
	<div>
		<v-container>
			<v-row>
				<v-col>
					<h1>Dev Page</h1>
				</v-col>
			</v-row>
			<v-row>
				<v-col>
					<v-card class="fill-height-card">
						<v-tabs vertical>
							<v-tab>
								<v-icon left>
									mdi-key
								</v-icon>
								<div v-if="!smAndDown">
									Authentication
								</div>
							</v-tab>
							<v-tab-item>
								<v-card class="pa-3 content-card">
									<v-row class="pa-0 ma-0">
										<v-col class="pa-0 ma-0">
											<v-card-title>
												Authentication
											</v-card-title>
											<p>Login Status: {{ $store.getters.loginStatus }}</p>
										</v-col>
									</v-row>
									<v-row>
										<v-col></v-col>
									</v-row>
								</v-card>
							</v-tab-item>
						</v-tabs>
					</v-card>
				</v-col>
			</v-row>
			<!--
			<v-row>
				<v-col>
					<v-btn large @click="testGet">Test: Get Http Request</v-btn>
				</v-col>
				<v-col>
					<p>
						GET HTTP Test Response:
					</p>
					<strong>{{ testGetResponse }}</strong>
					<v-btn v-show="testGetResponse !== ''" @click="clearTestGetResponse"
						>Clear</v-btn
					>
				</v-col>
			</v-row>
			-->
		</v-container>
	</div>
</template>
<style>
.fill-height-card {
	height: 60vh;
}
.content-card,
.fill-height-card .v-tabs,
.fill-height-card .v-tabs .v-window__container,
.fill-height-card .v-tabs .v-window__container .v-window-item {
	height: 100% !important;
}
</style>
<script>
import axios from "axios";

export default {
	name: "DevPage",
	data() {
		return {
			host: "",
			testGetResponse: ""
		};
	},
	computed: {
		smAndDown() {
			console.log(this.$vuetify.breakpoint);
			return this.$vuetify.breakpoint.smAndDown;
		}
	},
	methods: {
		setEnvironment() {
			this.host =
				window.location.host === "localhost:8080"
					? "http://localhost/levelz.app/"
					: "";
		},
		testGet() {
			axios
				.get(this.host + "api/")
				.then(response => {
					this.testGetResponse = response.data;
				})
				.catch(error => {
					console.error(error);
				});
		},
		clearTestGetResponse() {
			this.testGetResponse = "";
		}
	},
	created() {
		this.setEnvironment();
	}
};
</script>
