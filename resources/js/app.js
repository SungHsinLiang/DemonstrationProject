/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * This is for google map
 */
import * as VueGoogleMaps from "vue2-google-maps";

Vue.use(VueGoogleMaps, {
	load: {
		key: "AIzaSyDNiSnmDS-OsDEqtw13VAnfHG6Cn4Lxihw",
		libraries: "places" // This is required if you use the Autocomplete plugin
		// OR: libraries: 'places,drawing'
		// OR: libraries: 'places,drawing,visualization'
		// (as you require)

		//// If you want to set the version, you can do so:
		// v: '3.26',
	}
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
	"example-component",
	require("./components/ExampleComponent.vue").default
);
Vue.component("test-vue", require("./components/test/TestVue.vue").default);

Vue.component(
	"nav-purchase-cart",
	require("./components/NavPurchaseCart.vue").default
);
// Vue.component("show-purchase-list", require("./components/ShowPurchaseList.vue").default);
Vue.component(
	"purchase-cart-show",
	require("./components/purchase_carts/Show.vue").default
);

Vue.component("orders-index", require("./components/orders/Index.vue").default);
Vue.component("orders-show", require("./components/orders/Show.vue").default);

Vue.component(
	"home-carousel",
	require("./components/home/Carousel.vue").default
);

Vue.component(
	"edite-carousel",
	require("./components/administrators/EditeCarousel.vue").default
);

Vue.component(
	"men-left-navbar",
	require("./components/men/LeftNavbar.vue").default
);
Vue.component(
	"women-left-navbar",
	require("./components/women/LeftNavbar.vue").default
);

Vue.component(
	"product-categories-create",
	require("./components/products/categories/Create.vue").default
);
Vue.component(
	"product-styles-create",
	require("./components/products/styles/Create.vue").default
);
Vue.component(
	"product-create",
	require("./components/products/Create.vue").default
);
Vue.component(
	"product-show",
	require("./components/products/Show.vue").default
);

Vue.component(
	"about_me-index",
	require("./components/about_me/Index.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
	el: "#app"
});
