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
						<h1>What is Levelz?</h1>
						<p>
							Levelz is a productivity web app that gamifies the concept of a
							todo list or task tracking app. We try to help you reinforce good
							habits and level up your life.
						</p>
						<h1>Project Status</h1>
						<p>
							This app is currently in its very early stages of development.<br />
							We are an open-source project. More info:
							<a href="https://github.com/wforbes/levelz.app" target="_blank"
								>github.com/wforbes/levelz.app</a
							><br /><br />
							Please contact
							<a href="mailto:will@levelz.app">will@levelz.app</a>
							with any questions!
						</p>
					</v-col>
				</v-row>
			</v-container>
		</div>
		<div class="project-updates">
			<v-row>
				<v-col>
					<div
						style="display:inline-block; border: 0.1em solid black; border-bottom: 0.1em; padding: 0.2em; border-top-left-radius: 0.2em; border-top-right-radius: 0.2em; "
					>
						<h4>Project Updates:</h4>
					</div>
					<div
						style="border: 0.1em solid black; border-bottom: 0.25em solid black; border-radius:0.2em; padding: 1em;"
					>
						<ul style="list-style: none; padding:0; margin:0;">
							<li>
								<strong>(6/16/2020)</strong> Clicking the key icon in the top
								right opens a Signup/Login dialog window now. Created a simple
								email/data policy statement that displays there from the 'Click
								here for more info' link.
							</li>
							<li>
								<strong>(6/14/2020)</strong> I've started working on API calls
								on the <router-link to="/dev">Development Page</router-link>.
								The server works now!
							</li>
						</ul>
					</div>
				</v-col>
			</v-row>
		</div>
		<br /><br />
	</div>
</template>

<script>
export default {
	name: "HomePage",
	data() {
		return {};
	}
};
</script>
