<h1 class="nombre-pagina">Panel de Administracion</h1>
<?php
    include_once __DIR__ . '/../template/barra.php';
?>

<h2>Buscar Citas</h2>

<div class="bisqueda">
    <form class="formulario" action="">
        <div class="campo">
            <label for="Fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>" />
        </div>
    </form>
</div>

<div id="citas-admin">
    <ul class="citas">
        <?php
        $cita_id = 0;
        $total = 0;
            foreach( $citas as $key => $cita ):
                if( $cita_id !== $cita->id ):
        ?>
            <li>
                <p>ID: <span><?php echo $cita->id; ?></span></p>
                <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                <p>Email: <span><?php echo $cita->email; ?></span></p>
                <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>

                <h3>Servicios</h3>

                <?php
                $cita_id = $cita->id;
                // Here End IF
                    endif;
                    $total += $cita->precio;
                ?>

                <p class="servicio"><?php echo $cita->servicio . ' ' . $cita->precio;?></p>

                <?php
                    $actual = $cita->id;
                    $proximo = $citas[$key + 1]->id ?? 0;

                    if( esUltimo( $actual, $proximo ) ) 
                    { ?>
                    <p class="total">Total: <span>$ <?php echo $total; ?></span></p>

                <?php 
                        
                    }   // Here End If
                ?>

        <?php
        // Here End Foreach
            endforeach;
        ?>

    </ul>
    
</div>

<?php

        $script = "<script src='build/js/buscador.js'></script>";