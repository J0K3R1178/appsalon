<?php

namespace Controllers;

use MVC\Router;

class ServicioController
{
    public static function index( Router $router )
    {
        session_start();

        $router->render('/servicios/index', 
        [
            'nombre' => $_SESSION['nombre']
        ]);
    }   // Here End Function Index

    public static function create( Router $router )
    {
        session_start();

        if( $_SERVER['REQUEST_METHOD'] == 'POST' )
        {

        }   // Here End If

        $router->render('/servicios/crear', 
        [
            'nombre' => $_SESSION['nombre']
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