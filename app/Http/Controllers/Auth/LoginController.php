<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class LoginController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login');  // Vista donde el usuario ingresa las credenciales
    }

    // Procesar el login
    public function login(Request $request)
    {
        // Validar las credenciales
        $credentials = $request->only('email', 'password');

        // Validación básica
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt($credentials)) {
            // Si la autenticación es exitosa, redirigir al dashboard o la página principal
            return redirect()->intended('/dashboard');
        }

        // Si no se puede autenticar, redirigir con mensaje de error
        return back()->withErrors(['email' => 'Las credenciales son incorrectas.'])->withInput();
    }

    // Cerrar sesión
    public function logout()
    {
        Auth::logout();
        return redirect('index.inicio');
    }
}
