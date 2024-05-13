<h1 class="nombre-pagina">Reestable Tu Contraseña</h1>
<h4 class="descripcion-pagina">Coloca Tu Nueva Contraseña</h4>

<?php

    include_once __DIR__. '/../template/alertas.php';

?>

<?php
    if( $error ) return;
?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Coloca Tu Nuevo Password">
    </div>

    <input type="submit" class="boton" value="Guardar Nueva Contraseña">

    <div class="acciones">
        <a href="/" class="">Inicia Sesion</a>
        <a href="/register" class="">Registrarse</a>
    </div>
</form>