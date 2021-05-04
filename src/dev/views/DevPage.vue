<template>
	<div id="dev-page">
		<div v-if="isLoggedIn">
			<div v-if="hasDevPageRoutePermission">
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
											mdi-hammer-screwdriver
										</v-icon>
										<div v-if="!smAndDown">
											Configuration
										</div>
									</v-tab>
									<v-tab-item>
										<v-card class="pa-3 content-card">
											<v-row class="pa-0 ma-0">
												<v-col class="pa-0 ma-0">
													<v-card-title>
														Configuration
													</v-card-title>
													<p></p>
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
				</v-container>
			</div>
			<div v-else-if="permissionsLoading">
				<LoadingCard />
			</div>
			<div v-else>
				<NoAccessPage />
			</div>
		</div>
		<div v-else-if="loginIsLoading">
			<LoadingCard />
		</div>
		<div v-else>
			<NotLoggedIn />
		</div>
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
import LoadingCard from "@/app/components/LoadingCard.vue";
import NotLoggedIn from "@/app/views/NotLoggedIn.vue";
import NoAccessPage from "@/app/views/NoAccessPage.vue";

export default {
	name: "DevPage",
	components: {
		LoadingCard,
		NotLoggedIn,
		NoAccessPage
	},
	data() {
		return {
			permissionsLoading: false,
			hasDevPageRoutePermission: false
		};
	},
	created() {
		//this.checkPermissions();
	},
	computed: {
		smAndDown() {
			return this.$vuetify.breakpoint.smAndDown;
		},
		isLoggedIn() {
			return this.$store.getters.isLoggedIn;
		},
		loginIsLoading() {
			return this.$store.getters.loginIsLoading;
		}
	},
	watch: {
		loginIsLoading(newVal, oldVal) {
			if (!newVal && oldVal) {
				console.log("check");
				this.checkPermissions();
			}
		}
	},
	methods: {
		async checkPermissions() {
			this.permissionsLoading = true;
			this.hasDevPageRoutePermission = await this.$store.dispatch({
				type: "hasPermission",
				action: "route",
				object: "developer_page"
			});
			console.log(this.hasDevPageRoutePermission);
			this.permissionsLoading = false;
		}
	}
};
</script>
