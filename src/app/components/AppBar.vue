<template>
	<div>
		<NavMenu :navMenuIsOpen="navMenuIsOpen" @closeNavMenu="closeNavMenu" />
		<v-app-bar app dark>
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
						<v-btn icon class="mr-3" @click="openAuthDialog">
							<v-icon>mdi-key</v-icon>
						</v-btn>
					</v-col>
				</v-row>
			</v-container>
		</v-app-bar>
		<AuthDialog
			ref="authDialog"
			:dialogOpen="dialogOpen"
			@closeDialog="closeAuthDialog"
		/>
	</div>
</template>

<script>
import NavMenu from "./NavMenu.vue";
import AuthDialog from "../../auth/components/AuthDialog.vue";
export default {
	name: "AppBar",
	components: {
		NavMenu,
		AuthDialog
	},
	data() {
		return {
			navMenuIsOpen: null
		};
	},
	computed: {
		dialogOpen() {
			return this.$store.getters.authDialogOpen;
		}
	},
	methods: {
		openAuthDialog() {
			//this.dialogOpen = true;
			this.$store.dispatch("openAuthDialog");
		},
		closeAuthDialog() {
			//this.dialogOpen = false;
			this.$store.dispatch("closeAuthDialog");
		},
		closeNavMenu() {
			this.navMenuIsOpen = false;
		}
	}
};
</script>
