<template>
	<div>
		<v-container>
			<v-row>
				<v-col>
					<h1>User Dashboard</h1>
				</v-col>
			</v-row>
			<v-row>
				<v-col>
					<div v-if="!userLoggedIn">
						<NotLoggedIn />
					</div>
					<div v-else>
						<p>Lol Hey!</p>
					</div>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>
<script>
import NotLoggedIn from "../../app/views/NotLoggedIn.vue";
export default {
	name: "UserDashboard",
	components: {
		NotLoggedIn
	},
	data() {
		return {};
	},
	created() {},
	computed: {
		userLoggedIn() {
			return this.$store.getters.userId !== "";
		}
	},
	methods: {}
};
</script>
