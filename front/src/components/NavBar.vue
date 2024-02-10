<template>
  <header>
    <nav class="navbar navbar-expand-lg bg-custom">
      <div class="container-fluid navBar">
        <!-- Logo à gauche -->
        <div>
          <router-link to="/" class="navbar-brand">
            <img src="@/assets/logo.png" alt="logo restaurant" style = "border-radius: 50%;">
          </router-link>
        </div>

        <!-- Bouton de bascule à droite -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liens de navigation à droite -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <router-link to="/" class="nav-link active">Accueil</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/carte-menus" class="nav-link" style="font-weight: bolder;">Consulter La Carte</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/reservation" class="nav-link" style="font-weight: bolder;">Réserver Une Table</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/authentification" class="nav-link">Se connecter</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
</template>

<style scoped>
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
.nav-link{
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
