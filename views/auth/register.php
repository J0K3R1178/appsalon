<h1 class="nombre-pagina">Crear Cuenta</h1>
<h4 class="descripcion-pagina">Llena el Formulario para Crear una Cuenta</h4>

<form action="/register" class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Tu Nombre">
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido" placeholder="Tu Apellido">
    </div>

    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Tu Email">
    </div>

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input type="tel" name="telefono" id="telefono" placeholder="Tu Telefono">
    </div>

    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Tu Contraseña">
    </div>

    <input type="submit" class="boton" value="Crear Cuenta" />

    <div class="acciones">
        <a href="/" class="">Inicia Sesion</a>
        <a href="/forgotPassword" class="">Recuperar Contraseña</a>
    </div>
</form>