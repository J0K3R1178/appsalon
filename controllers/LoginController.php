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
        $alertas = [];

        $auth = new Usuario();

        if( $_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if( empty($alertas) )
            {
                // Check If The User Exist
                $usuario = Usuario::where('email', $auth->email);

                if( $usuario )
                {
                    // Check if The Password is Good
                    if( $usuario->comprobarPasswordAndVerificado($auth->password) )
                    {
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . ' ' . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        if($usuario->admin === '1')
                        {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('location: /admin');
                        }   // Here End If
                        else
                        {
                            header('Location: /cita');
                        }
                        showValues( $_SESSION);
                    }   // Here End If

                }   // Here End If
                else
                {
                    Usuario::setAlerta('error', 'Usuario No Encontrado');
                }   // Here End Else    
            }   // Here End If

            $alertas = Usuario::getAlertas();

        }   // Here End If
        $router->render('/auth/login', 
        [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }   // Here End Function Login

    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header('Location: /');
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
        $alertas = [];

        if( $_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            
            if( empty( $alertas ) )
            {
                $usuario = Usuario::where('email', $auth->email);

                if( $usuario && $usuario->confirmado === '1')
                {
                    // Create A Token
                    $usuario->crearToken();
                    $usuario->guardar();

                    // Send Email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    // TODO:
                    Usuario::setAlerta('exito', 'Revisa tu Email');
                }   // Here End If
                else
                {
                    Usuario::setAlerta('error', 'El Usuario No Existe o No Esta Confirmado');
                }   // Here End Else
            }   // Here End If
        }   // Here End If

        $alertas = Usuario::getAlertas();

        $router->render('auth/forgotpassword', 
        [
            'alertas' => $alertas
        ]);
    }   // Here End Function forgotPassword

    public static function resetPassword( Router $router)
    {
        $alertas = [];
        $error = false;

        $token = s( $_GET['token'] );

        $usuario = Usuario::where('token', $token);

        if( empty( $usuario ) )
        {
            Usuario::setAlerta('error', 'Token No Valido');
            $error = true;
        }   // Here End If

        if( $_SERVER['REQUEST_METHOD'] == 'POST' )
        {
            // Read New Password and Save It
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();
        }   // Here End If

        if( empty( $alertas ) )
        {
            $usuario->password = null;
            $usuario->password = $password->password;
            $usuario->hashPassword();
            $usuario->token = null;
            $resultado = $usuario->guardar();
            if( $resultado )
            {
                header('Location: /');
            } // Here End If
        }   // Here End If

        $alertas = Usuario::getAlertas();

        $router->render('auth/resetPassword', 
        [
            'alertas'=> $alertas,
            'error' => $error
        ]);
    }   // Here End Function Reset Password

    public static function confirmAccount(Router $router)
    {
        $alertas = [];

        $token = s( $_GET['token'] );

        $usuario = Usuario::where('token', $token);

        if( empty( $usuario ) )
        {
            $alertas = Usuario::setAlerta('error', 'Token No Valido');
        }   // Here End If
        else
        {
            $usuario->confirmado = 1;
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Confirmada Correctamente');
        }   // Here End Else

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmaccount', 
        [
            'alertas' => $alertas
        ]);
    }   // Here End Function Confirm Account

    public static function message(Router $router)
    {
        $router->render('auth/message');
    }   // Here End Function Message

}   // Here End Class LoginController


?>