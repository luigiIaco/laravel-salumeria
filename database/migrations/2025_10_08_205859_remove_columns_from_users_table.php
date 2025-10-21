<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Svuota tutti i dati della tabella users
        DB::table('users')->truncate();
    }

    public function down(): void
    {
        // Non c'è rollback possibile dei dati
    }
};

