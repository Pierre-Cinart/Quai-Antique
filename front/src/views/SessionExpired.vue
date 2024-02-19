<template>
    <div class="session-expired">
      <div class="message">Votre session a expiré. Veuillez vous reconnecter.</div>
     
      <router-link to="/authentification" class="reconnect-btn">Reconnecter</router-link>
    </div>
  </template>
  
  <script>
  import { mapMutations } from 'vuex'; // Importez mapMutations depuis vuex
  
  export default {
    name: 'SessionExpired',
    methods: {
      ...mapMutations(['resetUserData']), // Utilisation sans namespace si le module n'a pas de namespace
      logout() {
        // Supprimer les données utilisateur du stockage local
        localStorage.removeItem('userData');
        localStorage.removeItem('jwt');
        localStorage.removeItem('id');
        localStorage.removeItem('role');
  
        // Appeler la fonction reset du store user pour réinitialiser les données utilisateur
        this.resetUserData();
      }
    },
    mounted() {
      // Déconnexion automatique lors du montage de la page
      this.logout();
    }
  };
  </script>
  
  
  
  <style scoped>
  .session-expired {
    width: 75%;
    margin: auto;
    margin-top: 10px;
    text-align: center;
    background-color: red;
    color: aliceblue;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 70vh;
  }
  
  .message {
    font-size: 30px;
    margin-bottom: 20px;
  }
  
  .logout-btn {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 1.2rem;
    cursor: pointer;
    background-color: #333;
    color: white;
    border: none;
    border-radius: 5px;
  }
  
  .reconnect-btn {
    margin-top: 10px;
    font-size: 1.2rem;
    text-decoration: none;
    padding: 10px 20px;
    background-color: black;
    color: white;
    border: none;
    border-radius: 5px;
  }
  </style>
  