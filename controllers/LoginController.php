<?php

//  Namespaces
namespace Controllers;

// Uses
use MVC\Router;

class LoginController
{
    public static function login()
    {
        echo "Welcome";
    }   // Here End Function Login

    public static function logout()
    {
        echo "Desde Logout";
    }   // Here End Function Logout

    public static function register()
    {
        echo "Desde Register";
    }   // Here End Function Register

    public static function forgotPassword()
    {
        echo "Desde forgot Password";
    }   // Here End Function forgotPassword

    public static function resetPassword()
    {
        echo "Desde Reset Password";
    }   // Here End Function Reset Password

}   // Here End Class LoginController


?>