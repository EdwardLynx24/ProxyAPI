<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Método para manejar el registro de usuarios
    public function register(Request $request)
    {
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Crear el nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Autenticar al usuario
        Auth::login($user);

        // Redirigir a la página deseada
        return redirect()->intended('dashboard');
    }

    // Método para mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Método para manejar el inicio de sesión
    public function login(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            return redirect()->intended('dashboard');
        }

        // Autenticación fallida
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput($request->only('email'));
    }

    // Método para manejar el cierre de sesión
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function dashboard()
    {
        $users = User::all();
        return view('auth.dashboard', compact('users'));
    }
}
