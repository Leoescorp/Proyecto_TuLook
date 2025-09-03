<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- CSS externo -->
    <link rel="stylesheet" href="css/Login.css">
</head>
<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Registrarse</button>
                </div>
            </div>

            <!-- Formularios -->
            <div class="contenedor__login_register">
                <!-- Login -->
                <form action="{{ route('login.post') }}" method="POST" class="formulario__login">
                    <h2>Iniciar Sesión</h2>
                    @csrf 
                    <input type="email" placeholder="Correo Electrónico" name="email" id="login-email" required>
                    <div class="password-container">
                        <input type="password" placeholder="Contraseña" name="password" id="login-password" required>
                        <span class="password-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg>
                        </span>
                    </div>
                    <a href="#" class="olvido-contra">¿Olvidaste tu contraseña?</a>
                    <button type="submit">Entrar</button>
                </form>

                <!-- Registro -->
                <form action="{{ route('register.post') }}" method="POST" class="formulario__register">
                    <h2>Registrarse</h2>
                    @csrf 
                    @if ($errors->any())
                        <div style="color: red; margin-bottom: 10px; padding: 10px; border: 1px solid red; border-radius: 5px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="text" placeholder="Nombre completo" name="nombre_completo" id="nombre_completo" required>
                    
                    <select name="id_td" id="id_td" class="form-select" required>
                        <option value="" disabled selected>Tipo de Documento</option>
                        <option value="cc">Cédula de Ciudadanía</option>
                        <option value="ti">Tarjeta de Identidad</option>
                        <option value="ce">Cédula de Extranjería</option>
                        <option value="pa">Pasaporte</option>
                    </select>

                    <input type="text" placeholder="Número de Documento" name="n_documento" id="n_documento" required>
                    <input type="email" placeholder="Correo Electrónico" name="email" id="register-email" required>
                    <input type="text" placeholder="Número de Celular" name="celular" id="celular" required>
                    
                    <div class="password-container">
                        <input type="password" placeholder="Contraseña" name="password" id="register-password" required>
                        <span class="password-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg>
                        </span>
                    </div>
                    
                    <input type="password" placeholder="Confirmar Contraseña" name="password_confirmation" required>
                    <button type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </main>

    <!-- JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btnIniciarSesion = document.getElementById('btn__iniciar-sesion');
            const btnRegistrarse = document.getElementById('btn__registrarse');
            const contenedorLoginRegister = document.querySelector('.contenedor__login_register');
            const formularioLogin = document.querySelector('.formulario__login');
            const formularioRegister = document.querySelector('.formulario__register');
            const cajaTraseraLogin = document.querySelector('.caja__trasera-login');
            const cajaTraseraRegister = document.querySelector('.caja__trasera-register');

            btnIniciarSesion.addEventListener('click', () => {
                formularioRegister.style.display = 'none';
                contenedorLoginRegister.style.left = '10px';
                formularioLogin.style.display = 'block';
                cajaTraseraRegister.style.opacity = '1';
                cajaTraseraLogin.style.opacity = '0';
            });

            btnRegistrarse.addEventListener('click', () => {
                formularioRegister.style.display = 'block';
                contenedorLoginRegister.style.left = '410px';
                formularioLogin.style.display = 'none';
                cajaTraseraRegister.style.opacity = '0';
                cajaTraseraLogin.style.opacity = '1';
            });
        });
    </script>
</body>
</html>