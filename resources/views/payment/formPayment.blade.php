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

            <button type="submit" class="btn btn-primary w-100 mt-4">Paga ora</button>
        </form>

        <div id="message" class="alert mt-3 d-none"></div>
    </div>
</div>
@endsection
