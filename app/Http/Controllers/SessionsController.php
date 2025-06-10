<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session'); // the login form view
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Redirect based on user role
            switch ($user->role) {
                case 'directeur':
                    return redirect()->route('dashboard.directeur');
                case 'inspecteur':
                    return redirect()->route('dashboard.inspecteur');
                case 'coordinateur':
                    return redirect()->route('dashboard.coordinateur');
                case 'secretaire':
                    return redirect()->route('dashboard.secretaire');
                default:
                    return redirect('/home'); // fallback route
            }
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe invalide.',
        ]);
    }

    public function destroy()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Déconnexion réussie.');
    }
}
