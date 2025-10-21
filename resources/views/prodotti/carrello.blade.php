@extends('layouts.app')

@section('title', 'Il tuo carrello')

@section('content')
<div class="min-h-screen bg-[#D8B384]/30 py-12 px-6 sm:px-16 font-sans">
    <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl overflow-hidden border border-[#e6d2b4]">

        <!-- Header -->
        <div class="bg-gradient-to-r from-[#5A3E2B] to-[#B3543E] text-white px-8 py-5 flex justify-between items-center">
            <h2 class="text-3xl font-bold tracking-wide">🧺 Il tuo carrello</h2>
            <a href="{{ route('products.show') }}"
                class="text-sm bg-white/10 px-4 py-2 rounded-xl hover:bg-white/20 transition">
                Continua gli acquisti
            </a>
        </div>

        <!-- Lista prodotti -->
        <div class="divide-y divide-[#ecdcc3]">

            {{-- PRODOTTO --}}
            <div class="flex flex-col sm:flex-row items-center justify-between p-8 hover:bg-[#fdf8f2] transition relative">
                <!-- Immagine -->
                <div class="flex-shrink-0">
                    <img src=""
                        alt="Parmigiano Reggiano 30 mesi"
                        class="w-28 h-28 object-cover rounded-2xl shadow-md border border-[#e8d7b7]">
                </div>

                <!-- Dettagli prodotto -->
                <div class="flex-1 sm:ml-8 mt-6 sm:mt-0 text-center sm:text-left">
                    <h3 class="text-xl font-semibold text-[#5A3E2B]">Parmigiano Reggiano 30 mesi</h3>
                    <p class="text-gray-600 text-sm italic mt-1">
                        Stagionatura lunga, gusto intenso e armonioso.
                    </p>
                    <p class="mt-3 font-bold text-[#B3543E] text-lg">€ 14,90</p>
                </div>



                <form action="" method="POST" class="absolute bottom-2 right-1">
                    @csrf
                    @method('PUT')
                    Quantità:&nbsp;<input type="number" name="quantita" value="1" min="1"
                        class="w-16 border border-[#d1b58a] rounded-lg text-center py-1 focus:ring-2 focus:ring-[#B3543E]">
                </form>

                <form action="" method="POST" class="absolute top-1 right-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline font-medium">
                        <i class="fa-solid fa-trash fa-lg"></i>
                    </button>
                </form>
            </div>

        </div>

        <!-- Totale -->
        <div class="bg-[#fff7ed] px-8 py-6 flex flex-col sm:flex-row justify-between items-center border-t border-[#e8d7b7]">
            <h3 class="text-xl font-semibold text-[#5A3E2B]">
                Totale: <span class="text-[#B3543E] text-2xl font-bold">€ 34,80</span>
            </h3>

            <a href="#"
                class="mt-4 sm:mt-0 inline-block bg-gradient-to-r from-[#B3543E] to-[#5A3E2B] text-white px-8 py-3 rounded-full shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition">
                Procedi al pagamento 💳
            </a>
        </div>

    </div>
</div>
@endsection