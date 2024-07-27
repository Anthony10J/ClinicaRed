import * as funciones from "./validacionGeneral.js";

const formulario_OTP = document.getElementById('formOTP');
const inputs = document.querySelectorAll('#formOTP');

const expresiones = {
    numeros: /^[0-9]{1,6}$/ // Validar que solo se ingresen números en el input OTP
}

const validarInputs = (e) => {
    // let estadoValidado = true;
    switch (e.target.name) {
        case "codigo_otp2":
            validarInputOTP(e, 'codigo_otp2');
            break;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarInputs); // Verificar el campo después de presionar una tecla
    input.addEventListener('blur', validarInputs); // Comprobar cuando da clic fuera del campo
});

let validarInputOTP = (e, campo) => {
    let estadoValidacion = {
        estadoCV: false,
        estadoER: false,
    };
    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, `${campo}`, 'Por favor, ingresa tu código OTP');

    estadoValidacion.estadoCV
        ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.numeros, e.target, `${campo}`, 'Solo se permiten números')) : "";

    return estadoValidacion;
};

formulario_OTP.addEventListener('submit', function (e) {
    const error_formulario_OTP = document.querySelectorAll(".formulario__grupo-incorrecto");
    const error_Formulario = document.querySelectorAll(".formulario__input-error-activo");

    // Comprueba si hay errores de validación
    if (error_formulario_OTP.length > 0 || error_Formulario.length > 0) {
        e.preventDefault();
        funciones.MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
    } else {
        // Si no hay errores, permite el envío del formulario
        // Si llegas a este punto, el formulario se enviará
    }
});