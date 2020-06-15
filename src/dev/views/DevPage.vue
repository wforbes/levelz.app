<template>
	<v-main>
		<v-container>
			<v-row>
				<v-col>
					<h1>Dev Page</h1>
				</v-col>
			</v-row>
			<v-row>
				<v-col>
					<v-btn large @click='testGet'>Test: Get Http Request</v-btn>
					
				</v-col>
				<v-col>
					<p>
						GET HTTP Test Response: 
						<strong>{{ testGetResponse }}</strong>
					</p>
					<v-btn v-show="testGetResponse !== ''" @click="clearTestGetResponse">Clear</v-btn>
				</v-col>
			</v-row>
		</v-container>
	</v-main>
</template>
<script>
import axios from 'axios';

export default {
	name:"DevPage",
	data(){
		return {
			testGetResponse: ""
		};
	},
	methods: {
		testGet() {
			axios.get('http://localhost/levelz.app/api/')
				.then((response) => {
					//this.apiTest.getTestString = response.data;
					this.testGetResponse = response.data;
				})
				.catch((error) => {
					console.log(error);
				});
		},
		clearTestGetResponse() {
			this.testGetResponse = "";
		}
	},
	created() {}
}
</script>