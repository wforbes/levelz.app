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
		</v-container>
	</div>
</template>
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
					console.log(error);
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
