<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use Controllers\CitaController;
use MVC\Router;

$router = new Router();

// Get Routes Login Controller
$router->get('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/register', [LoginController::class,'register']);
$router->get('/forgotPassword', [LoginController::class,'forgotPassword']);
$router->get('/resetPassword', [LoginController::class, 'resetPassword']);
$router->get('/confirmAccount', [LoginController::class, 'confirmAccount']);
$router->get('/message', [LoginController::class, 'message']);

// Get Routes Cita Controller
$router->get('/cita', [CitaController::class,'index']);


// Post Routes Login Controller
$router->post('/', [LoginController::class, 'login']);
$router->post('/register', [LoginController::class,'register']);
$router->post('/forgotPassword', [LoginController::class, 'forgotPassword']);
$router->post('/resetPassword', [LoginController::class, 'resetPassword']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();