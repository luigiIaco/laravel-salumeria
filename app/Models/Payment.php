<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments'; 
    protected $fillable = [
        'user_id',
        'card_number',
        'amount',
        'currency',
        'status',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function credit_card()
    {
        return $this->belongsTo(CreditCard::class);
    }
}
