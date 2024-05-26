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