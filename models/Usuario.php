<?php

namespace Model;

class Usuario extends ActiveRecord
{
    // Database
    protected static $tabla = 'usuarios';
    protected static $columnasDB = array('id', 'nombre', 'apellido', 'email', 'telefono', 'admin', 'confirmado', 'token', 'password');

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;
    public $password;

    public function __construct( $args = [] )
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
        $this->token = $args['token'] ?? '';
        $this->password = $args['password'] ?? '';
    }   // Here End Construct

    public function validarNuevaCuenta()
    {
        if( $this->nombre === '')
        {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }   // Here End If

        if( $this->apellido === '')
        {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }   // Here End If

        if( $this->email === '')
        {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }   // Here End If

        if( $this->telefono === '')
        {
            self::$alertas['error'][] = 'El Telefono es Obligatorio';
        }   // Here End If

        if( $this->password === '')
        {
            self::$alertas['error'][] = 'La Contraseña es Obligatoria';
        }   // Here End If
        elseif( strlen($this->password) < 6)
        {
            self::$alertas['error'][] = 'La Contraseña debe tener al menos 6 caracteres';
        }   // Here End ElseIf

        return self::$alertas;

    }   // Here End Function Validar Nueva Cuenta

    public function existeUsuario()
    {
        $query = 'SELECT * FROM ' . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        
        if( $resultado->num_rows)
        {
            self::$alertas['error'][] = 'El Usuario Ya Esta Registrado';
        }   // Here End If

        return $resultado;

    }   // Here End Function Existe Usuario

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }   // Here End Function Hash Password

    public function crearToken()
    {
        $this->token = uniqid();
    }   // Here End Function Crear Token

}   // Here End Class Usuario


?>