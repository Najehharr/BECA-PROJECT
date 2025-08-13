<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    // Show the login form
    public function create()
    {
        return view('session.login-session'); // your login view
    }

    // Handle login
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
            'role'     => 'required|in:inspecteur,coordinateur,directeur,secretaire',
        ]);

        $role = $request->role;

        // Choose guard
        $guard = $role === 'inspecteur' ? 'inspecteur' : 'web';

        // Attempt login
    

        if (Auth::guard($guard)->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();

            // Redirect based on role
            switch ($role) {
                case 'directeur':
                    return redirect()->route('dashboard.directeur');
                case 'coordinateur':
                    return redirect()->route('dashboard.coordinateur');
                case 'inspecteur':
                    return redirect()->route('dashboard.inspecteur');
                case 'secretaire':
                    return redirect()->route('dashboard.secretaire');
                default:
                    return redirect('/home');
            }
        }

        // Failed login
        return back()->withErrors([
            'email' => 'Email ou mot de passe invalide.',
        ]);
    }

    // Handle logout
    public function destroy(Request $request)
    {
        $role = $request->role ?? 'web';
        $guard = $role === 'inspecteur' ? 'inspecteur' : 'web';

        Auth::guard($guard)->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Déconnexion réussie.');
    }
}
