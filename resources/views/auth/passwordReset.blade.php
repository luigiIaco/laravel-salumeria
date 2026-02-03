@extends('layouts.app')

@section('content')
<div class="container text-center flex justify-center py-5" style="position:relative">
    <div class="card">
        <!-- Logo Salumeria -->
        <img src="{{ asset('images/logo/logoSalumeria.png') }}" alt="Logo Salumeria" class="logo">
        <h2>Reset Password</h2>

        <form method="POST" action="{{ route('resetPassword') }}">
            @csrf

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

            <button type="submit" class="btn btn-success w-100">Cambia Password</button>
        </form>
    </div>
</div>
@endsection
