<template>
	<div>
		<v-dialog v-model="dialogOpen" persistent max-width="800">
			<v-card class="elevation-12">
				<v-toolbar dark dense flat>
					<v-toolbar-title>{{ toolbarTitle }}</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-btn @click="closeDialog" icon>
						<v-icon>mdi-close</v-icon>
					</v-btn>
				</v-toolbar>
				<v-tabs
					v-model="tabsKey"
					background-color="primary"
					dark
					fixed-tabs
					icons-and-text
				>
					<v-tab :key="0">
						Signup
						<v-icon>mdi-account-plus</v-icon>
					</v-tab>
					<v-tab-item :key="0">
						<v-container>
							<v-row>
								<v-col cols="12" sm="6" order-sm="1" order="2">
									<v-form v-model="signupValid">
										<v-text-field
											outlined
											label="Email"
											v-model="newEmail"
											:rules="[rules.required, rules.emailValid]"
										></v-text-field>
										<v-text-field
											outlined
											label="Username"
											v-model="newUsername"
											:rules="[
												rules.required,
												rules.usernameLength,
												rules.usernameValid
											]"
										></v-text-field>
										<v-text-field
											outlined
											label="Password"
											v-model="newPassword"
											type="password"
											:rules="[
												rules.required,
												rules.passwordLength,
												rules.passwordValid
											]"
										></v-text-field>
										<v-text-field
											outlined
											label="Repeat Password"
											v-model="newRepeatPassword"
											type="password"
											:rules="[rules.required, rules.passwordMatch]"
										></v-text-field>
										<v-container>
											<v-row>
												<v-col>
													<v-btn
														@click="submitSignup"
														:disabled="!signupValid"
														color="success"
														>Sign Up</v-btn
													>
												</v-col>
												<v-col align="right">
													<v-btn color="error" @click="resetSignupForm"
														>Reset</v-btn
													>
												</v-col>
											</v-row>
										</v-container>
									</v-form>
								</v-col>
								<v-col cols="12" sm="6" order-sm="2" order="1">
									<v-card class="elevation-6 pa-4">
										<span v-if="signupErrors.length === 0">
											<h5 class="text-h5">
												Signup for Lvlz
											</h5>
											<span class="text-subtitle-1">
												To create an account on Lvlz, we just need a couple
												pieces of info.<br />
											</span>
										</span>
										<span v-else-if="signupErrors.length >= 1">
											<h5 class="text-h6">
												Sorry, there
												<span v-if="signupErrors.length === 1"
													>was a problem</span
												>
												<span v-else-if="signupErrors.length >= 2"
													>were problems</span
												>
												with your signup request:
											</h5>
											<span v-html="signupFeedback"></span>
										</span>
									</v-card>
									<v-card class="elevation-6 mt-5 pa-4">
										<span class="text-subtitle-1">
											The good news is we won't spam you and we'll never share
											your data with anyone.<br />
											<a @click="showMoreInfo">Click here for more info.</a>
										</span>
									</v-card>
								</v-col>
							</v-row>
						</v-container>
					</v-tab-item>
					<v-tab :key="1">
						Log In
						<v-icon>mdi-login</v-icon>
					</v-tab>
					<v-tab-item :key="1">
						<v-container>
							<v-row>
								<v-col align="center">
									<div v-if="loginErrors.length >= 1">
										<h5 class="text-h6">
											Sorry, there
											<span v-if="loginErrors.length === 1">was a problem</span>
											<span v-else-if="loginErrors.length >= 2"
												>were problems</span
											>
											with your login request:
										</h5>
										<span v-html="loginFeedback"></span>
									</div>
								</v-col>
							</v-row>
							<v-row>
								<v-col cols="12" offset-sm="3" sm="6">
									<v-form v-model="loginValid">
										<v-text-field
											outlined
											label="Email / Username"
											v-model="loginUsername"
											:rules="[rules.required]"
										></v-text-field>
										<v-text-field
											outlined
											label="Password"
											type="password"
											v-model="loginPassword"
											:rules="[rules.required]"
										></v-text-field>
										<v-container>
											<v-row>
												<v-col>
													<v-btn
														:disabled="!loginValid"
														color="success"
														@click="submitLogin"
													>
														Log In
													</v-btn>
												</v-col>
												<v-col align="right">
													<v-btn color="error" @click="resetLoginForm"
														>Reset</v-btn
													>
												</v-col>
											</v-row>
										</v-container>
									</v-form>
								</v-col>
							</v-row>
						</v-container>
					</v-tab-item>
				</v-tabs>
			</v-card>
		</v-dialog>
		<v-dialog v-model="moreInfoOpen" max-width="800">
			<v-toolbar dark dense flat>
				<v-card-title>Lvlz Email and Data Statement</v-card-title>
				<v-spacer></v-spacer>
				<v-btn icon @click="closeMoreInfo">
					<v-icon>mdi-close</v-icon>
				</v-btn>
			</v-toolbar>
			<v-card class="pa-3 pr-6 pl-6">
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
					Levelz.app or Lvlz.app, in principle and practice. Not only do we
					value your privacy and security, but we also find it very important to
					keep you from experiencing the intrusive ads and solicitation that
					come from third-party data companies when they get ahold of your data
					and spread it around to all their friends. If we do ever share your
					data, it will be within your full control to limit it, or because
					specifically requested it!
				</p>
				<h4>Analytics and Usage Data</h4>
				<p>
					Although we do use your browsing data to make Lvlz.app better when we
					can, and a part of that may involve using the Google Analytics
					service, we'll always do our best to keep whatever analytics data we
					have about individuals private.
				</p>
				<h4>Third-Party Login Services</h4>
				<p>
					Although we may offer log in services from companies like Google or
					Facebook to provide you the convience of logging in to Lvlz.app using
					your accounts on those other platforms, we'll always do our best to
					limit our data sharing with those platforms so that we can conserve
					your privacy.
				</p>
				<h4>Goals For Offline Features</h4>
				<p>
					In our general development plan for Lvlz.app we've outlined various
					ways that we can offer offline, private, non-connected, self-contained
					versions of our features so that you may use Lvlz.app without even
					being connected to the internet, and thus not even sharing your data
					with us, unless you want to. We will continue to pursue paradigms like
					this because we support your desire to keep your data private.
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
	</div>
</template>
<script>
import axios from "axios";
export default {
	name: "AuthDialog",
	props: ["dialogOpen"],
	data() {
		return {
			host: "",
			signupFeedback: "",
			signupErrors: [],
			loginErrors: [],
			loginFeedback: "",
			tabsKey: 0,
			moreInfoOpen: false,
			newEmail: "",
			newUsername: "",
			newPassword: "",
			newRepeatPassword: "",
			emailTakenMsg: "",
			emailValidationMsg: "",
			usernameTakenMsg: "",
			usernameValidationMsg: "",
			passwordValidationMsg: "",
			passwordMatchMsg: "",
			rules: {
				required: value => !!value || "This can't be blank.",
				emailValid: value =>
					this.emailRegex.test(value) || "A valid Email is required.",
				usernameLength: value =>
					(value.length >= 3 && value.length <= 20) ||
					"Must be between 2 and 20 characters.",
				usernameValid: value =>
					this.isValidUsername(value) || this.usernameValidationMsg,
				passwordLength: value =>
					(value.length >= 6 && value.length <= 32) ||
					"Must be between 6 and 32 characters.",
				passwordValid: value =>
					this.isValidPassword(value) || this.passwordValidationMsg,
				passwordMatch: value =>
					value === this.newPassword || "Both passwords must match."
			},
			// eslint-disable-next-line no-control-regex
			emailRegex: /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/,
			signupValid: true,
			loginUsername: "",
			loginPassword: "",
			loginValid: true,
			x: ""
		};
	},
	created() {
		this.setEnvironment();
	},
	computed: {
		toolbarTitle() {
			return this.tabsKey ? "Log In To Lvlz" : "Create Your Lvlz Account";
		}
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
		},
		submitLogin() {
			this.loginErrors = [];
			axios
				.post(this.host + "api/", {
					data: {
						n: "auth",
						v: "login",
						u: this.loginUsername,
						p: this.loginPassword
					}
				})
				.then(response => {
					this.loginFeedback = response;
					if (response.data["success"]) {
						this.loginFeedback = response.data["success"];
						this.$store.dispatch({
							type: "loginUser",
							userId: response.data["success"]["userId"],
							userProfileId: response.data["success"]["userProfileId"]
						});
						this.closeDialog();
						if (this.$route.path !== "/dashboard") {
							this.$router.push("dashboard");
						}
					} else if (response.data["errors"]) {
						this.loginFeedback = response.data["errors"];
						this.loginErrors = response.data["errors"];
						this.loginFeedback = "<ul style='list-style:none; padding:0;'>";
						for (let msg of this.loginErrors) {
							this.loginFeedback +=
								"<li style='color:red;'><strong>" + msg + "</strong></li>";
						}
						this.loginFeedback += "</ul>";
					}
				});
		},
		submitSignup() {
			axios
				.post(this.host + "api/", {
					data: {
						n: "auth",
						v: "signup",
						u: this.newUsername,
						p: this.newPassword,
						r: this.newRepeatPassword,
						e: this.newEmail
					}
				})
				.then(response => {
					if (response.data["success"]) {
						this.$store.dispatch({
							type: "loginUser",
							userId: response.data["success"]["userId"],
							userProfileId: response.data["success"]["userProfileId"]
						});
						this.closeDialog();
						if (this.$route.path !== "/dashboard") {
							this.$router.push("dashboard");
						}
					} else if (response.data["errors"]) {
						this.signupErrors = response.data["errors"];
						this.signupFeedback = "<ul style='list-style:none; padding:0;'>";
						for (let msg of this.signupErrors) {
							this.signupFeedback +=
								"<li style='color:red;'><strong>" + msg + "</strong></li>";
						}
						this.signupFeedback += "</ul>";
					}
				});
		},
		setEnvironment() {
			this.host =
				window.location.host === "localhost:8080"
					? "http://localhost/levelz.app/"
					: "";
		},
		isValidUsername(username) {
			if (!username) return false;
			this.usernameValidationMsg = "";
			const noSpecialCharRegex = /^[a-zA-Z\d._]+$/;
			const numberFirstRegex = /^[\d]+$/;
			let formValid = false;
			let startValid = false;
			let dotscoreValid = false;
			let endValid = false;
			let startNumberValid = false;
			if (noSpecialCharRegex.test(username)) {
				formValid = true;
			} else {
				//this.checkUsernameForDelimAdd();
				this.usernameValidationMsg +=
					"Can only contain: [ A-Z, a-z, 0-9, . and _ ]\n";
			}

			if (!username.startsWith(".") && !username.startsWith("_")) {
				startValid = true;
			} else {
				this.checkUsernameForDelimAdd();
				this.usernameValidationMsg += "Can't begin with . or _ characters.";
			}

			if (!username.endsWith(".") && !username.endsWith("_")) {
				endValid = true;
			} else {
				this.checkUsernameForDelimAdd();
				this.usernameValidationMsg += "Can't end with . or _ characters.";
			}

			if (
				!username.includes("..") &&
				!username.includes("__") &&
				!username.includes("._") &&
				!username.includes("_.")
			) {
				dotscoreValid = true;
			} else {
				this.checkUsernameForDelimAdd();
				this.usernameValidationMsg += "Can't contain: [..],[._],[_.] or [__].";
			}

			if (!numberFirstRegex.test(username)) {
				startNumberValid = true;
			} else {
				this.checkUsernameForDelimAdd();
				this.usernameValidationMsg += "Can't begin with a number.";
			}

			return (
				formValid && startValid && endValid && dotscoreValid && startNumberValid
			);
		},
		isValidPassword(password) {
			this.passwordValidationMsg = "";
			let containsLower = false;
			let containsUpper = false;
			let containsNumber = false;
			const specialCharRegex = /[!"#$%&'()*+,\-./:;<=>?@[\\\]^_`{|}~]/g;
			let containsSpecial = false;

			if (password.match(/(?=.*[a-z])/g)) {
				containsLower = true;
			} else {
				this.checkPasswordForRequired();
				this.checkPasswordForDelimAdd();
				this.passwordValidationMsg += "1 lowercase letter";
			}

			if (password.match(/(?=.*[A-Z])/g)) {
				containsUpper = true;
			} else {
				this.checkPasswordForRequired();
				this.checkPasswordForDelimAdd();
				this.passwordValidationMsg += "one uppercase letter";
			}

			if (password.match(/(?=.*\d)/g)) {
				containsNumber = true;
			} else {
				this.checkPasswordForRequired();
				this.checkPasswordForDelimAdd();
				this.passwordValidationMsg += "one number";
			}

			if (password.match(specialCharRegex)) {
				containsSpecial = true;
			} else {
				this.checkPasswordForRequired();
				this.checkPasswordForDelimAdd();
				this.passwordValidationMsg += "one special character";
			}

			return (
				containsLower && containsUpper && containsNumber && containsSpecial
			);
		},
		checkPasswordForDelimAdd() {
			this.passwordValidationMsg +=
				this.passwordValidationMsg !== "" ? "; " : "";
		},
		checkPasswordForRequired() {
			this.passwordValidationMsg += this.passwordValidationMsg.startsWith("Req")
				? "Required: "
				: "";
		},
		checkUsernameForDelimAdd() {
			this.usernameValidationMsg +=
				this.usernameValidationMsg !== "" ? "; " : "";
		},
		resetSignupForm() {
			this.newEmail = "";
			this.newUsername = "";
			this.newPassword = "";
			this.newRepeatPassword = "";
			this.signupFeedback = "";
			this.signupErrors = [];
		},
		resetLoginForm() {
			this.loginUsername = "";
			this.loginPassword = "";
			this.loginErrors = [];
			this.loginFeedback = "";
		}
	}
};
</script>
