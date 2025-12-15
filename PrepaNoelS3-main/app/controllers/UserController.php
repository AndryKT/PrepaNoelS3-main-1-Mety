<?php
namespace app\controllers;

use app\models\User;
use Flight;

class UserController {

    public static function loginForm() {
        Flight::render('login');
    }

    public static function login() {
        $nomUser = $_POST['nomUser'] ?? '';
        $mdp = $_POST['mdp'] ?? '';

        $user = User::checkLogin($nomUser, $mdp);

        if ($user) {
            $_SESSION['user'] = $user;
            Flight::redirect('/home');
        } else {
            Flight::redirect('/login?error=1');
        }
    }

    public static function home() {
        if (!isset($_SESSION['user'])) {
            Flight::redirect('/login');
        }
        Flight::render('home', ['user' => $_SESSION['user']]);
    }
}
