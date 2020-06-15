import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

	const routes = [
	{
		path: '/',
		name: 'Home',
		component: () => import("../home/views/HomePage.vue"),
	},
	{
		path: '/dev',
		name: "DevPage",
		component: () => import("../dev/views/DevPage.vue"),
	},
	{ 
		path: '*',
		component: () => import("../app/views/Error404.vue"),
	},
];

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes: routes
});

export default router;
