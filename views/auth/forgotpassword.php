<h1 class="nombre-pagina">Olvidaste tu Contraseña</h1>
<h4 class="descripcion-pagina">Reestablece tu Password Escribiendo tu Email</h4>

<form action="/forgotPassword" method="post" class="formulario">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email" required>
    </div>

    <input type="submit" class="boton" value="Enviar Instrucciones">

    <div class="acciones">
        <a href="/" class="">Inicia Sesion</a>
        <a href="/register" class="">Registrarse</a>
    </div>
</form>