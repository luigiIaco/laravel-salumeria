@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 p-2 shadow-md" role="alert" style="width: 30%; margin: 0 auto; position:relative; top:30px" id="confirmation">
    <p class="font-bold" style="margin-bottom:0px !important">{{session('success')}}</p>
</div>
@endif


@if ($errors->any())
<div role="alert" class="flex justify-center relative top-10">
    <div class="rounded-b bg-red-100 text-red-700" id="confirmation">
        <ul class="mb-0 p-3" style="padding-left: 0px;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
<div class="container text-center flex justify-center py-5">
    <div class="card">
        <!-- Logo Salumeria -->
        <img src="{{ asset('images/logo/logoSalumeria.png') }}" alt="Logo Salumeria" class="logo">
        <h2>Login</h2>

        <form method="POST" action="{{ route('loginForm') }}">
            @csrf

            <div class="mb-3 text-start">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $rememberDataUsers['email'] ?? '' }}" required autofocus>
            </div>

            <div class="mb-3 text-start">
                <div class="flex justify-between">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <button type="button"
                        class="btn btn-outline-secondary btn-sm mb-1"
                        onclick="togglePassword()">
                        <i class="fa-solid fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
                <input id="password" type="password" class="form-control" name="password" required value="{{ $rememberDataUsers['password'] ?? '' }}">
            </div>

            <div class="mb-3 form-check text-start">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">Ricordami</label>
            </div>

            <button type="submit" class="btn btn-success w-100">Accedi</button>

            <div class="mt-3">
                <a class="text-decoration-none text-muted" href="{{ route('page.forgotPassword') }}">
                    Hai dimenticato la password?
                </a>
            </div>

            <div class="mt-4 flex justify-center">
                <p class="text-muted">Non hai un account?
                    <a href="{{ url('/register') }}" class="btn-underline mx-1 link">Registrati ora</a>
                </p>

            </div>
        </form>
    </div>
</div>
@endsection
