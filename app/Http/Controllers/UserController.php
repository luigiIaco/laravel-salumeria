<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);


        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
        return redirect()->route('home')->with('success', 'Registrazione avvenuta con successo');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/products')->with('success', 'Login effettuato con successo');
        }

        return back()->withErrors([
            'email' => 'Le credenziali fornite non sono corrette',
        ])->onlyInput('email');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'imageProfile' => 'required|mimes:jpeg,png,jpg,gif,svg,jfif,pjpeg,avif|max:2048',
        ]);

        $user = Auth::user();

        if ($user->imageProfile) {
            Storage::disk('public')->delete($user->imageProfile);
        }

        $path = $request->file('imageProfile')->store('profile_images/' . $user->name, 'public');

        $user->imageProfile = $path;
        $user->save();

        return redirect()->route('home')->with('success', 'Immagine caricata con successo');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout avvenuto con successo');
    }
}
