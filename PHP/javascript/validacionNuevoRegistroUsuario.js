import * as funciones from "./validacionGeneral.js";

const inputs = document.querySelectorAll('#registerFormUser  input');
const icon = document.querySelectorAll('.ver_password');

const expresiones = {
  usuario: /^[a-zA-Z]{3,15}$/, // Letras, numeros, guion y guion_bajo
  nombre: /^[a-zA-ZÀ-ÿ\s]{3,80}$/, // Letras y espacios, pueden llevar acentos.
  correo: /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  direccion: /^[a-zA-ZÀ-ÿ0-9\s,.-]+$/,
  // telefono: /^\d{8,12}$/, // 7 a 14 numeros.
  // direccion: /^[a-zA-Z0-9À-ÿ\s]{5,80}$/,
  password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]+$/, // Validar sin espacios una minúscula, una mayúscula, un número y un caracter especial.
  dni: /^(?!00)(?!.*0{5}$)[0-9]{1,13}$/,
  dniN:/^[0-9]{1,13}$/

}

const validarInputs = (e) => {
    // let estadoValidado = true;
    switch (e.target.name) {
        case "correo2":
            validarInputCorreo(e, 'correo2');
            break;

        case "password2":
            validarInputPassword(e, 'password2');
            // funciones.coincidirClave();
            break;

        case "password3":
            validarInputPassword(e, 'password3');
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

        case "direccion":
            validarInputDireccion(e);
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
        estadoMC: false,
    };

    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, `${campo}`, 'Por favor, ingresa tu contraseña');

    estadoValidacion.estadoCV
        ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.password, e.target, `${campo}`,
            'Solo se permiten mayúsculas, minúsculas, números y caracter especial')) : "";

    estadoValidacion.estadoCV
        ? (estadoValidacion.estadoCC = funciones.coincidirClave('password3', 'La contraseña no coincide con la anterior')) : "";

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
        ? (estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s/g, e.target, 'usuario', 'Debe limitarse a un espacio')) : "";
    
        return estadoValidacion;
};

//  validar input DNI
let validarInputDNI = (e) => {
    let estadoValidacion = {
        estadoCV: false,
        estadoER: false,
        estadoCC: false,
        estadoVDNI: false,
        estadoCM: false,
        // estadoConsulta: false,
        // estadoConsultaCorreo2: false,
    };

    // estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'dni', 'Por favor, ingresa tu DNI');

    // estadoValidacion.estadoCV
    estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.dniN, e.target, 'dni', 'Solo se permiten números');

    estadoValidacion.estadoER
        ? (estadoValidacion.estadoCC = funciones.validarCerosConsecutivos(expresiones.dni, e.target, "dni", 'DNI no válido')) : "";
    estadoValidacion.estadoCC
        ? (estadoValidacion.estadoCM = funciones.validarCampoMinimo (e.target, "dni", "No cumple la cantidad mínima de caracteres")): "";
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
    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'nombre', 'Por favor, ingresa tu nombre') ;

    estadoValidacion.estadoCV
        ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.nombre, e.target, 'nombre', 'Solo se permiten letras')) : "";

    estadoValidacion.estadoER
        ? (estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s/g, e.target, 'nombre', 'Debe limitarse a un espacio')) : "";

    estadoValidacion.estadoUE
        ? (estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, 'nombre', 'No debe colocar el mismo caracter +2 veces seguidas')) : "";

    return estadoValidacion;
};

// validar input dirección
let validarInputDireccion = (e) => {
    let estadoValidacion = {
      estadoCV: false,
      estadoER: false,
      estadoMC: false,
      estadoUE: false,
      estadoCM: false,
    };
    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'direccion', 'Por favor, ingresa tu dirección');
  
    estadoValidacion.estadoCV
    ? (estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s/g, e.target, 'direccion', 'Debe limitarse a un espacio')) : "";
  
    estadoValidacion.estadoUE
      ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.direccion, e.target, 'direccion', 'Caracter no válido')) : "";
  
    estadoValidacion.estadoER
      ? (estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, 'direccion', 'No debe colocar el mismo caracter +2 veces seguidas')) : "";
    estadoValidacion.estadoMC
    ? (estadoValidacion.estadoCM = funciones.validarCampoMaximo (e.target, "direccion", "No cumple la cantidad mínima de caracteres")): "";
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
            xhr.open('POST', '/PHP/Consultas/ValidarDNI.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;

                    if (response === "existe") {
                        estadoValidacion.isDniExist = true;
                        elemento.classList.add('formulario__grupo-incorrecto');
                        elemento.classList.remove('formulario__grupo-correcto');
                        document.querySelector('#grupo__dni .formulario__input-error').textContent = 'Ya existe el DNI';
                        document.querySelector('#grupo__dni .formulario__input-error').classList.add('formulario__input-error-activo');
                        // document.querySelector('#grupo__dni i').classList.remove('fa-times-circle');
                    } else {
                        estadoValidacion.isDniExist = false;
                        elemento.classList.remove('formulario__grupo-incorrecto2');
                        elemento.classList.add('formulario__grupo-correcto2');
                        document.querySelector('#grupo__dni .formulario__input-error2').textContent = '';
                        document.querySelector('#grupo__dni .formulario__input-error2').classList.remove('formulario__input-error-activo2');
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
        document.querySelector('#grupo__' + campo + ' .formulario__input-error').textContent = mensaje;
        document.querySelector('#grupo__' + campo + ' .formulario__input-error').classList.add('formulario__input-error-activo');
    }
});

document.addEventListener('DOMContentLoaded', function () {
    var estadoValidacion = { correoExiste: false };
    var correoInput = document.getElementById('correo2');

    correoInput.addEventListener('blur', function () {
        var correo2 = this.value.trim();
        var elemento = document.getElementById('grupo__correo2');

        if (correo2 === "") {
            validarCampoVacio(this, 'correo2', 'Por favor, ingresa tu correo electrónico');
        } else {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/PHP/Consultas/ValidarCorreo.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;

                    if (response === "existe") {
                        estadoValidacion.correoExiste = true;
                        elemento.classList.add('formulario__grupo-incorrecto');
                        elemento.classList.remove('formulario__grupo-correcto');
                        document.querySelector('#grupo__correo2 .formulario__input-error').textContent = 'Ya existe el correo electrónico';
                        document.querySelector('#grupo__correo2 .formulario__input-error').classList.add('formulario__input-error-activo');
                    } else {
                        estadoValidacion.correoExiste = false;
                        elemento.classList.remove('formulario__grupo-incorrecto');
                        elemento.classList.add('formulario__grupo-correcto');
                        document.querySelector('#grupo__correo2 .formulario__input-error').textContent = '';
                        document.querySelector('#grupo__correo2 .formulario__input-error').classList.remove('formulario__input-error-activo');
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
        var errorElement = document.querySelector('#grupo__' + campo + ' .formulario__input-error');
        if (errorElement) {
            errorElement.textContent = mensaje;
            errorElement.classList.add('formulario__input-error-activo');
        }
    }
});


document.addEventListener('DOMContentLoaded', function () {
    var estadoValidacion = { usuarioExiste: false };
    var usuarioInput = document.getElementById('usuario');

    usuarioInput.addEventListener('blur', function () {
        var usuario = this.value.trim();
        var elemento = document.getElementById('grupo__usuario');

        if (usuario === "") {
            validarCampoVacio(this, 'usuario', 'Por favor, ingresa tu usuario');
        } else {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/PHP/Consultas/ValidarUsuario.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;

                    if (response === "existe") {
                        estadoValidacion.usuarioExiste = true;
                        elemento.classList.add('formulario__grupo-incorrecto');
                        elemento.classList.remove('formulario__grupo-correcto');
                        document.querySelector('#grupo__usuario .formulario__input-error').textContent = 'Ya existe el usuario';
                        document.querySelector('#grupo__usuario .formulario__input-error').classList.add('formulario__input-error-activo');
                        // document.querySelector('#grupo__usuario i').classList.remove('fa-times-circle');
                    } else {
                        estadoValidacion.usuarioExiste = false;
                        elemento.classList.remove('formulario__grupo-incorrecto2');
                        elemento.classList.add('formulario__grupo-correcto2');
                        document.querySelector('#grupo__usuario .formulario__input-error2').textContent = '';
                        document.querySelector('#grupo__usuario .formulario__input-error2').classList.remove('formulario__input-error-activo2');
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
        document.querySelector('#grupo__' + campo + ' .formulario__input-error').textContent = mensaje;
        document.querySelector('#grupo__' + campo + ' .formulario__input-error').classList.add('formulario__input-error-activo');
    }
});

export const validarFechaNacimiento = () => {
    const fechaNacimientoInput = document.getElementById('fechanacimiento');
    const fechaNacimientoValue = new Date(fechaNacimientoInput.value);
    const fechaActual = new Date();
  
    // Ajustar la fecha de nacimiento para comparar con la fecha actual
    const fechaNacimientoValida = fechaNacimientoValue <= fechaActual;
  
    // Calcular la edad
    const edad = fechaActual.getFullYear() - fechaNacimientoValue.getFullYear();
  
    // Verificar si la fecha de nacimiento es válida (no es posterior a la fecha actual y tiene al menos 18 años)
    const fechaValida = fechaNacimientoValida && edad >= 18;
  
    // Obtener el elemento del mensaje de error
    const mensajeFechaNacimiento = document.getElementById("mensajeFechaNacimiento");
  
    // Mostrar mensaje de error si la fecha de nacimiento no es válida
    if (fechaNacimientoInput.value === '') {
        mensajeFechaNacimiento.innerText = 'Ingrese su fecha de nacimiento';
        fechaNacimientoInput.classList.remove('mensaje_error');
    } else {
        if (!fechaValida) {
            mensajeFechaNacimiento.innerText = '*Fecha no válida';
            fechaNacimientoInput.classList.add('mensaje_error');
        } else {
            // Si la fecha es válida, eliminamos el mensaje de error y permitimos el envío del formulario
            mensajeFechaNacimiento.innerText = '';
            fechaNacimientoInput.classList.remove('mensaje_error');
            return true; // La fecha es válida
        }
    }
    
  }
  // Agregamos un listener al evento submit del formulario para que llame a la función de validación
  const formulario = document.getElementById('registerFormUser'); 
  formulario.addEventListener("submit", function (event) {
      // Llamamos a la función de validación de fecha de nacimiento
      const fechaValida = validarFechaNacimiento();
    
      // Comprobamos si la fecha de nacimiento es válida
      if (!fechaValida) {
          event.preventDefault(); // Detener el envío del formulario
          // MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
      }   
  });
  // Agregar un event listener al input de fecha de nacimiento para validarla cuando cambie su valor
  document.getElementById("fechanacimiento").addEventListener("change", validarFechaNacimiento);
  
////Validacion Género
  const validarGenero = () => {
    const generoInput = document.getElementById('genero');
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
  
  // Agregar un listener al evento change del campo de género para llamar a la función de validación
  const generoInput = document.getElementById('genero');
  generoInput.addEventListener("change", validarGenero);
  // Agregamos un listener al evento submit del formulario para que llame a la función de validación
  const formulario2 = document.getElementById('registerFormUser'); 
  formulario2.addEventListener("submit", function (event) {
      // Llamamos a la función de validación de género
      const generoValido = validarGenero();
    
      // Comprobamos si el género es válido
      if (!generoValido) {
          event.preventDefault(); // Detener el envío del formulario
          // MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
      }   
  });


////Validacion ROL
  const validarROL = () => {
    const rolInput = document.getElementById('rol');
    const rolValue = rolInput.value;
  
    // Verificar si se ha seleccionado un género válido
    const rolValido = rolValue !== '0';
  
    // Obtener el elemento del mensaje de error
    const mensajerol = document.getElementById("mensajerol2");
    
    // Mostrar mensaje de error si el género no es válido
    if (!rolValido) {
        mensajerol.innerText = '*Por favor, seleccione un rol';
        rolInput.classList.add('mensaje_error');
    } else {
        // Si el género es válido, eliminamos el mensaje de error
        mensajerol.innerText = '';
        rolInput.classList.remove('mensaje_error');
        return true; // El género es válido
    }
  }
  
  // Agregar un listener al evento change del campo de género para llamar a la función de validación
  const rolInput = document.getElementById('rol');
  rolInput.addEventListener("change", validarROL);
  // Agregamos un listener al evento submit del formulario para que llame a la función de validación
  const formulario2rol = document.getElementById('registerFormUser'); 
  formulario2rol.addEventListener("submit", function (event) {
      // Llamamos a la función de validación de género
      const rolValido = validarROL();
    
      // Comprobamos si el género es válido
      if (!rolValido) {
          event.preventDefault(); // Detener el envío del formulario
          // MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
      }   
  });


////Validacion ESTADO USUARIO
  const validarestado = () => {
    const estadoInput = document.getElementById('estadoUser');
    const estadoValue = estadoInput.value;
  
    // Verificar si se ha seleccionado un género válido
    const estadoValido = estadoValue !== '0';
  
    // Obtener el elemento del mensaje de error
    const mensajeestado = document.getElementById("mensajeestado2");
    
    // Mostrar mensaje de error si el género no es válido
    if (!estadoValido) {
        mensajeestado.innerText = '*Por favor, seleccione un estado para el usuario';
        estadoInput.classList.add('mensaje_error');
    } else {
        // Si el género es válido, eliminamos el mensaje de error
        mensajeestado.innerText = '';
        estadoInput.classList.remove('mensaje_error');
        return true; // El género es válido
    }
  }
  
  // Agregar un listener al evento change del campo de género para llamar a la función de validación
  const estadoInput = document.getElementById('estadoUser');
  estadoInput.addEventListener("change", validarestado);
  // Agregamos un listener al evento submit del formulario para que llame a la función de validación
  const formulario2estado = document.getElementById('registerFormUser'); 
  formulario2estado.addEventListener("submit", function (event) {
      // Llamamos a la función de validación de género
      const estadoValido = validarestado();
    
      // Comprobamos si el género es válido
      if (!estadoValido) {
          event.preventDefault(); // Detener el envío del formulario
          // MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
      }   
  });

  
  //////////////////////////////
  export const validarContratacion = () => {
    const fechacontratacionInput = document.getElementById('fechacontratacion');
  
    // Obtener el elemento del mensaje de error
    const mensajecontratacion = document.getElementById("mensajeFechaContratacion");
  
    // Mostrar mensaje de error si la fecha de nacimiento no es válida
    if (fechacontratacionInput.value === '') {
        mensajecontratacion.innerText = 'Ingrese su fecha de contratación';
        fechacontratacionInput.classList.remove('mensaje_error');
    } else {
            // Si la fecha es válida, eliminamos el mensaje de error y permitimos el envío del formulario
            mensajecontratacion.innerText = '';
            fechacontratacionInput.classList.remove('mensaje_error');
            return true; // La fecha es válida
        }
    }
    
  // Agregamos un listener al evento submit del formulario para que llame a la función de validación
  const formularioC = document.getElementById('registerFormUser'); 
  formularioC.addEventListener("submit", function (event) {
      // Llamamos a la función de validación de fecha de nacimiento
      const fechaValida = validarContratacion();
    
      // Comprobamos si la fecha de nacimiento es válida
      if (!fechaValida) {
          event.preventDefault(); // Detener el envío del formulario
          // MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
      }   
  });
  // Agregar un event listener al input de fecha de nacimiento para validarla cuando cambie su valor
  document.getElementById("fechacontratacion").addEventListener("change", validarContratacion);


/////CAMPO VACIO NOMBRE
  document.addEventListener('DOMContentLoaded', function () {
    var usuarioInput = document.getElementById('nombre');

    usuarioInput.addEventListener('blur', function () {
        var usuario = this.value.trim();
        var elemento = document.getElementById('grupo__nombre');

        if (usuario === "") {
            validarCampoVacio(this, 'nombre', 'Por favor, ingresa tu nombre');
        } 
    });

    function validarCampoVacio(input, campo, mensaje) {
        var elemento = document.getElementById('grupo__' + campo);
        elemento.classList.add('formulario__grupo-incorrecto');
        elemento.classList.remove('formulario__grupo-correcto');
        document.querySelector('#grupo__' + campo + ' .formulario__input-error').textContent = mensaje;
        document.querySelector('#grupo__' + campo + ' .formulario__input-error').classList.add('formulario__input-error-activo');
    }
});

/////CAMPO VACIO DIRECCION
document.addEventListener('DOMContentLoaded', function () {
    var usuarioInput = document.getElementById('direccion');

    usuarioInput.addEventListener('blur', function () {
        var usuario = this.value.trim();
        var elemento = document.getElementById('grupo__direccion');

        if (usuario === "") {
            validarCampoVacio(this, 'direccion', 'Por favor, ingresa tu dirección');
        } 
    });

    function validarCampoVacio(input, campo, mensaje) {
        var elemento = document.getElementById('grupo__' + campo);
        elemento.classList.add('formulario__grupo-incorrecto');
        elemento.classList.remove('formulario__grupo-correcto');
        document.querySelector('#grupo__' + campo + ' .formulario__input-error').textContent = mensaje;
        document.querySelector('#grupo__' + campo + ' .formulario__input-error').classList.add('formulario__input-error-activo');
    }
});
/////CAMPO VACIO CONTRASENA
document.addEventListener('DOMContentLoaded', function () {
    var usuarioInput = document.getElementById('password2');

    usuarioInput.addEventListener('blur', function () {
        var usuario = this.value.trim();
        var elemento = document.getElementById('grupo__password2');

        if (usuario === "") {
            validarCampoVacio(this, 'password2', 'Por favor, ingresa tu contraseña');
        } 
    });

    function validarCampoVacio(input, campo, mensaje) {
        var elemento = document.getElementById('grupo__' + campo);
        elemento.classList.add('formulario__grupo-incorrecto');
        elemento.classList.remove('formulario__grupo-correcto');
        document.querySelector('#grupo__' + campo + ' .formulario__input-error').textContent = mensaje;
        document.querySelector('#grupo__' + campo + ' .formulario__input-error').classList.add('formulario__input-error-activo');
    }
});
// -----------------------------------

const formulario_Registro = document.getElementById('registerFormUser');
const botonEnviar = formulario_Registro.querySelector('button[type="submit"]');
const camposFormulario = formulario_Registro.querySelectorAll('input, select');

const validarInput = (input) => {
  let resultadoValidacion;
  switch (input.name) {
    case "correo2":
      resultadoValidacion = validarInputCorreo({ target: input }, input.name);
      break;
    case "password2":
    case "password3":
      resultadoValidacion = validarInputPassword({ target: input }, input.name);
      break;
    case "usuario":
      resultadoValidacion = validarInputUsuario({ target: input });
      break;
    case "nombre":
      resultadoValidacion = validarInputNombre({ target: input });
      break;
    case "dni":
      resultadoValidacion = validarInputDNI({ target: input });
      break;
    case "direccion":
      resultadoValidacion = validarInputDireccion({ target: input });
      break;
  }
  return resultadoValidacion;
};

formulario_Registro.addEventListener('submit', function (e) {
  let errorEncontrado = false;

  // Validar todos los inputs
  camposFormulario.forEach((input) => {
    const resultadoValidacion = validarInput(input);
    if (resultadoValidacion && (!resultadoValidacion.estadoER || (resultadoValidacion.estadoCC !== undefined && !resultadoValidacion.estadoCC))) {
      errorEncontrado = true;
    }
  });

  if (errorEncontrado) {
    e.preventDefault();
    funciones.MostrarAlerta('error', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
  }
});

camposFormulario.forEach(function(campo) {
  campo.addEventListener('input', function() {
    const algunCampoConValor = Array.from(camposFormulario).some(campo => campo.value.trim() !== '');
    if (algunCampoConValor) {
      botonEnviar.removeAttribute('disabled');
    } else {
      botonEnviar.setAttribute('disabled', 'disabled');
    }
  });
});

  




