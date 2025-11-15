<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{

    protected $table = 'credit_cards'; 
    protected $fillable = [
        'card_holder',
        'card_number_encrypted',
        'cvv',
        'brand',
        'exp_month',
        'exp_year',
        'credit'
    ];
}
