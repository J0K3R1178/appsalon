<?php

function showValues($variable) : string 
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}   // Here End Function ShowValues

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Check if the User is Authenticated
function isAuth()
{
    if( !isset( $_SESSION['login']  ) )
    {
        header('Location: /');
    }   // Here End If
}   // Here End Function IsAuth

function esUltimo( string $actual, string $proximo): bool
{
    if( $actual !== $proximo)
    {
        return true;
    }   // Here End If

    return false;
}   // Here End Function EsUltimo