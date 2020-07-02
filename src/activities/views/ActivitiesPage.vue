<template>
	<div>
		<v-container>
			<v-row>
				<v-col cols="8">
					<h1>Activites</h1>
				</v-col>
				<v-col v-if="userLoginStatus === 'loggedIn'" cols="4" align="right">
					<div class="pr-5">
						<v-btn @click="logout">Logout</v-btn>
					</div>
				</v-col>
			</v-row>
			<v-row>
				<v-col>
					<div v-if="userLoginStatus === 'loggedOut'">
						<NotLoggedIn />
					</div>
					<div v-if="userLoginStatus === 'loggedIn'">
						<v-container>
							<v-row>
								<v-col cols="12" sm="6">
									<v-btn @click="openNewActivityDialog">
										Create New Activity
									</v-btn>
								</v-col>
							</v-row>
							<v-row>
								<v-col>
									<p>
										You can use <strong>Activities</strong> to keep track of the
										stuff you do.
									</p>
									<p>
										When you complete
										<strong>Activities</strong> you'll be awarded bonuses like
										<strong>Experience Points</strong> to help you
										<strong>Level Up</strong>!
									</p>
									<p>
										If your <strong>Activities</strong> are a part of a larger
										goal, you can add them to <strong>Tasks</strong> so that
										they count toward your bigger goals and add them into your
										routine.
									</p>
								</v-col>
							</v-row>
						</v-container>
						<!--<v-card class="pa-2" min-height="420"></v-card>-->
					</div>
				</v-col>
			</v-row>
		</v-container>
		<NewActivityDialog
			:newActivityDialogOpen="newActivityDialogOpen"
			@closeNewActivityDialog="closeNewActivityDialog"
		/>
	</div>
</template>

<script>
import NotLoggedIn from "../../app/views/NotLoggedIn.vue";
import NewActivityDialog from "../components/NewActivityDialog.vue";
export default {
	name: "ActivitesPage",
	components: {
		NotLoggedIn,
		NewActivityDialog
	},
	data() {
		return {
			newActivityDialogOpen: false
		};
	},
	computed: {
		userLoginStatus() {
			return this.$store.getters.loginStatus;
		}
	},
	methods: {
		openNewActivityDialog() {
			this.newActivityDialogOpen = true;
		},
		closeNewActivityDialog() {
			this.newActivityDialogOpen = false;
		},
		//TODO: add this to MIXIN
		logout() {
			this.$store.dispatch("logoutUser");
		}
	}
};
</script>
