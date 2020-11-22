<template>
	<div>
		<v-snackbar v-model="snackBarOpen" :timeout="snackBarTimeout">
			<v-container>
				<v-row>
					<v-col cols="8" class="pa-0">
						{{ snackBarText }}
					</v-col>
					<v-col class="pa-0" align="right">
						<v-btn @click="snackBarOpen = false">
							Close
						</v-btn>
					</v-col>
				</v-row>
			</v-container>
		</v-snackbar>
	</div>
</template>
<script>
export default {
	name: "SnackBar",
	data() {
		return {
			snackBarTimeout: 2000,
			snackBarOpen: false
		};
	},
	computed: {
		snackBarSignal() {
			return this.$store.getters.snackBarSignal;
		},
		snackBarText() {
			return this.$store.getters.snackBarText;
		}
	},
	watch: {
		snackBarSignal(n, o) {
			console.log("saw signal");
			if (n && !o) {
				this.snackBarOpen = true;
				this.$store.dispatch("resetSnackBarSignal");
			}
		}
	}
};
</script>
