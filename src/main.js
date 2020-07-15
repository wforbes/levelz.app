import Vue from "vue";
import App from "./app/views/App.vue";
import "./registerServiceWorker";
import router from "./router";
import store from "./store";
import vuetify from "./plugins/vuetify";
import VueLodash from "vue-lodash";
import lodash from "lodash";
import PerfectScrollbar from "vue2-perfect-scrollbar";
import "vue2-perfect-scrollbar/dist/vue2-perfect-scrollbar.css";
import "@fortawesome/fontawesome-free/css/all.css";

/*
import { library } from "@fortawesome/fontawesome-svg-core";
import { faScroll } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
*/
Vue.use(VueLodash, { lodash: lodash });
Vue.use(PerfectScrollbar);

//library.add(faScroll);
//Vue.use("font-awesome-icon", FontAwesomeIcon);

Vue.config.productionTip = false;

new Vue({
	router,
	store,
	vuetify,
	render: h => h(App)
}).$mount("#app");
