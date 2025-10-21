<?php
// app/Models/Prodotto.php

namespace App\Models;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodotto extends Model
{
    use HasFactory;

    protected $table = 'prodotti'; // se il nome non è "products"

    protected $fillable = [
        'nome',
        'descrizione',
        'prezzo',
        'disponibiità',
        'category_id', // aggiungi questo se usi mass assignment
    ];

    /**
     * Relazione con la categoria (un prodotto appartiene a una categoria)
     */
    public function category()
    {
        return $this->belongsTo(Categoria::class, 'category_id');
    }
}

