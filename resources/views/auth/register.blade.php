@extends('layouts.app')

@section('title', 'Registrazione - Salumeria Bella Vita')

@section('content')
<style>
    .register-card {
        background: #fff8f0;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        max-width: 420px;
        width: 100%;
        padding: 40px 30px;
        overflow: hidden;
    }

    .register-card h2 {
        color: #8B0000;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .register-card p {
        color: #6c757d;
        margin-bottom: 30px;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 15px;
    }

    .btn-register {
        background-color: #8B0000;
        color: #fff;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
        background-color: #A01A1A;
        transform: translateY(-2px);
    }

    .link-login {
        position: relative;
        display: inline-block;
        color: #8B0000;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .link-login::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 0;
        height: 2px;
        background-color: #8B0000;
        transition: width 0.3s ease;
    }

    .link-login:hover::after {
        width: 100%;
    }

    .link-login:hover {
        color: #A01A1A;
    }

    .logo {
        display: block;
        margin: 0 auto 1.5rem;
        width: 100px;
        height: auto;
        border-radius: 50%;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="container text-center flex justify-center py-5">
    <div class="register-card scale-in">
        <img src="{{ asset('images/logo/logoSalumeria.png') }}" alt="Logo Salumeria" class="logo">
        <h2>Registrati</h2>
        <p class="fw-semibold">Crea un account per scoprire i nostri prodotti e offerte esclusive</p>

        <form method="POST" action="{{ route('registerForm') }}">
            @csrf

            <div class="mb-3 text-start">
                <label for="name" class="form-label fw-semibold">Nome</label>
                <input type="text" name="name" id="name" class="form-control" required autofocus>
            </div>

            <div class="mb-3 text-start">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3 text-start">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-4 text-start">
                <label for="password_confirmation" class="form-label fw-semibold">Conferma Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-register w-100 py-2">Registrati</button>
        </form>

        <p class="mt-4 mb-0">
            Hai già un account?
            <a href="{{ route('login') }}" class="link-login">Accedi qui</a>
        </p>
    </div>
</div>
@endsection