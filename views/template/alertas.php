<?php

    foreach($alertas as $key => $alerta)
    {
        foreach($alerta as $mensaje)
        {
?>
        <div class="alerta <?php echo $key; ?>">
            <?php echo $mensaje; ?>
        </div>

<?php
        }   // Here End Foreach

    }   //  Here End Foreach
?>