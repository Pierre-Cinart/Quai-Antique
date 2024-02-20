<script>
import axios from 'axios';

export default {
    name:'TestApi',
  data() {
    return {
      availableSlots: []
    };
  },
  mounted() {
    this.fetchPlaces();
  },
  methods: {
    async fetchPlaces() {
      try {
        const selectedDate = '2024-02-19'; // Vous devrez remplacer cela par la date sélectionnée
        const response = await axios.get(`${process.env.VUE_APP_API_URL}/get_reserv_hours.php?date=${selectedDate}`);
        this.availableSlots = response.data;
      } catch (error) {
        console.error("Erreur lors de la récupération des créneaux horaires disponibles", error);
      }
    }
  }
};
</script>
