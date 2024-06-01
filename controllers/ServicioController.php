<?php

namespace Controllers;

use MVC\Router;
use Model\Servicio;

class ServicioController
{
    public static function index( Router $router )
    {
        session_start();

        $servicios = Servicio::all();
        
        

        $router->render('/servicios/index', 
        [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }   // Here End Function Index

    public static function create( Router $router )
    {
        session_start();

        $servicio = new Servicio;
        $alertas = [];

        if( $_SERVER['REQUEST_METHOD'] == 'POST' )
        {
            $servicio->sincronizar( $_POST );

            $alertas = $servicio->validar();

            if( empty( $alertas ) )
            {
                $servicio->guardar();
                header('Location: /servicios');
            }   // Here End If
        }   // Here End If

        $router->render('/servicios/crear', 
        [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }   // Here End Function Create

    public static function update( Router $router )
    {
        session_start();

        $router->render('/servicios/index', 
        [
            'nombre' => $_SESSION['nombre']
        ]);
    }   // Here End Function Update

    public static function delete( Router $router )
    {
        session_start();

        $router->render('/servicios/index', 
        [
            'nombre' => $_SESSION['nombre']
        ]);
    }   // Here End Function Delete
}   // Here End Class ServiceController