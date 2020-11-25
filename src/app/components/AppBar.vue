<template>
	<div>
		<NavMenu :navMenuIsOpen="navMenuIsOpen" @closeNavMenu="closeNavMenu" />
		<v-app-bar app dark height="64px">
			<v-container>
				<v-row>
					<v-col
						offset-md="1"
						md="5"
						offset-lg="2"
						lg="4"
						offset-xl="3"
						xl="3"
						cols="6"
					>
						<div style="display:inline-block;">
							<v-app-bar-nav-icon
								@click.stop="navMenuIsOpen = !navMenuIsOpen"
							></v-app-bar-nav-icon>
						</div>
						<div
							style="display:inline-block; vertical-align:middle; margin-left:1em;"
						>
							<v-toolbar-title>
								<router-link to="/">
									<v-img src="../../assets/logo-icon.png" width="42" />
								</router-link>
							</v-toolbar-title>
						</div>
					</v-col>
					<v-col md="5" lg="4" xl="3" cols="6" align="right">
						<v-btn
							v-if="loginStatus === 'loggedIn'"
							icon
							class="mr-3"
							@click="openUserDialog"
						>
							<v-icon>mdi-account</v-icon>
						</v-btn>
						<v-btn v-else icon class="mr-3" @click="openAuthDialog">
							<v-icon>mdi-key</v-icon>
						</v-btn>
					</v-col>
				</v-row>
			</v-container>
		</v-app-bar>
		<AuthDialog
			ref="authDialog"
			:dialogOpen="authDialogOpen"
			@closeDialog="closeAuthDialog"
		/>
		<UserDialog :dialogOpen="userDialogOpen" @closeDialog="closeUserDialog" />
	</div>
</template>

<script>
import NavMenu from "./NavMenu.vue";
import AuthDialog from "../../auth/components/AuthDialog.vue";
import UserDialog from "../../user/components/UserDialog.vue";
export default {
	name: "AppBar",
	components: {
		NavMenu,
		AuthDialog,
		UserDialog
	},
	data() {
		return {
			navMenuIsOpen: null
		};
	},
	computed: {
		authDialogOpen() {
			return this.$store.getters.authDialogOpen;
		},
		loginStatus() {
			return this.$store.getters.loginStatus;
		},
		userDialogOpen() {
			return this.$store.getters.userDialogOpen;
		}
	},
	methods: {
		closeNavMenu() {
			this.navMenuIsOpen = false;
		},
		openAuthDialog() {
			this.$store.dispatch("openAuthDialog");
		},
		closeAuthDialog() {
			this.$store.dispatch("closeAuthDialog");
		},
		openUserDialog() {
			this.$store.dispatch("openUserDialog");
		},
		closeUserDialog() {
			this.$store.dispatch("closeUserDialog");
		}
	}
};
</script>
