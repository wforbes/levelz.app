<template>
	<div>
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
						<router-link to="/">
							<v-img src="../../assets/logo-icon.png" width="42" />
						</router-link>
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
import AuthDialog from "../../auth/components/AuthDialog.vue";
export default {
	name: "AppBar",
	components: {
		AuthDialog
	},
	data() {
		return {
			//dialogOpen: false
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
		}
	}
};
</script>
