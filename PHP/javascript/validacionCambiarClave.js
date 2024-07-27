import * as funciones from "./validacionGeneral.js";

const formulario_Registro = document.getElementById('formCambiarClave');

const inputs = document.querySelectorAll('#formCambiarClave');
const icon = document.querySelectorAll('.ver_password');

const expresiones = {
    password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]+$/, // Validar sin espacios una minúscula, una mayúscula, un número y un caracter especial.  
}

const validarInputs = (e) => {
    // let estadoValidado = true;
    switch (e.target.name) {
        case "password2":
            validarInputPassword(e, 'password2');
            // funciones.coincidirClave();
            break;

        case "password3":
            validarInputPassword(e, 'password3');
            break;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarInputs); // Verificar el campo después de presionar una tecla
    input.addEventListener('blur', validarInputs); // Comprobar cuando da clic fuera del campo
  });

icon.forEach(icon => {
    icon.addEventListener('click', function () {
        // Obtener el campo de contraseña asociado al icono actual
        const clave = this.parentElement.querySelector('.formulario__input');

        // Alternar el tipo de campo de contraseña entre 'password' y 'text'
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

let validarInputPassword = (e, campo) => {
    let estadoValidacion = {
      estadoCV: false,
      estadoER: false,
      estadoCC: false,
    };
  
    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, `${campo}`, 'Por favor, ingresa tu contraseña');
  
    estadoValidacion.estadoCV
      ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.password, e.target, `${campo}`, 
                                     'Debe contener sin espacios una mayúscula, una minúscula, un número y un caracter especial')) : "";
    
    estadoValidacion.estadoCV
      ? (estadoValidacion.estadoCC = funciones.coincidirClave('password3', 'La contraseña no coincide con la anterior')) : "";
  
      return estadoValidacion;
  };

  formulario_Registro.addEventListener('submit', function (e) {
    const error_Formulario_Registro = document.querySelectorAll(".formulario__grupo-incorrecto");
    const error_Formulario = document.querySelectorAll(".formulario__input-error-activo");

    // Comprueba si hay errores de validación
    if (error_Formulario_Registro.length > 0 || error_Formulario.length > 0) {
        e.preventDefault();
        // funciones.MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
        funciones.MostrarAlerta('error', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
    } else {
        // Si no hay errores, permite el envío del formulario
        // Si llegas a este punto, el formulario se enviará
    }
});