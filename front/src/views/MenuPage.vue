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
        <div v-show="showAll || selectedMenu === 'drinks'" class="starters">
          <img src="/images/drinks/drinks.jpg" alt="carte des boissons">
        </div>
        <!-- Affichage des entrées -->
        <div v-show="showAll || selectedMenu === 'starters'" class="starters">
          <div v-for="(starter, index) in paginatedStarters" :key="index">
            <img :src="'/images/starters/' + starter.picture" :alt="starter.title">
          </div>
          <!-- Pagination pour les entrées -->
          <div v-show="starters.length > itemsPerPage" class="pagination">
            <button @click="prevPageStarters" :disabled="currentPageStarters === 0">Précédent</button>
            <span>Page {{ currentPageStarters + 1 }} / {{ totalPagesStarters }}</span>
            <button @click="nextPageStarters" :disabled="currentPageStarters === totalPagesStarters - 1">Suivant</button>
          </div>
        </div>
        <!-- Affichage des plats -->
        <div v-show="showAll || selectedMenu === 'dishes'" class="dishes">
          <div v-for="(dish, index) in paginatedDishes" :key="index">
            <img :src="'/images/dishes/' + dish.picture" :alt="dish.title">
          </div>
          <!-- Pagination pour les plats -->
          <div v-show="dishes.length > itemsPerPage" class="pagination">
            <button @click="prevPageDishes" :disabled="currentPageDishes === 0">Précédent</button>
            <span>Page {{ currentPageDishes + 1 }} / {{ totalPagesDishes }}</span>
            <button @click="nextPageDishes" :disabled="currentPageDishes === totalPagesDishes - 1">Suivant</button>
          </div>
        </div>
        <!-- Affichage des desserts -->
        <div v-show="showAll || selectedMenu === 'desserts'" class="desserts">
          <template v-for="(dessert, index) in paginatedDesserts" :key="index">
            <img :src="'/images/desserts/' + dessert.picture" :alt="dessert.title">
          </template>
          <!-- Pagination pour les desserts -->
          <div v-show="desserts.length > itemsPerPage" class="pagination">
            <button @click="prevPageDesserts" :disabled="currentPageDesserts === 0">Précédent</button>
            <span>Page {{ currentPageDesserts + 1 }} / {{ totalPagesDesserts }}</span>
            <button @click="nextPageDesserts" :disabled="currentPageDesserts === totalPagesDesserts - 1">Suivant</button>
          </div>
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
      currentPageStarters: 0,
      currentPageDishes: 0,
      currentPageDesserts: 0,
      itemsPerPage: 2 // Nombre d'éléments à afficher par page
    };
  },
  computed: {
    paginatedStarters() {
      const startIndex = this.currentPageStarters * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.starters.slice(startIndex, endIndex);
    },
    paginatedDishes() {
      const startIndex = this.currentPageDishes * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.dishes.slice(startIndex, endIndex);
    },
    paginatedDesserts() {
      const startIndex = this.currentPageDesserts * this.itemsPerPage;
      const endIndex = startIndex + this.itemsPerPage;
      return this.desserts.slice(startIndex, endIndex);
    },
    totalPagesStarters() {
      return Math.ceil(this.starters.length / this.itemsPerPage);
    },
    totalPagesDishes() {
      return Math.ceil(this.dishes.length / this.itemsPerPage);
    },
    totalPagesDesserts() {
      return Math.ceil(this.desserts.length / this.itemsPerPage);
    }
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
    },
    // Fonctions pour la pagination des starters
    nextPageStarters() {
      this.currentPageStarters++;
    },
    prevPageStarters() {
      this.currentPageStarters--;
    },
    // Fonctions pour la pagination des plats
    nextPageDishes() {
      this.currentPageDishes++;
    },
    prevPageDishes() {
      this.currentPageDishes--;
    },
    // Fonctions pour la pagination des desserts
    nextPageDesserts() {
      this.currentPageDesserts++;
    },
    prevPageDesserts() {
      this.currentPageDesserts--;
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
    width: 80%;
    min-height :400px;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
}
.sort-menus div{
    border-radius: 5px;
    margin: 5px ;
    height: auto;
}
.sort-menus div img {
    width: 200px;
    height: auto;
    border: solid 1px black;
    border-radius: 5px;
    
}
.sort-menus div p {
    padding: 10px;
    margin: 0;
    background-color: #f1f1f1;
}
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
}
.pagination button {
  margin: 0 5px;
}
.starters,.dishes,.desserts {

}
</style>
