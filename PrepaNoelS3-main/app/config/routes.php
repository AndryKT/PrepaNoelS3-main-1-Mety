<?php

use app\controllers\UserController;
use app\controllers\MvtTrajetController;
use app\controllers\GestionController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\net\Router;
use flight\Engine;

/**
 * @var Router $router
 * @var Engine $app
 */

session_start();

// SECURED GROUP
$router->group('', function(Router $router) use ($app) {

    /* ---------------- LOGIN ---------------- */
    $router->get('/login', [UserController::class, 'loginForm']);
    $router->post('/login', [UserController::class, 'login']);
    $router->get('/home', [UserController::class, 'home']);

    /* ------------ MOUVEMENT TRAJET ---------- */
    $router->get('/mvtTrajet', [MvtTrajetController::class, 'form']);
    $router->post('/mvtTrajet/save', [MvtTrajetController::class, 'save']);

    $router->get('/stats', [MvtTrajetController::class, 'stats']);

    $router->get('/gestion', [GestionController::class, 'index']);
    $router->get('/gestion/verification', [GestionController::class, 'verificationSalaire']);
    $router->post('/gestion/update-versement', [GestionController::class, 'updateVersement']);

}, [ SecurityHeadersMiddleware::class ]);
