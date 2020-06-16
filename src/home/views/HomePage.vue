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
			<v-row>
				<v-col>
					<div style="display:inline-block; border: 0.1em solid black; border-bottom: 0.1em; padding: 0.2em; border-top-left-radius: 0.2em; border-top-right-radius: 0.2em; ">
						<h4>updates:</h4>
					</div>
					<div style="border: 0.1em solid black; border-bottom: 0.25em solid black; border-radius:0.2em; padding: 1em;">
						<ul style="list-style: none; padding:0; margin:0;">
							<li>
								(6/14/2020) I've started working on API calls on the <router-link to="/dev">Development Page</router-link>
							</li>
						</ul>
					</div>
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
							This app is currently in its very early stages of development.
							Please contact
							<a href="mailto:will@levelz.app">will@levelz.app</a>
							with any questions!
						</p>
					</v-col>
				</v-row>
			</v-container>
		</div>
		<br/><br/>
	</div>
</template>

<script>
export default {
	name:"HomePage",
	data() {
		return {};
	},
}
</script>