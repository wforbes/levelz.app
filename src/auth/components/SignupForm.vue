<template>
	<div>
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
							@keypress.enter="submitSignup"
						></v-text-field>
						<v-container>
							<v-row>
								<v-col>
									<v-btn color="error" @click="resetSignupForm">Reset</v-btn>
								</v-col>
								<v-col align="right">
									<v-btn
										@click="submitSignup"
										:disabled="!signupValid"
										color="success"
										>Sign Up</v-btn
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
								To create an account on Lvlz, we just need a couple pieces of
								info.<br />
							</span>
						</span>
						<span v-else-if="signupErrors.length >= 1">
							<h5 class="text-h6">
								Sorry, there
								<span v-if="signupErrors.length === 1">was a problem</span>
								<span v-else-if="signupErrors.length >= 2">were problems</span>
								with your signup request:
							</h5>
							<span v-html="signupFeedback"></span>
						</span>
					</v-card>
					<v-card class="elevation-6 mt-5 pa-4">
						<span class="text-subtitle-1">
							The good news is we won't spam you and we'll never share your data
							with anyone.<br />
							<a @click="showMoreInfo">Click here for more info.</a>
						</span>
					</v-card>
				</v-col>
			</v-row>
		</v-container>
		<DataStatementDialog
			:moreInfoOpen="moreInfoOpen"
			@closeMoreInfo="closeMoreInfo"
		/>
	</div>
</template>
<script>
import DataStatementDialog from "../components/DataStatementDialog.vue";
export default {
	name: "SignupForm",
	components: {
		DataStatementDialog
	},
	data() {
		return {
			host: "",
			// eslint-disable-next-line no-control-regex
			emailRegex: /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/,
			signupValid: true,
			signupFeedback: "",
			signupErrors: [],
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
			}
		};
	},
	created() {
		this.setEnvironment();
	},
	methods: {
		showMoreInfo() {
			this.moreInfoOpen = true;
		},
		closeMoreInfo() {
			this.moreInfoOpen = false;
		},
		setEnvironment() {
			this.host =
				window.location.host === "localhost:8080"
					? "http://localhost/levelz.app/"
					: "";
		},
		async submitSignup() {
			this.$store
				.dispatch({
					type: "submitSignup",
					signupData: {
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
							username: response.data["success"]["username"],
							userEmail: response.data["success"]["userEmail"],
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
		}
	}
};
</script>
