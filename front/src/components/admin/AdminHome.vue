
<template>
    <!--Gestion admin images page d 'acceuil-->
    <h2>Modifier les plats présentés à l'accueil</h2>
    <section class="admin-accueil">
    <div v-for="(image, index) in images" :key="index">
        <img :src="'/images/dishes/' + image.src" :alt="image.alt" />
    </div>
    </section>
</template>
<script>
import axios from 'axios';

export default {
    name : 'AdminHome',
  data() {
    return {
      images: [],
    };
  },
  mounted() {
    const apiEndpoint = `${process.env.VUE_APP_API_URL}/img_home.php`;
    axios.get(apiEndpoint)
      .then(response => {
        this.images = response.data;
      })
      .catch(error => {
        console.error("Erreur lors de la récupération d'images", error);
      });
  },
};
</script>

<style scoped>
 section , h2 {
    margin:auto;
  }
  h2{
    text-decoration :underline;
  }
.admin-accueil {
    display: flex;
  }
  img {
    width: 100px;
    margin:5px;
    border: solid 1px black;
  }
</style>