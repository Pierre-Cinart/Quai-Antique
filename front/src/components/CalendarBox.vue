<template>
    <section class="calendar-box">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 text-center mb-3">
            <h2>Calendrier</h2>
            <div class="current-date">
              <button @click="goToPreviousMonth"><i class="fas fa-chevron-left"></i></button>
              <span>{{ formattedDisplayedDate }}</span>
              <button @click="goToNextMonth"><i class="fas fa-chevron-right"></i></button>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="calendar-wrap">
              <table id="calendar">
                <thead>
                  <tr>
                    <th v-for="day in weekDays" :key="day">{{ day }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(week, index) in weeks" :key="index">
                    <td v-for="date in week" :key="date.day" @click="selectDate(date)">
                      <span v-if="date.day !== ''">{{ date.day }}</span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script>
  export default {
    data() {
      return {
        weekDays: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
        displayedDate: "", // La date affichée (par défaut aujourd'hui)
        weeks: [],
        selectedDate: null // La date sélectionnée par l'utilisateur
      };
    },
    computed: {
      formattedDisplayedDate() {
        // Récupérer la première lettre en majuscule de displayedDate
        return this.displayedDate.charAt(0).toUpperCase() + this.displayedDate.slice(1);
      }
    },
    mounted() {
      // Lorsque le composant est monté, mettre à jour le calendrier avec la date actuelle
      const currentDate = new Date();
      this.updateCalendar(currentDate);
    },
    methods: {
      updateCalendar(date) {
        // Mettre à jour la date affichée au format souhaité
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        this.displayedDate = date.toLocaleDateString('fr-FR', options);
  
        // Calculer le premier jour et le nombre de jours dans le mois
        const firstDayOfMonth = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
        const daysInMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
  
        // Initialiser un tableau pour stocker les semaines du mois
        let weeks = [[]];
        let weekIndex = 0;
  
        // Ajouter des cellules vides pour les jours précédents
        for (let i = 0; i < firstDayOfMonth; i++) {
          weeks[weekIndex].push({ day: '', date: null });
        }
  
        // Ajouter les jours du mois au tableau des semaines
        for (let day = 1; day <= daysInMonth; day++) {
          const currentDate = new Date(date.getFullYear(), date.getMonth(), day);
          weeks[weekIndex].push({ day: day, date: currentDate });
  
          // Si nous avons atteint la fin de la semaine (7 jours), passer à la semaine suivante
          if (weeks[weekIndex].length % 7 === 0) {
            weekIndex++;
            weeks.push([]);
          }
        }
  
        // Mettre à jour les semaines du calendrier
        this.weeks = weeks;
      },
      selectDate(date) {
        // Méthode appelée lorsque l'utilisateur sélectionne une date dans le calendrier
        if (date.date) {
          this.selectedDate = date.date; // Mettre à jour la date sélectionnée
          this.displayedDate = this.selectedDate.toLocaleDateString('fr-FR', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }); // Mettre à jour la date affichée avec la date sélectionnée
        }
      },
      goToPreviousMonth() {
        // À remplir
      },
      goToNextMonth() {
        // À remplir
      }
    }
  };
  </script>
  
  <style scoped>
  .calendar-box { 
    margin: 10px;
    user-select: none;
    color: rgb(40, 105, 34);
    background-color: #ddae48b9; 
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  }
  .current-date {
    display: flex;
    width:75%;
    margin: auto;
    justify-content: space-between;
    border-radius: 5px;
    font-weight: bold;
    background-color: #ddae48b9; 
    border: solid 1px rgb(40, 105, 34);
    font-size: 22px;
  }
  
  .calendar-box h2 {
    font-size: 24px;
    font-weight: bolder;
    color: #333;
  }
  .calendar-box i {
    margin: 10px;
    color:rgb(40, 105, 34);
  
  }
  #calendar {
    border: solid 1px rgb(40, 105, 34);
    font-size: 20px;
    width: 100%;
    border-collapse: collapse;
  }
  #calendar th {
    border: solid 1px rgb(40, 105, 34);
    text-align: center;
    font-weight: bold;
    padding: 10px;
    background-color: #ddae48c7;
  }
  #calendar td {
    border: solid 1px rgb(40, 105, 34);
    background-color: #fcfcfc79;;
    text-align: center;
    padding: 10px;
  }
  #calendar td span {
    font-weight: bolder;
    width: 20px;
    padding: 15px;
  }
  #calendar td span:hover {
    background-color: rgb(40, 105, 34);
    border-radius: 5px;
    border: solid 1px white;
    color: #ddae48b9; 
  }
  </style>
  