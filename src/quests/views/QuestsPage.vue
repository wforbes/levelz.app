<template>
	<div>
		<v-container>
			<v-row>
				<v-col cols="8">
					<h1>Quests</h1>
				</v-col>
				<v-col v-if="isLoggedIn" cols="4" align="right">
					<div class="pr-5">
						<v-btn @click="logout">Logout</v-btn>
					</div>
				</v-col>
			</v-row>
			<v-row>
				<v-col>
					<div v-if="isLoggedIn">
						<v-container>
							<v-row>
								<v-col cols="12" sm="6">
									<v-btn>New Quest</v-btn>
								</v-col>
							</v-row>
						</v-container>
						<!--<v-card class="pa-2" min-height="420"></v-card>-->
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
import NotLoggedIn from "../../app/views/NotLoggedIn.vue";
export default {
	name: "QuestsPage",
	components: {
		NotLoggedIn
	},
	data() {
		return {};
	},
	computed: {
		isLoggedIn() {
			return this.$store.getters.isLoggedIn;
		}
	},
	methods: {
		logout() {
			this.$store.dispatch("logoutUser");
		}
	}
};
</script>
