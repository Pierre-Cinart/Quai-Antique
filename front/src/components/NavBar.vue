<template>
  <header>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg bg-custom">
      <div class="container-fluid">
        <!-- Logo à gauche -->
        <div>
          <router-link to="/" class="navbar-brand">
            <!-- Insérez votre logo ici -->
            <img src="@/assets/logo.png" alt="logo restaurant" style="border-radius: 50%;">
          </router-link>
        </div>

        <!-- Bouton de bascule à droite pour les petits écrans -->
        <button class="navbar-toggler" type="button" @click="toggleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liens de navigation à droite -->
        <div :class="{'show': navbarOpen}" class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <!-- Lien vers la page d'accueil -->
            <li class="nav-item">
              <router-link to="/" class="nav-link active">Accueil</router-link>
            </li>
            <!-- Lien vers la page de consultation de la carte des menus -->
            <li class="nav-item">
              <router-link to="/carte-menus" class="nav-link" style="font-weight: bolder;">Consulter La Carte</router-link>
            </li>
            <!-- Lien vers la page de réservation de table -->
            <li class="nav-item">
              <router-link to="/reservation" class="nav-link" style="font-weight: bolder;">Réserver Une Table</router-link>
            </li>
            <!-- Lien dynamique en fonction de la connexion de l'utilisateur -->
            <li v-if="isLoggedIn" class="nav-item">
              <!-- Si l'utilisateur est connecté, affiche un bouton pour se déconnecter -->
              <router-link to="/" class="nav-link" @click="logoutAndRefresh">Se déconnecter</router-link>
            </li>
            <li v-else class="nav-item">
              <!-- Si l'utilisateur n'est pas connecté, affiche le lien vers la page de connexion -->
              <router-link to="/authentification" class="nav-link">Se connecter</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import router from '@/router';

export default {
  data() {
    return {
      navbarOpen: false
    };
  },
  computed: {
    isLoggedIn() {
      return this.$store.getters.getUserRole !== null;
    }
  },
  methods: {
    toggleNavbar() {
      this.navbarOpen = !this.navbarOpen;
    },
    logoutAndRefresh() {
      // Supprimer les données d'utilisateur du localStorage
      localStorage.removeItem('jwt');
      localStorage.removeItem('id');
      localStorage.removeItem('role');
      localStorage.removeItem('userData');
      // Déconnexion de l'utilisateur
      this.$store.commit('resetUserData');
      // Rediriger vers la page d'accueil
      router.push('/');
    },
    restoreUserFromLocalStorage() {
      const userData = JSON.parse(localStorage.getItem('userData'));
      if (userData) {
        this.$store.commit('setUserData', userData);
      }
    }
  },
  mounted() {
    // Restaurer les données de l'utilisateur depuis le localStorage lors du montage du composant
    this.restoreUserFromLocalStorage();
  }
};
</script>

<style scoped>
/* Styles CSS pour la barre de navigation */
header {
  font-size: 25px;
  font-family: 'Dancing Script', cursive;
  user-select: none;
  border: solid 2px #523e15;
}
.navBar {
  display: flex;
  justify-content: space-between;
  align-items: center; /* Centrer verticalement les éléments */
}
img {
  width: 80px;
}
.nav-item {
  margin: 10px;
}
.nav-item:hover {
  font-weight: bolder;
}
.nav-link {
  color: rgb(40, 105, 34);
}
/* Ajoutez une règle de media query pour les écrans plus petits */
@media (max-width: 767px) {
  .nav-item {
    width: 100%;
  }
}
/* Style personnalisé pour le fond de la navbar */
.bg-custom {
  background-color: #ddae48b9; 
}
</style>
