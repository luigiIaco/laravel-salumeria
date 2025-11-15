<?php

namespace App\Http\Controllers;

use App\Models\Carrello;
use App\Models\CreditCard;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function showPaymentForm()
    {
        return view('payment.formPayment');
    }

    public function showPaymentConfirmation()
    {
        return view('payment.paymentConfirmation');
    }


    public function paymentProduct(Request $request)
    {

        $prezzoTotaleCarrello = Session::get('prezzoTotaleCarrello');

        $validatedData = $request->validate([
            'holder'      => 'required|string|max:255',
            'numberCard'  => 'required', // numero carta valido
            'exp_month'   => 'required|digits_between:01,12',             // 01-12
            'exp_year'    => 'required|digits:2',             // 2 cifre
            'cvv'         => 'required',   // VISA/MasterCard = 3, Amex = 4
        ]);

        $firstFour = substr($request['numberCard'], 0, 4);
        if (is_numeric($firstFour) && $firstFour >= 1000 && $firstFour <= 2000) {
            $brand = 'Visa';
        } else if (is_numeric($firstFour) && $firstFour >= 2001 && $firstFour <= 3000) {
            $brand = 'Mastercard';
        } else if (is_numeric($firstFour) && $firstFour >= 3001 && $firstFour <= 4000) {
            $brand = 'Discover';
        } else {
            $brand = 'unknown';
        };


        if ($request->has('save_card')) {
            CreditCard::create([
                'card_holder' => $validatedData['holder'],
                'card_number_encrypted' => Hash::make($validatedData['numberCard']),
                'cvv' => $validatedData['cvv'],
                'brand' => $brand,
                'exp_month' => $validatedData['exp_month'],
                'exp_year' => $validatedData['exp_year']
            ]);
        }

        $user = Auth::user();

        if(Payment::create([
            'user_id' => $user->id,
            'card_number' => Hash::make($validatedData['numberCard']),
            'amount' => $prezzoTotaleCarrello,
            'status' => 'OK',
        ])) {
            Carrello::truncate();
        }



        $transactionData = [
            "cardNumber" => $firstFour,
            "brand" => $brand,
            "amount" => $prezzoTotaleCarrello,
            "status" => "OK"
        ];

        return redirect()->route('page.paymentConfirmation')->with('success', $transactionData);
    }
}
