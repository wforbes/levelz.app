import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
	{
		path: "/",
		name: "Home",
		component: () =>
			import(/* webpackChunkName: "bundle-Home" */ "../home/views/HomePage.vue")
	},
	{
		path: "/about",
		name: "About",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Home" */ "../about/views/AboutPage.vue"
			)
	},
	{
		path: "/contact",
		name: "Contact",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Home" */ "../contact/views/ContactPage.vue"
			)
	},
	{
		path: "*",
		component: () =>
			import(/* webpackChunkName: "bundle-Home" */ "../app/views/Error404.vue")
	},
	{
		path: "/dev",
		name: "DevPage",
		component: () => import("../dev/views/DevPage.vue")
	},
	{
		path: "/dashboard",
		name: "DashboardPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Dashboard" */ "../user/views/DashboardPage.vue"
			)
	},
	{
		path: "/account",
		name: "AccountPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Dashboard" */ "../user/views/AccountPage.vue"
			)
	},
	{
		path: "/activities",
		name: "ActivitesPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Activities" */ "../activities/views/ActivitiesPage.vue"
			)
	},
	{
		path: "/tasks",
		name: "TasksPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Tasks" */ "../tasks/views/TasksPage.vue"
			)
	},
	{
		path: "/quests",
		name: "QuestsPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Tasks" */ "../quests/views/QuestsPage.vue"
			)
	},
	{
		path: "/inventory",
		name: "InventoryPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Inventory" */ "../inventory/views/InventoryPage.vue"
			)
	},
	{
		path: "/financials",
		name: "FinancialsPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Financials" */ "../financials/views/FinancialsPage.vue"
			)
	},
	{
		path: "/travel",
		name: "TravelPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Travel" */ "../travel/views/TravelPage.vue"
			)
	}
];

const router = new VueRouter({
	mode: "history",
	base: process.env.BASE_URL,
	routes: routes
});

export default router;
