<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\ServicioController;

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

//  Get Routes Api de Citas 
$router->get('/api/servicios', [APIController::class,'index']);

// Get Routes Admin
$router->get('/admin', [AdminController::class,'index']);

// Get Routes Servicio Controller
$router->get('/servicios', [ServicioController::class,'index']);
$router->get('/servicios/crear', [ServicioController::class,'create']);
$router->get('/servicios/actualizar', [ServicioController::class,'update']);
$router->get('/servicios/eliminar', [ServicioController::class,'delete']);

// Get Routes Cita Controller

// Post Routes Api de Citas
$router->post('/api/citas', [APIController::class,'guardar']);
$router->post('/api/eliminar', [APIController::class,'eliminar']);


// Post Routes Login Controller
$router->post('/', [LoginController::class, 'login']);
$router->post('/register', [LoginController::class,'register']);
$router->post('/forgotPassword', [LoginController::class, 'forgotPassword']);
$router->post('/resetPassword', [LoginController::class, 'resetPassword']);

// Post Routes Servicio Controller
$router->post('/servicios/crear', [ServicioController::class,'create']);
$router->post('/servicios/actualizar', [ServicioController::class,'update']);
$router->post('/servicios/eliminar', [ServicioController::class,'delete']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();