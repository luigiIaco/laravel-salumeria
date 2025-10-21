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

    public function uploadImage(Request $request) {
        Log::info($request);
        
        $request->validate([
            'imageProfile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        if($user->imageProfile) {
            Storage::delete('public/' . $user->imageProfile);
        }

        $path = $request->file('imageProfile')->store('profile_images/' . $user->name ,'public');

        $user->imageProfile = $path;
        $user->save();

        return redirect()->route('home')->with('success','Immagine caricata con successo');

    }
}
