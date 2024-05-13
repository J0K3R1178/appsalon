<h1 class="nombre-pagina">Login</h1>
<h4 class="descripcion-pagina">Inicia Sesion con tus Datos</h4>

<?php

    include_once __DIR__. '/../template/alertas.php';

?>

<form action="/" class="formulario" method="POST">
    
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Tu Email" value="<?php echo s($auth->email); ?>" required />
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Tu Password" required />
    </div>

    <input type="submit" class="boton" value="Iniciar Sesion" />

    <div class="acciones">
        <a href="/register" class="">Registrarse</a>
        <a href="/forgotPassword" class="">Recuperar Contraseña</a>
    </div>
</form>