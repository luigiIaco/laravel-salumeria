@extends('layouts.app')


<style>
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

    @keyframes slideInLeft {
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

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
</style>
@section('content')
<div class="bg-[#D8B384]/30 py-12 px-6 sm:px-16 font-sans" style="height: 80.6vh;">
    <a href="{{ url('/products') }}" class="back-button">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Torna ai prodotti</span>
    </a>

    <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl border border-[#e6d2b4] mt-5">

        <!-- Header -->
        <div class="bg-gradient-to-r from-[#5A3E2B] to-[#B3543E] text-white p-4">
            <h2 class="text-3xl font-bold tracking-wide text-center">🧺 Il tuo carrello</h2>
        </div>



        <div class="divide-y divide-[#ecdcc3]" style="max-height: 500px; overflow: scroll;">
            @if(count($items) == 0)
            <p class="text-center p-3 fs-3">Il carrello è vuoto</p>
            @endif
            {{-- PRODOTTO --}}
            @foreach ($items as $item)
            <div class="flex flex-col sm:flex-row items-center p-3 hover:bg-[#fdf8f2] transition relative">
                <!-- Immagine -->
                <div class="flex-shrink-0">
                    <img src="{{$item->prodotto->image}}"
                        alt="{{$item->prodotto->nome}}"
                        class="w-28 h-28 object-cover rounded-2xl shadow-md border border-[#e8d7b7]">
                </div>

                <!-- Dettagli prodotto -->
                <div class="flex-1 sm:ml-8 mt-6 sm:mt-0 text-center sm:text-left">
                    <h3 class="text-xl font-semibold text-[#5A3E2B]">{{$item->prodotto->nome}}</h3>
                    <p class="text-gray-600 text-sm italic mt-1">
                        {{$item->prodotto->descrizione}}
                    </p>
                    <p class="mt-3 font-bold text-[#B3543E] text-lg">€ {{$item->prezzo}} (hai preso {{$item->quantita}} pezzo)</p>
                </div>


                <form action="{{ route('cart.delete') }}" method="POST" class="absolute top-3 right-0 delete-form">
                    @csrf
                    <div class="flex items-center gap-2">
                        <input type="hidden" name="nomeProdotto" value="{{$item->prodotto->nome}}">
                        <input
                            type="number"
                            name="quantita"
                            min="1"
                            max="{{ $item->quantita }}"
                            value="1"
                            class="w-16 border border-gray-300 rounded text-center py-1"
                            style="outline: none;">

                        <!-- Bottone che apre la modale -->
                        <button type="button"
                            class="text-danger border-0 bg-transparent"
                            onclick="openConfirmModal(this)">
                            <i class="fa-solid fa-trash fa-lg"></i>
                        </button>
                    </div>
                </form>

            </div>
            @endforeach
        </div>

        <!-- Totale -->
        <div class="bg-[#fff7ed] p-3 flex flex-col sm:flex-row justify-between items-center border-t border-[#e8d7b7]">
            <h3 class="text-xl font-semibold text-[#5A3E2B]">
                Totale: <span class="text-[#B3543E] text-2xl font-bold">€ {{$prezzo_totale}}</span>
            </h3>

            <a href="#"
                class="sm:mt-0 inline-block bg-gradient-to-r from-[#B3543E] to-[#5A3E2B] text-white p-3 rounded-full shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition">
                Procedi al pagamento 💳
            </a>
        </div>

    </div>
</div>
@endsection