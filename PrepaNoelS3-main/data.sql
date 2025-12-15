DROP DATABASE IF EXISTS taxiNoelS3;
CREATE DATABASE taxiNoelS3;

USE taxiNoelS3;

CREATE TABLE tbTrajets( 
            id INT PRIMARY KEY AUTO_INCREMENT,
            pointDepart VARCHAR(75),
            pointArrive VARCHAR(75),
            distance DOUBLE
        );

        CREATE TABLE tbChauffeurs(
            id INT PRIMARY KEY AUTO_INCREMENT,
            nomChauffeur VARCHAR(50),
            salaire DOUBLE
        );

        CREATE TABLE tbVehicules(
            id INT PRIMARY KEY AUTO_INCREMENT,
            nomVehicule VARCHAR(50),
            isDisponible boolean
        );

        CREATE TABLE tbMvtTrajet(
            id INT PRIMARY KEY AUTO_INCREMENT,
            dateDebut DATETIME,
            dateFin DATETIME,
            idChauffeur INT,
            idVehicule INT,
            idTrajet INT,
            montantRecette DOUBLE,
            montantCarburant DOUBLE,
            panne VARCHAR(10)
        );

        CREATE TABLE tbUsers(
            id INT PRIMARY KEY AUTO_INCREMENT,
            nomUser VARCHAR(50),
            mdp VARCHAR(10)
        );

        CREATE TABLE tbVersements(
            id INT PRIMARY KEY AUTO_INCREMENT,
            minVersement DOUBLE,
            idPourcentage INT
        );

        CREATE TABLE tbPourcentages(
            id INT PRIMARY KEY AUTO_INCREMENT,
            pourcentage DOUBLE
        );


INSERT INTO tbTrajets (pointDepart, pointArrive, distance) VALUES
('Antananarivo', 'Toamasina', 350.5),
('Antananarivo', 'Antsirabe', 169.8),
('Antananarivo', 'Mahajanga', 570.3),
('Antananarivo', 'Fianarantsoa', 411.2),
('Antananarivo', 'Toliara', 936.7),
('Antananarivo', 'Antsiranana', 1145.0);

INSERT INTO tbChauffeurs (nomChauffeur, salaire) VALUES
('Rajao Ramamonjy', 450000.00),
('Nirina Rakoto', 520000.50),
('Hary Ratsimba', 480000.00),
('Sandra Randria', 550000.75),
('Tahina Razafy', 460000.00),
('Voahangy Ravelo', 510000.25),
('Mamy Rabemananjara', 470000.00),
('Lanto Andrianaivo', 530000.50),
('Feno Rajaonarivelo', 465000.00),
('Hantamalala Rasoanaivo', 540000.75);

INSERT INTO tbVehicules (nomVehicule, isDisponible) VALUES
('Toyota Hiace Tana-001', true),
('Nissan Civilian Tana-002', false),
('Mercedes Sprinter Tana-003', true),
('Mitsubishi Rosa Tana-004', true),
('Isuzu Journey Tana-005', false),
('Toyota Coaster Tana-006', true),
('Nissan Caravan Tana-007', true),
('Mercedes Benz Tana-008', false),
('Mitsubishi Fuso Tana-009', true),
('Isuzu NPR Tana-010', true);

INSERT INTO tbMvtTrajet (dateDebut, dateFin, idChauffeur, idVehicule, idTrajet, montantRecette, montantCarburant, panne) VALUES
('2024-01-15 06:00:00', '2024-01-15 13:30:00', 1, 1, 1, 1200000, 250000,''),
('2024-01-16 07:00:00', '2024-01-16 11:45:00', 2, 3, 2, 850000, 180000,''),
('2024-01-17 05:30:00', '2024-01-17 20:00:00', 3, 4, 3, 2100000, 420000,''),
('2024-01-18 08:00:00', '2024-01-18 16:30:00', 4, 6, 4, 1500000, 320000,''),
('2024-01-19 06:30:00', '2024-01-19 22:00:00', 5, 7, 5, 2800000, 580000,''),
('2024-01-20 07:30:00', '2024-01-20 12:15:00', 6, 9, 1, 1250000, 260000,''),
('2024-01-21 06:00:00', '2024-01-21 11:30:00', 7, 10, 2, 880000, 190000,''),
('2024-01-22 05:00:00', '2024-01-22 19:45:00', 8, 1, 3, 2050000, 410000,''),
('2024-01-23 08:30:00', '2024-01-23 17:00:00', 9, 3, 4, 1550000, 330000,''),
('2024-01-24 07:00:00', '2024-01-25 00:30:00', 10, 4, 5, 2750000, 570000,'');

INSERT INTO tbUsers (nomUser, mdp) VALUES
('ESTELLE', 'admin123'),
('ANDRY', 'mgr456'),
('Comptable_A', 'cpta789'),
('Superviseur_Tana', 'supv012'),
('Chauffeur_Mgr', 'chfm345'),
('Operateur_1', 'oper678'),
('Operateur_2', 'oper901'),
('Directeur_Tana', 'dir234'),
('Assistant_Tana', 'ast567'),
('Technicien_Tana', 'tech890');

INSERT INTO tbPourcentages (pourcentage) VALUES
(5.0),
(7.5),
(10.0),
(12.5),
(15.0),
(17.5),
(20.0),
(22.5),
(25.0),
(30.0);

INSERT INTO tbVersements (minVersement, idPourcentage) VALUES
(100000, 1),
(500000, 2),
(1000000, 3),
(2000000, 4),
(3000000, 5),
(5000000, 6),
(7000000, 7),
(10000000, 8),
(15000000, 9),
(20000000, 10);

CREATE OR REPLACE VIEW v_listParJourVehiculesEtChauffeur AS
SELECT 
    DATE(mt.dateDebut) as jour,
    v.nomVehicule,
    c.nomChauffeur,
    t.distance as kilometreEffectue,
    mt.montantRecette,
    mt.montantCarburant,
    (mt.montantRecette - mt.montantCarburant) as benefice
FROM tbMvtTrajet mt
JOIN tbVehicules v ON mt.idVehicule = v.id
JOIN tbChauffeurs c ON mt.idChauffeur = c.id
JOIN tbTrajets t ON mt.idTrajet = t.id
ORDER BY mt.dateDebut DESC;


-- Ajouter la colonne panne à tbMvtTrajet si elle n'existe pas
ALTER TABLE tbMvtTrajet ADD COLUMN panne TEXT;

-- Ajouter une colonne date pour les versements
ALTER TABLE tbVersements ADD COLUMN date_creation DATE DEFAULT CURRENT_DATE;

-- 1. VIEW pour véhicules avec leurs trajets
CREATE OR REPLACE VIEW view_vehicules_trajets AS
SELECT 
    v.id,
    v.nomVehicule,
    v.isDisponible,
    mt.dateDebut,
    mt.dateFin,
    mt.panne
FROM tbVehicules v
LEFT JOIN tbMvtTrajet mt ON v.id = mt.idVehicule;

-- 2. VIEW pour taux de panne par mois
-- CREATE OR REPLACE VIEW view_taux_panne_mois AS
-- SELECT 
--     v.id,
--     v.nomVehicule,
--     COUNT(mt.idVehicule) as jours_travailles,
--     SUM(CASE WHEN mt.panne IS NOT NULL AND mt.panne != '' THEN 1 ELSE 0 END) as jours_panne,
--     MONTH(mt.dateDebut) as mois,
--     YEAR(mt.dateDebut) as annee
-- FROM tbVehicules v
-- LEFT JOIN tbMvtTrajet mt ON v.id = mt.idVehicule
-- WHERE mt.dateDebut IS NOT NULL
-- GROUP BY v.id, v.nomVehicule, MONTH(mt.dateDebut), YEAR(mt.dateDebut);


-- 3. VIEW pour salaire journalier
CREATE OR REPLACE VIEW view_salaire_journalier AS
SELECT 
    c.id,
    c.nomChauffeur,
    DATE(mt.dateDebut) as date_trajet,
    SUM(mt.montantRecette) as recette_totale,
    vrs.minVersement,
    prc.pourcentage as pourcentage_sup_minimum
FROM tbChauffeurs c
JOIN tbMvtTrajet mt ON c.id = mt.idChauffeur
LEFT JOIN tbVersements vrs ON vrs.date_creation <= DATE(mt.dateDebut) 
    OR vrs.date_creation IS NULL
LEFT JOIN tbPourcentages prc ON prc.id = vrs.idPourcentage
GROUP BY c.id, c.nomChauffeur, DATE(mt.dateDebut), vrs.minVersement, prc.pourcentage;

-- 4. VIEW pour vérification historique salaire
CREATE OR REPLACE VIEW view_verification_salaire AS
SELECT 
    DATE(mt.dateDebut) as date_trajet,
    c.nomChauffeur,
    mt.montantRecette,
    vrs.minVersement,
    prc.pourcentage as pourcentage_config
FROM tbMvtTrajet mt
JOIN tbChauffeurs c ON mt.idChauffeur = c.id
LEFT JOIN tbVersements vrs ON vrs.date_creation <= mt.dateDebut 
    OR vrs.date_creation IS NULL
LEFT JOIN tbPourcentages prc ON prc.id = vrs.idPourcentage;