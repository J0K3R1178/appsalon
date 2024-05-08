<?php

//  Namespaces
namespace Controllers;

// Uses
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
        $router->render('auth/register');
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