<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige Tus Servicios a Continuacion</p>

<div class="app">
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1" >Servicios</button>
        <button type="button" data-paso="2" >Informacion Cita</button>
        <button type="button" data-paso="3" >Resumen</button>
    </nav>
    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige Tus Servicios a Continuacion</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Citas</h2>
        <p class="text-center">Coloca Tus Datos y Fecha de Tu Cita</p>

        <form class="formulario" action="">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" value="<?php echo $nombre; ?>"/>
            </div>

            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" min="<?php echo date('Y-m-d'); ?>">
            </div>

            <div class="campo">
                <label for="hora">Hora</label>
                <input type="time" id="hora" name="hora">
            </div>
        </form>
    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p>Verifica que la Informacion es Correcta</p>
    </div>

    <div class="paginacion">
        <button type="button" id="anterior" class="boton">&laquo;Anterior</button>
        <button type="button" id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>

<?php $script = "
    <script src='build/js/app.js'></script>";