<?php

//  Namespaces
namespace Controllers;

// Uses

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
                echo 'ALL GOOD';
                exit;
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