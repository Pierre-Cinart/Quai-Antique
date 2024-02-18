<template>
  <div id = 'dashboard'>

    <div class="admin-title">
      <h1>Dashboard</h1>
    <p>Page réservée aux administrateurs</p>
    </div>

    <!--Gestion admin images page d 'acceuil-->
    <AdminHome/>
    <br>
    <!--Gestion des reservations-->
    <AdminReserv/>
    <!--Gestion des horraires-->
    <AdminHours/>
  </div>
</template>

<script>
import AdminHome from '@/components/admin/AdminHome.vue'
import AdminReserv from '@/components/admin/AdminReserv.vue'
import AdminHours from '@/components/admin/AdminHours.vue'
export default {
  components : {
     AdminHome,AdminReserv,AdminHours
  }
}
</script>

<style scoped>
  section , h2 {
    margin:auto;
  }
  #dashboard {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: aliceblue;
    display: flex;
    flex-direction: column;
  }
  
  .admin-title {
    user-select: none;
    background-color: rgba(0, 0, 0, 0.212);
    width:210px;
    line-height: 15px;
    border: solid 1px black;
    text-align: center;
    margin: auto;
  }
  .admin-title h2{
    font-weight:bolder;
  }
  .admin-title p{
    color: red;
  }
  .admin-accueil {
    display: flex;
  }

</style>
