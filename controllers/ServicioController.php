<?php

namespace Controllers;

use MVC\Router;
use Model\Servicio;

class ServicioController
{
    public static function index( Router $router )
    {
        session_start();

        isAdmin();

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

        isAdmin();

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

        isAdmin();

        $id = is_numeric(  $_GET['id'] );

        if( !$id ) return;

        $servicio = Servicio::find( $id );
        $alertas = [];

        if( $_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $servicio->sincronizar( $_POST );

            $alertas = $servicio->validar();

            if( empty( $alertas ) )
            {
                $servicio->guardar();
                header('Location: /servicios');
            }   // Here End If

        }   // Here End If

        $router->render('/servicios/actualizar', 
        [
            'nombre' => $_SESSION['nombre'],
            'alertas' => $alertas,
           'servicio' => $servicio
        ]);
    }   // Here End Function Update

    public static function delete( Router $router )
    {
        session_start();

        isAdmin();

        if( $_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $servicio = $_POST['id'];
            $servicio->eliminar();
            header('Location: /servicios');
        }   // Here End If

        $router->render('/servicios/index', 
        [
            'nombre' => $_SESSION['nombre']
        ]);
    }   // Here End Function Delete
}   // Here End Class ServiceController