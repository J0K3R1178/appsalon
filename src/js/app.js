let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = 
{
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function()
{
    iniciarApp();
}); // Here End EventListener

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

    // Consult Api in the Backend
    consultarApi();

    // Add The Name of Client to Object Cita
    nombreCliente();

    idCliente();

    // Add The Date of Client to Object Cita
    seleccionarFecha();

    // Add the Hour of Client to Object Cita
    seleccionarHora();

    // Shows Resume of the Date
    mostrarResumen();
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

            mostrarResumen();
        }
    else
    {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}   // Here End Function Botones Paginador

function paginaAnterior()
{
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function()
    {
        if( paso < pasoInicial ) return;
        paso--;

        botonesPaginador();
    });
}   // Here End Function Pagina Anterior

function paginaSiguiente()
{
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function()
    {
        if( paso >= pasoFinal ) return;
        paso++;

        botonesPaginador();
    });
}   // Here End Function Pagina Siguiente

async function consultarApi()
{
    try 
    {
        const url = 'http://localhost:3000/api/servicios';
        const resultado = await fetch( url );
        const servicios = await resultado.json();
        mostrarServicios( servicios );
    } catch (error) 
    {
        console.log(error);
    }   // Here End Try Catch 
}   // Here End Function Consultar API

function mostrarServicios( servicios )
{
    servicios.forEach( servicio => 
        {
            const { id, nombre, precio} = servicio;
            
            const nombreServicios = document.createElement( 'P' );
            nombreServicios.classList.add( 'nombre-servicio' );
            nombreServicios.textContent = nombre;

            const precioServicios = document.createElement( 'P' );
            precioServicios.classList.add( 'precio-servicio' );
            precioServicios.textContent = `$${precio}`;

            const servicioDiv = document.createElement( 'DIV' );
            servicioDiv.classList.add( 'servicio' );
            servicioDiv.dataset.idServicio = id;
            servicioDiv.onclick = function()
            {
                seleccionarServicio( servicio );
            };

            servicioDiv.appendChild( nombreServicios );
            servicioDiv.appendChild( precioServicios );

            document.querySelector('#servicios').appendChild( servicioDiv );
        });
}   // Here End Function Mostrar Servicios

function seleccionarServicio( servicio )
{
    const { id } = servicio;
    const { servicios } = cita;
    // Identify Element That Is Clicked
    const divServicio = document.querySelector( `[data-id-servicio="${id}"]` );

    

    // Check if a service was already added
    if( servicios.some( agregado => agregado.id === id ) )
        {
            // Delete the service
            cita.servicios = servicios.filter( agregado => agregado.id != id);
            // Remove the class
            divServicio.classList.remove('seleccionado' );
        }   // Here End If
        else
        {
            // Add the service
            cita.servicios = [...servicios, servicio];
            divServicio.classList.add( 'seleccionado' );
        }   // Here End Else

}   // Here End Function Seleccionar Servicio

function nombreCliente()
{
    const nombre = document.querySelector('#nombre').value;
    cita.nombre = nombre;

}   // Here End Function Nombre Cliente

function seleccionarFecha() 
{
    const inputFecha = document.querySelector('#fecha');
    inputFecha.addEventListener('input', function(e) 
    {
        const dia = new Date(e.target.value).getUTCDay();

        if( [6, 0].includes(dia) ) {
            e.target.value = '';
            mostrarAlerta('Fines de semana no permitidos', 'error', '.formulario');
        }   // Here End If
        else 
        {
            cita.fecha = e.target.value;
        }   // Here End Event
    }); // Here End Event
}   // Here End Function Seleccionar Fecha

function mostrarAlerta( mensaje, tipo, elemento, desaparece = true)
{
    const alertaPrevia = document.querySelector( '.alerta');
    if( alertaPrevia )
        {
            alertaPrevia.remove();
        }   // Here End If

    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add( 'alerta' );
    alerta.classList.add( tipo );

    const referencia = document.querySelector(elemento);
    referencia.appendChild( alerta );

    if( desaparece )
        {
            setTimeout( () => {
                alerta.remove();
            }, 3000);
        }   // Here End If

}   // Here End Function Mostrar Alerta

function seleccionarHora()
{
    const inputHora = document.querySelector( '#hora' );
    inputHora.addEventListener('input', function(e) 
    {
        const horaCita = e.target.value;
        const hora = horaCita.split(':')[0];
        if( hora<10 || hora>18)
            {
                e.target.value = '';
                mostrarAlerta('Hora No Valida','error', '.formulario');
            }   // Here End If
            else
            {
                cita.hora = e.target.value;
            }   // Here End Else
    }); // Here End Event
}   // Here End Function Seleccionar Hora

function mostrarResumen() 
{
    const resumen = document.querySelector('.contenido-resumen');

    // Limpiar el Contenido de Resumen
    while(resumen.firstChild) {
        resumen.removeChild(resumen.firstChild);
    }

    if(Object.values(cita).includes('') || cita.servicios.length === 0 ) {
        mostrarAlerta('Faltan datos de Servicios, Fecha u Hora', 'error', '.contenido-resumen', false);

        return;
    } 

    // Formatear el div de resumen
    const { nombre, fecha, hora, servicios } = cita;

    // Heading para Servicios en Resumen
    const headingServicios = document.createElement('H3');
    headingServicios.textContent = 'Resumen de Servicios';
    resumen.appendChild(headingServicios);

    // Iterando y mostrando los servicios
    servicios.forEach(servicio => {
        const { id, precio, nombre } = servicio;
        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('contenedor-servicio');

        const textoServicio = document.createElement('P');
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    });

    // Heading para Cita en Resumen
    const headingCita = document.createElement('H3');
    headingCita.textContent = 'Resumen de Cita';
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span>Nombre:</span> ${nombre}`;

    // Formatear la fecha en español
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date( Date.UTC(year, mes, dia));
    
    const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'}
    const fechaFormateada = fechaUTC.toLocaleDateString('es-MX', opciones);

    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span>Hora:</span> ${hora} Horas`;

    // Boton para Crear una cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('boton');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    resumen.appendChild(botonReservar);
}   // Here End Function Mostrar Resumen


async function reservarCita() {
    
    const { nombre, fecha, hora, servicios, id } = cita;

    const idServicios = servicios.map( servicio => servicio.id );
    // console.log(idServicios);

    const datos = new FormData();
    
    datos.append('fecha', fecha);
    datos.append('hora', hora );
    datos.append('usuarioid', id);
    datos.append('servicios', idServicios);

    console.log([...datos]);

    try {
        // Petición hacia la api
        const url = 'http://localhost:3000/api/citas'
        const respuesta = await fetch(url, 
        {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        
        console.log(resultado);
        
        if(resultado.resultado) {
            Swal.fire({
                icon: 'success',
                title: 'Cita Creada',
                text: 'Tu cita fue creada correctamente',
                button: 'OK'
            }).then( () => {
                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            })
        }
    } catch (error) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Hubo un error al guardar la cita'
        })
    }

    
    // console.log([...datos]);

}

function idCliente()
{
    cita.id = document.querySelector('#id').value;
}   // Here End Function Id Cliente