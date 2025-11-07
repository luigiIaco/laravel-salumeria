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
        $items = Carrello::all();
        $prezzo_totale = Carrello::sum('prezzo');
        return view('prodotti.carrello', compact('items', 'prezzo_totale'));
    }

    public function cartAdd(Request $request)
    {
        $user = Auth::user();
        $product_id = $request['product_id'];
        $product = Prodotto::where("id", $product_id)->first();
        $productInTheCart = Carrello::where("product_id", $product_id)->first();
        if ($productInTheCart) {
            $productInTheCart->quantita += $request['quantità'];
            $productInTheCart->prezzo += $product->prezzo * $request['quantità'];
            $productInTheCart->save();
        } else {
            Carrello::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantita' => $request['quantità'],
                'prezzo' => (float) $product->prezzo * $request['quantità'],
            ]);
        }
        return redirect()->back()->with('success', 'Prodotto aggiunto al carrello!');
    }

    public function cartDelete(Request $request)
    {
        $quantitaToDelete = $request['quantita'];
        $product = Prodotto::where("nome", $request['nomeProdotto'])->first();
        $productToDelete = Carrello::where("product_id", $product->id)->first();
        $productToDelete->quantita -= $quantitaToDelete;
        $productToDelete->prezzo -= $product->prezzo * $quantitaToDelete;
        if ($productToDelete->quantita == 0) {
            $productToDelete->delete();
        } else {
            $productToDelete->save();
        }



        return redirect()->back()->with('success', 'Prodotto aggiunto al carrello!');
    }
}
