import * as funciones from "./validacionGeneral.js";

const inputs = document.querySelectorAll('#formulario input');
const icon = document.querySelectorAll('.ver_password');

const expresiones = {
  usuario: /^[a-zA-Z]{1,15}$/, 
  nombre: /^[a-zA-ZÀ-ÿ\s]{3,40}$/, 
  correo: /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  direccion: /^[a-zA-ZÀ-ÿ0-9\s,.-]+$/,
  password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{5,}$/, 
  dni: /^(?!00)(?!.*0{5}$)[0-9]{1,13}$/,
  dniN:/^[0-9]{1,13}$/
};

const validarInputs = (e) => {
  switch (e.target.name) {
    case "correo2":
      validarInputCorreo(e, 'correo2');
      break;
    case "password2":
      validarInputPassword(e, 'password2');
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

let validarInputCorreo = (e, campo) => { 
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
  };
  estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, campo, 'Por favor, ingresa tu dirección de correo electrónico');
  if (estadoValidacion.estadoCV) {
    estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.correo, e.target, campo, 'El correo no coincide con el formato establecido');
  }
  return estadoValidacion;
};

let validarInputPassword = (e, campo) => {
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
    estadoCC: false,
  };
  estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, campo, 'Por favor, ingresa tu contraseña');
  if (estadoValidacion.estadoCV) {
    estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.password, e.target, campo, 'Debe contener una mayúscula, una minúscula, un número y un caracter especial');
    estadoValidacion.estadoCC = funciones.coincidirClave('password3', 'La contraseña no coincide con la anterior');
  }
  return estadoValidacion;
};

let validarInputUsuario = (e) => {
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
    estadoMC: false,
    estadoUE: false,
  };

  estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'usuario', 'Por favor, ingresa tu nombre de usuario');

  if (estadoValidacion.estadoCV) {
    estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.usuario, e.target, 'usuario', 'Solo se permiten letras');
  }

  if (estadoValidacion.estadoER) {
    estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, 'usuario', 'No debe colocar el mismo caracter más de 2 veces seguidas');
  }

  if (estadoValidacion.estadoMC) {
    estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s+/g, e.target, 'usuario', 'Debe limitarse a un solo espacio entre palabras');
  }

  return estadoValidacion;
};

let validarInputDNI = (e) => {
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
    estadoCC: false,
    estadoCM: false,
  };
  estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'dni', 'Por favor, ingresa tu DNI');
  if (estadoValidacion.estadoCV) {
    estadoValidacion.estadoCC = funciones.validarCerosConsecutivos(expresiones.dni, e.target, "dni", 'DNI no válido');
  }
  if (estadoValidacion.estadoCC) {
    estadoValidacion.estadoCM = funciones.validarCampoMinimo(e.target, 'dni', 'Por favor, ingresa correctamente el DNI');
  }
  if (estadoValidacion.estadoCM) {
    estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.dniN, e.target, 'dni', 'Solo se permiten números');
  }
  return estadoValidacion;
};

let validarInputNombre = (e) => {
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
    estadoMC: false,
    estadoUE: false,
  };
  estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'nombre', 'Por favor, ingresa tu nombre');
  if (estadoValidacion.estadoCV) {
    estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.nombre, e.target, 'nombre', 'Solo se permiten letras');
  }
  if (estadoValidacion.estadoER) {
    estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s+/g, e.target, 'nombre', 'Debe limitarse a un solo espacio entre palabras');
  }
  if (estadoValidacion.estadoUE) {
    estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, 'nombre', 'No debe colocar el mismo caracter más de 2 veces seguidas');
  }
  return estadoValidacion;
};

let validarInputDireccion = (e) => {
  let estadoValidacion = {
    estadoCV: false,
    estadoER: false,
    estadoMC: false,
    estadoUE: false,
    estadoCM: false,
  };
  estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'direccion', 'Por favor, ingresa tu dirección');
  if (estadoValidacion.estadoCV) {
    estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s+/g, e.target, 'direccion', 'Debe limitarse a un solo espacio entre palabras');
  }
  if (estadoValidacion.estadoUE) {
    estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.direccion, e.target, 'direccion', 'Caracter no válido');
  }
  if (estadoValidacion.estadoER) {
    estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, 'direccion', 'No debe colocar el mismo caracter más de 2 veces seguidas');
  }
  if (estadoValidacion.estadoMC) {
    estadoValidacion.estadoCM = funciones.validarCampoMaximo(e.target, "direccion", "No cumple la cantidad mínima de caracteres");
  }
  return estadoValidacion;
};

export const validarFechaNacimiento = () => {
  const fechaNacimientoInput = document.getElementById('fechanacimiento');
  const fechaNacimientoValue = new Date(fechaNacimientoInput.value);
  const fechaActual = new Date();

  const fechaNacimientoValida = fechaNacimientoValue <= fechaActual;
  const edad = fechaActual.getFullYear() - fechaNacimientoValue.getFullYear();
  const fechaValida = fechaNacimientoValida && edad >= 18;

  const mensajeFechaNacimiento = document.getElementById("mensajeFechaNacimiento");

  if (fechaNacimientoInput.value === '') {
      mensajeFechaNacimiento.innerText = 'Ingrese su fecha de nacimiento';
      fechaNacimientoInput.classList.remove('mensaje_error');
  } else {
      if (!fechaValida) {
          mensajeFechaNacimiento.innerText = '*Fecha no válida';
          fechaNacimientoInput.classList.add('mensaje_error');
      } else {
          mensajeFechaNacimiento.innerText = '';
          fechaNacimientoInput.classList.remove('mensaje_error');
          return true;
      }
  }
}

const formulario = document.getElementById('registerForm'); 
formulario.addEventListener("submit", function (event) {
    const fechaValida = validarFechaNacimiento();
  
    if (!fechaValida) {
        event.preventDefault();
    }   
});

document.getElementById("fechanacimiento").addEventListener("change", validarFechaNacimiento);

const validarGenero = () => {
  const generoInput = document.getElementById('mensajeGenero1');
  const generoValue = generoInput.value;

  const generoValido = generoValue !== '0';

  const mensajeGenero = document.getElementById("mensajeGenero");

  if (!generoValido) {
    mensajeGenero.innerText = 'Seleccione una opción válida';
    return false;
  } else {
    mensajeGenero.innerText = '';
    return true;
  }
}

document.getElementById('mensajeGenero1').addEventListener("change", validarGenero);

formulario.addEventListener("submit", function (event) {
  const generoValido = validarGenero();

  if (!generoValido) {
    event.preventDefault();
  }
});



// -----------------------------------
const formulario_Registro = document.getElementById('registerForm');
const botonEnviar = formulario_Registro.querySelector('button[type="submit"]');
const camposFormulario = formulario_Registro.querySelectorAll('input, select');

// Función para validar el formulario
function validarFormulario() {
  let errorEncontrado = false;

  // Validar todos los inputs
  camposFormulario.forEach((input) => {
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

    // Si alguna validación falla, marcar errorEncontrado como true
    if (resultadoValidacion && (!resultadoValidacion.estadoCV || !resultadoValidacion.estadoER || (resultadoValidacion.estadoCC !== undefined && !resultadoValidacion.estadoCC))) {
      errorEncontrado = true;
    }
  });

  return errorEncontrado;
}

// Listener para habilitar/deshabilitar el botón enviar
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

// Listener para el envío del formulario
formulario_Registro.addEventListener('submit', function (e) {
  const errorEncontrado = validarFormulario();

  if (errorEncontrado) {
    e.preventDefault();
    funciones.MostrarAlerta('error', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
  }
});