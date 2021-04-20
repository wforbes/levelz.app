<template>
	<div>
		<v-card class="pa-8" align="center">
			<h2>Loading</h2>
			<br />
			<font-awesome-icon :icon="['fas', 'spinner']" pulse size="4x" />
		</v-card>
	</div>
</template>
<script>
export default {
	name: "LoadingCard",
	data() {
		return {};
	}
};
</script>
