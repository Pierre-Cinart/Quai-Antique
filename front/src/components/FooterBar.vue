<template>
  <footer class="bg-dark text-light py-4">
    <div class="footer_box">
      <div class="container contact">
        <ul>
          <h4>Contact :</h4>
          <li>
            Restaurant quai antique <br>
            15 rue des délices <br>
            77555 Chamberry <br>
          </li>
          <li>tel : 040404040404 </li>
          <li>mail : quaiantique@mail.com </li>
        </ul>
      </div>
      <div class="reserv">
        <router-link to="/carte-menus" class="nav-link">Consulter La Carte</router-link>
        <router-link to="/reservation" class="nav-link">Réserver Une Table</router-link>
        <router-link to="/authentification" class="nav-link">Créer un compte client</router-link>
      </div>
      <div class="container horraires">
        <ul>
          <h4>Nos heures d ' ouverture :</h4>
          <li>Du Lundi au Vendredi de 11h30 à 15h00 et de 19h00 à 23h00 </li>
          <li>Le Samedi de 11h30 à 16h00 et de 19h00 à 00h00 </li>
          <li>Le Dimanche de 11h30 à 15h00 </li>
        </ul>
      </div>
    </div>
    <div class="container text-center">
      <span>&copy; Cinartdev.fr</span>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'FooterBar'
}
</script>

<style scoped>
.reserv {
  font-size: 22px;
  color: aliceblue;
  text-align: center;
  margin: auto;
  text-decoration: underline;
  width: 33%;
}

.reserv .nav-link:hover{
  color: blue;
}

.contact {
  margin-left: 10px;
  border-right: solid 1px white;
  width: 33%;
}

.horraires {
  text-align: left;
  border-left: solid 1px white;
  width: 33%;
}

.horraires ul li {
  list-style: none;
  line-height: 33px;
}

footer {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  height: auto;
  margin-top: 15px;
  width: 100%;
}

.footer_box {
  display: flex;
  justify-content: center;
  height: auto;
  margin-top: 15px;
  width: 100%;
}

@media screen and (max-width: 760px) {
  .footer_box {
    flex-wrap: wrap;
  }
  .contact,
  .reserv,
  .horraires {
    text-align: center;
    width: 100%;
    border: none;
    padding: 10px;
    margin-bottom: 10px;
    border-bottom: 1px solid white;
  }
  .contact ul li {
    list-style: none;
  }
  .reserv .nav-link:hover{
  color: white;
}

}
</style>
