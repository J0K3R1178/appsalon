<h1 class="nombre-pagina">Servicios</h1>
<h4 class="descripcion-pagina">LLena Todos Los Campos para Agregar un Nuevo Servicio</h4>
<?php
    include_once __DIR__ . "/../template/barra.php";
    include_once __DIR__ . "/../template/alertas.php";

?>

<form action="/servicios/crear" class="formulario" method="POST">
    <?php include_once __DIR__ . "/formulario.php"; ?>
    <input type="submit" class="boton" value="Guardar Servicio">
</form>