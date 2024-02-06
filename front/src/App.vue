<template>
  <div>
    <NavBar />
    <HomePictures />
    <router-view></router-view>
  </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue';


export default {
  components: {
    NavBar , 
  },
}
</script>

<style scoped>
  /* Ajoutez des styles si nécessaire */
</style>
