<template>
  <div class="profile-page">
    <div class="bubble"></div>
    <div class="user-info">
      <h4>Nom: {{ userInfo.first_name }}</h4>
      <h4>Prénom: {{ userInfo.last_name }}</h4>
    </div>
    <form class="personal-info-form" @submit.prevent="updateUserInfo">
      <h2>Informations personnelles</h2>
      <div class="form-group">
        <label for="password">Nouveau mot de passe:</label>
        <input type="password" id="password" v-model="newPassword">
      </div>
      <div class="form-group">
        <label for="tel">Téléphone:</label>
        <input type="tel" id="tel" v-model="userInfo.tel">
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" v-model="userInfo.email">
      </div>
      <div class="form-group">
        <label for="guests">Nombre de couverts:</label>
        <input type="number" id="guests" v-model="userInfo.number_of_guests" min="1" max="15">
      </div>
      <div class="form-group">
        <label for="allergies">Allergies:</label>
        <input type="text" id="allergies" v-model="userInfo.allergies">
      </div>
      <button class = "btn btn-success" type="submit">Enregistrer</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name : 'ProfilPage',
  data() {
    return {
      userInfo: {},
      newPassword: '',
      jwt: localStorage.getItem('jwt'),
      userId: localStorage.getItem('id')
    };
  },
  methods: {
    async updateUserInfo() {
      try {
        // Update user info
        await axios.post('http://localhost/api/update_user_info.php', {
          id: this.userId,
          jwt: this.jwt,
          newPassword: this.newPassword,
          tel: this.userInfo.tel,
          email: this.userInfo.email,
          number_of_guests: this.userInfo.number_of_guests,
          allergies: this.userInfo.allergies
        });
        // Optionally, you can reload the user info after updating
        const response = await axios.get(`http://localhost/api/get_user_info.php?id=${this.userId}&jwt=${this.jwt}`);
        this.userInfo = response.data;
        // Optionally, notify the user that the update was successful
        alert('Informations mises à jour avec succès!');
      } catch (error) {
        console.error('Erreur lors de la mise à jour des informations utilisateur:', error);
        alert('Erreur lors de la mise à jour des informations utilisateur. Veuillez réessayer.');
      }
    }
  }
};
</script>

<style scoped>
.profile-page {
  
  width: 50%;
  margin: auto;
  margin-top: 10px;
  background-color: aliceblue;
  border-radius: 10%;
  border: solid 1px black;
  padding: 20px;
  display: flex;
  align-items: center; /* Aligner les éléments verticalement */
}

.bubble {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background-color: #ccc; /* Couleur de la bulle */
  margin-right: 20px; /* Espace à droite de la bulle */
  border: solid 1px black;
}

.user-info {
  margin-right: auto; /* Pousse le contenu vers la gauche */
}

.personal-info-form {
  width: 60%; /* Largeur du formulaire */
}

.form-group {
  margin-bottom: 10px; /* Espacement entre les groupes de formulaire */
}

label {
  display: block; /* Afficher les labels en bloc (un en-dessous de l'autre) */
  font-size: 18px;
  font-weight: bold;
}

input, textarea {
  width: 100%; /* Remplir l'espace disponible */
}
</style>
