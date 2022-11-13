import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import HomePage from "./pages/HomePage.vue";

import NotFound from "./pages/NotFound.vue";

import RestaurantMenuPage from "./pages/RestaurantMenuPage";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: HomePage,
        },
        {
            path: "/restaurants/:slug",
            name: "restaurant-menu",
            component: RestaurantMenuPage,
        },

        //not-found page must be last or on refresh on an existing page it shows up. To check!!!
        {
            path: "/*",
            name: "not-found",
            component: NotFound,
        },
    ],
});

export default router;
