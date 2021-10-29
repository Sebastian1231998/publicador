<?php

require_once __DIR__ . "/../includes/app.php";

use Controllers\MessageController;
use Controllers\ProfileController;
use Controllers\RegistroController;
use Controllers\AppController;
use MVC\Router;



$router = new Router();


$router->requestGet('/', [RegistroController::class,  'redirect']);
$router->requestGet('/homepage', [AppController::class,  'homepage']);
$router->requestPost('/homepage', [AppController::class,  'homepage']);
$router->requestGet('/login', [RegistroController::class,  'login']);
$router->requestPost('/login', [RegistroController::class,  'login']);
$router->requestGet('/registro', [RegistroController::class,  'registro']);
$router->requestPost('/models/usuario', [RegistroController::class,  'registrarUsuario']);


$router->requestGet('/user/profile/prueba', [ProfileController::class,  'profile_prueba']);

//rutas models 

$router->requestGet('/user/profile', [ProfileController::class,  'profile']);
$router->requestPost('/user/profile', [ProfileController::class,  'profile']);
$router->requestPost('/publicacion', [ProfileController::class,  'publicacion']);
$router->requestGet('/cerrar', [RegistroController::class,  'cerrar']);



//
$router->requestPost('/models/comments', [AppController::class,  'comments']);
$router->requestGet('/models/comments', [AppController::class,  'commentsGet']);





// Messages 

$router->requestGet('/messages/user', [MessageController::class,  'messagePage']);
$router->requestGet('/models/messages', [MessageController::class,  'getMessage']);
$router->requestPost('/models/messages', [MessageController::class,  'messagePage']);
$router->requestPost('/models/messages/updateNotification', [MessageController::class,  'messageNotificacion']);





$router->validaRequest();
