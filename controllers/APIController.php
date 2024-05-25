<?php

namespace Controllers;

use Model\Cita;
use Model\Servicio;

class APIController
{
    public static function index()
    {
        $servicios = Servicio::all();

        echo json_encode($servicios);
        
    }   // Here End Function Index

    public static function guardar()
    {
        $cita = new Cita( $_POST );

        $resultado = $cita->guardar();

        echo json_encode( $resultado );
    }   // Her End Function Guardar
}   // Here End Class
