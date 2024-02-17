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
        <div v-show="showAll || selectedMenu === 'drinks'" class="drinks">
          <img src='/images/drinks/drinks.jpg' >
        </div>
        <!-- Affichage des entrées -->
        <div v-show="showAll || selectedMenu === 'starters'" class="starters">
          <div v-for="(starter, index) in paginatedStarters" :key="index" class="menu-item" @mouseenter.stop="showDescription(starter)" @mouseleave.stop="hideDescription(starter)" @click.stop="toggleDescription(starter)">
            <img :src="'/images/starters/' + starter.picture" :alt="starter.title" >
            <div class="menu-info">
              <h4>{{ starter.title }}</h4>
              <p>{{ starter.price }} €</p>
            </div>
            <p class="description" v-if="starter.showDescription">{{ starter.description }}</p>
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
          <div v-for="(dish, index) in paginatedDishes" :key="index" class="menu-item" @mouseenter.stop="showDescription(dish)" @mouseleave.stop="hideDescription(dish)" @click.stop="toggleDescription(dish)">
            <img :src="'/images/dishes/' + dish.picture" :alt="dish.title">
            <div class="menu-info">
              <h4>{{ dish.title }}</h4>
              <p>{{ dish.price }} €</p>
            </div>
            <p class="description" v-if="dish.showDescription">{{ dish.description }}</p>
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
          <div v-for="(dessert, index) in paginatedDesserts" :key="index" class="menu-item" @mouseenter.stop="showDescription(dessert)" @mouseleave.stop="hideDescription(dessert)" @click.stop="toggleDescription(dessert)">
            <img :src="'/images/desserts/' + dessert.picture" :alt="dessert.title">
            <div class="menu-info">
              <h4>{{ dessert.title }}</h4>
              <p>{{ dessert.price }} €</p>
            </div>
            <p class="description" v-if="dessert.showDescription">{{ dessert.description }}</p>
          </div>
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
  components: {
    TitleBox,
  },
  data() {
    return {
      selectedMenu: 'all',
      showAll: true,
      starters: [],
      dishes: [],
      desserts: [],
      currentPageStarters: 0,
      currentPageDishes: 0,
      currentPageDesserts: 0,
      itemsPerPage: 2
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
    this.fetchStarters();
    this.fetchDishes();
    this.fetchDesserts();
  },
  methods: {
    fetchStarters() {
      const apiEndpoint = `${process.env.VUE_APP_API_URL}/dishes.php`;
      axios.get(apiEndpoint)
        .then(response => {
          this.starters = response.data.starters;
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des entrées:", error);
        });
    },
    fetchDishes() {
      const apiEndpoint = `${process.env.VUE_APP_API_URL}/dishes.php`;
      axios.get(apiEndpoint)
        .then(response => {
          this.dishes = response.data.dishes;
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des plats:", error);
        });
    },
    fetchDesserts() {
      const apiEndpoint = `${process.env.VUE_APP_API_URL}/dishes.php`;
      axios.get(apiEndpoint)
        .then(response => {
          this.desserts = response.data.desserts;
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des desserts:", error);
        });
    },
    filterMenu(menuType) {
      this.selectedMenu = menuType;
      if (menuType === 'all') {
        this.showAll = true;
      } else {
        this.showAll = false;
      }
    },
    nextPageStarters() {
      this.currentPageStarters++;
    },
    prevPageStarters() {
      this.currentPageStarters--;
    },
    nextPageDishes() {
      this.currentPageDishes++;
    },
    prevPageDishes() {
      this.currentPageDishes--;
    },
    nextPageDesserts() {
      this.currentPageDesserts++;
    },
    prevPageDesserts() {
      this.currentPageDesserts--;
    },
    toggleDescription(item) {
      item.showDescription = !item.showDescription;
    },
    showDescription(item) {
      item.showDescription = true;
    },
    hideDescription(item) {
      item.showDescription = false;
    }
  }
};
</script>

<style scoped>
/* Styles pour le composant */
.carte-menu {
    background-color: aliceblue;
    width: 80%;
    border-radius: 5px;
    border: solid 1px black;
    margin: auto;
    padding: 10px;
}

.carte-menu h3 {
    background-color: rgba(0, 0, 0, 0.212);
    border-radius: 5px;
    border: solid 2px black;
    margin: auto;
    padding: 5px;
}

.carte-menu h3:hover {
    cursor: pointer;
    background-color: rgba(22, 160, 56, 0.212);
}

.sort-titles {
    user-select: none;
    display: flex;
    justify-content: baseline;
    flex-wrap: wrap;
    margin-bottom: 15px;
}

.sort-menus {
    width: 80%;
    min-height: 400px;
    margin: auto;
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
}

.sort-menus div {
    border-radius: 5px;
    margin: 5px;
    height: auto;
    position: relative;
}

.sort-menus div img {
    width: 200px;
    height: auto;
    border: solid 1px black;
    border-radius: 5px;
}

.sort-menus div .menu-info-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 10px;
    border-radius: 0 0 5px 5px;
    text-align: center;
}

.sort-menus div h4,
.sort-menus div p {
    margin: 0;
    font-size: 14px;
}
.sort-menus div .menu-info {
  background-color: rgba(0, 0, 0, 0.7);
  text-align: center;
  width: 100%;
  color: aliceblue;
  position: absolute;
  bottom: -5px;
  left:-5px;
}
.sort-menus div .menu-info-overlay h4 {
    font-weight: bold;
}

.sort-menus div .menu-info-overlay p {
    font-weight: normal;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
}

.pagination button {
    margin: 0 5px;
}
.description{
  z-index: 100;
  background-color: rgba(0, 0, 0, 0.88);
  text-align: center;
  width: 100%;
  padding:10px;
  color: aliceblue;
  position: absolute;
  top:0;
  left:0;
  font-size: 20px !important;
}
.starters,
.dishes,
.desserts {}
</style>

