<?php


namespace Model;


class CitaServicio extends ActiveRecord
{
    protected static $tabla = "citas_servicios";
    protected static $columnasDB = ['id', 'servicios_id', 'citas_id'];

    public $id;
    public $citas_id;
    public $servicios_id;

    public function __construct( $args = [] )
    {
        $this->id = $args['id'] ?? null;
        $this->servicios_id = $args['servicios_id'] ?? '';
        $this->citas_id = $args['citas_id'] ?? '';
        
    }   // Here End Construct
}   // Here End Class CitaServicio