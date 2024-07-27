import * as funciones from "./validacionGeneral.js";

// const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
// const clave = document.querySelectorAll('#password');
const icon = document.querySelectorAll('.ver_password');

const expresiones = {
  usuario: /^[A-Z]{5,15}$/, // Letras, numeros, guion y guion_bajo
  nombre: /^[a-zA-ZÀ-ÿ\s]{3,40}$/, // Letras y espacios, pueden llevar acentos.
  correo: /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  // telefono: /^\d{8,12}$/, // 7 a 14 numeros.
  direccion: /^[a-zA-Z0-9À-ÿ\s]{5,80}$/,
  password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]+$/, // Validar sin espacios una minúscula, una mayúscula, un número y un caracter especial.
  dni: /^[0-9]{1,13}$/,
  // ceroEspacios: /^[^\s]+$/
} 

// const campos = {
//   usuario: false,
//   nombre: false,
//   password: false,
//   correo: false,
//   telefono: false
// }

const validarInputs = (e) => {
  switch (e.target.name) {
    case "correo":
      validarInputCorreo(e, 'correo');
      break;

    case "password":
      validarInputPassword(e, 'password');
      break;

    // case "password2":
    //   validarInputPassword(e, 'password2', 'Por favor, ingresa tu contraseña');
    //   // funciones.coincidirClave();
    //   break;

    // case "password3":
    //   validarInputPassword(e, 'password3', 'Por favor, repite la contraseña');
      
    //   break;

    // case "usuario":
    //   validarInputUsuario(e);
    //   break;

    // case "direccion":
    //   funciones.validarExpresionRegular(expresiones.direccion, e.target, 'direccion');
    //   break;

    // case "nombre":
    //   validarInputNombre(e);      
    //   break;

    // case "dni":
    //   validarInputDNI(e);
    //   break;
  }
}

inputs.forEach((input) => {
  input.addEventListener('keyup', validarInputs); // Verificar el campo después de presionar una tecla
  input.addEventListener('blur', validarInputs); // Comprobar cuando da clic fuera del campo
});

// icon.forEach(icon => {
//   icon.addEventListener('click', function () {
//     // Obtener el campo de contraseña asociado al icono actual
//     const clave = this.parentElement.querySelector('.formulario__input');

//     // Alternar el tipo de campo de contraseña entre 'password' y 'text'
//     if (clave.type === "password") {
//       clave.type = "text";
//       this.classList.remove('fa-eye');
//       this.classList.add('fa-eye-slash');
//     } else {
//       clave.type = "password";
//       this.classList.remove('fa-eye-slash');
//       this.classList.add('fa-eye');
//     }
//   });
// });

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

// validar inputs de contraseña parametrizado 
let validarInputPassword = (e, campo) => {
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
    estadoCC: false,
    estadoVE: false,
  };

  estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, `${campo}`, 'Por favor, ingresa tu contraseña');

  estadoValidacion.estadoCV
    ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.password, e.target, `${campo}`, 
                                   'Debe contener sin espacios una mayúscula, una minúscula, un número y un caracter especial')) : "";
  
  // estadoValidacion.estadoCV
    // ? (estadoValidacion.estadoCC = funciones.coincidirClave('password3', 'La contraseña no coincide con la anterior')) : "";

  // estadoValidacion.estadoER
    // ? (estadoValidacion.estadoVE = funciones.validarEspacios(e.target, `${campo}`, 'No se permiten espacios')) : "";
    return estadoValidacion;
};

// validar input de usuario 
let validarInputUsuario = (e) => {
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
  };

  estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'usuario', 'Por favor, ingresa tu nombre de usuario');

  estadoValidacion.estadoCV
    ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.usuario, e.target, 'usuario', 'Solo se permiten letras')) : "";

    return estadoValidacion;
};

//  validar input DNI
let validarInputDNI = (e) => {
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
  };
  estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'dni', 'Por favor, ingresa tu DNI');

  estadoValidacion.estadoCV
    ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.dni, e.target, 'dni', 'Solo se permiten números')) : "";
  
    estadoValidacion.estadoER
    ? (estadoValidacion.estadoVE = funciones.validarEspacios(e.target, `${campo}`, 'No se permiten espacios')) : "";

    return estadoValidacion;
};

// validar input nombre
let validarInputNombre = (e) => {
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
    estadoMC: false,
  };
  estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'nombre', 'Por favor, ingresa tu nombre');

  estadoValidacion.estadoCV
    ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.nombre, e.target, 'nombre', 'Solo se permiten letras')) : "";

  estadoValidacion.estadoER
    ? (estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, 'nombre', 'No debe colocar el mismo caracter +2 veces seguidas')) : "";

    return estadoValidacion;
};

// Validar que el formulario login no tenga errores
const formulario_Login = document.getElementById('loginForm');

formulario_Login.addEventListener('submit', function (e) {
  inputs.forEach((input) => { // Validar todos los campos antes de enviar el formulario
    validarInputs({ target: input });
  });

  // Verificar si hay errores de validación
  const error_Formulario_Login = document.querySelectorAll(".formulario__grupo-incorrecto"); // variable = 1
  if (error_Formulario_Login.length > 0) { // 1 > 0
    // Si hay errores, por lo que, se muestra la siguiente alerta indicando al usuario que debe corregir los errores.
    funciones.MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
    e.preventDefault(); // Se detiene el envío del formulario.
  } 
  // else {
    // Si no hay errores, permitir el envío del formulario
    // alert("Formulario enviado correctamente!");
  // }
});
