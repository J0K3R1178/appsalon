<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
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
        // Save the appointment and return the ID
        $cita = new Cita( $_POST );

        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // Save the Services with the ID of the appointment
        $idServicios = explode(',', $_POST['servicios']);

        foreach ($idServicios as $idServicio) 
        {
            $args = 
            [
                'servicios_id' => $idServicio,
                'citas_id' => $id
                
            ];

            $citaServicio = new CitaServicio( $args );
            $citaServicio->guardar();
        }   // Here End Foreach

        echo json_encode( ['resultado' => $resultado] );
    }   // Her End Function Guardar

    public static function eliminar()
    {
        if( $_SERVER['REQUEST_METHOD'] === 'POST' )
        {
            $id = $_POST['id'];

            $cita = Cita::find( $id );

            $cita->eliminar();

            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }   // Here End If
    }   // Here End Function Eliminar
}   // Here End Class
