<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Prodotto;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->count(5)->create();

        $nomi = ['Salumi', 'Formaggi', 'Vini'];

        foreach ($nomi as $nome) {
            Categoria::factory()->create(['name' => $nome]);
        }
        //Categoria::factory()->count(3)->create();
        //rodotto::factory()->count(3)->create();
    }
}
