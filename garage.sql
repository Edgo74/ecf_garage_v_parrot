CREATE TABLE garage (
  numero varchar(50) NOT NULL,
  adresse varchar(250) NOT NULL
);


CREATE TABLE avis (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nom varchar(50) NOT NULL,
  commentaire TEXT NOT NULL,
  note INT NOT NULL,
  estValide tinyint NOT NULL DEFAULT 0
);

CREATE TABLE horaires (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  debut_heures_AM time DEFAULT NULL,
  fin_heures_AM time DEFAULT NULL,
  debut_heures_PM time DEFAULT NULL,
  fin_heures_PM time DEFAULT NULL,
  est_ouvert varchar(10) NOT NULL,
  jour  enum('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche')
);

CREATE TABLE services (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  titre varchar(100) NOT NULL,
  description TEXT NULL
);

CREATE TABLE utilisateur (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  password varchar(100) NOT NULL,
  mail varchar(100) NOT NULL,
  role varchar(50) NOT NULL DEFAULT 'employe'
);

CREATE TABLE voitures (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  titre varchar(50) NOT NULL,
  year varchar(20) NOT NULL,
  carburant varchar(50) NOT NULL,
  kilometre INT NOT NULL,
  price float NOT NULL,
  image varchar(100) NOT NULL
  immatriculation VARCHAR(50) NOT NULL,
  type float VARCHAR(50)  NOT NULL,
  date DATE  NOT NULL
);

-- Insertion de donnees fictives dans la base de données

INSERT INTO utilisateur (password, mail, role) VALUES
('$2y$10$/pPjdYpzR0Q3Rgv81KyA0.njs.Ik1uAkMzoyeSgQhVc8x3kYldSG6', 'admin@mail.com', 'administrateur');

INSERT INTO avis (nom, commentaire, note, estValide) VALUES
('Joseph', 'Super', 5, 1),
('John', 'tres bien ', 5, 1),
('Adam', 'Jaime bien.', 4,0),
('Milo', 'moyen', 3, 1),
('Tina', 'Super!', 4,0);



INSERT INTO horaires (debut_heures_AM, fin_heures_AM, debut_heures_PM, fin_heures_PM, est_ouvert, jour) VALUES
('08:00:00', '13:00:00', '20:30:00', '20:30:00', 'open', 'Lundi'),
('08:00:00', '11:00:00', '18:30:00', '18:30:00', 'open', 'Mardi'),
('08:00:00', '11:00:00', '18:30:00', '18:30:00', 'open', 'Mercredi'),
('09:00:00', '11:00:00', '18:30:00', '18:30:00', 'open', 'Jeudi'),
('08:00:00', '11:00:00', '18:30:00', '18:30:00', 'open', 'Vendredi'),
('11:00:00', '12:00:00', '16:00:00', '16:00:00', 'open', 'Samedi'),
('02:00:00', '18:00:00', '03:00:00', '03:00:00', 'open', 'Dimanche');

INSERT INTO services (titre, description) VALUES
('Entretien régulier', 'Vidange dhuile, remplacement du filtre à air, changement des bougies dallumage.'),
('Réparations mécaniques', 'Réparation et diagnostic des problèmes électriques, remplacement de la batterie.'),
('Réparation des vitres', 'Réparation ou remplacement des vitres et pare-brise.'),
('Services de carrosserie', 'Réparation des dommages de carrosserie, peinture, polissage.'),
('Pneus et roues', 'Rotation des pneus, équilibrage, alignement, remplacement des pneus.');

INSERT INTO voitures (titre, year, carburant, kilometre, price, image) VALUES
('Renault', '2002', 'diesel', 50000, 15000, '17424_voiture2.jpg', 'zsx-56-23', 'utilitaire', '2022-12-24' ),
('Ferrari', '2009', 'diesel', 33000, 42000, '20511_voiture2.jpg', 'sdf-78-62', 'sport', '2022-06-11' ),
('Mercedes', '2000', 'diesel', 220000, 16000, '34235_voiture.jpg', 'xyz-21-81', 'sport', '2023-08-02' ),
('Alpha Romeo', '2009', 'diesel', 180000, 42000, '82328_voiture2.jpg', 'abc-12-89', 'utilitaire', '2023-11-16' );

INSERT INTO garage(numero, adresse) VALUES("Toulouse", "061357896");