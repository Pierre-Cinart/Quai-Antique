<template>
  <section class="calendar-box">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-12 text-center mb-3">
          <h2>Selectionnez une date de reservation :</h2>
          <span class="selected-date" v-if="selectedDate">{{ formattedSelectedDate }}</span>
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
                  <td v-for="date in week" :key="date.day" @click="selectDate(date)" :class="{ 'disabled': isDateDisabled(date), 'selected': isDateSelected(date) }">
                    <span v-if="date.day !== ''">{{ date.day }}</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="current-date">
      <button @click="goToPreviousMonth" :disabled="isPreviousMonthDisabled"><i class="fas fa-chevron-left"></i></button>
      <span>{{ currentMonth }}</span>
      <button @click="goToNextMonth" :disabled="isNextMonthDisabled"><i class="fas fa-chevron-right"></i></button>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      weekDays: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
      currentDate: new Date(),
      currentMonth: "",
      weeks: [],
      selectedDate: null
    };
  },
  computed: {
    formattedSelectedDate() {
      if (this.selectedDate) {
        return this.selectedDate.toLocaleDateString('fr-FR', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
      }
      return '';
    },
    isPreviousMonthDisabled() {
      const today = new Date();
      return this.currentDate.getFullYear() === today.getFullYear() && this.currentDate.getMonth() === today.getMonth();
    },
    isNextMonthDisabled() {
      const sixMonthsLater = new Date();
      sixMonthsLater.setMonth(sixMonthsLater.getMonth() + 6);
      const nextMonth = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 1);
      return nextMonth > sixMonthsLater;
    }
  },
  mounted() {
    this.updateCalendar(this.currentDate);
  },
  methods: {
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
    selectDate(date) {
      if (date.date && !this.isDateDisabled(date)) {
        this.selectedDate = date.date;
      }
    },
    isDateDisabled(date) {
      return date.date && date.date < new Date().setHours(0, 0, 0, 0);
    },
    isDateSelected(date) {
      return date.date && this.selectedDate && date.date.toDateString() === this.selectedDate.toDateString();
    },
    goToPreviousMonth() {
      const previousMonth = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() - 1, 1);
      this.updateCalendar(previousMonth);
    },
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
}

#calendar td span {
  font-weight: bolder;
  width: 20px;
  padding: 15px;
}

#calendar td.selected span {
  background-color: rgb(40, 105, 34);
  border-radius: 5px;
  border: solid 1px white;
  color: #ddae48b9;
}

.selected-date{
  display: block;
  font-size: 22px;
  font-weight: bold;
  text-align: center;
  width: 50%;
  margin: auto;
}
</style>
