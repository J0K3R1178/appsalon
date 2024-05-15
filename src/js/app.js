let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

document.addEventListener('DOMContentLoaded', function()
{
    iniciarApp();
});

function iniciarApp()
{
    // Show And Hide Sections
    mostrarSeccion();
    // Change The Section When User Clicked
    tabs(); 
    //  Add o Remove Buttons of Paginador
    botonesPaginador();

    paginaSiguiente();

    paginaAnterior();
}   // Here End Function Iniciar App

function tabs()
{
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => 
        {
        boton.addEventListener('click', function( e ) 
            {
            paso = parseInt( e.target.dataset.paso );
            mostrarSeccion();

            botonesPaginador();
            });
        });
}   // Here End Function Tabs

function mostrarSeccion()
{
    // Hide the Section That Has The Class mostrar
    const seccionAnterior = document.querySelector('.mostrar');
    if( seccionAnterior )
        {
            seccionAnterior.classList.remove('mostrar');
        }
    // Select Section With The Pass
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector( pasoSelector );
    seccion.classList.add('mostrar');

    // Remove the previous Tab class
    const tabAnterior = document.querySelector('.actual');
    if( tabAnterior )
    {
        tabAnterior.classList.remove('actual');
    }

    // Highlight the Current Tab
    const tab = document.querySelector( `[data-paso="${paso}"]`);
    tab.classList.add('actual');
}   // Here End Function Mostrar Seccion

function botonesPaginador()
{
    const paginaSiguiente = document.querySelector('#siguiente');
    const paginaAnterior = document.querySelector('#anterior');
    
    if( paso === 1)
        {
            paginaAnterior.classList.add('ocultar');
            paginaSiguiente.classList.remove('ocultar');
        }
    else if( paso === 3)
        {
            paginaAnterior.classList.remove('ocultar');
            paginaSiguiente.classList.add('ocultar');
        }
    else
    {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior()
{
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function()
    {
        if( paso < pasoInicial ) return;
        paso--;

        botonesPaginador();
    });
}

function paginaSiguiente()
{
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function()
    {
        if( paso >= pasoFinal ) return;
        paso++;

        botonesPaginador();
    });
}