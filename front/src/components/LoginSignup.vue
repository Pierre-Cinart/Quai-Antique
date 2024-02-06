<template>
    <div class="login-signup-form container">
      <h2>Connexion</h2>
      <form @submit.prevent="login">
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
        <div class="mb-3">
          <label for="registerEmail" class="form-label">Email:</label>
          <input v-model="registerData.email" type="email" class="form-control" id="registerEmail" required />
        </div>
        <div class="mb-3">
          <label for="registerPassword" class="form-label">Mot de passe:</label>
          <input v-model="registerData.password" type="password" class="form-control" id="registerPassword" pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[!+-=?#]).{8,}$" title="Le mot de passe doit contenir au moins 1 majuscule, 1 chiffre, 1 symbole et être d'au moins 8 caractères" required />
        </div>
        <div class="mb-3">
          <label for="confirmPassword" class="form-label">Confirmer le mot de passe:</label>
          <input v-model="registerData.confirmPassword" type="password" class="form-control" id="confirmPassword" required />
        </div>
        <div class="mb-3">
          <label for="registerFirstName" class="form-label">Nom:</label>
          <input v-model="registerData.firstName" type="text" class="form-control" pattern="[A-Za-z]{3,}" title="Au moins 3 lettres" required />
        </div>
        <div class="mb-3">
          <label for="registerLastName" class="form-label">Prénom:</label>
          <input v-model="registerData.lastName" type="text" class="form-control" pattern="[A-Za-z]{3,}" title="Au moins 3 lettres" required />
        </div>
        <button type="submit" class="btn btn-success">S'inscrire</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        loginData: {
          email: '',
          password: '',
        },
        registerData: {
          email: '',
          password: '',
          confirmPassword: '',
          firstName: '',
          lastName: '',
        },
      };
    },
    methods: {
      login() {
        console.log('Tentative de connexion:', this.loginData);
        // Vous pouvez ajouter des logiques ici pour simuler une action de connexion
      },
      register() {
        console.log('Tentative d\'inscription:', this.registerData);
        // Vous pouvez ajouter des logiques ici pour simuler une action d'inscription
      },
    },
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
    margin-bottom:15px;
    width: 80%;
    max-width: 500px;
  }
 
  </style>
  