<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registrazione avvenuta con successo');
    }

    public function showLoginForm()
    {
        Artisan::call('storage:link');
        $cookie_remember = Cookie::get('remember_me');
        $rememberDataUsers = json_decode($cookie_remember, true);
        return view('auth.login', compact('rememberDataUsers'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //Log::info($credentials);

        if ($request->has('remember')) {
            Cookie::queue('remember_me', json_encode($credentials), 60 * 24 * 14); // 14 giorni
        }

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

        if ($user->imageprofile) {
            Storage::disk('public')->delete($user->imageprofile);
        }

        $path = $request->file('imageProfile')->store('profile_images/' . $user->name, 'public');

        $user->imageprofile = $path;
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

    public function showForgotPasswordForm()
    {
        return view('auth.forgotPassword');
    }

    public function showPageConfirmationSendEmail()
    {
        return view('auth.confirmSendEmail');
    }

    public function sendMail(Request $request)
    {
        Log::info($request);
        Session::put('email',$request['email']);
        $to = $request['email'];
        Mail::to($to)->send(new TestEmail());
        return redirect()->route('page.confirmSendEmail')->with('success', 'Caro utente,l"email è stata inviata con successo. Controlla la tua casella di posta per cambiare la tua password');
    }

    
     public function showResetPasswordForm()
    {
        return view('auth.passwordReset');
    }


    public function resetPassword(Request $request)
    {
        $email = Session::get('email');
        $user = User::where('email', $email)->firstOrFail();
        $user->password = Hash::make($request['password']);
        $user->save();
        return redirect()->route('login')->with('success', 'Password cambiata con successo');
    }
}
