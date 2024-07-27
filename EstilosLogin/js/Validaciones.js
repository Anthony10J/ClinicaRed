const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll('#formulario input');
const clave  = document.getElementById('password');
const clave2 = document.getElementById('password2');
const clave3 = document.getElementById('password3');
// const clave = document.querySelectorAll('#password');
const icon = document.querySelector('.ver_password');

const expresiones = {
	usuario: /^[a-zA-Z\_\-]{5,15}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{10,80}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{5,30}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{8,12}$/, // 7 a 14 numeros.
	direccion: /^[a-zA-Z0-9À-ÿ\s]{5,80}$/
}

const campos = {
	usuario: false,
	nombre: false,
	password: false,
	correo: false,
	telefono: false
}

const validarFormulario = (e) => {
   switch (e.target.name){
    case "correo":
        validarCampo(expresiones.correo, e.target, 'correo');
        break;
	case "correo2":
        validarCampo(expresiones.correo, e.target, 'correo2');
        break;
	case "password":
			validarCampo(expresiones.password, e.target, 'password');
		break;
	case "password2":
			validarCampo(expresiones.password, e.target, 'password2');
		break;
	case "password3":
			validarCampo(expresiones.password, e.target, 'password3');
		break;
	case "usuario":
        validarCampo(expresiones.usuario, e.target, 'usuario');
        break;
	case "direccion":
        validarCampo(expresiones.direccion, e.target, 'direccion');
        break;
	case "nombre":
        validarCampo(expresiones.nombre, e.target, 'nombre');
        break;
   }
}

const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-check-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
		document.querySelector(`#grupo__${campo} i`).classList.add('fa-times-circle');
		document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check-circle');
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[campo] = false;
	}
}

inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario); // Verificar el campo después de presionar una tecla
	input.addEventListener('blur', validarFormulario); // Comprobar cuando da clic fuera del campo
});

icon.addEventListener('click', e => {
	if (clave.type === "password" ||
		clave2.type === "password" ||
		clave3.type === "password"
	) {
		clave.type = "text";
		clave2.type = "text";
		clave3.type = "text";
		icon.classList.remove('fa-eye');
		icon.classList.add('fa-eye-slash');
	} else {
		clave.type = "password";
		clave2.type = "password";
		clave3.type = "password";
		icon.classList.remove('fa-eye-slash');
		icon.classList.add('fa-eye');
	}
});
// function togglePasswordVisibility(clave, icon) {
//     if (clave.type === "password") {
//         clave.type = "text";
//         icon.classList.remove('fa-eye');
//         icon.classList.add('fa-eye-slash');
//     } else {
//         clave.type = "password";
//         icon.classList.remove('fa-eye-slash');
//         icon.classList.add('fa-eye');
//     }
// }

// icon.addEventListener('click', () => {
//     togglePasswordVisibility(clave, icon);
// });

// formulario.addEventListener('submit', (e) => {

//    if (campos.correo && campos.password) {
//     formulario.reset();
	
// 	window.location.href = '../../PHP/Vistas/Main.php';
     
// 		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
// 		setTimeout(() => {
// 			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
// 		}, 5000);

// 		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
// 			icono.classList.remove('formulario__grupo-correcto');
// 		});
//    }else{
//     document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
//    }
// })



 
 