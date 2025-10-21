<?php

// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prodotto;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categories'; // se il nome non è "products"

    protected $fillable = [
        'name'
    ];

    /**
     * Relazione con i prodotti (una categoria ha molti prodotti)
     */
    public function prodotti()
    {
        return $this->hasMany(Prodotto::class, 'category_id');
    }
}
