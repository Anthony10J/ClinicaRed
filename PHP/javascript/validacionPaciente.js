import * as funciones from "./validacionGeneral.js";

const inputs = document.querySelectorAll('#registerFormPaciente');

const expresiones = {
    usuario: /^[a-zA-Z]{1,15}$/, // Letras, numeros, guion y guion_bajo
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    correo: /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    direccion: /^[a-zA-Z0-9,.-_#+\s]{1,80}$/,
    // telefono: /^\d{8,12}$/, // 7 a 14 numeros.
    // direccion: /^[a-zA-Z0-9À-ÿ\s]{5,80}$/,
    password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]+$/, // Validar sin espacios una minúscula, una mayúscula, un número y un caracter especial.
    dni: /^(?!00)(?!.*0{5}$)[0-9]{1,15}$/,
    dniN: /^[0-9]{1,15}$/

}

const validarInputs = (e) => {
    // let estadoValidado = true;
    switch (e.target.name) {
        case "nombre":
            validarInputNombre(e);
            break;

        case "direccion":
            validarInputDireccion(e, 'direccion');
            // funciones.coincidirClave();
            break;

        case "numero_de_documento":
            validarInputDNI(e, 'numero_de_documento');
            break;

        case "ocupacion":
            validarInputOcupacion(e, 'ocupacion');
            break;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarInputs); // Verificar el campo después de presionar una tecla
    input.addEventListener('blur', validarInputs); // Comprobar cuando da clic fuera del campo
});

// validar inputs de correo parametrizado
let validarInputOcupacion = (e, campo) => {
    let estadoValidacion = {
        estadoCV: false,
        estadoER: false,
        estadoMC: false,
        estadoUE: false,
    };
    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, `${campo}`, 'Por favor, ingresa tu ocupación');

    estadoValidacion.estadoCV
        ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.nombre, e.target, `${campo}`, 'Solo se permiten letras')) : "";

    estadoValidacion.estadoER
        ? (estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s/g, e.target, `${campo}`, 'Debe limitarse a un espacio')) : "";

    estadoValidacion.estadoUE
        ? (estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, `${campo}`, 'No debe colocar el mismo caracter +2 veces seguidas')) : "";

    return estadoValidacion;
};

//  validar input DNI
let validarInputDNI = (e) => {
    let estadoValidacion = {
        estadoCV: false,
        estadoER: false,
        estadoCC: false,
        estadoVDNI: false,
        // estadoConsulta: false,
        // estadoConsultaCorreo2: false,
    };

    // estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'dni', 'Por favor, ingresa tu DNI');

    // estadoValidacion.estadoCV
    estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.dniN, e.target, 'numero_de_documento', 'Solo se permiten números');

    estadoValidacion.estadoER
        ? (estadoValidacion.estadoCC = funciones.validarCerosConsecutivos(expresiones.dni, e.target, "numero_de_documento", 'No válido')) : "";

    return estadoValidacion;
};

// validar input nombre
let validarInputNombre = (e) => {
    let estadoValidacion = {
        estadoCV: false,
        estadoER: false,
        estadoMC: false,
        estadoUE: false,
    };
    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'nombre', 'Por favor, ingresa tu nombre');

    estadoValidacion.estadoCV
        ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.nombre, e.target, 'nombre', 'Solo se permiten letras')) : "";

    estadoValidacion.estadoER
        ? (estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s/g, e.target, 'nombre', 'Debe limitarse a un espacio')) : "";

    estadoValidacion.estadoUE
        ? (estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, 'nombre', 'No debe colocar el mismo caracter +2 veces seguidas')) : "";

    return estadoValidacion;
};

// validar input dirección
let validarInputDireccion = (e, campo) => {
    let estadoValidacion = {
        estadoCV: false,
        estadoER: false,
        estadoMC: false,
        estadoUE: false,
    };
    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, `${campo}`, 'Por favor, ingresa tu dirección');

    estadoValidacion.estadoCV
        ? (estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s/g, e.target, `${campo}`, 'Debe limitarse a un espacio')) : "";

    estadoValidacion.estadoUE
        ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.direccion, e.target, `${campo}`, 'Caracter no válido')) : "";

    estadoValidacion.estadoUE
        ? (estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, `${campo}`, 'No debe colocar el mismo caracter +2 veces seguidas')) : "";

    return estadoValidacion;
};


///////Fecha Nacimiento

export const validarFechaNacimiento = () => {
    const fechaNacimientoInput = document.getElementById('fechanacimiento');
    const fechaNacimientoValue = new Date(fechaNacimientoInput.value);
    
    // Establecer la zona horaria a Centroamérica (CST - UTC-6)
    const fechaActual = new Date().toLocaleString('en-US', { timeZone: 'America/Guatemala' });
    const fechaActualDate = new Date(fechaActual);
    
    // Agregar dos días a la fecha actual
    const fechaLimite = new Date(fechaActualDate);
    fechaLimite.setDate(fechaLimite.getDate() );

    // Verificar si la fecha de nacimiento es futura (más allá de dos días después de la fecha actual)
    const esFechaFutura = fechaNacimientoValue > fechaLimite;

    // Obtener el elemento del mensaje de error
    const mensajeFechaNacimiento = document.getElementById("mensajeFechaNacimiento");

    // Si la fecha de nacimiento es futura, mostrar mensaje de error
    if (esFechaFutura) {
        mensajeFechaNacimiento.innerText = '*Fecha no válida (no se permiten fechas futuras)';
        fechaNacimientoInput.classList.add('mensaje_error');
        return false; // La fecha no es válida
    } else {
        // Si la fecha es válida (hoy o en el pasado o dentro de dos días), eliminar el mensaje de error
        mensajeFechaNacimiento.innerText = '';
        fechaNacimientoInput.classList.remove('mensaje_error');
        return true; // La fecha es válida
    }
};
document.getElementById("fechanacimiento").addEventListener("change", validarFechaNacimiento);

///////// GENERO 
const validarGenero = () => {
    const generoInput = document.getElementById('mensajeGenero1');
    const generoValue = generoInput.value;

    // Verificar si se ha seleccionado un género válido
    const generoValido = generoValue !== '0';

    // Obtener el elemento del mensaje de error
    const mensajeGenero = document.getElementById("mensajeGenero2");

    // Mostrar mensaje de error si el género no es válido
    if (!generoValido) {
        mensajeGenero.innerText = '*Por favor, seleccione un género';
        generoInput.classList.add('mensaje_error');
    } else {
        // Si el género es válido, eliminamos el mensaje de error
        mensajeGenero.innerText = '';
        generoInput.classList.remove('mensaje_error');
        return true; // El género es válido
    }
}

const generoInput = document.getElementById('mensajeGenero1');
generoInput.addEventListener("change", validarGenero);

const formulario2 = document.getElementById('registerFormPaciente');
formulario2.addEventListener("submit", function (event) {
    // Llamamos a la función de validación de género
    const generoValido = validarGenero();

    // Comprobamos si el género es válido
    if (!generoValido) {
        event.preventDefault(); // Detener el envío del formulario
        // MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
    }
});

//////TIPO DOCUMENTO
const validarTipoDocumento = () => {
    const documentoInput = document.getElementById('mensajeDocumento1');
    const documentoValue = documentoInput.value;

    // Verificar si se ha seleccionado un género válido
    const documentoValido = documentoValue !== '0';

    // Obtener el elemento del mensaje de error
    const mensajeDocumento = document.getElementById("mensajeDocumento2");

    // Mostrar   mensaje de error si el género no es válido
    if (!documentoValido) {
        mensajeDocumento.innerText = '*Por favor, seleccione un tipo de documento';
        documentoInput.classList.add('mensaje_error');
    } else {
        // Si el género es válido, eliminamos el mensaje de error
        mensajeDocumento.innerText = '';
        documentoInput.classList.remove('mensaje_error');
        return true; // El género es válido
    }
}

const DocInput = document.getElementById('mensajeDocumento1');
DocInput.addEventListener("change", validarTipoDocumento);

const formulario3 = document.getElementById('registerFormPaciente');
formulario3.addEventListener("submit", function (event) {
    // Llamamos a la función de validación de género
    const documentoValido = validarTipoDocumento();

    // Comprobamos si el género es válido
    if (!documentoValido) {
        event.preventDefault(); // Detener el envío del formulario
        // MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
    }
});


const camposRequeridos = document.querySelectorAll("[required]");

camposRequeridos.forEach(campo => {
    campo.addEventListener('input', function() {
        validarCampo(this);
    });
});

function validarCampo(campo) {
    if (campo.value.trim() === '') {
        mostrarErrorCampo(campo);
    } else {
        ocultarErrorCampo(campo);
    }
}

function mostrarErrorCampo(campo) {
    campo.classList.add('formulario__grupo-incorrecto');
    // Mostrar mensaje de error si es necesario
}

function ocultarErrorCampo(campo) {
    campo.classList.remove('formulario__grupo-incorrecto');
    // Ocultar mensaje de error si es necesario
}


const botonGuardar = document.getElementById('Btnregistrar');

botonGuardar.addEventListener('click', function (e) {
    const camposRequeridos = document.querySelectorAll("[required]");
    let hayCamposVacios = false;

    camposRequeridos.forEach(function (campo) {
        if (campo.value.trim() === '') {
            hayCamposVacios = true;
            mostrarErrorCampo(campo);
        }
    });

    if (hayCamposVacios) {
        e.preventDefault();
        funciones.MostrarAlerta('', '¡ERROR!', 'Por favor, completa todos los campos requeridos antes de enviar el formulario.');
    }
});
const formulario_Registro = document.getElementById('registerFormPaciente');
formulario_Registro.addEventListener('submit', function (e) {
    const error_Formulario_Registro = document.querySelectorAll(".formulario__grupo-incorrecto");
    const error_Formulario = document.querySelectorAll(".formulario__input-error-activo");

    // Comprueba si hay errores de validación
    if (error_Formulario_Registro.length > 0 || error_Formulario.length > 0) {
        e.preventDefault();
        funciones.MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
    } else {
        Swal.fire({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas guardar los datos?',
            icon: 'question', // Ícono de pregunta
            showCancelButton: true, // Mostrar botón de cancelación
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar'
    });
}
 });