CREATE TABLE Utilisateur (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    passwd VARCHAR(255) NOT NULL,
    type VARCHAR(50) NOT NULL DEFAULT 'lecture',
    nom VARCHAR(100),
    prenom VARCHAR(100),
    nomdep VARCHAR(10),
    num_tel VARCHAR(20)
);


CREATE TABLE Sauveteur (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    departement VARCHAR(10) NOT NULL,
    specialite VARCHAR(100) NOT NULL,
    NumTel VARCHAR(20),
    DateHeureEngagement DATETIME NOT NULL
);


CREATE TABLE Statut (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    TypeStatut VARCHAR(50) NOT NULL,
    couleur VARCHAR(20) NOT NULL
);


CREATE TABLE Mission (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    DateHeureDebut DATETIME NOT NULL,
    DateHeureFin DATETIME,
    EnPrepa BOOLEAN NOT NULL DEFAULT 0,
    Lieu VARCHAR(255),
    ID_Sauveteur INT NOT NULL,
    ID_statut INT NOT NULL,
    ID_Utilisateur INT NOT NULL,
    CONSTRAINT fk_mission_sauveteur
        FOREIGN KEY (ID_Sauveteur) REFERENCES Sauveteur(ID)
        ON DELETE CASCADE,
    CONSTRAINT fk_mission_statut
        FOREIGN KEY (ID_statut) REFERENCES Statut(ID)
        ON DELETE RESTRICT,
    CONSTRAINT fk_mission_utilisateur
        FOREIGN KEY (ID_Utilisateur) REFERENCES Utilisateur(ID)
        ON DELETE RESTRICT
);


INSERT INTO Statut (TypeStatut, couleur) VALUES
('Sauveteur disponible',                 'vert'),
('Sauveteur en approche de la cavite',   'violet'),
('Sauveteur sous terre',                 'marron'),
('Sauveteur equipe de gestion',          'jaune'),
('Sauveteur en mission a l exterieur',   'orange'),
('Sauveteur en repos',                   'bleu'),
('Sauveteur en brancardage civiere',     'rouge');
