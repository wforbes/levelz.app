<template>
<v-footer color="primary" dark absolute padless>
	<v-col class="text-center" cols="12">
		&copy; {{ currentYear }} - <strong>William Forbes</strong>
	</v-col>
</v-footer>
</template>
<script>
export default {
	name: "Footer",
	data() {
		return {
			currentYear: new Date().getFullYear(),
		};
	},
	
};
</script>