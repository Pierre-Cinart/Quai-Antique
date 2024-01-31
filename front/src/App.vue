<!-- MaVue.vue -->
<template>
  <div>
    <NavBar />
    <!-- Autre contenu de votre vue -->
  </div>
</template>

<script>
import NavBar from '@/components/NavBar.vue'; // Assurez-vous de spécifier le chemin correct

export default {
  components: {
    NavBar
  },
  // Autres options de la vue
}
</script>

<style scoped>
  /* Styles spécifiques à cette vue */
</style>
