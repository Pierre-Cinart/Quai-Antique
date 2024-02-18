<template>
    <div class="home_page">
    <TitleBox/>
      <div class = "home_pictures">
        <HomePictures />
      </div>

      <div class="reservation_div">
        <div class="btn-reserv">
        <router-link to="/reservation" class="nav-link">Réserver Une Table</router-link>
        </div>
      </div>

    </div>
  </template>
  
  <script>
  import TitleBox from '@/components/TitleBox.vue'
  import HomePictures from '@/components/HomePictures.vue';
  
  export default {
    components: {
      HomePictures,
      TitleBox
    },
  };
  </script>

  <style scoped>
  .home_page{
    width: 100%;
    min-height: 100vh;
    
  }
  .reservation_div{
    margin-top: 10px;
    background-color: rgba(255, 255, 255, 0.445);
    padding: 5px;
    
  }
  
  .home_pictures {
    margin: auto;
    padding-top:15px;
    background-color: #ddae4867;
    width: 80%;
    min-width: 250px;
    border: solid 2px #523e15;
    border-radius: 5px;
  }
  .home_page_title {
    background-color: #ddae48c2; 
    padding-top: 5px;
    font-family: 'Dancing Script', cursive;
    
    max-width: 600px;
    margin: auto;
    
    margin-bottom: 10px;
    padding-top: 20px;
    border: solid 2px #523e15;
    border-radius: 5px;
  }
  .home_page_title h1{
    text-align: center;
    font-weight: bolder;
    color: rgb(40, 105, 34);
  }
  .home_page_title p {
    font-family: 'Dancing Script', cursive;
    font-size: 18px;
    text-align: right;
    font-weight: 450;
    padding-right: 30px;
    font-style: italic;
  }
 
</style>