@extends('layouts.app')

@section('content')
<div class="container text-center flex justify-center py-5">
    <div class="card scale-in p-4 shadow-lg" style="max-width: 500px; margin: 0 auto;">
        <img src="{{ asset('images/logo/logoSalumeria.png') }}" alt="Logo Salumeria" class="logo mb-3" style="max-width:150px;">
        <h4 class="mb-3 text-center">Pagamento con Carta</h4>

        <form method="POST" action="{{ route('paymentForm') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Intestatario della carta</label>
                <input type="text" id="card_holder" class="form-control" placeholder="Mario Rossi" name="holder" value="{{$card_holder}}" required>
            </div>

            <div class="mb-3" style="position: relative;">
                <label class="form-label">Numero carta</label>
                <div class="flex justify-between">
                    <input
                        type="text"
                        id="card_number"
                        class="form-control"
                        maxlength="19"
                        placeholder="4111 1111 1111 1111"
                        name="numberCard"
                        required
                        value="{{$numberCardInput}}"
                        style="width: 85%;">

                    <i id="visa_logo" class="fa-brands fa-cc-visa" style="font-size: 44px; display: none;"></i>
                    <i id="mastercard_logo" class="fa-brands fa-cc-mastercard" style="font-size: 44px; display: none;"></i>
                    <i id="discover_logo" class="fa-brands fa-cc-discover" style="font-size: 44px; display: none;"></i>
                </div>
            </div>


            <div class="row">
                <div class="col-4">
                    <label class="form-label">Mese</label>
                    <input type="text" id="exp_month" class="form-control" maxlength="2" minlength="2" placeholder="MM" name="exp_month" value="{{$exp_month}}" required>
                </div>
                <div class="col-4">
                    <label class="form-label">Anno</label>
                    <input type="text" id="exp_year" class="form-control" maxlength="2" placeholder="YY" name="exp_year" value="{{$exp_year}}" required>
                </div>
                <div class="col-4">
                    <label class="form-label">CVV</label>
                    <input type="text" id="cvv" class="form-control" maxlength="3" placeholder="123" name="cvv" value="{{$cvv}}" required>
                </div>
            </div>

            <div class="mt-3">
                <label class="form-label">Importo (€)</label>
                <input type="number" step="0.01" id="amount" class="form-control text-center" value="{{$total}}" disabled>
            </div>

            <!-- ✅ Checkbox "salva carta" -->
            <div class="mt-3">
                @if ($card_saved)
                <p class="mb-0 fw-semibold">Seleziona la carta che vuoi usare:</p>
                <div class="card p-3 mb-3 shadow-sm border-0 rounded-3">

                    <label class="d-flex align-items-center gap-3 cursor-pointer mx-4">

                        <!-- Icona Brand -->
                        @if ($brand === 'Visa')
                        <i class="fa-brands fa-cc-visa text-primary fs-1"></i>
                        @elseif ($brand === 'Mastercard')
                        <i class="fa-brands fa-cc-mastercard text-danger fs-1"></i>
                        @elseif ($brand === 'Discover')
                        <i class="fa-brands fa-cc-discover text-warning fs-1"></i>
                        @else
                        <span class="badge bg-secondary">Sconosciuto</span>
                        @endif

                        <!-- Testo carta -->
                        <div class="ms-2">
                            <small class="text-muted">
                                {{ $firstFour }} •••• •••• ••••
                            </small>
                        </div>

                    </label>

                </div>


                @else
                <input class="form-check-input" type="checkbox" value="1" name="save_card">
                <label class="form-check-label" for="save_card">
                    Salva questa carta per futuri pagamenti
                </label>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4">Paga ora</button>
        </form>

        <form method="GET" action="{{ route('page.paymentForm') }}" id="form" style="position:relative;right:205px;bottom:125px">
            <input type="checkbox" name="saved_card" class="form-check-input mx-1" id="checkbox" @checked($checked) />
        </form>

        <div id="message" class="alert mt-3 d-none"></div>
    </div>
</div>
@endsection