<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class LoginRegisterController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['home', 'logout']),
            new Middleware('auth', only: ['home', 'logout']),
        ];
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validăm datele de intrare
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        // Creăm user-ul cu rol de student și status inactiv (pentru activare ulterioară de către admin)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'faculty' => $request->faculty,
            'dormitory' => $request->dormitory,
            'floor' => $request->floor,
            'room' => $request->room,
            'password' => Hash::make($request->password),
            'role' => 'student',      // setare implicită pentru studenți
            'is_active' => false,     // contul va fi activat de un admin
        ]);

        // Opțional, aici poți adăuga logica de notificare către admin

        return redirect()->route('login')
            ->withSuccess('Te-ai înregistrat cu succes! Contul tău este în așteptare de aprobare de către un administrator.');
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        // Validăm credențialele
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Încercăm autentificarea
        if (Auth::attempt($credentials)) {
            // Dacă autentificarea a avut succes, verificăm dacă user-ul este activ
            if (!Auth::user()->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Contul tău nu a fost încă activat. Te rugăm sa mergi la administratie pentru activare.',
                ])->onlyInput('email');
            }
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Credențialele furnizate nu corespund cu înregistrările noastre.',
        ])->onlyInput('email');
    }

    public function home(): View
    {
        return view('auth.home');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('Te-ai deconectat cu succes!');
    }
}
