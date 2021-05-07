<template>
	<v-row>
		<v-col cols="11" class="pa-0 pl-4 pt-4" style="min-height:3em">
			<v-row>
				<transition name="fade" mode="out-in">
					<v-col class="pl-3 pa-0" v-if="stepStates.length === 0">
						<h1>
							Activities
						</h1>
					</v-col>
					<v-col v-else cols="11" class="pl-3 pa-0" style="margin-top:-0.6em;">
						<v-row>
							<v-col class="ml-0 pa-0" md="1" cols="2"></v-col>
							<v-col class="pl-1 pa-0 mb-n3">
								<h4>Activities</h4>
							</v-col>
						</v-row>
						<v-row>
							<v-col class="pl-3 pa-0">
								<v-row>
									<v-col class="pa-0" md="1" cols="2">
										<v-btn
											icon
											color="black"
											large
											v-if="currentStateHasBackBtn"
											@click="backStep"
										>
											<v-icon>mdi-arrow-left</v-icon>
										</v-btn>
									</v-col>
									<v-col class="pa-0 pt-2">
										<h2 style="margin-top:0.3em">
											<span v-for="(state, i) of stepStates" :key="i">
												<span style="text-overflow:ellipsis">
													{{ state.name }}
												</span>
												<span v-if="stepStates.length - 1 !== i">
													<v-icon>mdi-chevron-right</v-icon>
												</span>
											</span>
										</h2>
									</v-col>
								</v-row>
							</v-col>
						</v-row>
					</v-col>
				</transition>
				<v-col cols="1" align="center" class="pa-0 pr-2">
					<v-tooltip bottom>
						<template v-slot:activator="{ on, attrs }">
							<v-icon
								class="mt-3"
								v-on="on"
								v-bind="attrs"
								@click="openHelpOverlay"
							>
								mdi-help-circle-outline
							</v-icon>
						</template>
						<span>Help</span>
					</v-tooltip>
				</v-col>
			</v-row>
		</v-col>
	</v-row>
</template>
<style>
.fade-enter-active,
.fade-leave-active {
	transition: opacity 0.2s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
	opacity: 0;
}
</style>
<script>
export default {
	name: "HeaderControls",
	data() {
		return {};
	},
	computed: {
		stepStates() {
			return this.$store.getters.stepStates;
		},
		currentStateHasBackBtn() {
			return this.$store.getters.stepStates[
				this.$store.getters.stepStates.length - 1
			].hasBackBtn;
		}
	},
	methods: {
		openHelpOverlay() {
			this.$emit("openHelpOverlay");
		},
		backStep() {
			this.$store.dispatch("popStepState");
		}
	}
};
</script>
