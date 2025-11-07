<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrello extends Model
{
    protected $table = 'carrelli';
    protected $fillable = ['user_id', 'product_id', 'quantita', 'prezzo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prodotto()
    {
        return $this->belongsTo(Prodotto::class, 'product_id');
    }
}
