<?php

$db = mysqli_connect('localhost', 'root', 'J0K3R1178', 'appsalon_udemy');


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
