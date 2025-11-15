@extends('layouts.app')

@section('content')
<div class="container text-center flex justify-center py-5" style="position: relative; top:90px">
    <div class="card">
        <!-- Logo Salumeria -->
        <img src="{{ asset('images/logo/logoSalumeria.png') }}" alt="Logo Salumeria" class="logo">
        <h2>Recupera Password</h2>

        <form method="POST" action="{{ route('forgotPassword') }}">
            @csrf

            <div class="mb-3 text-start">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ $rememberDataUsers['email'] ?? '' }}" required autofocus>
            </div>

            <button type="submit" class="btn btn-success w-100">Invia Email</button>
        </form>
    </div>
</div>
@endsection