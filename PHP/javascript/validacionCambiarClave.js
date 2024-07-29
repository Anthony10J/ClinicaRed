import * as funciones from "./validacionGeneral.js";

const inputs = document.querySelectorAll('#formCambiarClave .formulario__input');
const icon = document.querySelectorAll('.ver_password');

const expresiones = {
    password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]+$/, // Expresión regular corregida
};

const validarInputs = (e) => {
    switch (e.target.name) {
        case "password2":
        case "password3":
            validarInputPassword(e, e.target.name);
            break;
    }
};

inputs.forEach((input) => {
    input.addEventListener('keyup', validarInputs);
    input.addEventListener('blur', validarInputs);
});

icon.forEach(icon => {
    icon.addEventListener('click', function () {
        const clave = this.parentElement.querySelector('.formulario__input');
        if (clave.type === "password") {
            clave.type = "text";
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            clave.type = "password";
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });
});

const validarInputPassword = (e, campo) => {
    let estadoValidacion = {
        estadoCV: false,
        estadoER: false,
        estadoCC: false,
    };

    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, `${campo}`, 'Por favor, ingresa tu contraseña');
  
    if (estadoValidacion.estadoCV) {
        estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.password, e.target, `${campo}`, 
            'Debe contener sin espacios una mayúscula, una minúscula, un número y un caracter especial');
        
        // Verifica que la contraseña coincida solo si `campo` es `password2`
        if (campo === 'password2') {
            estadoValidacion.estadoCC = funciones.coincidirClave('password3', 'La contraseña no coincide con la anterior');
        }
    }
  
    return estadoValidacion;
};

const formulario_Registro = document.getElementById('formCambiarClave');
const botonEnviar = formulario_Registro.querySelector('button[type="submit"]');

formulario_Registro.addEventListener('submit', function (e) {
    let errorEncontrado = false;

    inputs.forEach((input) => {
        if (input.name === 'password2' || input.name === 'password3') {
            const resultadoValidacion = validarInputPassword({ target: input }, input.name);
            // Si alguna validación falla, marca errorEncontrado como true
            if (!resultadoValidacion.estadoCV || !resultadoValidacion.estadoER || !resultadoValidacion.estadoCC) {
                errorEncontrado = true;
            }
        }
    });

    // Solo si se encontraron errores, se previene el envío del formulario
    if (errorEncontrado) {
        // // e.preventDefault();
        // funciones.MostrarAlerta('error', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
    }
});

const camposFormulario = formulario_Registro.querySelectorAll('input, select');

camposFormulario.forEach(function(campo) {
    campo.addEventListener('input', function() {
        // Verifica si al menos un campo tiene valor para habilitar el botón de envío
        const algunCampoConValor = Array.from(camposFormulario).some(campo => campo.value.trim() !== '');
        if (algunCampoConValor) {
            botonEnviar.removeAttribute('disabled');
        } else {
            botonEnviar.setAttribute('disabled', 'disabled');
        }
    });
});
