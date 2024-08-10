import * as funciones from "./validacionGeneral.js";

const inputs = document.querySelectorAll('#registerRol input');
const icon = document.querySelectorAll('.ver_password');

const expresiones = {
  rol: /^[a-zA-ZÀ-ÿ\s]{3,80}$/, // Letras y espacios, pueden llevar acentos.
  descripcionrol: /^[a-zA-ZÀ-ÿ\s]+$/,
 
}

const validarInputs = (e) => {
    // let estadoValidado = true;
    switch (e.target.name) {
        case "rol":
            validarInputRol(e);
            break;
        case "descripcionrol":
            validarInputDescripcion(e);
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



// validar input nombre
let validarInputRol = (e) => {
    let estadoValidacion = {
        estadoCV: false,
        estadoER: false,
        estadoMC: false,
        estadoUE: false,
    };
    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'rol', 'Por favor, ingresa el rol') ;

    estadoValidacion.estadoCV
        ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.rol, e.target, 'rol', 'Solo se permiten letras')) : "";

    estadoValidacion.estadoER
        ? (estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s/g, e.target, 'rol', 'Debe limitarse a un espacio')) : "";

    estadoValidacion.estadoUE
        ? (estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, 'rol', 'No debe colocar el mismo caracter +2 veces seguidas')) : "";

    return estadoValidacion;
};

// validar input dirección
let validarInputDescripcion = (e) => {
    let estadoValidacion = {
      estadoCV: false,
      estadoER: false,
      estadoMC: false,
      estadoUE: false,
      estadoCM: false,
    };
    estadoValidacion.estadoCV = funciones.validarCampoVacio(e.target, 'descripcionrol', 'Por favor, ingresa la descripción');
  
    estadoValidacion.estadoCV
    ? (estadoValidacion.estadoUE = funciones.validarEspacios(/\s\s/g, e.target, 'descripcionrol', 'Debe limitarse a un espacio')) : "";
  
    estadoValidacion.estadoUE
      ? (estadoValidacion.estadoER = funciones.validarExpresionRegular(expresiones.descripcionrol, e.target, 'descripcionrol', 'Solo se permiten letras')) : "";
  
    estadoValidacion.estadoER
      ? (estadoValidacion.estadoMC = funciones.validarMismoCaracter(e.target, 'descripcionrol', 'No debe colocar el mismo caracter +2 veces seguidas')) : "";
    estadoValidacion.estadoMC
    ? (estadoValidacion.estadoCM = funciones.validarCampoMaximo (e.target, "descripcionrol", "No cumple la cantidad mínima de caracteres")): "";
      return estadoValidacion;
  };


  const botonGuardar = document.getElementById('Btnregistrarrol');
botonGuardar.addEventListener('click', function (e) {
    // Validar la fecha de nacimiento
    const fechaEsValida = validarFechaNacimiento();

    // Validar otros campos requeridos
    const camposRequeridos = document.querySelectorAll("[required]");
    let hayCamposVacios = false;

    camposRequeridos.forEach(function (campo) {
        if (campo.value.trim() === '') {
            hayCamposVacios = true;
            mostrarErrorCampo(campo);
        }
    });

    if (hayCamposVacios || !fechaEsValida) {
        e.preventDefault();
        funciones.MostrarAlerta('', '¡ERROR!', 'Por favor, completa todos los campos requeridos antes de enviar el formulario.');
    }
});

const formulario_Registro = document.getElementById('registerRol');
formulario_Registro.addEventListener('submit', function (e) {
    const error_Formulario_Registro = document.querySelectorAll(".formulario__grupo-incorrecto");
    const error_Formulario = document.querySelectorAll(".formulario__input-error-activo");

    // Comprueba si hay errores de validación
    if (error_Formulario_Registro.length > 0 || error_Formulario.length > 0) {
        e.preventDefault();
        funciones.MostrarAlerta('', '¡ERROR!', 'Hay errores en el formulario. Por favor, corrígelos antes de enviarlo.');
    } else {
        e.preventDefault();
        Swal.fire({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas guardar los datos?',
            icon: 'question', // Ícono de pregunta
            showCancelButton: true, // Mostrar botón de cancelación
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                formulario_Registro.submit(); // Enviar el formulario si se confirma
            } 
        });
    }
});