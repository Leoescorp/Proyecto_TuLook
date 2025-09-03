// Declaración de variables para los elementos del DOM
let contenedorTodo;
let cajaTraseraLogin;
let cajaTraseraRegister;
let formularioLogin;
let formularioRegister;
let btnIniciarSesion;
let btnRegistrarse;

// Función para inicializar las variables y agregar los event listeners
function inicializarElementos() {
    contenedorTodo = document.querySelector(".contenedor__todo");
    cajaTraseraLogin = document.querySelector(".caja__trasera-login");
    cajaTraseraRegister = document.querySelector(".caja__trasera-register");
    formularioLogin = document.querySelector(".formulario__login");
    formularioRegister = document.querySelector(".formulario__register");
    btnIniciarSesion = document.getElementById("btn__iniciar-sesion");
    btnRegistrarse = document.getElementById("btn__registrarse");

    // Agrega los event listeners a los botones
    btnIniciarSesion.addEventListener("click", iniciarSesion);
    btnRegistrarse.addEventListener("click", registrarse);

    // Agrega event listeners a los íconos de visibilidad de contraseña
    const passwordIcons = document.querySelectorAll('.password-icon');
    passwordIcons.forEach(icon => {
        icon.addEventListener('click', togglePasswordVisibility);
    });

    // Llama a la función de ajuste inicial
    ajustarPantallaInicial();
}

// Función para ajustar la vista al cargar o redimensionar la página
function ajustarPantallaInicial() {
    if (window.innerWidth > 850) {
        // Vista de escritorio
        cajaTraseraLogin.style.display = "block";
        cajaTraseraRegister.style.display = "block";
    } else {
        // Vista móvil
        cajaTraseraLogin.style.display = "none";
        cajaTraseraRegister.style.display = "block";
        formularioLogin.style.display = "block";
        formularioRegister.style.display = "none";
        contenedorTodo.style.left = "0px";
    }
}

// Función para manejar el cambio a la vista de registro
function registrarse() {
    if (window.innerWidth > 850) {
        // Escritorio
        formularioRegister.style.display = "block";
        contenedorTodo.style.left = "410px";
        formularioLogin.style.display = "none";
        cajaTraseraRegister.style.opacity = "0";
        cajaTraseraLogin.style.opacity = "1";
    } else {
        // Móvil
        formularioRegister.style.display = "block";
        contenedorTodo.style.left = "0px";
        formularioLogin.style.display = "none";
        cajaTraseraRegister.style.display = "none";
        cajaTraseraLogin.style.display = "block";
        cajaTraseraLogin.style.opacity = "1";
    }
}

// Función para manejar el cambio a la vista de login
function iniciarSesion() {
    if (window.innerWidth > 850) {
        // Escritorio
        formularioRegister.style.display = "none";
        contenedorTodo.style.left = "10px";
        formularioLogin.style.display = "block";
        cajaTraseraRegister.style.opacity = "1";
        cajaTraseraLogin.style.opacity = "0";
    } else {
        // Móvil
        formularioRegister.style.display = "none";
        contenedorTodo.style.left = "0px";
        formularioLogin.style.display = "block";
        cajaTraseraRegister.style.display = "block";
        cajaTraseraLogin.style.display = "none";
    }
}

// Función para alternar la visibilidad de la contraseña
function togglePasswordVisibility(event) {
    const icon = event.currentTarget;
    const passwordInput = icon.previousElementSibling;
    const isPasswordVisible = passwordInput.type === 'text';
    passwordInput.type = isPasswordVisible ? 'password' : 'text';
    
    // Cambiar el ícono de ojo
    const eyeOpenSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/></svg>`;
    const eyeClosedSVG = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16"><path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.936 6.55 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588M5.21 3.088A7.029 7.029 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.936 1.45-2.206 2.895-.836 2.059-2.06 2.06c-.347.346-.689.673-1.018.966zm3.858 2.723a.5.5 0 1 0-.708-.708.5.5 0 0 0 .708.708z"/><path d="M14.717 4.544a4.4 4.4 0 0 0-3.322-3.322L8.766 4.332a.5.5 0 0 0-.708-.708l-2.06 2.06c-.347.346-.689.673-1.018.966z"/></svg>`;
    icon.innerHTML = isPasswordVisible ? eyeClosedSVG : eyeOpenSVG;
}

// Llama a la función de inicialización cuando el DOM esté completamente cargado
document.addEventListener("DOMContentLoaded", inicializarElementos);

// Agrega un event listener para el resize de la ventana para una experiencia fluida
window.addEventListener("resize", ajustarPantallaInicial);