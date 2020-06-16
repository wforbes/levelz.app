<template>
	<div>
		<v-dialog v-model="dialogOpen" persistent max-width="800">	
			<v-card class="elevation-12">
				<v-toolbar dark dense flat>
					<v-toolbar-title>Create Your Lvlz Account</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-btn @click="closeDialog" icon>
						<v-icon>mdi-close</v-icon>
					</v-btn>
				</v-toolbar>
				<v-tabs
					fixed-tabs
					background-color="indigo"
					dark
				>
					<v-tab :key="0">
						Signup
					</v-tab>
					<v-tab-item :key="0">
						<v-container>
							<v-row>
								<v-col>
									<span class="text-subtitle-1">
										To create an account on Lvlz, we just need a couple pieces of info.<br />
										We won't spam you and we'll never share your data with anyone.<br />
										<a @click="showMoreInfo">Click here for more info.</a>
									</span>
								</v-col>
							</v-row>
							<v-row>
								<v-col cols="12" sm="6">
									<v-form>
										<v-text-field outlined
											label="Email"
										></v-text-field>
										<v-text-field outlined
											label="Username"
										></v-text-field>
										<v-text-field outlined
											label="Password"
										></v-text-field>
										<v-text-field outlined
											label="Repeat Password"
										></v-text-field>
										<v-container>
											<v-row>
												<v-col>
													<v-btn color="success">Sign Up</v-btn>
												</v-col>
												<v-col align="right">
													<v-btn color="error">Reset</v-btn>
												</v-col>
											</v-row>
										</v-container>
									</v-form>
								</v-col>
								<v-col cols="12" sm="6">
									<p>Already have an account?</p>
									<v-btn>Login Instead</v-btn>
								</v-col>
							</v-row>
						</v-container>
					</v-tab-item>
					<v-tab :key="1">
						Log In
					</v-tab>
					<v-tab-item :key="1">
						Login form...
					</v-tab-item>
				</v-tabs>
			</v-card>
		</v-dialog>
		<v-dialog v-model="moreInfoOpen">
			<v-toolbar dark dense flat>
				<v-card-title>Lvlz Email and Data Statement</v-card-title>
				<v-spacer></v-spacer>
				<v-btn icon @click="closeMoreInfo">
					<v-icon>mdi-close</v-icon>
				</v-btn>
			</v-toolbar>
			<v-card class="pa-3 pr-6 pl-6">
				<!--<h1>Levelz.app Email and Data Statement</h1>-->
				<h3>We don't spam. Period.</h3>
				<ul>
					<li>We won't send messages you haven't agreed to.</li>
					<li>We won't ever send you messages you can't turn off or unsubscribe from.</li>
					<li>We won't send you messages from sources other than Levelz.app or Lvlz.app.</li>
				</ul>
				<h3>We don't share your data with Third-Parties. Period.</h3>
				<p>
					We don't agree with sharing your data with any other entity outside of
					Levelz.app or Lvlz.app, in principle and practice. Not only do we value your privacy 
					and security, but we also find it very important to keep you from experiencing 
					the intrusive ads and solicitation that comes from third-party data companies
					when they get ahold of your data and spread it around to all their friends.
				</p>
				<h4>We'll keep getting better at this.</h4>
				<p>
					Lvlz is a very young app and we're interested in finding new ways to improve this
					statement.<br />
					Email us with your thoughts at <a href="mailto:will@levelz.app">will@levelz.app</a>.
				</p>
			</v-card>
			
		</v-dialog>
	</div>
</template>
<script>
export default {
	name: "AuthDialog",
	props: [ "dialogOpen" ],
	data() { 
		return {
			moreInfoOpen: false
		};
	},
	methods: {
		closeDialog() {
			this.$emit("closeDialog");
		},
		showMoreInfo() {
			this.moreInfoOpen = true;
		},
		closeMoreInfo() {
			this.moreInfoOpen = false;
		}
	}
};
</script>
