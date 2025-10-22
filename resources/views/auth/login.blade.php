@extends('layouts.app')

@section('title', 'Accesso - Salumeria Bella Vita')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #f8e0b6 0%, #f7d9aa 50%, #f4c77a 100%);
        font-family: 'Poppins', sans-serif;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.92);
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        padding: 2.5rem;
        max-width: 420px;
        margin: 80px auto;
        animation: fadeIn 0.8s ease-in-out;
    }

    .login-card h1 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        font-size: 2rem;
        color: #8B0000;
        margin-bottom: 1.2rem;
    }

    .login-logo {
        display: block;
        margin: 0 auto 1.5rem;
        width: 100px;
        height: auto;
        border-radius: 50%;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    }

    .form-control {
        border-radius: 10px;
        padding: 0.8rem 1rem;
        border: 1px solid #ddd;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #8B0000;
        box-shadow: 0 0 5px rgba(139, 0, 0, 0.3);
    }

    .btn-login {
        background-color: #8B0000;
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 12px;
        padding: 0.8rem;
        transition: all 0.3s ease;
    }

    .btn-login:hover {
        background-color: #a01a1a;
        transform: scale(1.05);
    }

    .btn-underline {
        position: relative;
        display: inline-block;
        color: #8B0000;
        /* colore testo */
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .btn-underline::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -2px;
        /* distanza dalla scritta */
        width: 0;
        height: 2px;
        /* spessore della linea */
        background-color: #8B0000;
        transition: width 0.3s ease;
    }

    .btn-underline:hover::after {
        width: 100%;
        /* la linea si estende sotto tutto il testo */
    }

    .btn-underline:hover {
        color: #a01a1a;
        /* opzionale, cambia colore del testo */
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="container text-center">
    @if(session('success'))
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 p-2 shadow-md" role="alert" style="width: 16%; margin: 0 auto; position:relative; top:55px">
        <p class="font-bold" style="margin-bottom:0px !important">{{session('success')}}</p>
    </div>
    @endif


    @if ($errors->any())
    <div role="alert">
        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="login-card">
        <!-- Logo Salumeria -->
        <img src="{{ asset('images/logo/logoSalumeria.png') }}" alt="Logo Salumeria" class="login-logo">

        <h1>Benvenuto alla Salumeria Bella Vita</h1>
        <p class="text-muted mb-4">Accedi al tuo account per gustare la tradizione italiana 🍷</p>

        <form method="POST" action="{{ route('loginForm') }}">
            @csrf

            <div class="mb-3 text-start">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input id="email" type="email" class="form-control" name="email" required autofocus>
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3 form-check text-start">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Ricordami</label>
            </div>

            <button type="submit" class="btn btn-login w-100">Accedi</button>

            <div class="mt-3">
                <a class="text-decoration-none text-muted" href="">
                    Hai dimenticato la password?
                </a>
            </div>

            <div class="mt-4 flex justify-center">
                <p class="text-muted">Non hai un account?
                    <a href="{{ url('/register') }}" class="btn-underline mx-1">Registrati ora</a>
                </p>

            </div>
        </form>
    </div>
</div>
@endsection