<template>
	<div>
		<!-- <div style="text-align:center;">
			<span class="display-1" style="display:inline;">
				About Lvlz.app
			</span>
		</div> -->
		<v-container fluid>
			<v-row>
				<v-col>
					<h1>About Lvlz.app</h1>
					<p>
						<span style="font-size: 0.7em;">
							last updated 4/27/2021 by
							<a href="https://wforbes.net" target="_blank">Will Forbes</a>
						</span>
					</p>
				</v-col>
			</v-row>
			<v-row>
				<v-col>
					<v-card class="pa-3 mb-4">
						<p>
							I've started working on a draft of our introductory white-paper
							that explains Levelz and provides a description of it's features.
						</p>
						<div style="text-align:center">
							<v-btn color="primary" to="/white-paper">
								Read the Lvlz White Paper
							</v-btn>
						</div>
					</v-card>
					<v-card class="pa-3 mb-4">
						<p>
							Levelz is a productivity web app that looks to help you reinforce
							your good habits, stay productive, and level up in life!
						</p>
						<p>
							Right now I'm working to build Lvlz so that its useful for me,
							personally. To help stay productive and use everyday. I believe
							that if the app is easy, fun, rewarding and engaging for me - it
							has a chance to be enjoyed by other people.
						</p>
						<p>
							The first features of Levelz.app should be ready to start testing
							sometime in the middle of 2021.
						</p>
						<p>
							In the meantime, check out these similar apps:
						</p>
						<ul>
							<li>
								<a href="https://habitica.com/static/home" target="_blank">
									Habitica
								</a>
							</li>
							<li>
								<a href="https://lvluplife.com" target="_blank">
									LevelUpLife
								</a>
							</li>
							<li>
								<a
									href="https://play.google.com/store/apps/details?id=com.levor.liferpgtasks"
									target="_blank"
								>
									Do It Now: RPG To Do List. Habit Tracker. Calendar.
								</a>
							</li>
							<li>
								<a href="https://www.superbetter.com/" target="_blank">
									SuperBetter
								</a>
							</li>
							<li>
								<a
									href="https://play.google.com/store/apps/details?id=com.jayvant.liferpgmissions"
									target="_blank"
								>
									LifeRPG
								</a>
							</li>
							<li>
								<a
									href="https://apps.apple.com/us/app/epicwin/id372927221"
									target="_blank"
								>
									EpicWin
								</a>
							</li>
							<li>
								<a
									href="https://play.google.com/store/apps/details?id=com.twominds.thirty"
									target="_blank"
								>
									Thirty - Get Inspired
								</a>
							</li>
						</ul>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>

<script>
export default {
	name: "AboutPage",
	data() {
		return {};
	}
};
</script>
