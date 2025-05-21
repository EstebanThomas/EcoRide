use sql7780135;

CREATE TABLE Roles(
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50)
);

CREATE TABLE Utilisateurs(
    utilisateur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(200) NOT NULL,
    telephone VARCHAR(50),
    adresse VARCHAR(100),
    date_naissance VARCHAR(50),
    photo BLOB,
    photo_url VARCHAR(100),
    pseudo VARCHAR(50) UNIQUE NOT NULL,
    credits INT DEFAULT 0,
    suspendu BOOLEAN DEFAULT FALSE,
    note FLOAT,
    role_id INT NOT NULL DEFAULT 3,
    FOREIGN KEY (role_id) REFERENCES Roles(role_id)
);

CREATE TABLE Marque(
    marque_id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50)
);

CREATE TABLE Voiture(
    voiture_id INT AUTO_INCREMENT PRIMARY KEY,
    modele VARCHAR(50),
    immatriculation VARCHAR(9),
    date_premiere_immatriculation DATE,
    energie VARCHAR(50),
    couleur VARCHAR(50),
    utilisateur_id INT,
    marque_id INT,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(utilisateur_id),
    FOREIGN KEY (marque_id) REFERENCES Marque(marque_id)
);

CREATE TABLE Preferences(
    preferences_id INT AUTO_INCREMENT PRIMARY KEY,
    fumeur BOOLEAN DEFAULT FALSE,
    animaux BOOLEAN DEFAULT FALSE,
    propres_preferences VARCHAR(100),
    utilisateur_id INT,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(utilisateur_id)
);

CREATE TABLE Covoiturage(
    covoiturage_id INT AUTO_INCREMENT PRIMARY KEY,
    date_depart DATE,
    heure_depart TIME,
    lieu_depart VARCHAR(50),
    date_arrivee DATE,
    heure_arrivee TIME,
    lieu_arrivee VARCHAR(50),
    statut VARCHAR(50),
    nb_place INT,
    prix_personne FLOAT,
    participants TEXT DEFAULT NULL,
    utilisateur_id INT,
    voiture_id INT,
    preferences_id INT,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(utilisateur_id),
    FOREIGN KEY (voiture_id) REFERENCES Voiture(voiture_id),
    FOREIGN KEY (preferences_id) REFERENCES Preferences(preferences_id)
);

CREATE TABLE Avis(
    avis_id INT AUTO_INCREMENT PRIMARY KEY,
    commentaire VARCHAR(255),
    note FLOAT,
    statut VARCHAR(50),
    good_trip BOOLEAN DEFAULT TRUE,
    conducteur_id INT,
    covoiturage_id INT,
    utilisateur_id INT,
    FOREIGN KEY (covoiturage_id) REFERENCES Covoiturage(covoiturage_id),
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(utilisateur_id),
    FOREIGN KEY (conducteur_id) REFERENCES Utilisateurs(utilisateur_id)
);

CREATE TABLE Commission(
    commission_id INT AUTO_INCREMENT PRIMARY KEY,
    montant INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    utilisateur_id INT,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateurs(utilisateur_id)
);