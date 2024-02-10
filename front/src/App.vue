<template>
  
    <div class="main">
      <NavBar />
      <router-view></router-view>
      <FooterBar />
    </div>
  
</template>

<script>
import NavBar from '@/components/NavBar.vue';
import FooterBar from '@/components/FooterBar.vue';


export default {
  components: {
    NavBar , FooterBar ,
  },
}
</script>

<style scoped>
  .main{
    width: 100%;
    
    min-height: 100vh;
  }
 
</style>
