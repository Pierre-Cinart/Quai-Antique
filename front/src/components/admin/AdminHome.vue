<template>
  <!-- Section de gestion des images pour la page d'accueil d'administration -->
  <h4>Modifier les plats présentés à l'accueil</h4>
  <div class="img-home">
    <!-- Section pour afficher les images d'accueil -->
    <section class="admin-accueil">
      <!-- Affichage des images de la première div -->
      <div v-for="(image, index) in homeImages" :key="'home-' + index">
        <!-- Affichage de l'image avec gestion du clic pour la sélection -->
        <img 
          :src="image.path" 
          :alt="image.title" 
          @click="selectImage(image.home_picture_id)" 
          :class="{ 'selected': selectedImage === image.home_picture_id }" 
        />
      </div>
    </section>
  </div>
  <h6>cliquez sur l'image à modifier <br> puis selectionnez une nouvelle image pour la remplacée</h6>
  <!-- Section pour afficher les  images disponibles pour la modif-->
  <section class="other-images">
    <!-- Affichage des images de la deuxième div -->
    <div v-for="(image, index) in otherImages" :key="'other-' + index">
      <!-- Affichage de l'image avec gestion du clic pour le remplacement -->
      <img 
        :src="image.path" 
        :alt="image.title" 
        @click="selectReplaceImage(image.dish_id)" 
        :class="{ 'selected-replace': selectedReplaceImage === image.dish_id }"
      />
    </div>
  </section>
</template>

<script>
import axios from 'axios';

export default {
  name: 'AdminHome',
  data() {
    return {
      homeImages: [], // Tableau pour stocker les images de la première div
      otherImages: [], // Tableau pour stocker les images de la deuxième div
      selectedImage: null, // ID de l'image sélectionnée dans la première div
      selectedReplaceImage: null // ID de l'image sélectionnée dans la deuxième div pour le remplacement
    };
  },
  mounted() {
    // Chargement des images d'accueil et des autres images disponibles
    this.fetchHomeImages();
    this.fetchOtherImages();
  },
  methods: {
    // Fonction pour récupérer les images d'accueil depuis l'API
    fetchHomeImages() {
      const homeImagesEndpoint = `${process.env.VUE_APP_API_URL}/img_home.php`;
      axios.post(homeImagesEndpoint)
        .then(response => {
          this.homeImages = response.data;
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des images de l'accueil", error);
        });
    },
    // Fonction pour récupérer les autres images disponibles depuis l'API
    fetchOtherImages() {
      const otherImagesEndpoint = `${process.env.VUE_APP_API_URL}/list_dishes.php`;
      axios.get(otherImagesEndpoint)
        .then(response => {
          this.otherImages = response.data;
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des autres images de plats", error);
        });
    },
    // Fonction pour sélectionner une image dans la première div ou annuler sa selection
    selectImage(imageId) {
      if (this.selectedImage != imageId){
        this.selectedImage = imageId;
        console.log("image selectionnée : ",imageId);
      }
      else this.selectedImage=null;
      
    },
    selectReplaceImage(imageId) {
      // Sélectionne l'image cliquée et désélectionne les autres
      this.selectedReplaceImage = imageId;
      console.log("image 2 selectionnée : ",imageId);
      if (this.selectedImage!=null){
        this.replaceImage(this.selectedImage,this.selectedReplaceImage)
      }
    },
    // Fonction pour remplacer l'image d'accueil sélectionnée par une autre image
    replaceImage(selectedImageId, replaceImageId) {
  if (!selectedImageId || !replaceImageId) {
    return;
  }
  const replaceImageEndpoint = `${process.env.VUE_APP_API_URL}/replace_home_picture.php`;
  axios.post(replaceImageEndpoint, {
    selectedImageId,
    replaceImageId
  })
  .then(() => {
    this.fetchHomeImages();
    this.selectedImage = null;
  })
  .catch(error => {
    console.error("Erreur lors du remplacement de l'image", error);
  });
}

  }
};
</script>


<style scoped>
*{
  text-align: center;
}
.admin-accueil {
  overflow-x: auto;
  white-space: nowrap;
}
.selected {
  border: 2px solid greenyellow; /* Bordure pour mettre en évidence l'image sélectionnée */
}
.selected-replace {
  border: 2px solid green; /* Bordure pour mettre en évidence l'image de remplacement sélectionnée */
}

.admin-accueil,
.other-images {
  width: 80%;
  margin: auto ;
  overflow-x: scroll;
  display: flex;
  margin: auto;
  align-items: center;
  justify-content: space-around;
}

.admin-accueil {
  padding: 10px;
  background-color: rgba(0, 0, 0, 0.336);
  border: solid 1px black;
  margin: auto;
}

img {
  width: 150px;
  margin: 5px;
  border: solid 1px black;
}
img:hover {
  cursor: pointer;
}
.img-home {
  display:flex;
  align-items: center;
}
</style>
