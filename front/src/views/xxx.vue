 <!-- Affichage des desserts -->
 <div v-show="showAll || selectedMenu === 'desserts'" class="desserts">
    <div v-for="(dessert, index) in paginatedDesserts" :key="index" class="menu-item">
      <img :src="'/images/desserts/' + dessert.picture" :alt="dessert.title" @click="handleItemClick(dessert)">
        <p class="description" v-if="dessert.showDescription">{{ dessert.description }}</p>
      <div class="menu-info" @click.stop="toggleDescription(dessert)" @mouseenter="showDescription(dessert)" @mouseleave="hideDescription(dessert)">
        <h4>{{ starter.title }}</h4>
        <p>{{ starter.price }} €</p>
      
      </div>
    </div>
    <!-- Pagination pour les plats -->
    <div v-show="desserts.length > itemsPerPage" class="pagination">
      <button @click="prevPageDesserts" :disabled="currentPageDesserts === 0">Précédent</button>
      <span>Page {{ currentPageDesserts + 1 }} / {{ totalPagesDesserts }}</span>
      <button @click="nextPageDesserts" :disabled="currentPageDesserts === totalPagesDesserts - 1">Suivant</button>
    </div>
  </div>