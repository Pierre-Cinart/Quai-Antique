<template>
  <div id = 'dashboard'>

    <div class="admin-title">
      <h1>Dashboard</h1>
    <p>Page réservée aux administrateurs</p>
    </div>

    <!--Gestion images page d 'acceuil-->
    <h2>Modifier les plats présentés à l'accueil</h2>
    <section class="admin-accueil">
      <div v-for="(image, index) in images" :key="index">
        <img :src="'/images/dishes/' + image.src" :alt="image.alt" />
      </div>
    </section>

    <!--Gestion des reservations-->
    <section class="admin-reserv">
       <p>requete des reservations et possibilité de les supprimer</p>
    </section>

    <!--Gestion des horraires-->
    <section class="admin-horraire">
      <p>requete des horraires et possibilité de les modifier</p>
    </section>
  </div>
</template>

<script>
import axios from 'axios';

export default {
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
  #dashboard {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: aliceblue;
    display: flex;
    flex-direction: column;
  }
  img {
    width: 100px;
    margin:5px;
    border: solid 1px black;
  }
  .admin-title {
    user-select: none;
    background-color: rgba(0, 0, 0, 0.212);
    width:210px;
    line-height: 15px;
    border: solid 1px black;
    text-align: center;
    margin: auto;
  }
  .admin-title h2{
    font-weight:bolder;
  }
  .admin-title p{
    color: red;
  }
  .admin-accueil {
    display: flex;
  }

</style>
