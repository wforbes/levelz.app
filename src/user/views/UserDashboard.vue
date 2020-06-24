<template>
	<div>
		<v-container>
			<v-row>
				<v-col>
					<h1>Dashboard</h1>
				</v-col>
				<v-col v-if="userLoginStatus === 'loggedIn'" align="right">
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
						<v-card class="pa-2" min-height="420">
							<v-container>
								<v-row>
									<v-col cols="12" sm="6">
										<v-row class="ma-0 pa-0">
											<v-col class="ma-0 pa-0">
												<span class="display-2">
													<strong>{{ this.username }}</strong>
												</span>
											</v-col>
										</v-row>
										<v-row>
											<v-col>
												<v-row>
													<v-img
														src="../../assets/profilePic.png"
														max-width="150"
														class="elevation-3"
													></v-img>
												</v-row>
											</v-col>
											<v-col class="ma-0">
												<v-row>
													<span>
														Title: <strong>{{ this.userProfile.title }}</strong>
													</span>
												</v-row>
												<v-row>
													<span>
														Headline:<strong>{{
															this.userProfile.headline
														}}</strong>
													</span>
												</v-row>
												<v-row>
													<span>
														Location:<strong>{{
															this.userProfile.location
														}}</strong>
													</span>
												</v-row>
												<v-row>
													<span>
														Bio:<strong>{{ this.userProfile.bio }}</strong>
													</span>
												</v-row>
												<v-row>
													<span>
														Joined:<strong>{{
															this.userProfile.joinedDate
														}}</strong>
													</span>
												</v-row>
											</v-col>
										</v-row>
									</v-col>
									<v-col></v-col>
								</v-row>
								<v-row>
									<v-col>
										<v-row>
											<v-col cols="12" sm="6" class="pa-0 ma-0">
												<v-row>
													<v-col>
														<v-card class="pa-4">
															<v-row>
																<span class="headline"
																	>Level {{ player.level }}</span
																>
															</v-row>
															<v-row>
																<span class="title">{{ player.job }}</span>
															</v-row>
															<v-row>
																<span>
																	Experience Points:
																	<strong
																		>{{ player.experiencePoints }} /
																		{{ player.level * 10000 }}</strong
																	>
																</span>
																<v-progress-linear
																	v-model="experiencePercentage"
																	height="50"
																	color="amber"
																	style="border-radius: 0.75em"
																>
																	<template v-slot="{ value }">
																		<strong>{{ Math.ceil(value) }}%</strong>
																	</template>
																</v-progress-linear>
															</v-row>
														</v-card>
													</v-col>
												</v-row>
												<v-row>
													<v-col class="ma-4">
														<v-row>
															<span class="headline">Vitals</span>
														</v-row>
														<v-row>
															<v-col>
																<v-row>
																	<span>Health Points:</span>
																</v-row>
																<v-row>
																	<v-col cols="3">
																		<v-row>
																			<span
																				>{{
																					player.stats.vitals.healthPoints
																						.current
																				}}
																				/
																				{{
																					player.stats.vitals.healthPoints.total
																				}}</span
																			>
																		</v-row>
																	</v-col>
																	<v-col>
																		<v-progress-linear
																			v-model="healthPercentage"
																			height="20"
																			color="red"
																			style="border-radius: 0.75em"
																		>
																			<template v-slot="{ value }">
																				<strong>{{ Math.ceil(value) }}%</strong>
																			</template>
																		</v-progress-linear>
																	</v-col>
																</v-row>
															</v-col>
														</v-row>
														<v-row>
															<v-col>
																<v-row>
																	<span>Endurance Points:</span>
																</v-row>
																<v-row>
																	<v-col cols="3">
																		<v-row>
																			<span
																				>{{
																					player.stats.vitals.endurancePoints
																						.current
																				}}
																				/
																				{{
																					player.stats.vitals.endurancePoints.total
																				}}</span
																			>
																		</v-row>
																	</v-col>
																	<v-col>
																		<v-progress-linear
																			v-model="endurancePercentage"
																			height="20"
																			color="orange"
																			style="border-radius: 0.75em"
																		>
																			<template v-slot="{ value }">
																				<strong>{{ Math.ceil(value) }}%</strong>
																			</template>
																		</v-progress-linear>
																	</v-col>
																</v-row>
															</v-col>
														</v-row>
														<v-row>
															<v-col>
																<v-row>
																	<span>Spiritual Points:</span>
																</v-row>
																<v-row>
																	<v-col cols="3">
																		<v-row>
																			<span
																				>{{
																					player.stats.vitals.spiritualPoints
																						.current
																				}}
																				/
																				{{
																					player.stats.vitals.spiritualPoints.total
																				}}</span
																			>
																		</v-row>
																	</v-col>
																	<v-col>
																		<v-progress-linear
																			v-model="spiritualPercentage"
																			height="20"
																			color="blue"
																			style="border-radius: 0.75em"
																		>
																			<template v-slot="{ value }">
																				<strong>{{ Math.ceil(value) }}%</strong>
																			</template>
																		</v-progress-linear>
																	</v-col>
																</v-row>
															</v-col>
														</v-row>
														<v-row>
															<v-col>
																<v-row>
																	<span>Focus Points:</span>
																</v-row>
																<v-row>
																	<v-col cols="3">
																		<v-row>
																			<span
																				>{{
																					player.stats.vitals.focusPoints
																						.current
																				}}
																				/
																				{{
																					player.stats.vitals.focusPoints.total
																				}}</span
																			>
																		</v-row>
																	</v-col>
																	<v-col>
																		<v-progress-linear
																			v-model="focusPercentage"
																			height="20"
																			color="green"
																			style="border-radius: 0.75em"
																		>
																			<template v-slot="{ value }">
																				<strong>{{ Math.ceil(value) }}%</strong>
																			</template>
																		</v-progress-linear>
																	</v-col>
																</v-row>
															</v-col>
														</v-row>
													</v-col>
												</v-row>
											</v-col>
											<v-col cols="12" sm="6">
												<v-row>
													<v-col>
														<span class="headline">Stats</span>
													</v-col>
												</v-row>
												<v-row>
													<v-col>
														<v-row>
															<v-col cols="8"
																><span class="subtitle-1">Strength</span></v-col
															>
															<v-col>{{ player.stats.base.strength }}</v-col>
														</v-row>
														<v-row>
															<v-col cols="8"
																><span class="subtitle-1">Stamina</span></v-col
															>
															<v-col>{{ player.stats.base.stamina }}</v-col>
														</v-row>
														<v-row>
															<v-col cols="8"
																><span class="subtitle-1">Agility</span></v-col
															>
															<v-col>{{ player.stats.base.agility }}</v-col>
														</v-row>
														<v-row>
															<v-col cols="8"
																><span class="subtitle-1"
																	>Dexterity</span
																></v-col
															>
															<v-col>{{ player.stats.base.dexterity }}</v-col>
														</v-row>
													</v-col>
													<v-divider vertical></v-divider>
													<v-col>
														<v-row>
															<v-col cols="8"
																><span class="subtitle-1">Wisdom</span></v-col
															>
															<v-col>{{ player.stats.base.wisdom }}</v-col>
														</v-row>
														<v-row>
															<v-col cols="8"
																><span class="subtitle-2"
																	>Intelligence</span
																></v-col
															>
															<v-col>{{
																player.stats.base.intelligence
															}}</v-col>
														</v-row>
														<v-row>
															<v-col cols="8"
																><span class="subtitle-1">Charisma</span></v-col
															>
															<v-col>{{ player.stats.base.charisma }}</v-col>
														</v-row>
														<v-row>
															<v-col cols="8"
																><span class="subtitle-1">Luck</span></v-col
															>
															<v-col>{{ player.stats.base.luck }}</v-col>
														</v-row>
													</v-col>
												</v-row>
											</v-col>
										</v-row>
										<!--
										<v-col sm="6" cols="12" class="pa-0">
											<v-card class="pa-3">
												
											</v-card>
										</v-col>
										-->
									</v-col>
								</v-row>
							</v-container>
						</v-card>
					</div>
					<div v-if="userLoginStatus === 'loading'"></div>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>
<script>
//import U from "../../lib/util/U.js";
import NotLoggedIn from "../../app/views/NotLoggedIn.vue";
export default {
	name: "UserDashboard",
	components: {
		NotLoggedIn
	},
	data() {
		return {
			player: {
				level: 1,
				job: "Apprentice",
				experiencePoints: 121,
				stats: {
					vitals: {
						healthPoints: {
							current: 300,
							total: 320
						},
						spiritualPoints: {
							current: 400,
							total: 500
						},
						focusPoints: {
							current: 210,
							total: 250
						},
						endurancePoints: {
							current: 100,
							total: 320
						}
					},
					combat: {
						armorClass: 100,
						attackPoints: 100
					},
					base: {
						strength: 50,
						stamina: 50,
						agility: 50,
						dexterity: 50,
						wisdom: 50,
						intelligence: 50,
						charisma: 50,
						luck: 50
					}
				}
			}
		};
	},
	created() {},
	computed: {
		userLoginStatus() {
			return this.$store.getters.loginStatus;
		},
		profileImgSrc() {
			return "../../assets/profilePic.png";
		},
		userProfile() {
			return this.$store.getters.userProfile;
		},
		username() {
			return this.$store.getters.username;
		},
		experiencePercentage() {
			return (this.player.experiencePoints / (this.player.level * 1000)) * 100;
		},
		healthPercentage() {
			return (
				(this.player.stats.vitals.healthPoints.current /
					this.player.stats.vitals.healthPoints.total) *
				100
			);
		},
		endurancePercentage() {
			return (
				(this.player.stats.vitals.endurancePoints.current /
					this.player.stats.vitals.endurancePoints.total) *
				100
			);
		},
		spiritualPercentage() {
			return (
				(this.player.stats.vitals.spiritualPoints.current /
					this.player.stats.vitals.spiritualPoints.total) *
				100
			);
		},
		focusPercentage() {
			return (
				(this.player.stats.vitals.focusPoints.current /
					this.player.stats.vitals.focusPoints.total) *
				100
			);
		}
	},
	methods: {
		logout() {
			this.$store.dispatch("logoutUser");
		}
	}
};
</script>
