@extends('layouts.app')

@section('content')
<div class="container text-center flex justify-center py-5">
    <div class="card scale-in">
        <img src="{{ asset('images/logo/logoSalumeria.png') }}" alt="Logo Salumeria" class="logo">
        <h2>Registrati</h2>

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
                <div class="flex justify-between">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <button type="button"
                        class="btn btn-outline-secondary btn-sm mb-1"
                        onclick="togglePassword()"
                        >
                        <i class="fa-solid fa-eye" id="toggleIcon"></i>
                    </button>
                </div>

                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-4 text-start">
                <label for="password_confirmation" class="form-label fw-semibold">Conferma Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100 py-2 ">Registrati</button>
        </form>

        <p class="mt-4 mb-0">
            Hai già un account?
            <a href="{{ route('login') }}" class="link btn-underline">Accedi qui</a>
        </p>
    </div>
</div>
@endsection