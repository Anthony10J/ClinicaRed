import * as funciones from "./validacionGeneral.js";

const inputs = document.querySelectorAll('editFormUser');

const expresiones = {
  usuario: /^[a-zA-Z]{1,15}$/, // Letras, numeros, guion y guion_bajo
  nombre: /^[a-zA-ZÀ-ÿ\s]{3,40}$/, // Letras y espacios, pueden llevar acentos.
  correo: /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  // telefono: /^\d{8,12}$/, // 7 a 14 numeros.
  // direccion: /^[a-zA-Z0-9À-ÿ\s]{5,80}$/,
  dni: /^(?!00)(?!.*0{5}$)[0-9]{1,13}$/,
  dniN:/^[0-9]{1,13}$/

} 

const validarInputs = (e) => {
// let estadoValidado = true;
  switch (e.target.name) {
    case "correo":
      validarInputCorreo(e, 'correo');
      break;

    case "usuario":
      validarInputUsuario(e);
      break;

    case "nombre":
      validarInputNombre(e);    
      break;

    case "dni":     
      validarInputDNI(e);
    break;
    
  }
}

inputs.forEach((input) => {
  input.addEventListener('keyup', validarInputs); // Verificar el campo después de presionar una tecla
  input.addEventListener('blur', validarInputs); // Comprobar cuando da clic fuera del campo
});

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
    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, campo, 'Por favor, ingresa tu dirección de correo electrónico');

    estadoValidacion.estadoCV 
        ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.correo, e.target, campo, 'El correo no coincide con el formato establecido')) : "";
    
    return estadoValidacion;
};

// validar input de usuario 
let validarInputUsuario = (e) => {
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
    estadoMC: false,
    estadoUE: false,
  };

  estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'usuario', 'Por favor, ingresa tu nombre de usuario');

  estadoValidacion.estadoCV
    ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.usuario, e.target, 'usuario', 'Solo se permiten letras')) : "";

  estadoValidacion.estadoER
    ? (estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, 'usuario', 'No debe colocar el mismo caracter +2 veces seguidas')) : "";
 
  estadoValidacion.estadoMC
    ? (estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s/g, e.target, 'nombre', 'Debe limitarse a un espacio')) : "";
    return estadoValidacion;
};

//  validar input DNI
let validarInputDNI = (e) => {
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
    estadoCC: false,
    estadoVDNI:false,
    // estadoConsulta: false,
    // estadoConsultaCorreo2: false,
  };

  // estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'dni', 'Por favor, ingresa tu DNI');

  // estadoValidacion.estadoCV
  estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.dniN, e.target, 'dni', 'Solo se permiten números');

  estadoValidacion.estadoER
    ? (estadoValidacion.estadoCC = funciones.validarCerosConsecutivos(expresiones.dni, e.target, "dni", 'DNI no válido')) : "";
  
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

document.addEventListener('DOMContentLoaded', function () {
  var estadoValidacion = { isDniExist: false };
  var dniInput = document.getElementById('dni');

  dniInput.addEventListener('blur', function () {
    var dni = this.value.trim();
    var elemento = document.getElementById('grupo__dni');

    if (dni === "") {
      validarCampoVacio(this, 'dni', 'Por favor, ingresa tu DNI');
    } else {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../Consultas/ValidarDNI.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var response = xhr.responseText;
          
          if (response === "existe") {
            estadoValidacion.isDniExist = true;
            elemento.classList.add('formulario__grupo-incorrecto');
            elemento.classList.remove('formulario__grupo-correcto');
            document.querySelector('#grupo_dni .formulario_input-error').textContent = 'Ya existe el DNI';
            document.querySelector('#grupo_dni .formularioinput-error').classList.add('formulario_input-error-activo');
            // document.querySelector('#grupo__dni i').classList.remove('fa-times-circle');
          } else {
            estadoValidacion.isDniExist = false;
            elemento.classList.remove('formulario__grupo-incorrecto2');
            elemento.classList.add('formulario__grupo-correcto2');
            document.querySelector('#grupo_dni .formulario_input-error2').textContent = '';
            document.querySelector('#grupo_dni .formularioinput-error2').classList.remove('formulario_input-error-activo2');          
          }
        }
      };
      xhr.send('dni=' + dni);
    }
  });

  function validarCampoVacio(input, campo, mensaje) {
    var elemento = document.getElementById('grupo__' + campo);
    elemento.classList.add('formulario__grupo-incorrecto');
    elemento.classList.remove('formulario__grupo-correcto');
    document.querySelector('#grupo_' + campo + ' .formulario_input-error').textContent = mensaje;
    document.querySelector('#grupo_' + campo + ' .formularioinput-error').classList.add('formulario_input-error-activo');
  }
});

document.addEventListener('DOMContentLoaded', function () {
  var estadoValidacion = { correoExiste : false };
  var correoInput = document.getElementById('correo');

  correoInput.addEventListener('blur', function () {
    var correo2 = this.value.trim();
    var elemento = document.getElementById('grupo__correo2');

    if (correo2 === "") {
      validarCampoVacio(this, 'correo2', 'Por favor, ingresa tu correo electronico');
    } else {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../Consultas/ValidarCorreo.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var response = xhr.responseText;
          
          if (response === "existe") {
            estadoValidacion.correoExiste  = true;
            elemento.classList.add('formulario__grupo-incorrecto');
            elemento.classList.remove('formulario__grupo-correcto');
            document.querySelector('#grupo_correo2 .formulario_input-error').textContent = 'Ya existe el correo electrónico';
            document.querySelector('#grupo_correo2 .formularioinput-error').classList.add('formulario_input-error-activo');
            // document.querySelector('#grupo__correo2 i').classList.remove('fa-times-circle');
          } else {
            estadoValidacion.correoExiste  = false;
            elemento.classList.remove('formulario__grupo-incorrecto2');
            elemento.classList.add('formulario__grupo-correcto2');
            document.querySelector('#grupo_correo2 .formulario_input-error2').textContent = '';
            document.querySelector('#grupo_correo2 .formularioinput-error2').classList.remove('formulario_input-error-activo2');          
          }
        }
      };
      xhr.send('correo2=' + correo2);
    }
  });

  function validarCampoVacio(input, campo, mensaje) {
    var elemento = document.getElementById('grupo__' + campo);
    elemento.classList.add('formulario__grupo-incorrecto');
    elemento.classList.remove('formulario__grupo-correcto');
    document.querySelector('#grupo_' + campo + ' .formulario_input-error').textContent = mensaje;
    document.querySelector('#grupo_' + campo + ' .formularioinput-error').classList.add('formulario_input-error-activo');
  }
});

document.addEventListener('DOMContentLoaded', function () {
  var estadoValidacion = { usuarioExiste : false };
  var usuarioInput = document.getElementById('usuario');

  usuarioInput.addEventListener('blur', function () {
    var usuario = this.value.trim();
    var elemento = document.getElementById('grupo__usuario');

    if (usuario === "") {
      validarCampoVacio(this, 'usuario', 'Por favor, ingresa tu usuario');
    } else {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../Consultas/ValidarUsuario.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var response = xhr.responseText;
          
          if (response === "existe") {
            estadoValidacion.usuarioExiste = true;
            elemento.classList.add('formulario__grupo-incorrecto');
            elemento.classList.remove('formulario__grupo-correcto');
            document.querySelector('#grupo_usuario .formulario_input-error').textContent = 'Ya existe el usuario';
            document.querySelector('#grupo_usuario .formularioinput-error').classList.add('formulario_input-error-activo');
            // document.querySelector('#grupo__usuario i').classList.remove('fa-times-circle');
          } else {
            estadoValidacion.usuarioExiste = false;
            elemento.classList.remove('formulario__grupo-incorrecto2');
            elemento.classList.add('formulario__grupo-correcto2');
            document.querySelector('#grupo_usuario .formulario_input-error2').textContent = '';
            document.querySelector('#grupo_usuario .formularioinput-error2').classList.remove('formulario_input-error-activo2');          
          }
        }
      };
      xhr.send('usuario=' + usuario);
    }
  });

  function validarCampoVacio(input, campo, mensaje) {
    var elemento = document.getElementById('grupo__' + campo);
    elemento.classList.add('formulario__grupo-incorrecto');
    elemento.classList.remove('formulario__grupo-correcto');
    document.querySelector('#grupo_' + campo + ' .formulario_input-error').textContent = mensaje;
    document.querySelector('#grupo_' + campo + ' .formularioinput-error').classList.add('formulario_input-error-activo');
  }
});





// const formulario_Registro = document.getElementById('registerForm');

// formulario_Registro.addEventListener('submit', function (e) {
//   const error_Formulario_Registro = document.querySelectorAll(".formulario__grupo-incorrecto");
//   const error_Formulario = document.querySelectorAll(".formulario__input-error-activo");

//   // Comprueba si hay errores de validación
//   if (error_Formulario_Registro.length > 0 || error_Formulario.length > 0 || isDniExist ) {
//     e.preventDefault();
//     funciones.MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
//   } else {
//     // Si no hay errores, permite el envío del formulario
//     // Si llegas a este punto, el formulario se enviará
//   }
// });

const formulario_Registro = document.getElementById('editeFormUser');
const botonEnviar = formulario_Registro.querySelector('button[type="submit"]'); // Obtener el botón de envío

// Agregar evento de submit al formulario
formulario_Registro.addEventListener('submit', function (e) {
  const error_Formulario_Registro = document.querySelectorAll(".formulario__grupo-incorrecto");
  const error_Formulario = document.querySelectorAll(".formulario__input-error-activo");

  // Comprueba si hay errores de validación
  if (error_Formulario_Registro.length > 0 || error_Formulario.length > 0 || isDniExist ) {
    e.preventDefault();
    funciones.MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
  } else {
    // Si no hay errores, permite el envío del formulario
    // Si llegas a este punto, el formulario se enviará
  }
});

// Agregar evento de entrada a cada campo del formulario
const camposFormulario = formulario_Registro.querySelectorAll('input, select'); // Obtener todos los campos del formulario

camposFormulario.forEach(function(campo) {
  campo.addEventListener('input', function() {
    // Verificar si algún campo tiene algún valor
    const algunCampoConValor = Array.from(camposFormulario).some(campo => campo.value.trim() !== '');

    // Habilitar o deshabilitar el botón en función de si algún campo tiene algún valor
    if (algunCampoConValor) {
      botonEnviar.removeAttribute('disabled'); // Habilitar el botón
    } else {
      botonEnviar.setAttribute('disabled', 'disabled'); // Deshabilitar el botón
    }
  });
});