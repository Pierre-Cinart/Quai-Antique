<template>
    <div class="not-found">
      <h1>404 - Page Not Found</h1>
      <p>Oups ! Il semblerait que  cette page soit introuvable ...</p>
    </div>
  </template>
  
  <script>
  export default {
    name: 'PageNotFound'
  };
  </script>
  <style scoped>
    .not-found {
        width: 100%;
        height:40vh;
        padding-top:5%;
        margin-top:10px;
        background-color: aliceblue;
        text-align: center;
    }
    .not-found p {
        font-size: 22px;
        font-weight: bolder;
    }
</style>