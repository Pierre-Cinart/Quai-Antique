import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    userData: null
  },
  mutations: {
    setUserData(state, data) {
      state.userData = data;
    },
    resetUserData(state) {
      state.userData = null;
    }
  },
  actions: {
    async fetchUserData({ commit }, requestData) {
      const apiEndpoint = `${process.env.VUE_APP_API_URL}/login.php`;
      try {
        const response = await axios.post(apiEndpoint, requestData);
        commit('setUserData', response.data);
        return response.data;
      } catch (error) {
        console.error('Erreur lors de la récupération des données:', error);
        throw error;
      }
    }
  },
  getters: {
    getUserRole: state => {
      return state.userData ? state.userData.role : null;
    },
    getUserJwt: state => {
      return state.userData ? state.userData.jwt : null;
    }
  }
  
});
