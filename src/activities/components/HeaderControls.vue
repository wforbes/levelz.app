<template>
	<v-row>
		<v-col cols="11" class="pa-0 pl-4 pt-2" style="min-height:3em">
			<v-row>
				<transition name="fade" mode="out-in">
					<v-col class="pl-3 pa-0" v-if="stepStates.length === 0">
						<h1>
							Activities
						</h1>
					</v-col>
					<v-col v-else class="pt-2">
						<v-row>
							<v-col v-if="currentStateHasBackBtn" sm="1" cols="2">
								<v-btn icon color="black" large @click="backStep">
									<v-icon>mdi-arrow-left</v-icon>
								</v-btn>
							</v-col>
							<v-col
								:class="{
									'ml-4 mt-5': $vuetify.breakpoint.mdAndUp,
									'ml-4 mt-1': $vuetify.breakpoint.smAndDown
								}"
							>
								<v-row>
									<v-col class="pa-0">
										<span v-if="stepStates.length >= 1">
											<strong>Activity</strong>
											<span>
												<v-icon>mdi-chevron-right</v-icon>
											</span>
										</span>
										<span v-for="(state, i) of stepStates" :key="i">
											<span style="display:inline; text-overflow:ellipsis">
												{{ state.name }}
											</span>
											<span v-if="stepStates.length - 1 !== i">
												<v-icon>mdi-chevron-right</v-icon>
											</span>
										</span>
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
