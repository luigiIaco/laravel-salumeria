@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 90vh;">
    <div class="card shadow-lg border-0 text-center p-4 rounded-4" style="max-width: 480px;">
        <div class="card-body">

            <!-- Icona di successo -->
            <div class="mb-3">
                <i class="fa-solid fa-circle-check text-success fa-4x"></i>
            </div>

            <h2 class="fw-bold mb-3 text-success">Pagamento completato</h2>

            <p class="text-muted fs-5 mb-4">
                Caro <strong>{{ Auth()->user()->name }}</strong>, il tuo pagamento è andato a buon fine.<br>
                Ecco il riepilogo:
            </p>

            <!-- RIEPILOGO -->
            <ul class="list-group list-group-flush text-start mx-auto" style="max-width: 330px;">

                <li class="list-group-item d-flex justify-content-between">
                    <span class="fw-semibold">Importo:</span>
                    <span>{{ session('success')['amount'] }} €</span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span class="fw-semibold">Tipo di carta:</span>
                    <span class="
                        badge 
                        text-white 
                        px-3 py-2
                        @if(session('success')['brand'] === 'Visa') bg-primary
                        @elseif(session('success')['brand'] === 'Mastercard') bg-danger
                        @elseif(session('success')['brand'] === 'Discover') bg-warning text-dark
                        @else bg-secondary @endif
                    ">
                        {{ session('success')['brand'] }}
                    </span>
                </li>

                <li class="list-group-item d-flex justify-content-between">
                    <span class="fw-semibold">Numero carta:</span>
                    <span>{{ session('success')['cardNumber'] }}••••••••••••••</span>
                </li>

            </ul>

            <!-- Bottone -->
            <a href="{{ route('home') }}" class="btn btn-primary w-100 mt-4 py-2 rounded-3">
                <i class="fa-solid fa-house me-2"></i> Torna alla Home
            </a>
        </div>
    </div>
</div>
@endsection