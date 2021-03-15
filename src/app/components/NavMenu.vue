<template>
	<v-navigation-drawer v-model="isOpen" app :clipped-left="true" temporary dark>
		<v-list dense>
			<v-list-item>
				<v-list-item-action>
					<v-img src="../../assets/logo-icon.png" width="25" />
				</v-list-item-action>
				<v-list-item-content>
					<v-list-item-title>Levelz</v-list-item-title>
				</v-list-item-content>
			</v-list-item>
			<v-list-item link to="/">
				<v-list-item-action>
					<v-icon>mdi-home</v-icon>
				</v-list-item-action>
				<v-list-item-content>
					<v-list-item-title>Home</v-list-item-title>
				</v-list-item-content>
			</v-list-item>
			<v-list-item link to="/about">
				<v-list-item-action>
					<v-icon>mdi-thought-bubble-outline</v-icon>
				</v-list-item-action>
				<v-list-item-content>
					<v-list-item-title>About</v-list-item-title>
				</v-list-item-content>
			</v-list-item>
			<v-list-item link to="/contact">
				<v-list-item-action>
					<v-icon>mdi-email</v-icon>
				</v-list-item-action>
				<v-list-item-content>
					<v-list-item-title>Contact</v-list-item-title>
				</v-list-item-content>
			</v-list-item>
			<!--
			<div v-if="viewAdminLink">
				<v-divider inset></v-divider>
				<v-subheader>Administration</v-subheader>
				<v-list-item link to="/admin">
					<v-list-item-action>
						<v-icon>mdi-account-tie</v-icon>
					</v-list-item-action>
					<v-list-item-content>
						<v-list-item-title>Admin</v-list-item-title>
					</v-list-item-content>
				</v-list-item>
			</div>
			-->
		</v-list>
	</v-navigation-drawer>
</template>

<script>
export default {
	name: "NavMenu",
	props: ["navMenuIsOpen"],
	data() {
		return {};
	},
	computed: {
		isOpen: {
			get: function() {
				return this.navMenuIsOpen;
			},
			set: function(newValue) {
				if (!newValue) {
					this.$emit("closeNavMenu", newValue);
				}
			}
		},
		/*
		viewAdminLink() {
			if (this.$store.getters.loginStatus) {
				return this.$store.dispatch({
					type: "checkPermission",
					permission: "viewAdminLink"
				});
			} else {
				return false;
			}
		}*/
	},
	watch: {
		isOpen(newVal, oldVal) {
			if (!newVal && oldVal) {
				this.$emit("closeNavMenu");
			}
		}
	}
};
</script>
