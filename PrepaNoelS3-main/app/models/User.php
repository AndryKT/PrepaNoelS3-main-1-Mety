<?php
namespace app\models;

use Flight;

class User {

    public static function checkLogin($nomUser, $mdp) {
        $db = Flight::db();

        $sql = "SELECT * FROM tbUsers WHERE nomUser = :nom AND mdp = :mdp";
        $stm = $db->prepare($sql);
        $stm->execute([
            'nom' => $nomUser,
            'mdp' => $mdp
        ]);

        return $stm->fetch();
    }
}
