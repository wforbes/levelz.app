<template>
	<div>
		<v-container>
			<v-row>
				<v-col>
					<h1>Help Page</h1>
					<h5>Last updated 11/20/20 (v0.0.1)</h5>
				</v-col>
			</v-row>
			<v-row>
				<v-col>
					<v-card class="pa-2">
						<v-row>
							<v-col>
								<h2>Activities</h2>
								<p>
									<strong>Activities</strong> are used to keep track of the
									things you do throughout the day. These can be as simple as a
									to-do list to help you remember the parts of a task, or more
									complex like tracking the tasks required to learn or practice
									a new skill and recording metrics on how well you did them.
								</p>
								<p>
									<strong>Creating An Activity</strong>
								</p>
								<p></p>
							</v-col>
						</v-row>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
	</div>
</template>

<script>
export default {
	name: "HelpPage",
	data() {
		return {
			topics: ["activites"]
		};
	},
	watch: {
		$route(to, from) {
			console.log(to);
			console.log(from);
		}
	},
	created() {
		console.log(this.$route.params);
	}
};
</script>
