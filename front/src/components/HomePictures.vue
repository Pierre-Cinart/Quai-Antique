<template>
  <div>
    <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
      <div class="carousel-inner">
        <div v-for="(image, index) in images" :key="index" :class="{ 'carousel-item': true, 'active': index === 0 }">
          <img :src="'/images/' + image.src" :alt="image.alt" :title="image.alt" class="d-block w-100" />
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
        console.error("erreur lors de la récupérations d ' images'", error);
      });
  },
};
</script>

<style>
  #imageCarousel {
    padding: 10px;
    max-width: 500px;
    margin: 0 auto;
  }

  .carousel-inner {
    .carousel-item {
      display: none;
      position: relative;
      opacity: 0;
    }

    .carousel-item.active {
      display: block;
      opacity: 1;
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

    img::after {
      content: attr(title);
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      background: rgba(0, 0, 0, 0.7);
      color: #fff;
      padding: 10px;
      box-sizing: border-box;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
    }

    img:hover::after {
      opacity: 1;
    }
  }
</style>
