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

    public function showPaymentForm(Request $request)
    {
        Log::info($request);
        $numberCard = 0;
        $card_saved = false;
        $brand = '';
        $user = Auth::user();
        $total = Session::get('prezzoTotaleCarrello');
        $item = CreditCard::where("user_id", $user->id)->first();
        if ($request['saved_card'] == 'on') {
            $card_holder = $item->card_holder;
            $numberCardInput = $item->card_number;
            $exp_month = $item->exp_month;
            $exp_year = $item->exp_year;
            $cvv = $item->cvv;
            $checked = true;
        } else {
            $card_holder = '';
            $numberCardInput = '';
            $exp_month = '';
            $exp_year = '';
            $cvv = '';
            $checked = false;
        }
        if ($item) {
            $card_saved = true;
            $numberCard = $item->card_number;
            $firstFour = substr($numberCard, 0, 4);
            $brand = $item->brand;
        } else {
            $card_saved = false;
        }
        return view('payment.formPayment', compact('brand', 'card_saved', 'numberCard', 'checked', 'cvv', 'exp_month', 'exp_year', 'numberCardInput', 'card_holder', 'total'));
    }

    public function showPaymentConfirmation()
    {
        return view('payment.paymentConfirmation');
    }


    public function paymentProduct(Request $request)
    {
        $prezzoTotaleCarrello = Session::get('prezzoTotaleCarrello');
        $user = Auth::user();
        $item = CreditCard::where("user_id", $user->id)->first();

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
                'user_id' => $user->id,
                'card_holder' => $validatedData['holder'],
                'card_number' => $validatedData['numberCard'],
                'cvv' => $validatedData['cvv'],
                'brand' => $brand,
                'exp_month' => $validatedData['exp_month'],
                'exp_year' => $validatedData['exp_year']
            ]);
        }

        if (Payment::create([
            'user_id' => $user->id,
            'card_number' => Hash::make($validatedData['numberCard']),
            'amount' => $prezzoTotaleCarrello,
            'status' => 'OK',
        ])) {
            Carrello::truncate();
            $item = CreditCard::where("card_number", $validatedData['numberCard'])->first();
            if ($item) {
                $item->credit -= $prezzoTotaleCarrello;
                $item->save();
            }
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
