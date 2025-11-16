@extends('layouts.app')

@section('content')
<h1 class="text-center fw-semibold relative top-10">Dettagli dei nostri prodotti</h1>
<!-- 🔙 Pulsante Torna ai Prodotti -->
<a href="{{ url('/products') }}" class="back-button">
    <i class="fa-solid fa-arrow-left"></i>
    <span>Torna ai prodotti</span>
</a>

<!-- 🔹 Contenitore principale -->
<div class="product-container">
    <div class="product-card">
        <!-- Immagine con frecce -->
        <div class="product-image">
            @if($prev)
            <a href="{{ route('products.detail', $prev->id) }}" class="nav-arrow left" title="Prodotto precedente">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            @endif

            <img src="{{ $product->image }}"
                alt="{{ $product->nome }}">

            @if($next)
            <a href="{{ route('products.detail', $next->id) }}" class="nav-arrow right" title="Prodotto successivo">
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            @endif
        </div>

        <!-- Dettagli -->
        <div class="product-details">
            <h1 class="product-title">{{ $product->nome }}</h1>
            <p class="product-description">{{ $product->descrizione }}</p>
            <p class="product-price">€ {{ number_format($product->prezzo, 2, ',', '.') }} / kg</p>

            <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                @if($product->disponibilità)
                <input type="number" name="quantità" value="1" min="1"
                    class="w-16 border border-[#d1b58a] rounded-lg text-center py-1 focus:ring-2 focus:ring-[#B3543E]">
                <button type="submit" class="btn">
                    <i class="fa-solid fa-cart-plus fa-xl"></i>
                </button>
                @if(session('success'))
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 p-2 shadow-md mt-2" id="confirmation" role="alert" style="width: 40%">
                    <p class="font-bold" style="margin-bottom:0px !important">{{session('success')}}</p>
                </div>
                @endif
                @else
                <p class="bg-danger text-white rounded-pill px-3 py-1 d-inline-block fw-semibold fs-5">
                    Esaurito
                </p>
                @endif
            </form>

        </div>
    </div>
</div>
@endsection