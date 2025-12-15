<?php
namespace app\models;

use Flight;

class MvtTrajet {

    public static function getAllChauffeurs() {
        return Flight::db()->query("SELECT * FROM tbChauffeurs")->fetchAll();
    }

    public static function getAllVehicules() {
        return Flight::db()->query("SELECT * FROM tbVehicules")->fetchAll();
    }

    public static function getAllTrajets() {
        return Flight::db()->query("SELECT * FROM tbTrajets")->fetchAll();
    }

    public static function save($data) {
        $sql = "INSERT INTO tbMvtTrajet(dateDebut,dateFin,idChauffeur,idVehicule,idTrajet,montantRecette,montantCarburant,panne)
                VALUES (:dateDebut,:dateFin,:idChauffeur,:idVehicule,:idTrajet,:recette,:carburant,:panne)";

        $stm = Flight::db()->prepare($sql);
        return $stm->execute($data);
    }

    // ============ NOUVELLES METHODES POUR LA PAGE 3 ============

    /**
     * Récupérer toutes les statistiques par jour, véhicule et chauffeur
     */
    public static function getStatsByDayVehicleAndDriver() {
        $sql = "SELECT * FROM v_listParJourVehiculesEtChauffeur";
        return Flight::db()->query($sql)->fetchAll();
    }

    /**
     * Récupérer le bénéfice total par jour
     */
    public static function getDailyBenefitSummary() {
        $sql = "SELECT 
                    jour,
                    SUM(montantRecette) as totalRecette,
                    SUM(montantCarburant) as totalCarburant,
                    SUM(benefice) as totalBenefice,
                    SUM(kilometreEffectue) as totalKilometres
                FROM v_listParJourVehiculesEtChauffeur
                GROUP BY jour
                ORDER BY jour DESC";
        return Flight::db()->query($sql)->fetchAll();
    }

    /**
     * Récupérer le bénéfice par véhicule
     */
    public static function getBenefitByVehicle() {
        $sql = "SELECT 
                    nomVehicule,
                    SUM(montantRecette) as totalRecette,
                    SUM(montantCarburant) as totalCarburant,
                    SUM(benefice) as totalBenefice,
                    SUM(kilometreEffectue) as totalKilometres
                FROM v_listParJourVehiculesEtChauffeur
                GROUP BY nomVehicule
                ORDER BY totalBenefice DESC";
        return Flight::db()->query($sql)->fetchAll();
    }

    /**
     * Récupérer les détails des bénéfices par jour
     */
    public static function getDailyBenefitDetails() {
        $sql = "SELECT 
                    jour,
                    nomVehicule,
                    nomChauffeur,
                    kilometreEffectue,
                    montantRecette,
                    montantCarburant,
                    benefice
                FROM v_listParJourVehiculesEtChauffeur
                ORDER BY jour DESC, benefice DESC";
        return Flight::db()->query($sql)->fetchAll();
    }

    
}