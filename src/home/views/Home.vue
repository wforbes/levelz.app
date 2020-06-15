<template>
	<v-content>
		<div class="app-title">
			<v-container>
				<v-row>
					<v-col offset-sm="3" sm="6" cols="12">
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
					</v-col>
				</v-row>
			</v-container>
		</div>
		<div class="home">
			<v-container fluid>
				<v-row>
					<v-col offset-sm="3" sm="6" cols="12">
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
				<v-row>
					<v-col>
						<router-link to="/dev">Development Page</router-link>
					</v-col>
				</v-row>
			</v-container>
		</div>
	</v-content>
</template>

<script>
export default {
	name:"Home",
	data() {},
}
</script>