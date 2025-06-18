CREATE DATABASE IF NOT EXISTS gestionvaccin;
USE gestionvaccin;

-- Table UTILISATEUR
CREATE TABLE IF NOT EXISTS Utilisateur (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    role ENUM('admin', 'medecin', 'parent') NOT NULL,
    mdp VARCHAR(255) NOT NULL
);

-- Table MEDECIN
CREATE TABLE IF NOT EXISTS Medecin (
    id_medecin INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT NOT NULL,
    num_ref INT UNIQUE NOT NULL,
    FOREIGN KEY (id_user) REFERENCES Utilisateur(id_user) ON DELETE CASCADE
);

-- Table BEBE
CREATE TABLE IF NOT EXISTS Bebe (
    id_bebe INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    poid DECIMAL(5,2) NOT NULL,
    taille DECIMAL(5,2) NOT NULL,
    id_user INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES Utilisateur(id_user) ON DELETE CASCADE
);

-- Table VACCIN
CREATE TABLE IF NOT EXISTS vaccin (
    id_vaccin INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    age_recommande INT NOT NULL,
    id_bebe INT NOT NULL,
    date_renouvellement DATE,
    obligatoire ENUM('oui', 'non') NOT NULL,
    FOREIGN KEY (id_bebe) REFERENCES Bebe(id_bebe) ON DELETE CASCADE
);

-- Table CARNET DE VACCINATION
CREATE TABLE IF NOT EXISTS carnetvaccination (
    id_c INT AUTO_INCREMENT PRIMARY KEY,
    date_administration DATE NOT NULL,
    id_medecin INT NOT NULL,
    statut ENUM('prévu', 'effectué') NOT NULL,
    id_bebe INT NOT NULL,
    id_vaccin INT NOT NULL,
    rappel DATE,
    FOREIGN KEY (id_medecin) REFERENCES Medecin(id_medecin) ON DELETE CASCADE,
    FOREIGN KEY (id_bebe) REFERENCES Bebe(id_bebe) ON DELETE CASCADE,
    FOREIGN KEY (id_vaccin) REFERENCES Vaccin(id_vaccin) ON DELETE CASCADE
);


-----les procedures stockées

-- Ajouter un utilisateur
DELIMITER //
CREATE PROCEDURE AjouterUtilisateur(
    IN p_nom VARCHAR(100),
    IN p_prenom VARCHAR(100),
    IN p_email VARCHAR(150),
    IN p_role ENUM('admin', 'medecin', 'parent'),
    IN p_mdp VARCHAR(255)
)
BEGIN
    INSERT INTO Utilisateur (nom, prenom, email, role, mdp)
    VALUES (p_nom, p_prenom, p_email, p_role, p_mdp);
END //
DELIMITER ;

-- Ajouter un médecin
DELIMITER //
CREATE PROCEDURE AjouterMedecin(
    IN p_id_user INT,
    IN p_num_ref INT
)
BEGIN
    INSERT INTO Medecin (id_user, num_ref)
    VALUES (p_id_user, p_num_ref);
END //
DELIMITER ;

-- Ajouter un bébé
DELIMITER //
CREATE PROCEDURE AjouterBebe(
    IN p_nom VARCHAR(100),
    IN p_prenom VARCHAR(100),
    IN p_date_naissance DATE,
    IN p_poid DECIMAL(5,2),
    IN p_taille DECIMAL(5,2),
    IN p_id_user INT
)
BEGIN
    INSERT INTO Bebe (nom, prenom, date_naissance, poid, taille, id_user)
    VALUES (p_nom, p_prenom, p_date_naissance, p_poid, p_taille, p_id_user);
END //
DELIMITER ;

-- Ajouter un vaccin
DELIMITER //
CREATE PROCEDURE AjouterVaccin(
    IN p_nom VARCHAR(100),
    IN p_description TEXT,
    IN p_age_recommande INT,
    IN p_id_bebe INT,
    IN p_date_renouvellement DATE,
    IN p_obligatoire ENUM('oui', 'non')
)
BEGIN
    INSERT INTO vaccin (nom, description, age_recommande, id_bebe, date_renouvellement, obligatoire)
    VALUES (p_nom, p_description, p_age_recommande, p_id_bebe, p_date_renouvellement, p_obligatoire);
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE AjouterCarnetVaccination(
    IN p_date_administration DATE,
    IN p_id_medecin INT,
    IN p_statut ENUM('prévu', 'effectué'),
    IN p_id_bebe INT,
    IN p_id_vaccin INT,
    IN p_rappel DATE
)
BEGIN
    INSERT INTO carnetvaccination (date_administration, id_medecin, statut, id_bebe, id_vaccin, rappel)
    VALUES (p_date_administration, p_id_medecin, p_statut, p_id_bebe, p_id_vaccin, p_rappel);
END //

DELIMITER ;
-----lire--
-- Lire tous les utilisateurs
DELIMITER //
CREATE PROCEDURE LireUtilisateurs()
BEGIN
    SELECT * FROM Utilisateur;
END //
DELIMITER ;

-- Lire tous les bébés
DELIMITER //
CREATE PROCEDURE LireBebes()
BEGIN
    SELECT * FROM Bebe;
END //
DELIMITER ;

-- Lire tous les médecins
DELIMITER //
CREATE PROCEDURE LireMedecins()
BEGIN
    SELECT * FROM Medecin;
END //
DELIMITER ;

-- Lire tous les vaccins d'un bébé
DELIMITER //
CREATE PROCEDURE LireVaccinsParBebe(IN p_id_bebe INT)
BEGIN
    SELECT * FROM vaccin WHERE id_bebe = p_id_bebe;
END //
DELIMITER ;
-- Lire toutes les entrées du carnet
DELIMITER //


DELIMITER $$

CREATE PROCEDURE LireTousLesCarnets()
BEGIN
    SELECT 
        c.id_c,
        c.date_administration,
        b.nom AS nom_bebe,
        b.prenom AS prenom_bebe,
        v.nom AS nom_vaccin, 
        u.nom AS nom_medecin,
        u.prenom AS prenom_medecin,
        c.statut,
        c.rappel
    FROM carnetvaccination c
    JOIN bebe b ON c.id_bebe = b.id_bebe
    JOIN vaccin v ON c.id_vaccin = v.id_vaccin
    JOIN medecin m ON c.id_medecin = m.id_medecin
    JOIN utilisateur u ON m.id_user = u.id_user;
END $$

DELIMITER ;




-- Lire les entrées du carnet par bébé
DELIMITER //
CREATE PROCEDURE LireCarnetParBebe(IN p_id_bebe INT)
BEGIN
    SELECT * FROM carnetvaccination WHERE id_bebe = p_id_bebe;
END //
DELIMITER ;

-- Lire les entrées du carnet par médecin
DELIMITER //
CREATE PROCEDURE LireCarnetParMedecin(IN p_id_medecin INT)
BEGIN
    SELECT * FROM carnetvaccination WHERE id_medecin = p_id_medecin;
END //
DELIMITER ;







DELIMITER $$

CREATE PROCEDURE GetBebesParParent(IN id_parent INT)
BEGIN
    SELECT 
        bebe.*, 
        utilisateur.nom AS nom_parent, 
        utilisateur.prenom AS prenom_parent
    FROM 
        bebe
    INNER JOIN 
        utilisateur 
    ON 
        bebe.id_user = utilisateur.id_user
    WHERE 
        bebe.id_user = id_parent;
END$$

DELIMITER ;









------modifier---
-- Mettre à jour un utilisateur
DELIMITER //
CREATE PROCEDURE ModifierUtilisateur(
    IN p_id_user INT,
    IN p_nom VARCHAR(100),
    IN p_prenom VARCHAR(100),
    IN p_email VARCHAR(150),
    IN p_role ENUM('admin', 'medecin', 'parent'),
    IN p_mdp VARCHAR(255)
)
BEGIN
    UPDATE Utilisateur 
    SET nom = p_nom, prenom = p_prenom, email = p_email, role = p_role, mdp = p_mdp
    WHERE id_user = p_id_user;
END //
DELIMITER ;

-- Mettre à jour un médecin
DELIMITER //
CREATE PROCEDURE ModifierMedecin(
    IN p_id_medecin INT,
    IN p_num_ref INT
)
BEGIN
    UPDATE Medecin 
    SET num_ref = p_num_ref
    WHERE id_medecin = p_id_medecin;
END //
DELIMITER ;

-- Mettre à jour les informations d'un bébé
DELIMITER //
CREATE PROCEDURE ModifierBebe(
    IN p_id_bebe INT,
    IN p_nom VARCHAR(100),
    IN p_prenom VARCHAR(100),
    IN p_date_naissance DATE,
    IN p_poid DECIMAL(5,2),
    IN p_taille DECIMAL(5,2)
)
BEGIN
    UPDATE Bebe 
    SET nom = p_nom, prenom = p_prenom, date_naissance = p_date_naissance, poid = p_poid, taille = p_taille
    WHERE id_bebe = p_id_bebe;
END //
DELIMITER ;







DELIMITER //
CREATE PROCEDURE ModifierCarnetVaccination(
    IN p_id_c INT,
    IN p_date_administration DATE,
    IN p_id_medecin INT,
    IN p_statut ENUM('prévu', 'effectué'),
    IN p_id_bebe INT,
    IN p_id_vaccin INT,
    IN p_rappel DATE
)
BEGIN
    UPDATE carnetvaccination 
    SET date_administration = p_date_administration,
        id_medecin = p_id_medecin,
        statut = p_statut,
        id_bebe = p_id_bebe,
        id_vaccin = p_id_vaccin,
        rappel = p_rappel
    WHERE id_c = p_id_c;
END //
DELIMITER ;


------supprimer--
-- Supprimer un utilisateur
DELIMITER //
CREATE PROCEDURE SupprimerUtilisateur(IN p_id_user INT)
BEGIN
    DELETE FROM Utilisateur WHERE id_user = p_id_user;
END //
DELIMITER ;

-- Supprimer un médecin
DELIMITER //
CREATE PROCEDURE SupprimerMedecin(IN p_id_medecin INT)
BEGIN
    DELETE FROM Medecin WHERE id_medecin = p_id_medecin;
END //
DELIMITER ;

-- Supprimer un bébé
DELIMITER //
CREATE PROCEDURE SupprimerBebe(IN p_id_bebe INT)
BEGIN
    DELETE FROM Bebe WHERE id_bebe = p_id_bebe;
END //
DELIMITER ;

-- Supprimer un vaccin
DELIMITER //
CREATE PROCEDURE SupprimerVaccin(IN p_id_vaccin INT)
BEGIN
    DELETE FROM vaccin WHERE id_vaccin = p_id_vaccin;
END //
DELIMITER ;


DELIMITER //
CREATE PROCEDURE SupprimerCarnetVaccination(IN p_id_c INT)
BEGIN
    DELETE FROM carnetvaccination  WHERE id_c = p_id_c;
END //
DELIMITER ;

DELIMITER //
CREATE PROCEDURE VerifierUtilisateur(
    IN p_email VARCHAR(150),
    IN p_mdp VARCHAR(255)
)
BEGIN
    SELECT id_user, nom, prenom, email, role
    FROM Utilisateur 
    WHERE email = p_email AND mdp = p_mdp;
END //
DELIMITER ;

DELIMITER $$

CREATE PROCEDURE LireVaccinsAVenir()
BEGIN
    SELECT id_vaccin, nom, description, age_recommande, date_renouvellement, obligatoire
    FROM vaccin
    WHERE date_renouvellement > CURDATE();
END $$

DELIMITER ;


DELIMITER $$

CREATE PROCEDURE LireVaccinsAdministres(
    IN p_id_bebe INT
)
BEGIN
    SELECT id_vaccin, nom, description, age_recommande, date_renouvellement, obligatoire
    FROM vaccin
    WHERE id_bebe = p_id_bebe AND date_renouvellement <= CURDATE();
END $$

DELIMITER ;

DELIMITER $$

CREATE PROCEDURE LireVaccinsFuturs()
BEGIN
    SELECT * FROM vaccins WHERE date_renouvellement > NOW();
END$$

DELIMITER ;
