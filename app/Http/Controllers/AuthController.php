<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de login/registro.
     */
    public function showLoginRegister()
    {
        return view('Login_Register');
    }

    /**
     * Registrar un nuevo usuario.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nombre_completo' => ['required', 'string', 'max:255'],
            'id_td' => ['required', 'string'], // llega como "cc", "ti", "ce", "pa"
            'n_documento' => ['required', 'string', 'max:50', 'unique:usuario,N_Documento'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuario,Correo'],
            'celular' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 🔹 Mapeo de siglas a enteros (según tu tabla tipos_documento)
        $tiposDocumento = [
            'cc' => 1,
            'ti' => 2,
            'ce' => 3,
            'pa' => 4,
        ];

        // Convertir el string en número
        $idTD = $tiposDocumento[strtolower($request->id_td)] ?? null;

        if (!$idTD) {
            return back()->withErrors([
                'id_td' => 'El tipo de documento seleccionado no es válido.',
            ]);
        }

        $usuario = Usuario::create([
            'Nombre_Completo' => $request->nombre_completo,
            'ID_Rol' => 2, // 👈 por defecto cliente
            'ID_TD' => $idTD,
            'N_Documento' => $request->n_documento,
            'Correo' => $request->email,
            'Celular' => $request->celular,
            'Contrasena' => Hash::make($request->password),
        ]);

        Auth::login($usuario);

        return redirect()->route('dashboard.welcome')
                         ->with('success', '¡Registro exitoso!');
    }

    /**
     * Iniciar sesión.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt([
            'Correo' => $credentials['email'],
            'password' => $credentials['password'], // usa getAuthPassword en el modelo
        ])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.welcome')->with('success', 'Bienvenido de nuevo!');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    /**
     * Cerrar sesión.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Sesión cerrada correctamente.');
    }
}
