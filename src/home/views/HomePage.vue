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
								Click or tap the key icon (<v-icon>mdi-key</v-icon>) at the top
								right of the page to get started.
							</p>
							<p>
								For more info, you can read all about the app on
								<router-link to="about">lvlz.app/about</router-link>!
							</p>
						</v-card>
						<v-card class="pa-3 mb-4">
							<h3>Project Status</h3>
							<p>
								This app is currently in its very early stages of development.
								For the rest of 2021, I'll just be adding little features to
								test out ideas. Then next year we'll reassess the app moving
								forward!<br />
								This is an open-source project. (
								<a
									href="http://www.gnu.org/licenses/gpl-3.0.html"
									target="_blank"
								>
									GNU Public License v3.0</a
								>
								)<br />
								More info:
								<a href="https://github.com/wforbes/levelz.app" target="_blank">
									github.com/wforbes/levelz.app </a
								><br /><br />
								Please contact
								<a href="mailto:will@levelz.app">will@levelz.app</a>
								with any questions!
							</p>
						</v-card>
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
		navigateToDashboard() {
			this.$router.push("dashboard");
		}
	}
};
</script>
