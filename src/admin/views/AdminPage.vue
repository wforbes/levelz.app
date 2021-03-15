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
					<div v-if="$store.getters.isLoggedIn">
						<v-card class="pa-2" min-height="420">
							<v-container>
								<v-row>
									<v-col>
										<v-tabs v-model="selectedTab" vertical>
											<v-tab v-for="tab in tabs" :key="tab.title">
												<v-icon left>{{ tab.icon }}</v-icon>
												{{ tab.title }}
											</v-tab>
											<v-tab-item v-for="tab in tabs" :key="tab.title">
												<component
													:is="tab.component"
													:parentsActiveItem="tabs[selectedTab].component"
												/>
											</v-tab-item>
										</v-tabs>
									</v-col>
								</v-row>
							</v-container>
						</v-card>
					</div>
					<div v-else>
						<NotLoggedIn />
					</div>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>
<script>
import NotLoggedIn from "@/app/views/NotLoggedIn.vue";
import DatabaseList from "../components/DatabaseList.vue";
import PermissionList from "../components/PermissionList.vue";
export default {
	name: "AdminPage",
	components: {
		NotLoggedIn,
		DatabaseList,
		PermissionList
	},
	data() {
		return {
			selectedTab: 0,
			tabs: [
				{
					icon: "mdi-database-edit",
					title: "Database",
					component: "DatabaseList"
				},
				{
					icon: "mdi-account",
					title: "Permissions",
					component: "PermissionList"
				}
			]
		};
	},
	computed: {
		loginStatus() {
			return this.$store.getters.loginStatus;
		}
	},
	watch: {},
	methods: {}
};
</script>
