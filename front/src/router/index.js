import { createRouter, createWebHistory } from 'vue-router';
import PageNotFound from '@/views/PageNotFound.vue';


const routes = [

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
  {
    path: '/session_end',
    name: 'SessionExpired',
    component: () => import(/* webpackChunkName: "SessionExpired" */ '../views/SessionExpired.vue'),
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
  const userRole = parseInt(localStorage.getItem('role')); // Assurez-vous de convertir en entier
  console.log('User role:', userRole);
  console.log('Is admin route:', to.meta.requiresAdmin);

  const isAdminRoute = to.matched.some(record => record.meta.requiresAdmin);

  if (isAdminRoute) {
    if (userRole !== 555 && userRole !== 745) {
      console.log('Access denied for admin route');
      next({ name: 'ForbiddenAccess' });
    } else {
      console.log('Access granted for admin route');
      next();
    }
  } else {
    console.log('Not an admin route');
    next();
  }
});



export default router;
