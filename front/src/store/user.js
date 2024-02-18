// store/user.js
import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    userData: null
  },
  getters: {
    // Définir un getter pour récupérer le rôle de l'utilisateur depuis state.userData
    getUserRole: state => {
      return state.userData ? state.userData.role : null;
    }
  },
  mutations: {
    setUserData(state, data) {
      state.userData = data;
    },
    resetUserData(state) {
        console.log(state.userData);
        state.userData = null;
        console.log(state.userData);
    }
  },
  actions: {
    async fetchUserData({ commit }, requestData) {
      const apiEndpoint = `${process.env.VUE_APP_API_URL}/login.php`;
      try {
        const response = await axios.post(apiEndpoint, requestData);
        commit('setUserData', response.data);
        console.log(response.data);
        return response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des données:', error);
        throw error;
      }
    }
  },
  
});
