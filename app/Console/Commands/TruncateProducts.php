<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Conferma prima di cancellare
        if ($this->confirm('Sei sicuro di voler svuotare la tabella prodotti? Tutti i dati saranno persi!')) {
            DB::table('prodotti')->truncate();
            $this->info('Tabella prodotti svuotata con successo.');
        } else {
            $this->info('Operazione annullata.');
        }

        return 0;
    }
}
