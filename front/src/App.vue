<template>
    <div class="main">
      <NavBar />
      <TestApi /> 
      <router-view></router-view>
     <FooterBar /> 
    </div>
  
</template>

<script>
import NavBar from '@/components/NavBar.vue';
import FooterBar from '@/components/FooterBar.vue';
import TestApi from '@/components/TestApi.vue';


export default {
  components: {
    NavBar,
    FooterBar,
    TestApi
},
}
</script>

<style scoped>
  .main{
    width: 100%;
    min-height: 100vh;
  }
 
</style>
