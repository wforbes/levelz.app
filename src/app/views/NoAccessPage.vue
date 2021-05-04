<template>
	<div>
		<v-card class="pa-3">
			<h2>You have access to this page!</h2>
			<br />
			<p>
				Sorry, you aren't logged in as a user with access to this page.
			</p>
			<v-container>
				<v-row>
					<v-col align="center">
						<v-btn x-large to="/">
							<v-icon medium>mdi-home</v-icon> Go Back Home
						</v-btn>
					</v-col>
				</v-row>
			</v-container>
		</v-card>
	</div>
</template>
<script>
export default {
	name: "NoAccessPage",
	data() {
		return {};
	}
};
</script>
