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
			<div v-if="isLoggedIn && hasAnyPermission">
				<v-divider></v-divider>
				<v-list-item v-if="hasDevPageRoutePermission" link to="/dev">
					<v-list-item-action>
						<v-icon>mdi-code-braces</v-icon>
					</v-list-item-action>
					<v-list-item-content>
						<v-list-item-title>Developer</v-list-item-title>
					</v-list-item-content>
				</v-list-item>
			</div>
		</v-list>
	</v-navigation-drawer>
</template>

<script>
export default {
	name: "NavMenu",
	props: ["navMenuIsOpen"],
	data() {
		return {
			hasAnyPermission: false,
			hasDevPageRoutePermission: false
		};
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
		isLoggedIn() {
			return this.$store.getters.isLoggedIn;
		}
	},
	watch: {
		isOpen(newVal, oldVal) {
			if (!newVal && oldVal) {
				this.$emit("closeNavMenu");
			}
			if (newVal && !oldVal) {
				this.checkPermissions();
			}
		}
	},
	methods: {
		async checkPermissions() {
			this.hasDevPageRoutePermission = await this.$store.dispatch({
				type: "hasPermission",
				action: "route",
				object: "developer_page"
			});

			//TODO: Modify this when multiple permissions are checked
			this.hasAnyPermission = this.hasDevPageRoutePermission;
		}
	}
};
</script>
