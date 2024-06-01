<?php

namespace Model;

class Servicio extends ActiveRecord
{
    // Database
    protected static $tabla = "servicios";
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct( $args = [] )
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }   // Here End Construct

    public function validar()
    {
        if( !$this->nombre )
        {
            self::$alertas['error'][] = "EL Nombre del Servicio es Obligatorio";
        }   // Here End If

        if( !$this->precio )
        {
            self::$alertas['error'][] = "EL Precio del Servicio es Obligatorio";
        }   // Here End If

        if( is_numeric(!$this->precio ) )
        {
            self::$alertas['error'][] = "EL Precio del Servicio Deben Ser Numeros Validos";
        }   // Here End If

        return self::$alertas;
    }   // Here End Function Validar

}   // Here End Class Servicio

