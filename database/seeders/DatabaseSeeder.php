<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            EnderecoSeeder::class,
            BarbeiroSeeder::class,
            ClienteSeeder::class,
            IntervaloSeeder::class,
            ServicosSeeder::class,
            PendenteSeeder::class
        ]);
    }
}
