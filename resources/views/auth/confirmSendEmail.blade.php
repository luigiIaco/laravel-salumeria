@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 85vh;">
    <div class="card shadow-lg border-0 text-center p-4" style="max-width: 450px;">
        <div class="card-body">
            <div class="mb-3">
                <i class="fa-solid fa-circle-check text-success fa-4x"></i>
            </div>
            <h2 class="fw-bold mb-3 text-success">Operazione completata</h2>
            <p class="text-muted fs-5">
                Controlla la tua casella di posta. Ti abbiamo inviato un email per il reset della password
            </p>

            <a href="{{ route('home') }}" class="btn btn-primary w-100 mt-3">
                <i class="fa-solid fa-house me-2"></i> Torna alla home
            </a>
        </div>
    </div>
</div>
@endsection