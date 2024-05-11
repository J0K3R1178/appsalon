<?php

//  Namespaces
namespace Controllers;

// Uses

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $router->render('/auth/login');
    }   // Here End Function Login

    public static function logout()
    {
        echo "Desde Logout";
    }   // Here End Function Logout

    public static function register(Router $router)
    {
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            if( empty( $alertas ) )
            {
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows)
                {
                    $alertas = Usuario::getAlertas();
                }
                else
                {
                    // Hash Password
                    $usuario->hashPassword();

                    // Create a Unique Token
                    $usuario->crearToken();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    showValues($email);
                }
            }   // Here End If

        }   // Here End If

        $router->render('auth/register', 
        [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }   // Here End Function Register

    public static function forgotPassword(Router $router)
    {
        $router->render('auth/forgotpassword');
    }   // Here End Function forgotPassword

    public static function resetPassword()
    {
        echo "Desde Reset Password";
    }   // Here End Function Reset Password

}   // Here End Class LoginController


?>