Mise en place de l’environnement de travail EcoRide

1- Choix de l'environnement local
    Pour simplifier la mise en place du serveur web, de la base de données et de PHP prendre XAMPP :
    Apache (serveur web) + MySQL (système de gestion de base de données) + PHP (langage utilisé par Laravel)
    XAMPP est simple à installer, multiplateforme et permet de configurer rapidement un environnement local prêt à l’emploi sans avoir à installer chaque composant séparément.

2- Initialisation du projet
    Clonage du dépôt Git sur la branch main :
    git clone https://github.com/EstebanThomas/EcoRide

    Installation des dépendances avec Composer :
    composer install
    Installation des dépendances avec npm :
    npm install
    npm run build

    Composer est essentiel pour gérer les bibliothèques PHP et npm pour les ressources front-end.

3- Mise en place de la base de données MySQL
    Démarrage de MySQL via XAMPP.

    Créer le fichier .env grâce au ficher .env.example et configurer les identifiants de connexion dans le fichier .env :
        APP_URL=http://localhost

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=ecoride
        DB_USERNAME=root
        DB_PASSWORD=

        SESSION_DRIVER=file

        MAIL_MAILER=smtp
        MAIL_HOST=mailpit
        MAIL_PORT=1025
        MAIL_USERNAME=null
        MAIL_PASSWORD=null
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS="ecoride.et@gmail.com"
        MAIL_FROM_NAME="${APP_NAME}"

        
    Importation d’un premier fichier structure_local.sql contenant la structure de la base de données (tables, relations, etc.).
    Importation d’un second fichier data_local.sql contenant des données de la table marque, et le compte administrateur.

    Importer directement les fichiers .sql via phpMyAdmin permet un gain de temps considérable, notamment lors des phases de test ou de réinitialisation rapide de l’environnement.

4- Lancement de l’application en local
    Exécution du serveur local avec Laravel :
    php artisan serve
    Accès à l'application via : http://localhost:8000