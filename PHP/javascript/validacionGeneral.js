// import * as space from "./validacionIndex";
const campos = {
    usuario: false,
    nombre: false,
    password: false,
    correo: false,
    telefono: false,
    direccion: false,
    dni: false,
    dniN: false,
    // ceroEspacios: false,
}

export const validarCampoVacio = (input, campo, mensajeError) => {
    let elemento = document.getElementById(`grupo__${campo}`);

    if (input.value.trim() === '') {
        elemento.classList.add('formulario__grupo-incorrecto');
        elemento.classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).textContent = mensajeError;
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    } else {
        elemento.classList.remove('formulario__grupo-incorrecto');
        elemento.classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    }
    return campos[campo];
}

export const validarMismoCaracter = (input, campo, mensajeError) => {
    let expresion = /^(?:(?!([a-zA-Z\d])\1\1).)+$/
        ;

    if (expresion.test(input.value)) {
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).textContent = mensajeError;
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
    return campos[campo];
}
export const validarExpresionRegular = (expresion, input, campo, mensajeError) => {
    // let elemento = document.getElementById(`grupo__${campo}`);
    console.log(expresion.test(input.value))
    if (expresion.test(input.value)) {

        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).textContent = mensajeError;
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
    return campos[campo];
}

// export const validarEspacios = (input, campo, mensajeError) => {
//     let expresion = /^[^\S]+$/;
//     if (expresion.test(input.value)) {
//         document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
//         document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
//         document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
//         document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
//         document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
//         campos[campo] = false;
//     } else {
//         document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
//         document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
//         document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
//         document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
//         document.querySelector(`#grupo__${campo} .formulario__input-error`).textContent = mensajeError;
//         document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');        
//         campos[campo] = true;
//     }
//     return campos[campo];
// }

export const coincidirClave = (campo, mensajeError) => {
    const inputPassword1 = document.getElementById('password2');
    const inputPassword2 = document.getElementById('password3');

    if (inputPassword1.value.trim() === '' && inputPassword2.value.trim() === '') {
        // Ambos campos están vacíos, no realizamos ninguna validación
        return;
    }

    if (inputPassword1.value !== inputPassword2.value) {
        document.getElementById(`grupo__password3`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__password3`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).textContent = mensajeError;
        document.querySelector(`#grupo__password3 .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos['password'] = false;
    } else {
        document.getElementById(`grupo__password3`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__password3`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__password3 .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos['password'] = true;
    }
}

////////////////// Validar Fecha de Nacimiento ////////////////////////

// export const validarFechaNacimiento = () => {
//     const fechaNacimientoInput = document.getElementById('fechanacimiento');
//     const fechaNacimientoValue = new Date(fechaNacimientoInput.value);
//     const fechaActual = new Date();

//     // Ajustar la fecha de nacimiento para comparar con la fecha actual
//     const fechaNacimientoValida = fechaNacimientoValue <= fechaActual;

//     // Calcular la edad
//     const edad = fechaActual.getFullYear() - fechaNacimientoValue.getFullYear();

//     // Verificar si la fecha de nacimiento es válida (no es posterior a la fecha actual y tiene al menos 18 años)
//     const fechaValida = fechaNacimientoValida && edad >= 18;

//     // Obtener el elemento del mensaje de error
//     const mensajeFechaNacimiento = document.getElementById("mensajeFechaNacimiento");

//     // Mostrar mensaje de error si la fecha de nacimiento no es válida
//     if (fechaNacimientoInput.value === '') {
//         mensajeFechaNacimiento.innerText = 'Ingrese su fecha de nacimiento';
//         fechaNacimientoInput.classList.remove('mensaje_error');
//     } else {
//         if (!fechaValida) {
//             mensajeFechaNacimiento.innerText = '*Fecha no válida';
//             fechaNacimientoInput.classList.add('mensaje_error');
//         } else {
//             // Si la fecha es válida, eliminamos el mensaje de error y permitimos el envío del formulario
//             mensajeFechaNacimiento.innerText = '';
//             fechaNacimientoInput.classList.remove('mensaje_error');
//             return true; // La fecha es válida
//         }
//     }
    
// }
// // Agregamos un listener al evento submit del formulario para que llame a la función de validación
// const formulario = document.getElementById('registerForm'); 
// formulario.addEventListener("submit", function (event) {
//     // Llamamos a la función de validación de fecha de nacimiento
//     const fechaValida = validarFechaNacimiento();
  
//     // Comprobamos si la fecha de nacimiento es válida
//     if (!fechaValida) {
//         event.preventDefault(); // Detener el envío del formulario
//         MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
//     }   
// });


// // Agregar un event listener al input de fecha de nacimiento para validarla cuando cambie su valor
// document.getElementById("fechanacimiento").addEventListener("change", validarFechaNacimiento);

export const MostrarAlerta = (icon, title, message) => {
    Swal.fire({
        icon: icon,
        title: title,
        text: message,
    })
    // .then(() => {
    //     window.location = url;
    // });
}

export const validarEspacios = (expresion, input, campo, mensajeError) => {
    // let elemento = document.getElementById(`grupo__${campo}`);

    if (!expresion.test(input.value)) {

        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).textContent = mensajeError;
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
    return campos[campo];
}

export const validarCerosConsecutivos = (expresion, input, campo, mensajeError) => {
    // let elemento = document.getElementById(`grupo__${campo}`);

    if (expresion.test(input.value)) {

        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} .formulario__input-error`).textContent = mensajeError;
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
    return campos[campo];
}


/////////////////////// Validar Genero //////////////////////////////
// const validarGenero = () => {
//     const generoInput = document.getElementById('mensajeGenero1');
//     const generoValue = generoInput.value;

//     // Verificar si se ha seleccionado un género válido
//     const generoValido = generoValue !== '0';

//     // Obtener el elemento del mensaje de error
//     const mensajeGenero = document.getElementById("mensajeGenero2");
    
//     // Mostrar mensaje de error si el género no es válido
//     if (!generoValido) {
//         mensajeGenero.innerText = '*Por favor, seleccione un género';
//         generoInput.classList.add('mensaje_error');
//     } else {
//         // Si el género es válido, eliminamos el mensaje de error
//         mensajeGenero.innerText = '';
//         generoInput.classList.remove('mensaje_error');
//         return true; // El género es válido
//     }
// }

// // Agregar un listener al evento change del campo de género para llamar a la función de validación
// const generoInput = document.getElementById('mensajeGenero1');
// generoInput.addEventListener("change", validarGenero);

// // Agregamos un listener al evento submit del formulario para que llame a la función de validación
// const formulario2 = document.getElementById('registerForm'); 
// formulario2.addEventListener("submit", function (event) {
//     // Llamamos a la función de validación de género
//     const generoValido = validarGenero();
  
//     // Comprobamos si el género es válido
//     if (!generoValido) {
//         event.preventDefault(); // Detener el envío del formulario
//         MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
//     }   
// });
