<template>
    <TitleBox/>
    <section class="carte-menu">
        <div class="sort-titles">
            <h3 @click="filterMenu('all')">Tout</h3>
            <h3 @click="filterMenu('entrées')">Entrées</h3>
            <h3 @click="filterMenu('plats')">Plats</h3>
            <h3 @click="filterMenu('desserts')">Desserts</h3>
            <h3 @click="filterMenu('boissons')">Boissons</h3>
        </div>
        
        <div class="sort-menus">
            <div v-show="showAll || selectedMenu === 'entrées'" class ="entrées">
                <img src="" alt="Entrées">
            </div>
            <div v-show="showAll || selectedMenu === 'plats'" class = "plats">
                <img src="" alt="PLats">
            </div>
            <div v-show="showAll || selectedMenu === 'desserts'" class = "desserts">
                <img src="" alt="Desserts">
            </div>
            <div v-show="showAll || selectedMenu === 'boissons'" class = "boissons">
                <img src="" alt="Boissons">
            </div>
        </div>
    </section>
</template>
  
<script>
import TitleBox from '@/components/TitleBox.vue';
export default {
    components : {
        TitleBox,
    },
    data() {
        return {
            selectedMenu: 'all', // Par défaut, afficher tout
            showAll: true // Variable pour gérer l'affichage de tous les éléments
        };
    },
    methods: {
        filterMenu(menuType) {
            // Met à jour le type de menu sélectionné
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
    width:200px;
    height: auto;
}
</style>
