<template>
  <!-- Gestion admin des horaires -->
  <div>
    <h2>Modifier les horaires</h2>
    <br>
    <section class="admin-hours">
      <div v-for="(schedule, index) in schedules" :key="index" class="schedule-item">
        <label class="days">{{ getDay(schedule.day) }}</label>
        <div>
          <label>Ouverture (matin):</label>
          <input type="time" v-model="schedule.morning_start" />
        </div>
        <div>
          <label>Fermeture (matin):</label>
          <input type="time" v-model="schedule.morning_end" />
        </div>
        <div>
          <label>Ouverture (après-midi):</label>
          <input type="time" v-model="schedule.after_start" />
        </div>
        <div>
          <label>Fermeture (après-midi):</label>
          <input type="time" v-model="schedule.after_end" />
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'AdminHours',
  data() {
    return {
      schedules: [],
    };
  },
  mounted() {
    this.fetchSchedules();
  },
  methods: {
    async fetchSchedules() {
      try {
        const response = await axios.get(`${process.env.VUE_APP_API_URL}/opening_hours.php`);
        this.schedules = this.formatSchedules(response.data);
      } catch (error) {
        console.error("Erreur lors de la récupération des horaires :", error);
      }
    },
    formatSchedules(data) {
      const formattedSchedules = {};
      for (const [key, value] of Object.entries(data)) {
        formattedSchedules[key] = {
          ...value,
          morning_start: this.formatTime(value.morning_start),
          morning_end: this.formatTime(value.morning_end),
          after_start: this.formatTime(value.after_start),
          after_end: this.formatTime(value.after_end)
        };
      }
      return formattedSchedules;
    },
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
},


    getDay(day) {
      switch (day) {
        case 'week':
          return 'Du lundi au vendredi :';
        case 'saturday':
          return 'Samedi :';
        case 'sunday':
          return 'Dimanche et jours fériés : ';
        // Ajoutez d'autres cas pour les jours fériés si nécessaire
        default:
          return day;
      }
    }
  }
};
</script>

<style scoped>
.admin-hours {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.schedule-item {
  margin-bottom: 20px;
}

label {
  margin-right: 10px;
}

input {
  margin-bottom: 5px;
}

h2 {
  text-decoration: underline;
  margin: auto;
  text-align: center;
}
.days {
  font-weight: bolder;
}
</style>
