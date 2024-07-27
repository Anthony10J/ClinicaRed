import * as funciones from "./validacionGeneral.js";

const formulario_Correo = document.getElementById('formCorreoCambioClave');
const inputs = document.querySelectorAll('#formCorreoCambioClave');

const expresiones = {
    correo: /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
}

const validarInputs = (e) => {
    // let estadoValidado = true;
    switch (e.target.name) {
        case "correo3":
            validarInputCorreo(e, 'correo3');
            break;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarInputs); // Verificar el campo después de presionar una tecla
    input.addEventListener('blur', validarInputs); // Comprobar cuando da clic fuera del campo
});

// validar inputs de correo parametrizado
let validarInputCorreo = (e, campo) => {
    let estadoValidacion = {
        estadoCV: false,
        estadoER: false,
    };
    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, `${campo}`, 'Por favor, ingresa tu dirección de correo electrónico');

    estadoValidacion.estadoCV
        ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.correo, e.target, `${campo}`, 'El correo no coincide con el formato establecido')) : "";

    return estadoValidacion;
};

// formulario_Correo.addEventListener('submit', function (e) {
//     const error_formulario_Correo = document.querySelectorAll(".formulario__grupo-incorrecto");
//     const error_Formulario = document.querySelectorAll(".formulario__input-error-activo");
//     // captcha ;

//     const captchaResponse = grecaptcha.getResponse();


//     // Comprueba si hay errores de validación
//     if (error_formulario_Correo.length > 0 || error_Formulario.length > 0) {
//         e.preventDefault();
//         funciones.MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
//     } else if (captchaResponse === '') {
//         // Si reCAPTCHA no se ha completado, muestra un mensaje de error
//         funciones.MostrarAlerta('', '¡ERROR!', 'Por favor, completa el reCAPTCHA antes de enviar el formulario.')
//     }else {
//         // Si no hay errores, permite el envío del formulario
//         // Si llegas a este punto, el formulario se enviará
//         recaptchaCallback();
//         this.submit();
//     }
// });

// Habilita el botón de enviar cuando reCAPTCHA se complete correctamente
// function recaptchaCallback() {
//     document.getElementById('botonEnviar').removeAttribute('disabled');
// }

// formulario_Correo.addEventListener('submit', function (e) {
//     const error_formulario_Correo = document.querySelectorAll(".formulario__grupo-incorrecto");
//     const error_Formulario = document.querySelectorAll(".formulario__input-error-activo");
//     const captchaResponse = grecaptcha.getResponse();

//     // Comprueba si hay errores de validación
//     if (error_formulario_Correo.length > 0 || error_Formulario.length > 0 || captchaResponse === '') {
//         e.preventDefault(); // Evita el envío del formulario si hay errores
//         funciones.MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario o no has completado reCAPTCHA. Por favor, corrígelos antes de enviarlo.');
//     }
// });

// const camposFormulario = formulario_Registro.querySelectorAll('input, select'); // Obtener todos los campos del formulario
// camposFormulario.forEach(function (campo) {
//     campo.addEventListener('input', function () {
//         // Verificar si algún campo tiene algún valor
//         const algunCampoConValor = Array.from(camposFormulario).some(campo => campo.value.trim() !== '');

//         // Habilitar o deshabilitar el botón en función de si algún campo tiene algún valor
//         if (algunCampoConValor) {
//             botonEnviar.removeAttribute('disabled'); // Habilitar el botón
//         } else {
//             botonEnviar.setAttribute('disabled', 'disabled'); // Deshabilitar el botón
//         }
//     });
// });

// const formulario_Correo = document.getElementById('formCorreoCambioClave');
// const botonEnviar = document.getElementById('botonEnviar');

// formulario_Correo.addEventListener('submit', function (e) {
//     const error_formulario_Correo = document.querySelectorAll(".formulario__grupo-incorrecto");
//     const error_Formulario = document.querySelectorAll(".formulario__input-error-activo");
//     // const captchaResponse = grecaptcha.getResponse();

//     // Comprueba si hay errores de validación
//     if (error_formulario_Correo.length > 0 || error_Formulario.length > 0 ) {
//         e.preventDefault(); // Evita el envío del formulario si hay errores
//         funciones.MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario o no has completado reCAPTCHA. Por favor, corrígelos antes de enviarlo.');
//     }
// });

// const camposFormulario = formulario_Correo.querySelectorAll('input, select'); // Obtener todos los campos del formulario
// camposFormulario.forEach(function (campo) {
//     campo.addEventListener('input', function () {
//         // Verificar si algún campo tiene algún valor
//         const algunCampoConValor = Array.from(camposFormulario).some(campo => campo.value.trim() !== '');

//         // Habilitar o deshabilitar el botón en función de si algún campo tiene algún valor
//         if (algunCampoConValor && grecaptcha.getResponse() !== '') {
//             botonEnviar.removeAttribute('disabled'); // Habilitar el botón
//         } else {
//             botonEnviar.setAttribute('disabled', 'disabled'); // Deshabilitar el botón
//         }
//     });
// });

// const formulario_Correo = document.getElementById('formCorreoCambioClave');

formulario_Correo.addEventListener('submit', function (e) {
    const captchaResponse = grecaptcha.getResponse();
    const error_formulario_Correo = document.querySelectorAll(".formulario__grupo-incorrecto");
    const error_Formulario = document.querySelectorAll(".formulario__input-error-activo");

    if (captchaResponse === '') {
        e.preventDefault();
        funciones.MostrarAlerta('', '¡ERROR!', 'Por favor, verifica el reCAPTCHA antes de enviar el formulario.');
    } else if (error_formulario_Correo.length > 0 || error_Formulario.length > 0) {
        e.preventDefault();
        funciones.MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
        } else {
            // console.log("Formulario enviado correctamente.");
        }
});



