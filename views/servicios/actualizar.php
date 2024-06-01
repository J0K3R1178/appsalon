<h1 class="nombre-pagina">Servicios</h1>
<h4 class="descripcion-pagina">Modifica los Servicios con los Campos A Continuacion</h4>

<?php
    include_once __DIR__ . "/../template/barra.php";
    include_once __DIR__ . "/../template/alertas.php";

?>

<form class="formulario" method="POST">
    <?php include_once __DIR__ . "/formulario.php"; ?>
    <input type="submit" class="boton" value="Actualizar">
</form>