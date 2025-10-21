<?php

namespace App\Http\Controllers;

use App\Models\Prodotto;
use App\Services\ProductApiService;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

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


        Log::info($products);

        return view('prodotti.index', compact('products', 'category'));
    }

    public function cartPage()
    {
        return view('prodotti.carrello');
    }
}
