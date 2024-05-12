<?php

namespace Model;

class Usuario extends ActiveRecord
{
    // Database
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'telefono', 'admin', 'confirmado', 'token', 'password'];

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
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
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

    public function validarEmail()
    {
        if( $this->email === '')
        {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }   // Here End If

        return self::$alertas;
    }   // Here End Email

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

    public function validarLogin()
    {
        if(!$this->email)
        {
            self::$alertas['error'][] = 'El Email Es Obligatorio';
        }   // Here End If

        if(!$this->password)
        {
            self::$alertas['error'][] = 'La Contraseña Es Obligatoria';
        }   // Here End If

        return self::$alertas;
    }   // Here End Function Validar Login

    public function comprobarPasswordAndVerificado( $email )
    {
        $resultado = password_verify($email, $this->password);
        
        if(!$resultado || !$this->confirmado)
        {
            self::$alertas['error'][] = 'La Contraseña Es Incorrecta o la Cuenta no Esta Confirmada';
        }   // Here End If
        else
        {
            return true;
        }   // Here End Else 
    }   // Here End Function Comprobar Password Verificado

}   // Here End Class Usuario


?>