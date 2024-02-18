import { createRouter, createWebHistory } from 'vue-router';
import PageNotFound from '@/views/PageNotFound.vue';
import store from '@/store/user'; // Importez le store user.js

const routes = [
  // ... autres routes

  {
    path: '/authentification',
    name: 'AuthPage',
    component: () => import(/* webpackChunkName: "AuthPage" */ '../views/AuthPage.vue'),
  },
  {
    path: '/',
    name: 'HomePage',
    component: () => import(/* webpackChunkName: "HomePage" */ '../views/HomePage.vue'),
  },
  {
    path: '/reservation',
    name: 'ReservationPage',
    component: () => import(/* webpackChunkName: "ReservationPage" */ '../views/ReservationPage.vue'),
  },
  {
    path: '/carte-menus',
    name: 'MenuPage',
    component: () => import(/* webpackChunkName: "MenuPage" */ '../views/MenuPage.vue'),
  },
  //admin
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: () => import(/* webpackChunkName: "Dashboard" */ '../views/admin/DashBoard.vue'),
    meta: { requiresAdmin: true } // Indique que cette route nécessite le rôle d'administrateur
  },
  {
    path: '/forbidden',
    name: 'ForbiddenAccess',
    component: () => import(/* webpackChunkName: "ForbiddenAccess" */ '../views/ForbiddenAccess.vue'),
  },
  // Route 404
  {
    path: '/:catchAll(.*)',
    component: PageNotFound
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach((to, from, next) => {
  const userRole = store.state.userData ? store.state.userData.role : null;
  const isAdminRoute = to.matched.some(record => record.meta.requiresAdmin);

  // Vérifier si l'utilisateur a accès à la route d'administration
  if (isAdminRoute) {
    if (userRole !== 'admin' && userRole !== 'super admin') {
      // Rediriger vers la page d'erreur 403 si l'accès est interdit
      next({ name: 'ForbiddenAccess' });
    } else {
      // Continuer vers la route demandée si l'accès est autorisé
      next();
    }
  } else {
    // Si ce n'est pas une route d'administration, continuer normalement
    next();
  }
});


export default router;
