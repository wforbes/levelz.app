<template>
	<div>
		<div class="app-title">
			<v-row>
				<v-col cols="5" align="right">
					<v-img src="../../assets/logo-icon.png" max-width="60" />
				</v-col>
				<v-col cols="7">
					<span class="display-2">
						Levelz
					</span>
				</v-col>
			</v-row>
		</div>
		<div class="home">
			<v-container fluid>
				<v-row>
					<v-col>
						<v-card class="pa-3 mb-4">
							<h1>What is Levelz?</h1>
							<p>
								Levelz is a productivity web app that looks to help you
								reinforce your good habits, get organized, stay productive, and
								level up in life!
							</p>
							<p>
								For more info, you can read all about the app on
								<router-link to="about">lvlz.app/about</router-link>!
							</p>
							<p>
								For the most up to date info on what's been added to the app,
								click on "Project Updates" below!
							</p>
						</v-card>
						<v-expansion-panels v-model="openPanels" focusable accordion>
							<v-expansion-panel>
								<v-expansion-panel-header ripple color="primary">
									<span><strong>Project Status</strong></span>
									<template v-slot:actions>
										<v-icon class="panel-expander-icon">$expand</v-icon>
									</template>
								</v-expansion-panel-header>
								<v-expansion-panel-content>
									<div class="panel-inner-content">
										<h3>Project Status</h3>
										<p>
											This app is currently in its very early stages of
											development. For the rest of 2020, I'll just be adding
											little features to test out ideas. Then next year we'll
											reassess the app moving forward!<br />
											This is an open-source project. (
											<a
												href="http://www.gnu.org/licenses/gpl-3.0.html"
												target="_blank"
											>
												GNU Public License v3.0</a
											>
											)<br />
											More info:
											<a
												href="https://github.com/wforbes/levelz.app"
												target="_blank"
											>
												github.com/wforbes/levelz.app </a
											><br /><br />
											Please contact
											<a href="mailto:will@levelz.app">will@levelz.app</a>
											with any questions!
										</p>
									</div>
								</v-expansion-panel-content>
							</v-expansion-panel>
							<v-expansion-panel>
								<v-expansion-panel-header ripple color="primary">
									<strong>Project Updates</strong>
									<template v-slot:actions>
										<v-icon class="panel-expander-icon">$expand</v-icon>
									</template>
								</v-expansion-panel-header>
								<v-expansion-panel-content>
									<ul style="list-style: none; padding:1em 0; margin:0;">
										<li>
											<v-card class="pa-2 mb-3">
												<h4>
													(7/3/2020) FeatureMenu, Activites, NavMenu,
													UserDialog, and more
												</h4>
												<strong>Features Menu</strong>
												<p>
													There's a 'Features Menu' of icon buttons on the User
													Dashboard now that link to the various pages. Most of
													the pages are very blank, but the Activities page was
													started this week.
												</p>
												<strong>Experimenting on Activities Page</strong>
												<p>
													Clicking the Activities icon on the Dashboard or
													visiting
													<router-link to="activities">
														lvlz.app/activities
													</router-link>
													will bring you to the Activities Page. Here
													experiments were started with a workflow to create an
													Activity and add Actions to it. So far I don't like
													it, so it'll be changing quite a bit this month, but
													it's a start! :) Next week I'll be switching gears to
													start with simple Activities that are quick to set up
													and complete, then building Actions into it. I made
													some user story 'issues' on the
													<a
														href="https://github.com/wforbes/levelz.app"
														target="_blank"
														>lvlz github</a
													>
													and I'll be working on those next.
												</p>
												<strong>Navigation Menu</strong>
												<p>
													A Navigation Menu was added, you can get to it by
													clicking the menu icon in the toolbar at the very top
													left of the app.
												</p>
												<strong>About Page</strong>
												<p>
													Clicking the About menu item on the NavMenu or
													visiting
													<router-link to="about">
														lvlz.app/about
													</router-link>
													will bring you to the About Page. I tried to add as
													much information here as I could about my plans for
													the app. I'll be updating this as the app progresses
													and trimming it down as features become available.
												</p>
												<strong>Contact Page</strong>
												<p>
													Clicking the Contact menu item on the NavMenu or
													visiting
													<router-link to="contact">
														lvlz.app/contact
													</router-link>
													will bring you to the Contact Page. It's really basic,
													but I'd like to add a chat/support feature here
													eventually.
												</p>
												<strong>User Menu Dialog</strong>
												<p>
													After you sign up or you log in, the 'key' icon in the
													upper right of the screen turns into a 'user' icon.
													Clicking that 'user' icon will open the User Dialog
													menu. This provides quick links to get back to the
													User Dashboard, go to the Account Management page
													(empty for now), or Logout of the app.
												</p>
												<strong>Studying Habitica.com</strong>
												<p>
													<a href="https://habitica.com" target="_blank"
														>Habitica.com</a
													>
													is an open source app for Web, Android and iOS that
													provides a very similar experience to what I hope to
													achieve on Levelz.app one day. I started studying
													Habitica to get inspired with ideas and I plan on
													looking in to contributing to the codebase eventually.
												</p>
											</v-card>
										</li>
										<li>
											<v-card class="pa-2 mb-3">
												<strong>(6/24/2020) User Dashboard Layout</strong><br />
												<span>
													I worked on laying out the User Dashboard with some
													placeholder stuff. Included are some concepts on game
													stats there like: your Level, Class, Experience
													Points; Vital stats like Health, Endurance, Spirit,
													and Focus; and base stats like Strength, Stamina,
													Agility, Dexterity, Wisdom, Intelligence, Charisma,
													and Luck.
												</span>
											</v-card>
										</li>
										<li>
											<v-card class="pa-2 mb-3">
												<strong>(6/21/2020) Account Signups</strong><br />
												<span>
													Open the
													<a @click="openAuthDialog">Authentication Dialog</a>
													by clicking the key icon in the upper right corner of
													the screen. While you enter your information into the
													Signup Form, it's checked that it conforms to our
													standards. When you get it right, click the Submit
													button to create a new User account on our server and
													be navigated to the
													<a @click="navigateToDashboard">User dashboard page</a
													>. If you visit the User dashboard page without
													signing up, you will see a 'Not Logged In' page with a
													couple buttons to either come back to the home page or
													open the Authentication Dialog.
												</span>
												<br />
												<strong>Account Logins</strong><br />
												<span>
													Users who have already signed up for an account can
													log in via the Login Tab on the Authentication Dialog.
												</span>
												<br />
												<strong>Login Sessions and Logouts</strong><br />
												<span>
													Your login session should persist through reloading
													the page or navigating between pages. You can log out
													via a button on the User Dashboard. You should also be
													logged out if you close your browser tab or window.
												</span>
											</v-card>
										</li>
										<li>
											<v-card class="pa-2 mb-3">
												<strong>(6/16/2020) Authentication Dialog</strong><br />
												<span>
													Clicking the key icon in the top right of the screen
													opens a Signup/Login dialog window now. I created a
													simple email/data policy statement that displays there
													from the 'Click here for more info' link.
												</span>
											</v-card>
										</li>
										<li>
											<v-card class="pa-2 mb-3">
												<strong>(6/14/2020) Initial set up</strong><br />
												<span>
													I've started working on API calls on the
													<router-link to="/dev">Development Page</router-link>.
													The server works now!
												</span>
											</v-card>
										</li>
									</ul>
								</v-expansion-panel-content>
							</v-expansion-panel>
						</v-expansion-panels>
					</v-col>
				</v-row>
			</v-container>
		</div>
		<br /><br />
	</div>
</template>
<style>
.v-expansion-panel-header {
	color: white;
}
.panel-expander-icon {
	color: white !important;
}
.panel-inner-content {
	margin: 1em;
}
</style>

<script>
export default {
	name: "HomePage",
	data() {
		return {
			openPanels: 0
		};
	},
	methods: {
		openAuthDialog() {
			this.$store.dispatch("openAuthDialog");
		},
		navigateToDashboard() {
			this.$router.push("dashboard");
		}
	}
};
</script>
