CREATE DATABASE ExamS2;
USE ExamS2;

CREATE TABLE IF NOT EXISTS `ExamS2_membre` (
    `id_membre` INT AUTO_INCREMENT PRIMARY KEY,
    `nom` VARCHAR(50) NOT NULL,
    `date_de_naissance` DATE NOT NULL,
    `genre` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `ville` VARCHAR(255) NOT NULL,
    `mot_de_passe` VARCHAR(255) NOT NULL,
    `image_profil` VARCHAR(255) DEFAULT 'default.jpg' 
);

CREATE TABLE IF NOT EXISTS `ExamS2_categorie_objet` (
    `id_categorie` INT AUTO_INCREMENT PRIMARY KEY,
    `nom_categorie` VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS `ExamS2_objet` (
    `id_objet` INT AUTO_INCREMENT PRIMARY KEY,
    `nom_objet` VARCHAR(100) NOT NULL,
    `id_categorie` INT NOT NULL,
    `id_membre` INT NOT NULL,
    FOREIGN KEY (`id_categorie`) REFERENCES `ExamS2_categorie_objet`(`id_categorie`),
    FOREIGN KEY (`id_membre`) REFERENCES `ExamS2_membre`(`id_membre`)
);

CREATE TABLE IF NOT EXISTS `ExamS2_image_objet` (
    `id_image` INT AUTO_INCREMENT PRIMARY KEY,
    `id_objet` INT NOT NULL,
    `nom_image` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`id_objet`) REFERENCES `ExamS2_objet`(`id_objet`)
);

CREATE TABLE IF NOT EXISTS `ExamS2_emprunt` (
    `id_emprunt` INT AUTO_INCREMENT PRIMARY KEY,
    `id_objet` INT NOT NULL,
    `id_membre` INT NOT NULL,
    `date_emprunt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `date_retour` DATETIME,
    FOREIGN KEY (`id_objet`) REFERENCES `ExamS2_objet`(`id_objet`),
    FOREIGN KEY (`id_membre`) REFERENCES `ExamS2_membre`(`id_membre`)
);

Insert into `ExamS2_membre` (`nom`, `date_de_naissance`, `genre`, `email`, `ville`, `mot_de_passe`) VALUES
('RAKOTOBE Joshua Riki', '2005-02-02', 'Homme', 'rakotobe@gmail.com', 'Antananarivo', 'password123'),
('RAVELOMANANTSOA Tony Mahefa', '2001-06-13', 'Homme', 'rtonymahefa@gmail.com', 'Antananarivo', 'password123'),
('RANDRIANARISOA Fanja', '1999-11-23', 'Femme', 'fanja.randrianarisoa@gmail.com', 'Fianarantsoa', 'password456'),
('ANDRIAMAHERY Lova', '2003-04-17', 'Homme', 'lova.andriamahery@gmail.com', 'Toamasina', 'password789');

INSERT INTO `ExamS2_categorie_objet` (`nom_categorie`) VALUES
('Esthétique'),
('Bricolage'),
('Mécanique'),
('Cuisine');

INSERT INTO `ExamS2_objet` (`nom_objet`, `id_categorie`, `id_membre`) VALUES
-- Objets pour RAKOTOBE Joshua Riki (id_membre = 1)
('Sèche-cheveux', 1, 1),
('Trousse de maquillage', 1, 1),
('Perceuse', 2, 1),
('Tournevis', 2, 1),
('Clé à molette', 3, 1),
('Pompe à vélo', 3, 1),
('Mixeur', 4, 1),
('Casserole', 4, 1),
('Batteur électrique', 4, 1),
('Grille-pain', 4, 1),

-- Objets pour RAVELOMANANTSOA Tony Mahefa (id_membre = 2)
('Fer à lisser', 1, 2),
('Crème hydratante', 1, 2),
('Marteau', 2, 2),
('Scie', 2, 2),
('Clé plate', 3, 2),
('Compresseur', 3, 2),
('Blender', 4, 2),
('Poêle', 4, 2),
('Cafetière', 4, 2),
('Micro-ondes', 4, 2),

-- Objets pour RANDRIANARISOA Fanja (id_membre = 3)
('Brosse à cheveux', 1, 3),
('Palette de fards', 1, 3),
('Pinceau', 2, 3),
('Visseuse', 2, 3),
('Clé Allen', 3, 3),
('Cric', 3, 3),
('Robot pâtissier', 4, 3),
('Moule à gâteau', 4, 3),
('Bouilloire', 4, 3),
('Four', 4, 3),

-- Objets pour ANDRIAMAHERY Lova (id_membre = 4)
('Gel coiffant', 1, 4),
('Lisseur', 1, 4),
('Pince multiprise', 2, 4),
('Perceuse-visseuse', 2, 4),
('Clé dynamométrique', 3, 4),
('Manomètre', 3, 4),
('Friteuse', 4, 4),
('Cuiseur vapeur', 4, 4),
('Râpe à fromage', 4, 4),
('Planche à découper', 4, 4);

INSERT INTO `ExamS2_emprunt` (`id_objet`, `id_membre`, `date_emprunt`, `date_retour`) VALUES
(1, 2, '2024-06-01 10:00:00', '2024-06-05 15:00:00'),
(5, 3, '2024-06-02 09:30:00', '2024-06-06 11:00:00'),
(12, 1, '2024-06-03 14:00:00', '2024-06-07 16:00:00'),
(18, 4, '2024-06-04 08:00:00', '2024-06-08 12:00:00'),
(23, 2, '2024-06-05 13:00:00', '2024-06-09 17:00:00'),
(27, 3, '2024-06-06 15:30:00', '2024-06-10 18:00:00'),
(35, 1, '2024-06-07 11:00:00', '2024-06-11 19:00:00'),
(38, 4, '2024-06-08 16:00:00', '2024-06-12 20:00:00'),
(10, 3, '2024-06-09 12:00:00', '2024-06-13 21:00:00'),
(20, 2, '2024-06-10 17:00:00', '2024-06-14 22:00:00');