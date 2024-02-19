<template>
    <div class="session-expired">
      <div class="message">Votre session a expirée. Veuillez vous reconnecter.</div>
      <router-link to="/authentification" class="link">Se reconnecter</router-link>
    </div>
  </template>
  
  <script>
  export default {
    name: 'SessionExpired',
  };
  </script>
  
  <style scoped>
  .session-expired {
    width: 75%;
    margin: auto;
    margin-top: 10px;
    text-align:center;
    background-color: red;
    color: aliceblue;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 70vh;
  }
  
  .message {
    font-size: 30px;
    margin-bottom: 20px;
  }
  
  .link {
    font-size: 28px;
    padding: 10px;
    background-color:black;
    border-radius: 10%;
    border: solid 1px white;
    color: white;
    font-weight : bolder;
  }
 
  </style>