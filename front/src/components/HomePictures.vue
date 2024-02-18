<template>
  <div>
    <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
      <div class="carousel-inner">
        <div v-for="(image, index) in images" :key="index" :class="{ 'carousel-item': true, 'active': index === 0 }">
          <div class="carousel-item-content">
            <img :src="'/images/dishes/' + image.src" :alt="image.alt" class="d-block w-100" />
            <div class="carousel-item-overlay">
              <h3>{{ image.title }}</h3>
              <p>{{ image.price }} €</p>
              <router-link to="/reservation" class="btn-reserv">Réserver une table</router-link>
            </div>
          </div>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { Carousel } from 'bootstrap'; // Importer le module Carousel de Bootstrap

export default {
  data() {
    return {
      images: [],
      carousel: null, // Déclarer la variable pour stocker l'instance du carrousel
    };
  },
  mounted() {
    const apiEndpoint = `${process.env.VUE_APP_API_URL}/img_home.php`;
    axios.get(apiEndpoint)
      .then(response => {
        this.images = response.data;

        // Initialisation du carrousel Bootstrap
        this.$nextTick(() => {
          // Stocker l'instance du carrousel dans la variable 'carousel'
          this.carousel = new Carousel(document.getElementById('imageCarousel'), {
            interval: 3500
          });
        });
      })
      .catch(error => {
        console.error("Erreur lors de la récupération d'images", error);
      });
  },
};
</script>

<style>
 #imageCarousel {
  padding: 10px;
  max-width: 500px;
  margin: auto;
  margin-bottom: 15px;
  position: relative;
}

.carousel-control-prev,
.carousel-control-next {
  width: auto;
  background-color: rgba(0, 0, 0, 0.5);
}

.carousel-control-prev {
  left: -45px; /* Ajustez la position à gauche */
}

.carousel-control-next {
  right: -45px; /* Ajustez la position à droite */
}

.carousel-inner .carousel-item {
  display: none;
  position: relative;
  opacity: 0;
  transition: opacity 0.5s ease-in-out;
}

.carousel-inner .carousel-item.active {
  display: block;
  opacity: 1;
}

.carousel-item-content {
  position: relative;
}

.carousel-item-overlay {
  position: absolute;
  bottom: 20px;
  left: 20px;
  background-color: rgba(0, 0, 0, 0.5);
  padding: 10px;
  border-radius: 5px;
  color: white;
  display: none;
}

.carousel-item-content:hover .carousel-item-overlay {
  display: block;
}

img {
  width: 100%;
  height: auto;
  border-radius: 5px;
  transition: opacity 0.5s ease-in-out;
}

img:hover {
  opacity: 0.8;
  cursor: pointer;
}
</style>
