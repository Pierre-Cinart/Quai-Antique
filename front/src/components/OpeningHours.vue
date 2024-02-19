<template>
    <div class="horraires">
      <h4>Nos heures d'ouverture :</h4>
      <ul>
        <li v-if="week">
          <span class="day"> Du Lundi au Vendredi :</span>
          <span>
            de {{ formatTime(week.morning_start) }} à {{ formatTime(week.morning_end) }} <br>
            et de {{ formatTime(week.after_start) }} à {{ formatTime(week.after_end) }}
          </span>
        </li>
        <li v-if="saturday">
          <span class="day">Le Samedi : </span>
          <span>
            de {{ formatTime(saturday.morning_start) }} à {{ formatTime(saturday.morning_end) }} <br>
            et de {{ formatTime(saturday.after_start) }} à {{ formatTime(saturday.after_end) }}
          </span>
        </li>
        <li v-if="sunday">
          <span class="day">Le Dimanche et jours fériés: </span>
          <span>
            de {{ formatTime(sunday.morning_start) }} à {{ formatTime(sunday.morning_end) }} 
          </span>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name : 'OpeningHours',
    data() {
      return {
        week: null,
        saturday: null,
        sunday: null
      };
    },
    mounted() {
      const apiEndpoint = `${process.env.VUE_APP_API_URL}/opening_hours.php`;
      axios.get(apiEndpoint)
        .then(response => {
          this.week = response.data.week;
          this.saturday = response.data.saturday;
          this.sunday = response.data.sunday;
        })
        .catch(error => {
          console.error("Erreur lors de la récupération des horaires d'ouverture", error);
        });
    },
    methods: {
      formatTime(time) {
        if (time === null || time === undefined) return ''; // Gérer le cas où le temps est null ou undefined

        let formattedTime = String(time);
        if (formattedTime.length < 4) {
          // Ajouter des zéros avant si le nombre comporte moins de 4 chiffres
          formattedTime = formattedTime.padStart(4, '0');
        }
        const hour = formattedTime.slice(0, 2); // Prendre les deux premiers chiffres pour les heures
        const minute = formattedTime.slice(2); // Prendre les deux derniers chiffres pour les minutes
        return `${hour}:${minute}`;
      }

    }
  };
  </script>
  
  <style scoped>
  .day{
    font-weight: 600;
    font-size: 18px;
  }
 .horraires {
  text-align: left;
  border-left: solid 1px white;
  width: 33%;
}
.horraires h4{
  margin-left: 10px;
}
@media screen and (max-width: 760px) {
  
  .horraires {
    text-align: center;
    width: 100%;
    border: none;
    padding: 10px;
    margin-bottom: 10px;
    border-bottom: 1px solid white;
  }

}
</style>
