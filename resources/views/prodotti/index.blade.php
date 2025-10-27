@extends('layouts.app')

@section('content')
<div class="container-fluid py-5">

    @if(!isset($category))
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5 text-dark">Tutti i Prodotti</h1>
        <p class="text-muted fs-2">Scopri la nostra selezione di salumi, formaggi e specialità italiane</p>
    </div>
    @else
    <h1 class="text-center">Hai scelto il nostro assortimento di <span style="text-decoration: underline; color: red;">{{$products[0]->category->name}}</span></h1>
    @endif

    <div class="row justify-content-center px-3 px-md-5">
        @foreach ($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm border-0 transition hover:scale-105 scale-in">
                <a href="{{ route('products.detail', $product->id) }}" @class([ 'text-decoration-none' , 'opacity-50'=> !$product->disponibilità, {{-- ad esempio se vuoi opacità quando non disponibile --}}
                    'opacity-100' => $product->disponibilità,
                    'pointer-events-none' => !$product->disponibilità
                    ])>
                    <img
                        src="{{$product->image}}"
                        class="card-img-top img-fluid rounded-top"
                        alt="{{ $product->nome }}"
                        style="height: 220px; object-fit: cover;">

                    <div class="card-body text-center">
                        <h5 class="card-title fw-semibold fs-2">{{ $product->nome }}</h5>
                        <p class="card-text text-danger fs-5 mb-2">
                            € {{ number_format($product->prezzo, 2, ',', '.') }} / kg
                        </p>
                        @if ($product->disponibilità)
                        <span class="badge bg-success px-3 py-2 fs-5">Disponibile</span>
                        @else
                        <span class="badge bg-danger px-3 py-2 fs-5">Non disponibile</span>
                        @endif
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection