@extends('layouts.app')

@section('content')
<style>
    .login-card {
        background: rgba(255, 255, 255, 0.92);
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        padding: 2.5rem;
        max-width: 420px;
        margin: 85px auto;
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
        width: 80px;
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

<div class="container text-center" style="position: relative; top:90px">
    <div class="login-card">
        <!-- Logo Salumeria -->
        <img src="{{ asset('images/logo/logoSalumeria.png') }}" alt="Logo Salumeria" class="login-logo">
        <h2>Recupera Password</h2>

        <form method="POST" action="{{ route('forgotPassword') }}">
            @csrf

            <div class="mb-3 text-start">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $rememberDataUsers['email'] ?? '' }}" required autofocus>
            </div>

            <button type="submit" class="btn btn-login w-100">Invia Email</button>
        </form>
    </div>
</div>
@endsection