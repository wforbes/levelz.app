import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
	{
		path: "/",
		name: "Home",
		component: () => import("../home/views/HomePage.vue")
	},
	{
		path: "/about",
		name: "About",
		component: () => import("../about/views/AboutPage.vue")
	},
	{
		path: "/contact",
		name: "Contact",
		component: () => import("../contact/views/ContactPage.vue")
	},
	{
		path: "*",
		component: () => import("../app/views/Error404.vue")
	},
	{
		path: "/dev",
		name: "DevPage",
		component: () => import("../dev/views/DevPage.vue")
	},
	{
		path: "/dashboard",
		name: "DashboardPage",
		component: () => import("../user/views/DashboardPage.vue")
	},
	{
		path: "/account",
		name: "AccountPage",
		component: () => import("../user/views/AccountPage.vue")
	},
	{
		path: "/activities",
		name: "ActivitesPage",
		component: () => import("../activities/views/ActivitiesPage.vue")
	},
	{
		path: "/tasks",
		name: "TasksPage",
		component: () => import("../tasks/views/TasksPage.vue")
	},
	{
		path: "/quests",
		name: "QuestsPage",
		component: () => import("../quests/views/QuestsPage.vue")
	},
	{
		path: "/inventory",
		name: "InventoryPage",
		component: () => import("../inventory/views/InventoryPage.vue")
	},
	{
		path: "/financials",
		name: "FinancialsPage",
		component: () => import("../financials/views/FinancialsPage.vue")
	},
	{
		path: "/travel",
		name: "TravelPage",
		component: () => import("../travel/views/TravelPage.vue")
	}
];

const router = new VueRouter({
	mode: "history",
	base: process.env.BASE_URL,
	routes: routes
});

export default router;
