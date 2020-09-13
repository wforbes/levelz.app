<template>
	<div>
		<v-container>
			<v-row>
				<v-col>
					<h1>Administration</h1>
				</v-col>
			</v-row>
			<v-row>
				<v-col>
					<div v-if="userLoginStatus === 'loggedOut'">
						<NotLoggedIn />
					</div>
					<div v-if="userLoginStatus === 'loggedIn'">
						<v-card class="pa-2" min-height="420">
							<v-container>
								<v-row>
									<v-col cols="12" sm="6">
										<v-tabs vertical>
											<v-tab>
												<v-icon left>mdi-database-edit</v-icon>
												Database
											</v-tab>
											<v-tab>
												<v-icon left>mdi-account</v-icon>
												Users
											</v-tab>
											<v-tab-item>
												<v-card flat>
													<v-card-text>
														<p>
															Database...
														</p>
														<div>
															<v-btn @click="getDataTables">
																getDataTables()
															</v-btn>
														</div>
														<br />
														<p
															v-for="(table, index) in datatables"
															:key="index"
														>
															{{ table[0] }}
														</p>
													</v-card-text>
												</v-card>
											</v-tab-item>
											<v-tab-item>
												<v-card flat>
													<v-card-text>
														<p>
															User...
														</p>
													</v-card-text>
												</v-card>
											</v-tab-item>
										</v-tabs>
									</v-col>
								</v-row>
							</v-container>
						</v-card>
					</div>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>
<script>
import axios from "axios";
import NotLoggedIn from "@/app/views/NotLoggedIn.vue";
export default {
	name: "AdminPage",
	components: {
		NotLoggedIn
	},
	data() {
		return {
			datatables: []
		};
	},
	computed: {
		userLoginStatus() {
			return this.$store.getters.loginStatus;
		}
	},
	methods: {
		getDataTables() {
			const d = {
				n: ["data", "database"],
				v: "getDatabaseTables"
			};
			axios
				.post(this.$store.getters.host + "api/", { data: d })
				.catch(error => {
					console.error(error);
				})
				.then(response => {
					console.log(response.data);
					this.datatables = response.data;
				});
		}
	}
};
</script>
