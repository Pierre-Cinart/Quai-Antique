// Fonction pour mettre à jour le temps d'expiration du localStorage
export const updateExpirationTime = (key, timeInMinutes) => {
    const currentTime = new Date().getTime();
    const expirationTime = currentTime + timeInMinutes * 60 * 1000;
    console.log(`Nouveau temps d'expiration pour la clé ${key}: ${new Date(expirationTime)}`);
    const data = {
      value: localStorage.getItem(key),
      expirationTime: expirationTime,
    };
    localStorage.setItem(key, JSON.stringify(data));
};

// Fonction pour supprimer les données du localStorage
export const clearLocalStorage = () => {
    localStorage.removeItem('jwt');
    localStorage.removeItem('id');
    localStorage.removeItem('role');
    console.log('Données localStorage supprimées.');
};
