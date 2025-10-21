<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Qui puoi scegliere il nome del comando: php artisan users:truncate
     */
    protected $signature = 'users:truncate';

    /**
     * The console command description.
     */
    protected $description = 'Svuota la tabella users senza cancellare la migration';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // Conferma prima di cancellare
        if ($this->confirm('Sei sicuro di voler svuotare la tabella users? Tutti i dati saranno persi!')) {
            DB::table('categories')->truncate();
            $this->info('Tabella users svuotata con successo.');
        } else {
            $this->info('Operazione annullata.');
        }

        return 0;
    }
}