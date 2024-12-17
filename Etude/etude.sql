CREATE TABLE `Langue` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `libelle` VARCHAR(255),
  `description` TEXT
);

CREATE TABLE `SousCategorie` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `libelle` VARCHAR(255),
  `description` TEXT,
  `parentId` INT
);

CREATE TABLE `Emplacement` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `range` INT,
  `colonne` INT,
  `position` INT,
  `libelle` VARCHAR(255)
);

CREATE TABLE `Auteur` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `libelle` VARCHAR(255),
  `description` TEXT,
  `nbreLivre` INT
);

CREATE TABLE `StatusReservation` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `libelle` VARCHAR(255),
  `description` TEXT,
  `couleur` VARCHAR(50)
);

CREATE TABLE `StatusEmprunt` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `libelle` VARCHAR(255),
  `description` TEXT,
  `couleur` VARCHAR(50)
);

CREATE TABLE `Role` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `libelle` VARCHAR(255),
  `description` TEXT
);

CREATE TABLE `Livre` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `libelle` VARCHAR(255),
  `auteur_id` INT,
  `nbrePages` INT,
  `nbreExemplaires` INT,
  `langue_id` INT,
  `image` TEXT,
  `sousCategorie_id` INT,
  `tags` TEXT,
  `themes` TEXT,
  `resume` TEXT,
  `edition` VARCHAR(255)
);

CREATE TABLE `Chapitre` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `livre_id` INT,
  `libelle` VARCHAR(255),
  `description` TEXT,
  `tags` TEXT
);

CREATE TABLE `Exemplaire` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `livre_id` INT,
  `numero` VARCHAR(50),
  `emplacement_id` INT,
  `libre` BOOLEAN,
  `dateDisponible` DATE
);

CREATE TABLE `Membre` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `nom` VARCHAR(255),
  `prenom` VARCHAR(255),
  `login` VARCHAR(255),
  `password` TEXT,
  `contact` VARCHAR(50),
  `whatsapp` VARCHAR(50),
  `email` VARCHAR(255),
  `role_id` INT,
  `profil` TEXT
);

CREATE TABLE `Reservation` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `exemplaire_id` INT,
  `membre_id` INT,
  `dateDebutPrevu` DATE,
  `dateFinPrevu` DATE,
  `statusReservation_id` INT,
  `dateReservation` DATE
);

CREATE TABLE `Emprunt` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `reservation_id` INT,
  `statusEmprunt_id` INT
);

ALTER TABLE `SousCategorie` ADD FOREIGN KEY (`parentId`) REFERENCES `SousCategorie` (`id`);

ALTER TABLE `Livre` ADD FOREIGN KEY (`auteur_id`) REFERENCES `Auteur` (`id`);

ALTER TABLE `Livre` ADD FOREIGN KEY (`langue_id`) REFERENCES `Langue` (`id`);

ALTER TABLE `Livre` ADD FOREIGN KEY (`sousCategorie_id`) REFERENCES `SousCategorie` (`id`);

ALTER TABLE `Chapitre` ADD FOREIGN KEY (`livre_id`) REFERENCES `Livre` (`id`);

ALTER TABLE `Exemplaire` ADD FOREIGN KEY (`livre_id`) REFERENCES `Livre` (`id`);

ALTER TABLE `Exemplaire` ADD FOREIGN KEY (`emplacement_id`) REFERENCES `Emplacement` (`id`);

ALTER TABLE `Membre` ADD FOREIGN KEY (`role_id`) REFERENCES `Role` (`id`);

ALTER TABLE `Reservation` ADD FOREIGN KEY (`exemplaire_id`) REFERENCES `Exemplaire` (`id`);

ALTER TABLE `Reservation` ADD FOREIGN KEY (`membre_id`) REFERENCES `Membre` (`id`);

ALTER TABLE `Reservation` ADD FOREIGN KEY (`statusReservation_id`) REFERENCES `StatusReservation` (`id`);

ALTER TABLE `Emprunt` ADD FOREIGN KEY (`reservation_id`) REFERENCES `Reservation` (`id`);

ALTER TABLE `Emprunt` ADD FOREIGN KEY (`statusEmprunt_id`) REFERENCES `StatusEmprunt` (`id`);
