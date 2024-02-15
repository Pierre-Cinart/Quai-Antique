<template>
    <div class = "title-box">
        <h1>Bienvenue au restaurant Quai Antique</h1>
        <p>Découvrez les délices de la Savoie </p>
    </div>
</template>
<script>
    export default {
  name: 'TitleBox'
}
</script>
<style scoped>
.title-box {
    background-color: #ddae48c2; 
    padding-top: 5px;
    font-family: 'Dancing Script', cursive;
    max-width: 600px;
    margin: auto;
    margin-bottom: 10px;
    margin-top: 20px;
    border: solid 2px #523e15;
    border-radius: 5px;
  }
  .title-box h1{
    text-align: center;
    font-weight: bolder;
    color: rgb(40, 105, 34);
  }
.title-box p {
    font-family: 'Dancing Script', cursive;
    font-weight: bold;
    font-size: 20px;
    text-align: right;
    padding-right: 30px;
    font-style: italic;
  }
</style>