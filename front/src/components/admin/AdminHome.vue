<template>
  <!-- Gestion admin images page d 'acceuil -->
  <div>
    <h4>Modifier les plats présentés à l'accueil</h4>
    <section class="admin-accueil">
      <div v-for="(image, index) in homeImages" :key="'home-' + index">
        <img :src="image.path" :alt="image.alt" @click="replaceImage(image.path)" />
      </div>
    </section>
    <h6>cliquez sur l'image à modifier <br> puis selectionnez une nouvelle image pour la remplacée</h6>
    <section class="other-images">
      <div v-for="(image, index) in otherImages" :key="'other-' + index">
        <img :src="image.path" :alt="image.dish_id" @click="replaceImage(image.path)" />
      </div>
    </section>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'AdminHome',
  data() {
    return {
      homeImages: [],
      otherImages: [],
    };
  },
  mounted() {
    const homeImagesEndpoint = `${process.env.VUE_APP_API_URL}/img_home.php`;
    axios.get(homeImagesEndpoint)
      .then(response => {
        this.homeImages = response.data;
      })
      .catch(error => {
        console.error("Erreur lors de la récupération des images de l'accueil", error);
      });

    const otherImagesEndpoint = `${process.env.VUE_APP_API_URL}/list_dishes.php`;
    axios.get(otherImagesEndpoint)
      .then(response => {
        this.otherImages = response.data;
      })
      .catch(error => {
        console.error("Erreur lors de la récupération des autres images de plats", error);
      });
  },
  methods: {
    replaceImage(path) {
      // Faites quelque chose pour remplacer l'image d'accueil avec 'path'
      console.log('Image sélectionnée:', path);
    }
  }
};
</script>

<style scoped>
*{
  text-align: center;
  width:50%;
  min-width: 200px;
  margin: auto;
}
section,
h4 {
  margin: auto;
  text-decoration: underline;
}


.admin-accueil,
.other-images {
  overflow-x: scroll;
  display: flex;
  margin: auto;
}
.admin-accueil{
  padding: 10px;
  background-color: rgba(0, 0, 0, 0.336);
  border: solid 1 px black;
}
.other-images {
 
 
}

img {
  width: 100px;
  margin: 5px;
  border: solid 1px black;
}
img:hover{
  cursor: pointer;
}
</style>
