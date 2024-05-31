document.addEventListener('DOMContentLoaded', function()
{
    iniciarApp();
});

function iniciarApp()
{
    buscarFecha();
}   // Here End Function Iniciar App

function buscarFecha()
{
    const fechaInput = document.querySelector( '#fecha' );
    fechaInput.addEventListener( 'input', function( e )
    {
        const fechaSeleccionada = e.target.value;

        window.location = `?fecha=${fechaSeleccionada}`;
    });
}   // Here End Function Buscar Fecha