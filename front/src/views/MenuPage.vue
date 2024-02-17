<template>
    <div>
      <TitleBox/>
      <section class="carte-menu">
        <div class="sort-titles">
          <h3 @click="filterMenu('all')">Tout</h3>
          <h3 @click="filterMenu('starters')">Entrées</h3>
          <h3 @click="filterMenu('dishes')">Plats</h3>
          <h3 @click="filterMenu('desserts')">Desserts</h3>
          <h3 @click="filterMenu('drinks')">Boissons</h3>
        </div>
  
        <div class="sort-menus">

          <!-- Affichage des boissons -->
          <div v-show="showAll || selectedMenu === 'drinks'" class ="starters">
            <img src="/images/drinks/drinks.jpg" alt="carte des boissons">
          </div>
          <!-- Affichage des entrées -->
          <div v-show="showAll || selectedMenu === 'starters'" class ="starters">
            <div v-for="(starter, index) in starters" :key="index">
              <img :src="'/images/starters/' + starter.picture" :alt="starter.title">
            </div>
          </div>
          <!-- Affichage des plats -->
          <div v-show="showAll || selectedMenu === 'dishes'" class = "dishes">
            <div v-for="(dish, index) in dishes" :key="index">
              <img :src="'/images/dishes/' + dish.picture" :alt="dish.title">
            </div>
          </div>
          <!-- Affichage des desserts -->
          <div v-show="showAll || selectedMenu === 'desserts'" class = "desserts">
            <template v-for="(dessert, index) in desserts" :key="index">
              <img :src="'/images/dishes/' + dessert.picture" :alt="dessert.title">
            </template>
          </div>
        </div>
      </section>
    </div>
  </template>
  
  <script>
 
  import TitleBox from '@/components/TitleBox.vue';
import axios from 'axios';

export default {
  components : {
    TitleBox,
  },
  data() {
    return {
      selectedMenu: 'all', // Par défaut, afficher tout
      showAll: true, // Variable pour gérer l'affichage de tous les éléments
      starters: [],
      dishes: [], // Données des plats
      desserts: [], // Données des desserts
    };
  },
  mounted() {
    // Récupérer les données des plats
    this.fetchStarters();

    // Récupérer les données des plats
    this.fetchDishes();
  
    // Récupérer les données des desserts
    this.fetchDesserts();
  },
  methods: {
    fetchStarters() {
      const apiEndpoint = `${process.env.VUE_APP_API_URL}/dishes.php`;
      axios.get(apiEndpoint)
        .then(response => {
          this.starters = response.data.starters; // Assigner les données des entrées aux starters
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des entrées:", error);
        });
    },
    fetchDishes() {
      const apiEndpoint = `${process.env.VUE_APP_API_URL}/dishes.php`;
      axios.get(apiEndpoint)
        .then(response => {
          this.dishes = response.data.dishes; // Assigner les données des plats aux dishes
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des plats:", error);
        });
    },
    fetchDesserts() {
      const apiEndpoint = `${process.env.VUE_APP_API_URL}/dishes.php`;
      axios.get(apiEndpoint)
        .then(response => {
          this.desserts = response.data.desserts; // Assigner les données des desserts aux desserts
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des desserts:", error);
        });
    },
    filterMenu(menuType) {
      // Mettre à jour le type de menu sélectionné
      this.selectedMenu = menuType;
      if (menuType === 'all') {
        // Si "Tout" est sélectionné, afficher tous les éléments
        this.showAll = true;
      } else {
        // Sinon, n'afficher que les éléments du type sélectionné
        this.showAll = false;
      }
    }
  }
};

  </script>
  
  
  

<style scoped>
.carte-menu{
    background-color: aliceblue;
    width: 80%;
    border-radius: 5px;
    border: solid 1px black;
    margin: auto;
    padding: 10px;
}
.carte-menu h3{
    background-color: rgba(0, 0, 0, 0.212);
    border-radius: 5px;
    border: solid 2px black;
    margin: auto;
    padding: 5px;
}
.carte-menu h3:hover{
    cursor: pointer;
    background-color:  rgba(22, 160, 56, 0.212);;
}
.sort-titles{
    user-select: none;
    display: flex;
    justify-content: baseline;
    flex-wrap: wrap;
    margin-bottom: 15px;
}
.sort-menus{
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}
.sort-menus div{
    border-radius: 5px;
    border: solid 2px black;
    margin: 2px;
    width:200px;
    height: auto;
}
.sort-menus div img {
    width: 100%;
    height: auto;
    padding:5px;
    border-radius: 5px;
    
}
.sort-menus div p {
    padding: 10px;
    margin: 0;
    background-color: #f1f1f1;
}
</style>
