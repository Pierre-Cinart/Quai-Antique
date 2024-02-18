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
      <!-- Formulaire d'inscription -->
    
      <div class="mb-3">
        <label for="signupFirstName" class="form-label">Prénom:</label>
        <input v-model="signupData.firstName" type="text" class="form-control" id="signupFirstName" required />
      </div>
      <div class="mb-3">
        <label for="signupLastName" class="form-label">Nom:</label>
        <input v-model="signupData.lastName" type="text" class="form-control" id="signupLastName" required />
      </div>
      <div class="mb-3">
        <label for="signupEmail" class="form-label">Email:</label>
        <input v-model="signupData.email" type="email" class="form-control" id="signupEmail" required />
      </div>
      <div class="mb-3">
        <label for="signupTel" class="form-label">Téléphone:</label>
        <input v-model="signupData.tel" type="tel" class="form-control" id="signupTel"  />
      </div>
      <div class="mb-3">
        <label for="signupPassword" class="form-label">Mot de passe:</label>
        <input v-model="signupData.password" type="password" class="form-control" id="signupPassword" required />
      </div>
      <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirmer le mot de passe:</label>
        <input v-model="signupData.confirmPassword" type="password" class="form-control" id="confirmPassword" required />
      </div>
      <div class="mb-3">
        <label for="allergies" class="form-label">Allergies:</label>
        <input v-model="signupData.allergies" type="text" class="form-control" id="allergies" />
      </div>
      <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
    <!-- message d erreur -->
    <p v-if="errorMessageSignup" class="error-message">{{ errorMessageSignup }}</p>
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
    const signupData = ref({
      firstName: '',
      lastName: '',
      email: '',
      tel: '',
      password: '',
      confirmPassword: '',
      allergies: ''
    });
    const errorMessage = ref('');
    const errorMessageSignup = ref('');

    const login = async () => {
      try {
        const response = await store.dispatch('fetchUserData', loginData.value);
        // Vérifier si la réponse contient des données valides
        if (response && response.role !== null) {
          const jwt = response.jwt;
          window.localStorage.setItem('jwt', jwt);
          // Afficher le JWT dans la console pour vérification
          console.log('JWT dans le localStorage :', jwt);

          if (response.role == 'admin' || response.role == 'super admin'){
            // Enregistrer le JWT dans le localStorage
            router.push('/dashboard');
          } else {
            router.push('/');
          }
          // Authentification réussie, rediriger vers la page d'accueil
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
  try {
    // Validation du prénom
    if (!/^[a-zA-Z]{3,}$/.test(signupData.value.firstName)) {
      throw new Error("Le prénom doit contenir au moins trois caractères alphabétiques.");
    }
    
    // Validation du nom
    if (!/^[a-zA-Z]{3,}$/.test(signupData.value.lastName)) {
      throw new Error("Le nom doit contenir au moins trois caractères alphabétiques.");
    }

    // Validation du téléphone 
    if (!/^\d+$/.test(signupData.value.tel) && signupData.value.tel!="") {
      throw new Error("Le numéro de téléphone ne doit contenir que des chiffres.");
    }
    // Validation du mot de passe
    if (!/(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}/.test(signupData.value.password)) {
      throw new Error("Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, un chiffre et un symbole.");
    }

    if (signupData.value.password != signupData.value.confirmPassword) {
      throw new Error("Les mots de passe ne correspondent pas . ");
    }
    router.push('/');
    // Logique pour envoyer les données d'inscription au serveur si la validation réussit
    console.log('Données d\'inscription :', signupData.value);
  } catch (error) {
    console.error('Erreur lors de l\'inscription:', error);
    errorMessageSignup.value = error.message;
  }
};

    return {
      loginData,
      signupData,
      errorMessage,
      errorMessageSignup,
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
