<template>
    <!-- Section principale du calendrier -->
    <section class="calendar-box">
    <!-- Conteneur pour le titre et la date sélectionnée -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 text-center mb-3">
          <!-- Titre du calendrier -->
          <h2>Selectionnez une date de reservation :</h2>
             <!-- Section de navigation pour changer de mois -->
          <div class="current-date">
      <!-- Bouton pour aller au mois précédent -->
      <button @click="goToPreviousMonth" :disabled="isPreviousMonthDisabled"><i class="fas fa-chevron-left"></i></button>
      <!-- Affichage du mois en cours -->
      <span>{{ currentMonth }}</span>
      <!-- Bouton pour aller au mois suivant -->
      <button @click="goToNextMonth" :disabled="isNextMonthDisabled"><i class="fas fa-chevron-right"></i></button>
    </div>
        </div>
      </div>
      <!-- Calendrier -->
      <div class="row">
        <div class="col-md-12">
          <div class="calendar-wrap">
            <table id="calendar">
              <thead>
                <!-- En-tête du calendrier avec les jours de la semaine -->
                <tr>
                  <th v-for="day in weekDays" :key="day">{{ day }}</th>
                </tr>
              </thead>
              <tbody>
                <!-- Corps du calendrier avec les jours -->
                <tr v-for="(week, index) in weeks" :key="index">
                  <td v-for="date in week" :key="date.day" @click="selectDate(date)" :class="{ 'disabled': isDateDisabled(date), 'selected': isDateSelected(date) }">
                    <!-- Affichage du jour -->
                    <span v-if="date.day !== ''">{{ date.day }}</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
 
   <!-- Affichage de la date sélectionnée -->
    <span class="selected-date">{{ formattedSelectedDate }}</span>
  </section>
  
     <!-- Section du formulaire de réservation -->
  <section class="my-form container">
    <h2>Réservation</h2>
    <form>
      <div class="row mb-3">
      
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label" for="nom">Nom :</label>
        <div class="col-sm-9">
          <input type="text" id="nom" v-model="reservation.nom" class="form-control" required>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label" for="prenom">Prénom :</label>
        <div class="col-sm-9">
          <input type="text" id="prenom" v-model="reservation.prenom" class="form-control" required>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label" for="email">Email :</label>
        <div class="col-sm-9">
          <input type="email" id="email" v-model="reservation.email" class="form-control" required>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label" for="tel">Téléphone :</label>
        <div class="col-sm-9">
          <input type="tel" id="tel" v-model="reservation.tel" class="form-control" required>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label" for="couverts">Nombre de couverts :</label>
        <div class="col-sm-9">
          <input type="number" id="couverts" v-model="reservation.couverts" class="form-control" required>
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label" for="allergies">Allergies :</label>
        <div class="col-sm-9">
          <textarea id="allergies" v-model="reservation.allergies" class="form-control"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <button type="submit" class="btn btn-success">Réserver</button>
        </div>
      </div>
    </form>
  </section>
  
</template>

<script>
export default {
  name: 'CalendarBox',
  data() {
    return {
      // Jours de la semaine
      weekDays: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
      // Date actuelle
      currentDate: new Date(),
      // Mois actuel affiché
      currentMonth: "",
      // Semaines du mois
      weeks: [],
      // Date sélectionnée
      selectedDate: null,
      // Données de la réservation
      reservation: {
        nom: '',
        prenom: '',
        email: '',
        tel: '',
        couverts: '',
        allergies: ''
      }
    };
  },
  computed: {
    // Formatage de la date sélectionnée
    formattedSelectedDate() {
      if (this.selectedDate) {
        return this.selectedDate.toLocaleDateString('fr-FR', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
      }
      return '';
    },
    // Formatage de la date sélectionnée pour le input type date
    selectedDateFormatted() {
      if (this.selectedDate) {
        const year = this.selectedDate.getFullYear();
        const month = `${this.selectedDate.getMonth() + 1}`.padStart(2, '0');
        const day = `${this.selectedDate.getDate()}`.padStart(2, '0');
        return `${year}-${month}-${day}`;
      }
      return '';
    },
    // Vérifie si le mois précédent est désactivé
    isPreviousMonthDisabled() {
      const today = new Date();
      return this.currentDate.getFullYear() === today.getFullYear() && this.currentDate.getMonth() === today.getMonth();
    },
    // Vérifie si le mois suivant est désactivé
    isNextMonthDisabled() {
      const sixMonthsLater = new Date();
      sixMonthsLater.setMonth(sixMonthsLater.getMonth() + 6);
      const nextMonth = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 1);
      return nextMonth > sixMonthsLater;
    }
  },
  mounted() {
    // Afficher le calendrier lors du montage du composant
    this.updateCalendar(this.currentDate);
  },
  methods: {
    // Mettre à jour le calendrier avec la date spécifiée
    updateCalendar(date) {
      this.currentDate = date;
      this.currentMonth = date.toLocaleDateString('fr-FR', { month: 'long', year: 'numeric' });

      const firstDayOfMonth = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
      const daysInMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

      let weeks = [[]];
      let weekIndex = 0;

      for (let i = 0; i < firstDayOfMonth; i++) {
        weeks[weekIndex].push({ day: '', date: null });
      }

      for (let day = 1; day <= daysInMonth; day++) {
        const currentDate = new Date(date.getFullYear(), date.getMonth(), day);
        weeks[weekIndex].push({ day: day, date: currentDate });

        if (weeks[weekIndex].length % 7 === 0) {
          weekIndex++;
          weeks.push([]);
        }
      }

      this.weeks = weeks;
    },
    // Sélectionner une date sur le calendrier
    selectDate(date) {
      if (date.date && !this.isDateDisabled(date)) {
        this.selectedDate = date.date;
      }
    },
    // Vérifier si une date est désactivée
    isDateDisabled(date) {
      return date.date && date.date < new Date().setHours(0, 0, 0, 0);
    },
    // Vérifier si une date est sélectionnée
    isDateSelected(date) {
      return date.date && this.selectedDate && date.date.toDateString() === this.selectedDate.toDateString();
    },
    // Passer au mois précédent
    goToPreviousMonth() {
      const previousMonth = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
      this.updateCalendar(previousMonth);
    },
    // Passer au mois suivant si disponible
    goToNextMonth() {
      const nextMonth = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 1);
      const sixMonthsLater = new Date();
      sixMonthsLater.setMonth(sixMonthsLater.getMonth() + 6);
      if (nextMonth <= sixMonthsLater) {
        this.updateCalendar(nextMonth);
      }
    }
  }
};
</script>

<style scoped>
.disabled {
  pointer-events: none;
  color: #ccc;
}

.calendar-box {
  box-sizing: border-box;
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
  margin-top: 20px;
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
  width:10%;
}

#calendar td span {
  font-weight: bolder;
  
}

#calendar td.selected {
  background-color: #ddae48;
  border-radius: 5px;
}

#calendar td :hover {
  cursor: pointer;
  border-radius: 5px;
  color: #08380cde;
}

.selected-date{
  display: block;
  font-size: 22px;
  font-weight: bold;
  text-align: center;
  width: 50%;
  margin: auto;
}
@media  screen  and (max-device-width: 700px) {
  .calendar-box i {
  margin: 5px;
  
}

#calendar {
  
  font-size: 15px;
  width: 100%;
  border-collapse: collapse;
}
}


</style>
