<?php

namespace App\Http\Controllers;

use App\Models\Carrello;
use App\Models\Prodotto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProdottoController extends Controller
{

    public $contatore = 0;
    // Tutti i prodotti
    public function index()
    {

        $products = Prodotto::orderBy('id', 'asc')->get();
        return view('prodotti.index', compact('products'));
    }

    // Dettaglio singolo prodotto
    public function show($id)
    {

        $product = Prodotto::findOrFail($id);
        $prev = Prodotto::where('id', '<', $id)->orderBy('id', 'desc')->first();

        // prodotto successivo
        $next = Prodotto::where('id', '>', $id)->orderBy('id', 'asc')->first();

        return view('prodotti.productDetails', compact('product', 'prev', 'next'));
    }

    public function showCategory($category)
    {

        $products = Prodotto::where("category_id", $category)->get();

        return view('prodotti.index', compact('products', 'category'));
    }

    public function cartPage()
    {
        return view('prodotti.carrello');
    }

    public function cartAdd(Request $request)
    {
        $product_id = $request['product_id'];
        $product = Prodotto::where("id", $product_id)->get();
        Log::info($product);
        $user = Auth::user();
        Carrello::create([
            'user_id' => $user->id,
            'product_id' => $product[0]->id,
            'quantita' => $request['quantità'],
            'prezzo' => (int) $product[0]->prezzo,
        ]);
        return redirect()->back()->with('success', 'Prodotto aggiunto al carrello!');
    }
}
