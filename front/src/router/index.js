import { createRouter, createWebHistory } from 'vue-router';


const routes = [
  // ... autres routes

  {
    path: '/authentification',
    name: 'AuthPage',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "AuthPage" */ '../views/AuthPage.vue'),
  },
  {
    path: '/',
    name: 'HomePage',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "HomePage" */ '../views/HomePage.vue'),
  },
  {
    path: '/reservation',
    name: 'ReservationPage',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "ReservationPage" */ '../views/ReservationPage.vue'),
  },
  {
    path: '/carte-menus',
    name: 'MenuPage',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "MenuPage" */ '../views/MenuPage.vue'),
  },
 
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
