<template>
	<div id="profile-image-dialog">
		<v-dialog v-model="dialogOpen" ref="userDialog" persistent max-width="800">
			<v-card class="elevation-12">
				<v-toolbar dark dense flat>
					<v-toolbar-title>{{ toolbarTitle }}</v-toolbar-title>
					<v-spacer></v-spacer>
					<v-btn @click="closeDialog" icon>
						<v-icon>mdi-close</v-icon>
					</v-btn>
				</v-toolbar>
				<v-card class="pa-5" v-if="!uploadSubmitted">
					<v-form max-width="200" class="text-xs-center ma-0 pa-0">
						<v-row class="ma-0 pa-0" justify="center">
							<v-col style="text-align:center" class="ma-0 pa-0">
								<img v-if="previewFile" id="preview-image" :width="200" />
							</v-col>
						</v-row>
						<v-row justify="center" align="center" class="ma-0 pa-0">
							<v-col
								class="ma-0 pa-0"
								offset-cols="0"
								offset-sm="2"
								cols="12"
								sm="8"
								style="text-align:center"
							>
								<v-file-input
									v-model="imageFile"
									filled
									:rules="rules"
									show-size
									accept="image/png, image/jpeg, image/bmp"
									class="mt-5"
									prepend-icon="mdi-camera"
									label="Click to choose image"
									max-width="50"
									@change="fileAdded()"
								></v-file-input>
							</v-col>
							<v-col cols="12" sm="2" align="center" class="ma-0 pa-3">
								<v-btn
									:disabled="!imageFile"
									color="success"
									@click="submitUpload()"
								>
									Upload
								</v-btn>
							</v-col>
						</v-row>
						<v-row class="ma-0 pa-0">
							<v-col align="center" class="ma-0 pa-0">
								<p>
									<span
										v-for="(errorMsg, index) of errorMsgs"
										:key="index"
										style="color:red; font-size: 0.9em;"
									>
										{{ errorMsg }}
										<span v-if="index !== errorMsgs.length - 1"><br /></span>
									</span>
								</p>
							</v-col>
						</v-row>
					</v-form>
					<div>
						<v-img
							:class="{ selected: selectedImage === index }"
							max-width="200"
							v-for="(url, index) of imgUrlArray"
							:key="index"
							:src="url"
							@click="selectImage(index)"
						></v-img>
					</div>
				</v-card>
				<div v-if="showLoading">
					<LoadingCard />
				</div>
				<v-card v-if="uploadSuccess" class="pa-5" align="center">
					<v-card-title class="justify-center">
						Upload Complete
					</v-card-title>
					<v-card-text>
						{{ successMsg }}
					</v-card-text>
					<v-card-actions class="justify-center">
						<v-btn @click="closeDialog()">Close</v-btn>
					</v-card-actions>
				</v-card>
			</v-card>
		</v-dialog>
	</div>
</template>

<style>
.selected {
	border: 0.2em solid #209cee;
}
</style>

<script>
import LoadingCard from "@/app/components/LoadingCard.vue";
export default {
	name: "ProfileImageDialog",
	props: ["dialogOpen"],
	components: {
		LoadingCard
	},
	data() {
		return {
			toolbarTitle: "Profile Image",
			imgUrls: [],
			selectedImage: undefined,
			imageFile: undefined,
			previewFile: undefined,
			previewNaturalWidth: 0,
			previewNaturalHeight: 0,
			errorMsgs: [],
			successMsg: "",
			uploadSubmitted: false,
			showLoading: false,
			uploadSuccess: false,
			rules: [
				value =>
					!value ||
					value.size < 3000000 ||
					"Image size should be less than 4 MB!"
			]
		};
	},
	computed: {
		imgUrlArray() {
			return this.$store.getters.userProfilePicUrlList;
		},
		userProfilePicUrl() {
			return this.$store.getters.userProfilePicUrl;
		}
	},
	watch: {
		async dialogOpen(newV, oldV) {
			if (newV && !oldV) {
				await this.$store.dispatch("loadAllUserProfilePictures");
				let selectedIndex = this.imgUrlArray.findIndex(
					url => url === this.userProfilePicUrl
				);
				this.selectedImage = selectedIndex >= 0 ? selectedIndex : undefined;
			}
			if (oldV && !newV) {
				console.log("dialog closed");
			}
		}
	},
	methods: {
		selectImage(index) {
			if (this.selectedImage === index) return;
			this.selectedImage = index;
			let fileName = this.imgUrlArray[index];
			fileName = fileName.split("/").pop();
			this.$store.dispatch({
				type: "updateDefaultUserProfilePic",
				fileName: fileName
			});
		},
		async submitUpload() {
			this.errorMsgs = [];
			if (this.previewNaturalWidth > 640 || this.previewNaturalHeight > 640) {
				this.errorMsgs.push("Image can't be larger than 640x640");
			} else {
				this.uploadSubmitted = true;
				let formData = new FormData();
				formData.append("user_profile_img", this.imageFile);
				this.showLoading = true;
				this.$store
					.dispatch({
						type: "submitUserProfilePicture",
						formData: formData
					})
					.then(response => {
						this.showLoading = false;
						if (response.data.success) {
							const msg = response.data.success[0];
							this.successMsg = msg;
							this.uploadSuccess = true;
							this.$store.dispatch({
								type: "loadUserProfile",
								userProfileId: this.$store.getters.userProfile.id
							});
						} else {
							this.uploadSubmitted = false;
							if (response.data.errors) {
								for (let error of response.data.errors) {
									this.errorMsgs.push(error);
								}
							}
						}
					});
			}
		},
		fileAdded() {
			this.errorMsgs = [];
			if (!this.imageFile) {
				this.previewFile = undefined;
				return;
			}
			this.previewFile = this.imageFile;
			const reader = new FileReader();
			reader.addEventListener("load", () => {
				const img = document.querySelector("#preview-image");
				img.addEventListener("load", () => {
					this.previewNaturalWidth = img.naturalWidth;
					this.previewNaturalHeight = img.naturalHeight;
				});
				img.src = reader.result;
			});
			reader.readAsDataURL(this.previewFile);
		},
		resetDialog() {
			this.previewFile = undefined;
			this.imageFile = undefined;
			this.previewNaturalWidth = 0;
			this.previewNaturalHeight = 0;
			this.errorMsgs = [];
			this.successMsg = "";
			this.uploadSubmitted = false;
			this.showLoading = false;
			this.uploadSuccess = false;
		},
		closeDialog() {
			this.resetDialog();
			this.$emit("closeDialog");
		}
	}
};
</script>
