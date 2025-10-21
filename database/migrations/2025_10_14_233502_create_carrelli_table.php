<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carrelli', function (Blueprint $table) {
            $table->id();

            // 🔹 Chiave esterna verso l’utente (chi ha aggiunto al carrello)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // 🔹 Chiave esterna verso il prodotto
            $table->foreignId('product_id')
                  ->constrained('prodotti')
                  ->onDelete('cascade');

            // 🔹 Quantità del prodotto nel carrello
            $table->integer('quantita')->default(1);

            // 🔹 Prezzo totale (opzionale, utile se vuoi memorizzare snapshot)
            $table->decimal('prezzo_totale', 8, 2)->nullable();

            // 🔹 Timestamp di creazione e aggiornamento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrelli');
    }
};