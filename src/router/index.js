import Vue from "vue";
import VueRouter from "vue-router";
import goTo from "vuetify/es5/services/goto";
import store from "@/store/index.js";

Vue.use(VueRouter);

const routes = [
	{
		path: "/",
		name: "HomePage",
		component: () =>
			import(/* webpackChunkName: "bundle-Home" */ "@/home/views/HomePage.vue")
	},
	{
		path: "/about",
		name: "About",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Home" */ "@/about/views/AboutPage.vue"
			)
	},
	{
		path: "/white-paper",
		name: "WhitePaperPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Home" */ "@/about/views/WhitePaperPage.vue"
			)
	},
	{
		path: "/contact",
		name: "Contact",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Home" */ "@/contact/views/ContactPage.vue"
			)
	},
	{
		path: "/help",
		name: "Help",
		component: () =>
			import(/* webpackChunkName: "bundle-Home" */ "@/help/views/HelpPage.vue")
	},
	{
		path: "/help/:topic",
		component: () =>
			import(/* webpackChunkName: "bundle-Home" */ "@/help/views/HelpPage.vue")
	},
	{
		path: "/auth",
		name: "Auth",
		component: () =>
			import(/* webpackChunkName: "bundle-Home" */ "@/auth/views/AuthPage.vue"),
		alias: ["/login", "/signup", "/verify", "/logout"],
		props: route => ({
			route: route.path,
			email: route.query.e,
			hash: route.query.h
		})
	},
	{
		path: "*",
		component: () =>
			import(/* webpackChunkName: "bundle-Home" */ "@/app/views/Error404.vue")
	},
	{
		path: "/no-access",
		name: "NoAccessPage",
		component: () => import("@/app/views/NoAccessPage.vue")
	},
	{
		path: "/admin",
		name: "AdminPage",
		component: () => import("@/admin/views/AdminPage.vue")
	},
	{
		path: "/dev",
		name: "DevPage",
		component: () => import("@/dev/views/DevPage.vue"),
		beforeEnter: async function(to, from, next) {
			const hasPermission = await store.dispatch({
				type: "hasPermission",
				action: "route",
				object: "developer_page"
			});
			if (hasPermission === true) {
				next();
			} else {
				next({ path: "/no-access" });
			}
		}
	},
	{
		path: "/dashboard",
		name: "DashboardPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Dashboard" */ "@/user/views/DashboardPage.vue"
			)
	},
	{
		path: "/account",
		name: "AccountPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Dashboard" */ "@/user/views/AccountPage.vue"
			)
	},
	{
		path: "/activities",
		name: "ActivitesPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Activities" */ "@/activities/views/ActivitiesPage.vue"
			)
	},
	{
		path: "/tasks",
		name: "TasksPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Tasks" */ "@/tasks/views/TasksPage.vue"
			)
	},
	{
		path: "/quests",
		name: "QuestsPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Tasks" */ "@/quests/views/QuestsPage.vue"
			)
	},
	{
		path: "/inventory",
		name: "InventoryPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Inventory" */ "@/inventory/views/InventoryPage.vue"
			)
	},
	{
		path: "/financials",
		name: "FinancialsPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Financials" */ "@/financials/views/FinancialsPage.vue"
			)
	},
	{
		path: "/travel",
		name: "TravelPage",
		component: () =>
			import(
				/* webpackChunkName: "bundle-Travel" */ "@/travel/views/TravelPage.vue"
			)
	}
];

const router = new VueRouter({
	mode: "history",
	base: process.env.BASE_URL,
	routes: routes,
	scrollBehavior: (to, from, savedPosition) => {
		let scrollTo = 0;

		if (to.hash) {
			scrollTo = to.hash;
		} else if (savedPosition) {
			scrollTo = savedPosition.y;
		}

		return goTo(scrollTo, {
			duration: 942,
			offset: 64,
			easing: "easeInOutCubic"
		});
	}
});

export default router;
