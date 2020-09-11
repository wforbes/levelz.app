<template>
	<v-dialog v-model="moreInfoOpen" max-width="800">
		<v-card class="pa-3 pr-6 pl-6">
			<v-toolbar dark dense flat>
				<v-card-title>Lvlz Email and Data Statement</v-card-title>
				<v-spacer></v-spacer>
				<v-btn icon @click="closeMoreInfo">
					<v-icon>mdi-close</v-icon>
				</v-btn>
			</v-toolbar>
			<h3>We don't spam. Period.</h3>
			<ul>
				<li>
					We won't send you emails you can't unsubscribe from or turn off.
				</li>
				<li>
					We won't send you emails from sources other than addresses at
					Levelz.app or Lvlz.app.
				</li>
				<li>
					We won't send you emails that you haven't specifically agreed to
					wanting to get.
				</li>
			</ul>
			<h3>We don't share your data with Third-Parties. Period.</h3>
			<p>
				We don't agree with sharing your data with any other entity outside of
				Levelz.app or Lvlz.app, in principle and practice.
			</p>

			<p>
				Not only do we value your privacy and security, but we also find it very
				important to keep you from experiencing the intrusive ads and
				solicitation that come from third-party data companies when they get
				ahold of your data and spread it around to all their friends.
			</p>
			<p>
				If we do ever need to share your data, you'll be the first to know. It
				will be because you specifically requested it, or within your full
				control to limit it!
			</p>
			<h4>Analytics and Usage Data</h4>
			<p>
				Although we do use your browsing data to make Lvlz.app better when we
				can, and a part of that may involve using the Google Analytics service,
				we'll always do our best to keep whatever analytics data we have about
				you as private as possible.
			</p>
			<h4>Third-Party Login Services</h4>
			<p>
				Although we may offer log in services from companies like Google or
				Facebook to provide you the convience of logging in to Lvlz.app using
				your accounts on those other platforms, we'll always do our best to
				limit our data sharing with those platforms so that we can conserve your
				privacy.
			</p>
			<h4>Goals For Offline Features</h4>
			<p>
				In our general development plan for Lvlz.app we've outlined various ways
				that we can offer offline, private, non-connected, self-contained
				versions of our features so that you may use Lvlz.app without even being
				connected to the internet, and thus not even sharing your data with us,
				unless you want to. We will continue to pursue paradigms like this
				because we support your desire to keep your data private.
			</p>
			<h4>We'll keep getting better at this.</h4>
			<p>
				Lvlz is a very young app and we're interested in finding new ways to
				improve this statement.<br />
				Email me with your thoughts at
				<a href="mailto:will@levelz.app">will@levelz.app</a>.
			</p>
			<p>Thanks, Lvlz</p>
		</v-card>
	</v-dialog>
</template>
<style>
.v-dialog > .v-card > .v-toolbar {
	position: sticky;
	top: 0;
	z-index: 999;
}
</style>
<script>
export default {
	name: "DataStatementDialog",
	props: ["moreInfoOpen"],
	data() {
		return {};
	},
	methods: {
		closeMoreInfo() {
			this.$emit("closeMoreInfo");
		}
	}
};
</script>
