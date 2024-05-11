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
                }   // Here End If
                else
                {
                    // Hash Password
                    $usuario->hashPassword();

                    // Create a Unique Token
                    $usuario->crearToken();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    $resultado = $usuario->guardar();

                    if($resultado)
                    {
                        header('Location: /message');
                    }   // Here End If
                }   // Here End Else
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

    public static function confirmAccount(Router $router)
    {
        echo "Desde Confirm Account";
    }   // Here End Function Confirm Account

    public static function message(Router $router)
    {
        $router->render('auth/message');
    }   // Here End Function Message

}   // Here End Class LoginController


?>