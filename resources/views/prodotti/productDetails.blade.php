@extends('layouts.app')

<style>
    /* 🔹 Contenitore principale */
    .product-container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 74.8vh;
    }

    @keyframes popIn {
        0% {
            transform: scale(1);
        }

        60% {
            transform: scale(1.1);
        }

        100% {
            transform: scale(1);
        }
    }


    /* 🔹 Card principale */
    .product-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: row;
        overflow: hidden;
        max-width: 900px;
        width: 100%;
        animation: fadeIn 0.7s ease forwards;
        transform-origin: top center;
        position: relative;
    }

    /* 🔹 Sezione immagine */
    .product-image {
        flex: 1;
        position: relative;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .product-image:hover img {
        transform: scale(1.05);
    }

    /* 🔹 Frecce navigazione */
    .nav-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.6);
        color: white;
        border: none;
        padding: 12px 15px;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .nav-arrow:hover {
        background: rgba(0, 0, 0, 0.85);
        transform: translateY(-50%) scale(1.1);
    }

    .nav-arrow.left {
        left: 15px;
    }

    .nav-arrow.right {
        right: 15px;
    }

    /* 🔹 Dettagli prodotto */
    .product-details {
        flex: 1;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .product-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .product-description {
        font-size: 1rem;
        color: #555;
        margin-bottom: 25px;
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: 600;
        color: #e63946;
        margin-bottom: 25px;
    }

    .btn-cart {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        font-size: 1rem;
        transition: background 0.3s ease;
        align-self: start;
    }

    .btn-cart:hover {
        background-color: #0056b3;
    }

    /* 🔹 Pulsante "Torna ai prodotti" */
    .back-button {
        position: absolute;
        top: 45%;
        left: 2%;
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.9);
        color: #333;
        border-radius: 50px;
        padding: 12px 22px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        z-index: 1000;
        overflow: hidden;
        opacity: 1;
        transform: translateX(-30px);
        animation: slideInLeft 0.6s ease forwards 0.4s;
        animation: popIn 1.5s ease-in-out infinite;
    }

    .back-button i {
        transition: transform 0.3s ease;
    }

    .back-button:hover {
        background: white;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
    }

    .back-button:hover i {
        transform: translateX(-5px);
    }

    /* Effetto luce */
    .back-button::after {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(120deg, transparent 0%, rgba(255, 255, 255, 0.5) 50%, transparent 100%);
        transition: all 0.6s ease;
    }

    .back-button:hover::after {
        left: 100%;
    }

    /* 🔹 Animazioni */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes slideInLeft {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @media (max-width: 768px) {
        .product-card {
            flex-direction: column;
        }

        .product-details {
            padding: 20px;
        }

        .back-button {
            top: 20px;
            left: 20px;
            font-size: 14px;
            padding: 10px 16px;
        }
    }
</style>

@section('content')
<h1 class="text-center fw-semibold relative top-10">Dettagli dei nostri prodotti</h1>
@if(session('success'))
<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 p-2 shadow-md mb-3 relative top-35" id="confirmation" role="alert" style="width: 16%; margin: 0 auto;">
    <p class="font-bold" style="margin-bottom:0px !important">{{session('success')}}</p>
</div>
@endif
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