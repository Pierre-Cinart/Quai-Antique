// Import des dépendances de base
import { createApp } from 'vue';

// Import des fichiers CSS nécessaires
import 'bootstrap/dist/css/bootstrap.css';

// Import de l'application principale (App.vue), Vue Router et le store Vuex
import App from './App.vue';
import router from './router';
import store from './store';
import userStore from './store/user.js';


// Création de l'application Vue
const app = createApp(App);

// Utilisation des plugins Vue Router et Vuex
app.use(router);
app.use(store);
app.use(userStore);

// Montage de l'application sur l'élément avec l'id "app" dans le DOM
app.mount('#app');
