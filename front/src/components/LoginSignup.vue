<template>
  <div class="login-signup-form container">
    <h2>Connexion</h2>
    <form @submit.prevent="login">
       <!-- Affichage de l'erreur -->
    <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
      <div class="mb-3">
        <label for="loginEmail" class="form-label">Email:</label>
        <input v-model="loginData.email" type="email" class="form-control" id="loginEmail" required />
      </div>
      <div class="mb-3">
        <label for="loginPassword" class="form-label">Mot de passe:</label>
        <input v-model="loginData.password" type="password" class="form-control" id="loginPassword" required />
      </div>
      <button type="submit" class="btn btn-success">Se connecter</button>
    </form>
    <br>
    <div class="sep"></div>
    <br>
    <h2>Inscription</h2>
    <form @submit.prevent="register">
      <!-- Formualire d'inscription -->
    </form>
   
  </div>
</template>

<script>
import { ref } from 'vue';
import { useStore } from 'vuex';
import router from '@/router';

export default {
  setup() {
    const store = useStore();
    const loginData = ref({
      email: '',
      password: ''
    });
    const errorMessage = ref('');

    const login = async () => {
      try {
        const response = await store.dispatch('fetchUserData', loginData.value);
        // Vérifier si la réponse contient des données valides
        if (response && response.role !== null) {
          // Authentification réussie, rediriger vers la page d'accueil
          router.push('/');
        } else {
          // Afficher un message d'erreur approprié
          errorMessage.value = "Identifiant ou mot de passe incorrect";
        }
      } catch (error) {
        console.error('Erreur lors de la connexion:', error);
        // Gérer les erreurs de connexion
        errorMessage.value = "Erreur lors de la connexion. Veuillez réessayer.";
      }
    };

    const register = async () => {
      // Logique d'inscription
    };

    return {
      loginData,
      errorMessage,
      login,
      register
    };
  }
};
</script>

<style scoped>
/* LoginSignupForm */
.login-signup-form {
  background-color: #ddae48c2;
  border: solid 2px #523e15;
  border-radius: 5px;
  margin: auto;
  margin-top: 15px;
  width: 80%;
  max-width: 500px;
}
</style>
