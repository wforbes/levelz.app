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
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>
<script>
import NotLoggedIn from "@/app/views/NotLoggedIn.vue";
import DatabaseEditor from "../components/DatabaseEditor.vue";
import UserEditor from "../components/UserEditor.vue";
export default {
	name: "AdminPage",
	components: {
		NotLoggedIn,
		DatabaseEditor,
		UserEditor
	},
	data() {
		return {
			selectedTab: 0,
			tabs: [
				{
					icon: "mdi-database-edit",
					title: "Database",
					component: "DatabaseEditor"
				},
				{
					icon: "mdi-account",
					title: "Users",
					component: "UserEditor"
				}
			]
		};
	},
	computed: {
		userLoginStatus() {
			return this.$store.getters.loginStatus;
		}
	},
	watch: {},
	methods: {}
};
</script>
