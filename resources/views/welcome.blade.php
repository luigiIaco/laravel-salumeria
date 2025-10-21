{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

<style>
    * {
        margin: 0;
        padding: 0;

    }
</style>

@section('title', 'Salumeria Bella Vita')

@section('content')
<!-- Hero -->
<!-- Navbar -->

<section class="bg-emerald-600 text-white text-center py-5 scale-in" style="animation-delay: .5s;">
    <div class="container">
        <h1 class="fw-bold">Benvenuti alla Salumeria Bella Vita</h1>
        <p class="lead fs-3">Tradizione e gusto dal cuore dell’Italia</p>
        <a href="{{ url('/products') }}" class="btn btn-warning btn-lg mt-3">Catalogo prodotti</a>
    </div>
</section>

<!-- Chi siamo -->
<section class="py-5 scale-in" id="chi-siamo" style="animation-delay: 1s;">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Chi Siamo</h2>
        <p class="text-muted fs-5 fw-semibold">
            La nostra salumeria è un luogo dove la qualità incontra la tradizione.
            Offriamo una selezione di salumi artigianali, formaggi tipici e prodotti genuini.
            Da oltre 30 anni portiamo sulle vostre tavole il meglio della tradizione gastronomica italiana.
        </p>
    </div>
</section>

<!-- Prodotti -->
<section id="prodotti" class="py-5 bg-light scale-in" style="animation-delay: 1.5s;">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">I Nostri Prodotti</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <a href="{{ route('products.showCategory', 1) }}" style="text-decoration: none;">
                    <div class="card h-100 shadow-sm transform transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('images/salumi.jpg') }}" alt="Logo Salumeria">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-semibold">Salumi</h5>
                            <p class="card-text fs-4">Prosciutti, salami e specialità locali selezionate con cura.</p>
                        </div>
                    </div>
                </a>

            </div>

            <div class="col-md-4">
                <a href="{{ route('products.showCategory', 2) }}" style="text-decoration: none;">
                    <div class="card h-100 shadow-sm transform transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('images/formaggi.jpg') }}" alt="Logo Salumeria">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-semibold">Formaggi</h5>
                            <p class="card-text fs-4">Dai pecorini stagionati ai freschi, solo il meglio delle malghe italiane.</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('products.showCategory', 3) }}" style="text-decoration: none;">
                    <div class="card h-100 shadow-sm transform transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('images/vino.jpg') }}" alt="Logo Salumeria">
                        <div class="card-body text-center">
                            <h5 class="card-title fw-semibold">Vini & Specialità</h5>
                            <p class="card-text fs-4">Una selezione di vini locali e prodotti tipici per accompagnare i tuoi piatti.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contatti -->
<section class="py-5 text-center" id="contattaci" style="animation-delay: 2s;">
    <div class="container">
        <h2 class="fw-bold mb-4">Contattaci</h2>
        <p class="text-muted">📍 Via Roma 123, Bologna</p>
        <p class="text-muted">📞 +39 051 1234567</p>
        <p class="text-muted">✉️ info@salumeriabellavita.it</p>
    </div>
</section>
@endsection