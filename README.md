# Projet Quai Antique

Bienvenue dans le projet Quai Antique. Ce projet est réalisé dans le cadre d'un ecf de développement web
Le restaurant quai antique est un restaurant fictif

## Configuration de l'environnement

### Backend (PHP)

1. Assurez-vous d'avoir [Composer](https://getcomposer.org/) installé sur votre machine.
2. Naviguez vers le dossier `back` et exécutez `composer install` pour installer les dépendances PHP.
3. Créez un fichier à la racine du projet  `.env.` . Mettez à jour les variables d'environnement appropriées telles que `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, etc.

   Exemple de fichier `.env` :
   ```env
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=quai_antique
   DB_USERNAME=root
   DB_PASSWORD=password
   ```

4. Exécutez votre fichier SQL pour créer et alimenter la base de données.

### Frontend (Vue.js)

1. Assurez-vous d'avoir [Node.js](https://nodejs.org/) installé sur votre machine.
2. Rendez vous dans le dossier front , installez Vue.js en exécutant la commande suivante dans votre terminal :

    ```bash
    npm install -g vue
    ```

3. Puis installez Vue CLI en exécutant la commande suivante :

    ```bash
    npm install -g @vue/cli
    ```

4. Ensuite installez Bootstrap en exécutant la commande suivante :
    ```bash
    npm install bootstrap
    ```
5. Enfin installer les dépendances Vue.js , exécutez :

    ```bash
    npm install 
    ```

## Utilisation du projet

1. Assurez-vous que le backend est en cours d'exécution avec les configurations correctes.
2. Exécutez le frontend avec `npm run serve` dans le dossier `front`.
3. Accédez à l'application dans votre navigateur à l'adresse indiquée (généralement http://localhost:8080).

## Configurations de connexion

### Backend (PHP)

- **Host:** L'adresse du serveur de base de données (DB_HOST dans le fichier `.env`).
- **Port:** Le port utilisé par le serveur de base de données (DB_PORT dans le fichier `.env`).
- **Nom de la base de données:** Le nom de la base de données utilisée (DB_DATABASE dans le fichier `.env`).
- **Nom d'utilisateur:** Le nom d'utilisateur pour se connecter à la base de données (DB_USERNAME dans le fichier `.env`).
- **Mot de passe:** Le mot de passe pour se connecter à la base de données (DB_PASSWORD dans le fichier `.env`).

### Frontend (Vue.js)

- **URL de l'API Backend:** Assurez-vous que l'URL de l'API backend est correctement configurée dans le fichier `.env` du frontend.

   Exemple de fichier `.env` :
   ```env
   VUE_APP_API_URL=http://localhost/back/api
   ```








