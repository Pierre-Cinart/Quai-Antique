<template>
    <section class="calendar-box">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 text-center mb-3">
            <h2>Séléctionnez une date et vérifiez nos disponibilités</h2>
            <div class="current-date">
              <span>{{ displayedDate }}</span>
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
        displayedDate: "",
        weeks: [],
        selectedDate: null
      };
    },
    mounted() {
      this.updateCalendar(new Date());
    },
    methods: {
      updateCalendar(date) {
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        this.displayedDate = this.selectedDate ? this.capitalizeFirstLetter(this.selectedDate.toLocaleDateString('fr-FR', options)) : this.capitalizeFirstLetter(date.toLocaleDateString('fr-FR', options));
  
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
        if (date.date) {
          this.selectedDate = date.date;
          this.updateCalendar(date.date);
        }
      },
      capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
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
  .current-date{
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
  